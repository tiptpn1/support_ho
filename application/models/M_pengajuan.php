<?php

class M_pengajuan extends CI_Model
{

  function tampil_pengajuan_lelang($id_departemen)
  {
    $this->db->select('*');
    $this->db->from('pengajuan_lelang');
    $this->db->join('master_kantor', 'master_kantor.id_master_kantor = pengajuan_lelang.id_master_kantor');
    $this->db->where('master_kantor.id_master_kantor', $id_departemen);
    $this->db->order_by('tgl_memo', 'desc');
    $this->db->order_by('id_pengajuan', 'desc');

    return $this->db->get();
  }
  function get_id_bagian($id)
  {
    $this->db->select('*');
    $this->db->from('bagian_pengajuan');
    $this->db->join('bagian', 'bagian_pengajuan.id_bagian = bagian.id_bagian');
    $this->db->where('id_bagian_pengajuan', $id);
    return $this->db->get()->result();
  }
  function get_prgkt_dinamis($id_pengajuan)
  {
    $this->db->select('*');
    $this->db->from('pengajuan_lelang');
    $this->db->join('master_prgkt_dinamis', 'pengajuan_lelang.id_prgkt_dinamis = master_prgkt_dinamis.id_prgkt_dinamis');
    $this->db->join('master_prgkt', 'master_prgkt_dinamis.id_master_prgkt = master_prgkt.id_master_prgkt');
    $this->db->join('master_jns', 'master_prgkt.id_master_jns = master_jns.id_master_jns', 'LEFT');
    $this->db->where('id_pengajuan', $id_pengajuan);
    return $this->db->get()->result();
  }
  function tampil_prgkt_dinamis()
  {
    $this->db->select('*');
    $this->db->from('master_prgkt_dinamis');
    $this->db->join('master_prgkt', 'master_prgkt_dinamis.id_master_prgkt = master_prgkt.id_master_prgkt');
    //$this->db->where('id_prgkt_dinamis', $id);
    return $this->db->get();
  }
  function tampil_bagian()
  {
    return $this->db->get('bagian');
  }
  function tampil_bagian2($id)
  {
    return $this->db->get_where('bagian', array('id_master_kantor' => $id));
  }

  function input_data_pengajuan($data)
  {
    $tmp_id = md5(date('Y-m-d H:i:s'));
    //foreach ($data['upload_file'] as $key1 => $v) {

    $tbl_pengajuan = array(
      'id_bagian_pengajuan' => $tmp_id,
      'no_memo' => $data['no_memo'],
      'tgl_memo' => $data['tgl_memo'],
      'jumlah' => $data['jumlah'],
      //'upload_file' => $_FILES['upload_file']['name'],
      //'upload_file' => $data['upload_file'] ?? NULL,
      //'upload_file' => $waktu_sekarang."_".$_FILES['upload_file']['name'],
      'status_proses' => $data['status_proses'],
      'id_prgkt_dinamis' => $data['id_prgkt_dinamis'],
      'id_master_prgkt' => $data['id_master_prgkt'],
      'id_master_kantor' => $data['id_master_kantor']
    );
    if (isset($data['upload_file'])) {
      $tbl_pengajuan['upload_file'] = $data['upload_file'];
    }

    //echo '<pre>';
    //print_r($tbl_pengajuan); die();
    $this->db->insert('pengajuan_lelang', $tbl_pengajuan);
    //}
    // Tabel Master Perangkat Dinamis
    foreach ($data['id_master_prgkt'] as $key => $value) {
      $tbl_prgkt_dnms = array(
        'id_prgkt_dinamis' => $data['id_prgkt_dinamis'],
        'id_master_prgkt' => $value,
        'jml1' =>  $data['jml'][$key]
      );
      $this->db->insert('master_prgkt_dinamis', $tbl_prgkt_dnms);
    }
    //
    foreach ($data['id_bagian'] as $b) {
      $tbl_bagian_pengajuan = array(
        'id_bagian_pengajuan' => $tmp_id,
        'id_bagian' => $b
      );
      $this->db->insert('bagian_pengajuan', $tbl_bagian_pengajuan);
    };
    return 1;
  }

