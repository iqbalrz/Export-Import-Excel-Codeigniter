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
    $data['title'] = 'preview data';

    $data['datas'] = $this->Model->getAll()->result_array();
    $data['fields'] = $this->Model->getFields();
    $data['numCol'] = $this->Model->getCol();

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
  
      $this->Model->post($data);
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
  
      $this->Model->update($id, $data);
      $this->session->set_flashdata('flash', 'Selected data has been updated');
      redirect('');
    }
    $where = [
      'id' => $id
    ];

    $data['data'] = $this->Model->get($where)->row();

    $this->load->view('header', $data);
    $this->load->view('form', $data);
  }

  public function del_data($id) {
    $this->Model->delete($id);
    $this->session->set_flashdata('flash', 'Selected data successfully deleted');
    redirect('');
  }

}

