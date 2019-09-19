<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {

  public function get($table, $where) {
    return $this->db->get_where($table, $where);
  }
  
  public function getAll($table) {
    return $this->db->get($table);
  }

  public function getFields($table) {
    return $this->db->list_fields($table);
  }

  public function getCol($table) {
    return $this->db->get($table)->num_fields();
  }

  public function post($table, $data) {
    $this->db->insert($table, $data);
  }

  public function update($table, $where, $data) {
    $this->db->where('id', $where);
    $this->db->update($table, $data);
  }

  public function delete($table, $where) {
    $this->db->where('id', $where);
    $this->db->delete($table);
  }

  public function post_batch($table, $data){
    $this->db->insert_batch($table, $data);
  }
}