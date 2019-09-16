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

  public function index() {
    $data['title'] = 'preview data';

    $data['datas'] = $this->Model->getAll('applicant')->result_array();
    $data['fields'] = $this->Model->getFields('applicant');
    $data['numCol'] = $this->Model->getCol('applicant');

    $this->load->view('header', $data);
    $this->load->view('preview', $data);
  }

  public function new_data() {
    $data['title'] = 'insert data';

    if( $this->input->post('first_name') ) {
      $data = [
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'gender' => $this->input->post('gender'),
        'phone' => $this->input->post('phone'),
        'email' => $this->input->post('email'),
        'skill' => $this->input->post('skill')
      ];
  
      $this->Model->post('applicant', $data);
      $this->session->set_flashdata('flash', 'New data has been added');
      redirect('');
    }

    $this->load->view('header', $data);
    $this->load->view('form', $data);
  }

  public function up_data($id) {
    $data['title'] = 'insert data';

    if( $this->input->post('first_name') ) {
      $data = [
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'gender' => $this->input->post('gender'),
        'phone' => $this->input->post('phone'),
        'email' => $this->input->post('email'),
        'skill' => $this->input->post('skill')
      ];
  
      $this->Model->update('applicant', $id, $data);
      $this->session->set_flashdata('flash', 'Selected data has been updated');
      redirect('');
    }
    $where = [
      'id' => $id
    ];

    $data['data'] = $this->Model->get('applicant', $where)->row();

    $this->load->view('header', $data);
    $this->load->view('form', $data);
  }

  public function del_data($id) {
    $this->Model->delete('applicant', $id);
    $this->session->set_flashdata('flash', 'Selected data successfully deleted');
    redirect('');
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

  public function hitung($num_col) {
    $arra = [];

    for($i=1; $i <= $num_col; $i++) {
      $char = $this->generateChar($i);
      // echo  "{$i}. {$char} <br>";
      array_push($arra, $char);
    }

    var_dump($arra);
  }

}

