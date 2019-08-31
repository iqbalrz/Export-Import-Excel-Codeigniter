<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// call & use spreadsheet vendor
// require FCPATH . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('Model');
  }

  public function index() {
    

    $data['buku'] = $this->Model->getAll('buku')->result_array();
    $data['fields'] = $this->Model->getFields('buku');
    $data['numCol'] = $this->Model->getCol('buku');

    $this->load->view('preview', $data);
  }

  public function export() {

    // set range coloumn (a maximum of 26 coloumns)
    $alphabet = [ 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z'];

    // get number & name fields
    $fields = $this->Model->getFields('buku');
    $num_col = $this->Model->getCol('buku');

    // create object
    $xlsx = new Spreadsheet();
    $sheet = $xlsx->getActiveSheet();

    // give style
    $styleArray = [
      'font' => [
        'bold' => true
      ], 
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
        'bottom' => [
          'borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
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
    $xlsx->getActiveSheet()->getStyle($alphabet[0].'1:'.$alphabet[$num_col].'1')->applyFromArray($styleArray);

    // autofit coloumn
    foreach(range($alphabet[0], $alphabet[$num_col]) as $columnID) {
      $xlsx->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }

    // set header name
    $x=0;
    foreach ($fields as $field) {
      $sheet->setCellValue($alphabet[$x].'1', $field);
      $x++;
    }

    // get data from db
    $getdata = $this->Model->getAll('buku')->result_array();
    // // $length = count($getdata);

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
    $write->save('export/data_export.xlsx');

    // set session flash message
    $this->session->set_flashdata('flash', 'Excel has been successfully generated'); 
    redirect('');
  }
}