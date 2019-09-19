<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// call & use spreadsheet vendor
require FCPATH . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Html;

class Excel extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('Model');
    $this->load->library('form_validation');
  }

  public function index() {
  	$this->check_import();
  }

  public function generateChar($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $div = ($num - 1) / 26;
    $num2 = (int)$div;
    if ($num2 > 0) {
        return $this->generateChar($num2) . $letter;
    } else {
        return $letter;
    }
  }

  public function getLetters($num_col) {
    // initialize array to hold coloumn character
    $letters = [];

    // generate char based on coloumn in db
    for($i=1; $i <= $num_col; $i++) {
      $char = $this->generateChar($i);
      array_push($letters, $char);
    }

    return $letters;
  }

  public function export() {

    // get number & name fields
    $fields = $this->Model->getFields('applicant');
    $num_col = $this->Model->getCol('applicant');

    // get letters array
    $alphabet = $this->getLetters($num_col);

    // create object
    $xlsx = new Spreadsheet();
    $sheet = $xlsx->getActiveSheet();

    // give style
    $style = [
      'font' => [
        'bold' => true
      ], 
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
        'bottom' => [
          'borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          'color' => [ 'rgb' => 333333 ]
        ]
      ],
      'fill' => [
        'type'       => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
        'rotation'   => 90,
        'startcolor' => array('rgb' => '0d0d0d'),
        'endColor'   => array('rgb' => 'f2f2f2'),
      ]
    ];
    // apply style to header
    $xlsx->getActiveSheet()->getStyle($alphabet[0].'1:'.$alphabet[$num_col-1].'1')->applyFromArray($style);

    // autofit coloumn
    foreach(range($alphabet[0], $alphabet[$num_col-1]) as $columnID) {
      $xlsx->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }

    // set header name
    $x=0;
    foreach ($fields as $field) {
      $sheet->setCellValue($alphabet[$x].'1', $field);
      $x++;
    }

    // get data from db
    $getdata = $this->Model->getAll('applicant')->result_array();

    // push data
    $i = 2; //starting row
    foreach( $getdata as $get ) {
      $n=0;
      foreach ($fields as $field) {
        $sheet->setCellValue("$alphabet[$n]$i", $get[$field]);
        $n++;
      }
      $i++;
    }

    // create excel
    $write = new Xlsx($xlsx);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="data_export.xlsx"');
    $write->save('php://output');
  }

  public function dl_format() {
    $fields = $this->Model->getFields('applicant');

  	$htmlString = '<table>';
    $htmlString .= '<tr>';
    foreach ($fields as $field) {
    	$htmlString .= '<th align="center" style="font-weight:bold">';
    	$htmlString .= $field;
    	$htmlString .= '</th>';
    }
    $htmlString .= '</tr>';
		$htmlString .= '</table>';

		// convert to spreadsheet-type
	 	$reader = new Html();
		$spreadsheet = $reader->loadFromString($htmlString);

		// // generate excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="formatX.xlsx"');
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
  }

  public function check_import() {
  	// load upload library
		$this->load->library('upload');
  	$data['title'] = 'import data from excel';

  	// get fieldsname & number of coloumn
    $data['fields'] = $this->Model->getFields('applicant');
    $num_col = $this->Model->getCol('applicant');

    // get letters array
    $alphabet = $this->getLetters($num_col);

  	$this->load->view('header', $data);
  	$this->load->view('import');

    // check if preview button was clicked
    if(isset($_POST['preview'])) {

    	// set config for uploaded file
    	$config['upload_path']          = './uploads/';
      $config['allowed_types']        = 'xlsx';
      $config['file_name']						= 'import_data';
      $config['overwrite']						= TRUE;

      // load upload library config
      $this->upload->initialize($config);

      // if uploaded
      if ( $this->upload->do_upload('file_import') ) {
      	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      	// read file that has been uploaded using specific reader
      	$spreadsheet = $reader->load('./uploads/'.$this->upload->data('file_name'));

      	// get all retrieved data from cell to array
      	$data['sheet'] = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
      	$data['letters'] = $alphabet;

      	$this->load->view('import_preview', $data);
      } 
      // if failed upload
      else {
      	// var_dump($this->upload->display_errors());
	      $this->session->set_flashdata('flash', 'File failed to upload :(');
	      redirect('excel/check_import');
      }
	  }
  }

  public function import() {
  	// get number of coloumn
    $fields = $this->Model->getFields('applicant');
    $num_col = $this->Model->getCol('applicant');

    // get letters array
    $alphabet = $this->getLetters($num_col);

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  	$spreadsheet = $reader->load('./uploads/import_data.xlsx');

  	$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
  	// $data['letters'] = $alphabet;

    // initialize array to hold inserted data 
  	$datas = [];
  	$data = [];

  	// var_dump($alphabet);
  	// foreach ($sheet as $row) {
  	// 	foreach ($fields as $field) {
	  // 		for ($i=0; $i < $num_col; $i++) { 
		 //  		array_push($data, [
		 //  			"{$field}" => $row[$alphabet[$i]],
		 //  		]);
		 //  		continue;
	  // 		}
	  // 		continue;
  	// 	}
  	// 	array_push($datas, $data);
  	// }

  	// var_dump($data);

  	foreach ($sheet as $row) {
  		array_push($data, [
  			'first_name' => $row['B'],
  			'last_name' => $row['C'],
  			'gender' => $row['D'],
  			'phone' => $row['E'],
  			'email' => $row['F'],
  			'skill' => $row['G']
  		]);
  	}

  	$this->Model->post_batch('applicant', $data);
	  $this->session->set_flashdata('flash', 'Import data has been inserted');
	  redirect('');
  }
  
}