<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {
  
  public function getAll($table) {
    return $this->db->get($table);
  }

  public function getFields($table) {
    return $this->db->list_fields($table);
  }

  public function getCol($table) {
    return $this->db->get($table)->num_fields();
  }
}