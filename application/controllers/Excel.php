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
  }

  public function export() {

    // array to hold coloumn character
    $alphabet = [];

    // get number & name fields
    $fields = $this->Model->getFields('applicant');
    $num_col = $this->Model->getCol('applicant');

    // generate char based on coloumn in db
    for($i=1; $i <= $num_col; $i++) {
      $char = $this->generateChar($i);
      array_push($alphabet, $char);
    }

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

    // set session flash message
    $this->session->set_flashdata('flash', 'Excel has been successfully generated'); 
    redirect('');
  }

  public function dl_format() {
    $fields = $this->Model->getFields('buku');

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

  public function import() {
  	$data['title'] = 'import data from excel';

  	if ($this->input->post) {
  		$this->load->view('import_preview');
  	}

  	$this->load->view('header', $data);
  	$this->load->view('import');
  }

  public function ez() {
		$arr_file = explode('.', $_FILES['file']['name']);
    $extension = end($arr_file);
 
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
 
    $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
     
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    // print_r($sheetData);
    foreach ($sheetData as $damn) {
    	foreach ($damn as $key => $value) {
    		# code...
    	print_r($damn);
    	echo '<br>';
    	}
    }
  }
}