  function edit_pengajuan($id_pengajuan)
  {
    $this->db->select('*');
    $this->db->from('pengajuan_lelang');
    //$this->db->join('bagian', 'pengajuan_lelang.id_bagian = bagian.id_bagian');
    $this->db->where('id_pengajuan', $id_pengajuan);
    return $this->db->get();
  }

  function edit_aksi_pengajuan($data, $where)
  {

    //$loc = "./assets/upload/".$ambil;

    //echo $where['id_pengajuan']; die();

    $data1 = array(
      'no_memo'       => $data['no_memo'],
      'tgl_memo'       => $data['tgl_memo'],
      'jumlah'       => $data['jumlah'],
      'status_proses' => $data['status_proses'],
      'upload_file' => $data['upload_file'],
      'id_prgkt_dinamis' => $data['id_prgkt_dinamis']
    );

    //$this->db->insert('pengajuan_lelang_histori', $data1, $where);
    $this->db->update('pengajuan_lelang', $data1, $where);
    //Simpan ID 
    $id_bagian_pengajuan = $this->edit_pengajuan($where['id_pengajuan'])->row()->id_bagian_pengajuan;
    //$id_prgkt_dinamis = $this->edit_pengajuan($where['id_pengajuan'])->row()->id_prgkt_dinamis;
    //Hapus
    $this->db->delete('bagian_pengajuan', array('id_bagian_pengajuan' => $id_bagian_pengajuan));
    //$this->db->delete('master_prgkt_dinamis', array('id_prgkt_dinamis' => $id_prgkt_dinamis));
    //Tambahkan ID baru
    foreach ($data['id_bagian'] as $b) {
      $data2 = array(
        'id_bagian_pengajuan' => $id_bagian_pengajuan,
        'id_bagian' => $b
      );
      $this->db->insert('bagian_pengajuan', $data2);
    };

    $this->db->delete('master_prgkt_dinamis', array('id_prgkt_dinamis' => $data['id_prgkt_dinamis']));
    for ($i = 1; $i <= count($data['id_master_prgkt']); $i++) {
      $no_urut = $i - 1;
      $tbl_prgkt_dnms = array(
        'id_prgkt_dinamis' => $data['id_prgkt_dinamis'],
        'id_master_prgkt' => $data['id_master_prgkt'][$no_urut],
        'jml1' =>  $data['jml1'][$no_urut]
      );
      $this->db->insert('master_prgkt_dinamis', $tbl_prgkt_dnms);
    }
    //
    return 1;
  }

  function hapus_data_pengajuan($where)
  {
    //Simpan ID 
    $id_bagian_pengajuan = $this->edit_pengajuan($where['id_pengajuan'])->row()->id_bagian_pengajuan;
    $id_prgkt_dinamis = $this->edit_pengajuan($where['id_pengajuan'])->row()->id_prgkt_dinamis;
    $id_pengajuan = $this->edit_pengajuan($where['id_pengajuan'])->row()->id_pengajuan;
    //
    //$id = $this->input->post('id_pengajuan');
    $query  = $this->db->query("SELECT upload_file FROM pengajuan_lelang WHERE id_pengajuan='$id_pengajuan'");
    $ambil = $query->row_array();
    unlink('./assets/upload/' . $ambil['upload_file']);
    //print_r($ambil); die();

    $this->db->delete('pengajuan_lelang', $where);
    $this->db->delete('perangkat', array('id_pengajuan' => $id_pengajuan));
    $this->db->delete('bagian_pengajuan', array('id_bagian_pengajuan' => $id_bagian_pengajuan));
    $this->db->delete('master_prgkt_dinamis', array('id_prgkt_dinamis' => $id_prgkt_dinamis));

    return 1;
  }
}
