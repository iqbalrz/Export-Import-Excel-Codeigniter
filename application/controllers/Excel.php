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
  	// get data from DB
    $book = $this->Model->getAll('buku')->result_array();
    $fields = $this->Model->getFields('buku');

    // make html html-type output
  	$htmlString = '<table>';
	    $htmlString .= '<tr>';
	    foreach ($fields as $field) {
	    	$htmlString .= '<th align="center" style="font-weight:bold">';
	    	$htmlString .= $field;
	    	$htmlString .= '</th>';
	    }
	    $htmlString .= '</tr>';

	    foreach ($book as $bk) {
	    	$htmlString .= '<tr>';
	      foreach ($fields as $field) {
	      	$htmlString .= '<td>';
	      	$htmlString .= htmlspecialchars($bk[$field]);
	      	$htmlString .= '</td>';
	      }
	    	$htmlString .= '</tr>';
	    }
		$htmlString .= '</table>';

		//what it's looks like in html view
		/*<table>
	    <?php foreach ($fields as $field) : ?>
	    <th><?= strtoupper($field) ?></th>
	    <?php endforeach; ?>

	    <?php foreach ($buku as $bk) : ?>
	    <tr>
	      <?php foreach ($fields as $field) : ?>
	      <td>
	        <?= $bk[$field] ?>
	      </td>
	      <?php endforeach; ?>
	    </tr>
	    <?php endforeach; ?>
	  </table>*/ 

		// convert to spreadsheet-type
	 	$reader = new Html();
		$spreadsheet = $reader->loadFromString($htmlString);

		// // generate excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="file.xlsx"');
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
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