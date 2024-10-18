<?php 
 
class M_tahun extends CI_Model{
    public function tampil_thn(){
		return $this->db->get('tahun');
    }
}