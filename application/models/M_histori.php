<?php

class M_histori extends CI_Model
{
  public function tampil_pengajuan_h($id_pengajuan)
  {
    $this->db->select('*');
    $this->db->from('pengajuan_lelang_histori');
    $this->db->where('id_pengajuan', $id_pengajuan);
    $this->db->order_by('id_pengajuan_histori', 'asc');
    return $this->db->get();
  }
  public function tampil_mutasi_perangkat_h($id_perangkat)
  {
    $this->db->select('*');
    $this->db->from('perangkat_histori');
    $this->db->join('bagian', 'perangkat_histori.id_bagian = bagian.id_bagian');
    //$this->db->join('perangkat', 'perangkat_histori.id_perangkat = perangkat.id_perangkat', 'LEFT');
    $this->db->where('id_perangkat', $id_perangkat);
    return $this->db->get();
  }
  /*public function tampil_ajukan_h()
  {
    return $this->db->get('ajukan_keluhan_histori');
  }*/
  function tampil_ajukan_h($id_perangkat)
  {
    $this->db->select('*');
    $this->db->from('ajukan_keluhan_histori');
    $this->db->where('id_perangkat', $id_perangkat);
    $this->db->order_by('id_keluhan_histori', 'DESC');
    //$this->db->limit(1); 
    return $this->db->get();
  }

  function tampil_kd($kd_servis)
  {
    $this->db->select('*');
    $this->db->from('ajukan_keluhan_histori');
    $this->db->where('kode_servis', $kd_servis);
    return $this->db->get();
  }
}
