<?php 
 
class M_jamkerja extends CI_Model{
    private $_tbl = 'jam_kerja';
    function r_masuk($hari)
    {
        return $this->db->get_where($this->_tbl, array('hari' => $hari))->row()->jam_masuk;
    }
    function r_keluar($hari)
    {
        return $this->db->get_where($this->_tbl, array('hari' => $hari))->row()->jam_keluar;
    }
}