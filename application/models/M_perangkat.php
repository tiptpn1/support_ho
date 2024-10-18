<?php

class M_perangkat extends CI_Model
{

  function tampil_pilih_dokumen($id_departemen)
  {
    $this->db->select('*');
    $this->db->from('pengajuan_lelang');
    $this->db->order_by('tgl_memo', 'desc');
    $this->db->join('master_kantor', 'master_kantor.id_master_kantor = pengajuan_lelang.id_master_kantor');
    $this->db->where('status_proses', 'Terealisasi');
    $this->db->where('master_kantor.id_master_kantor', $id_departemen);
    return $this->db->get();
  }

  function tampil_bagian()
  {
    return $this->db->get('bagian');
  }
  function bagian_byID($id)
  {
    return $this->db->get_where('bagian', array('id_bagian' => $id))->row();
  }
  function tampil_nama_prgkt($id)
  {
    return $this->db->get_where('perangkat', array('id_perangkat' => $id))->row();
  }
  /*function input_data_perangkat($data){
      return $this->db->insert('perangkat',$data);
  }*/

  function tampil_perangkat($id_departemen = null, $id_perangkat = null)
  {
    $this->db->select('*');
    $this->db->select('bagian.bagian as bagian');
    //$this->db->select('bagian_baru.bagian as bagian_baru');
    $this->db->from('perangkat');
    $this->db->join('bagian', 'perangkat.id_bagian = bagian.id_bagian');
    $this->db->join('master_kantor', 'perangkat.id_master_kantor = master_kantor.id_master_kantor');
    //$this->db->join('bagian as bagian_baru', 'perangkat.id_bagian_baru = bagian_baru.id_bagian', 'LEFT');
    $this->db->where('master_kantor.id_master_kantor', $id_departemen);
    if ($id_perangkat != null) {
      $this->db->where('perangkat.id_perangkat', $id_perangkat);
    }
    $this->db->order_by('id_perangkat', 'desc');
    return $this->db->get();
  }

  function tampil_aktif_perangkat($id_departemen)
  {
    $this->db->select('*');
    $this->db->select('bagian.bagian as bagian');
    $this->db->from('perangkat');
    $this->db->join('bagian', 'perangkat.id_bagian = bagian.id_bagian');
    $this->db->join('master_kantor', 'perangkat.id_master_kantor = master_kantor.id_master_kantor');
    $this->db->where('status', 'aktif');
    $this->db->where('master_kantor.id_master_kantor', $id_departemen);
    $this->db->order_by('id_perangkat', 'desc');
    return $this->db->get();
  }
  function tampil_aktif_perangkat_cetak($id_perangkat)
  {
    $this->db->select('*');
    $this->db->select('bagian.bagian as bagian');
    $this->db->from('perangkat');
    $this->db->join('bagian', 'perangkat.id_bagian = bagian.id_bagian');
    $this->db->where('status', 'aktif');
    $this->db->where('id_perangkat', $id_perangkat);
    $this->db->order_by('id_perangkat', 'desc');
    return $this->db->get();
  }

  /*function input_data_perangkat($data){
      $this->db->insert('perangkat',$data);
  }*/

  function get_id_bagian($id)
  {
    $this->db->select('*');
    $this->db->from('bagian_perangkat');
    $this->db->join('bagian', 'bagian_perangkat.id_bagian = bagian.id_bagian');
    $this->db->where('id_bagian_perangkat', $id);
    return $this->db->get()->result();
  }

  /*function input_data_perangkat($data)
  {
    $tmp_id = md5(date('Y-m-d H:i:s'));
    $tbl_perangkat = array(
      'jns_prgkt' => $data['jns_prgkt'],
      'tipe_prgkt' => $data['tipe_prgkt'],
      'kepemilikan' => $data['kepemilikan'],
      'no_prgkt' => $data['no_prgkt'],
      'no_spk' => $data['no_spk'],
      'pil_dok' => $data['pil_dok'],
      'id_bagian_perangkat' => $tmp_id,
      'status' => $data['status'],
      'qr_code' => $data['qr_code']
    );
    $this->db->insert('perangkat', $tbl_perangkat);
    foreach ($data['id_bagian'] as $b) {
      $tbl_bagian_perangkat = array(
        'id_bagian_perangkat' => $tmp_id,
        'id_bagian' => $b
      );
      $this->db->insert('bagian_perangkat', $tbl_bagian_perangkat);
    };
    return $tmp_id;
  }*/
  public function input_data_perangkat($data)
  {
    $this->db->insert('perangkat', $data);
  }

  public function get_id_perangkat()
  {
    $this->db->select('*');
    $this->db->from('perangkat');
    //$this->db->where('id_perangkat', $id_perangkat);
    $this->db->order_by('id_perangkat', 'desc');
    return $this->db->get();
  }

  function edit_perangkat($id_perangkat)
  {
    $this->db->select('*');
    $this->db->from('perangkat');
    //$this->db->join('bagian', 'perangkat.id_bagian = bagian.id_bagian');
    //$this->db->join('bagian', 'perangkat.id_bagian_baru = bagian.id_bagian');
    $this->db->join('master_prgkt', 'perangkat.id_master_prgkt = master_prgkt.id_master_prgkt');
    $this->db->join('master_jns', 'master_prgkt.id_master_jns = master_jns.id_master_jns', 'LEFT');
    $this->db->where('id_perangkat', $id_perangkat);
    return $this->db->get();
  }

  /*function edit_aksi_perangkat($data, $where){
      return $this->db->update('perangkat', $data, $where);
  }*/

  /*function edit_aksi_perangkat($data, $where){
      $this->db->update('perangkat', $data, $where);
  }*/

  /*function edit_aksi_perangkat($data, $where)
  {
    //Buat baru di tabel bagian multiple (md5)
    //Tambahkan ID baru
    $id_baru = md5(date("Y-m-d H:i:s"));
    foreach ($data['id_bagian_baru'] as $b) {
      $data2 = array(
        'id_bagian_perangkat' => $id_baru,
        'id_bagian' => $b
      );
      $this->db->insert('bagian_perangkat', $data2);
    };

    //Update tabel perangkat
    $data1 = array(
      'jns_prgkt' => $data['jns_prgkt'],
      'tipe_prgkt' => $data['tipe_prgkt'],
      'kepemilikan' => $data['kepemilikan'],
      'no_prgkt' => $data['no_prgkt'],
      'no_spk' => $data['no_spk'],
      'pil_dok' => $data['pil_dok'],
      'status' => $data['status'],
      'id_bagian_baru' => $id_baru,
      'no_prgkt_baru' => $data['no_prgkt_baru'],
      'qr_code' => $data['qr_code']
    );
    $this->db->update('perangkat', $data1, $where);
    //
    return 1;
  }*/
  public function edit_aksi_perangkat_histori($data, $where)
  {
    $this->db->update('perangkat_histori', $data, $where);
    return 1;
  }

  public  function edit_aksi_perangkat($data, $where)
  {
    //unlink('./assets/images/' . $data['qr_code']);
    $this->db->update('perangkat', $data, $where);
    return 1;
  }

  function lihat_mutasi($id_perangkat)
  {
    $data = $this->db->get_where('perangkat_mutasi', array('id_perangkat' => $id_perangkat))->result();
  }

  function mutasi_terakhir($id_perangkat)
  {
    $this->db->select('*');
    $this->db->from('perangkat_mutasi');
    $this->db->where('id_perangkat', $id_perangkat);
    $this->db->order_by('id_mutasi', 'DESC');
    $this->db->get()->row();
  }

  /*function hapus_data_perangkat($where){
    return $this->db->delete('perangkat', $where);
  }*/

  function hapus_data_perangkat($where)
  {
    //Simpan ID 
    $id_bagian_perangkat = $this->edit_perangkat($where['id_perangkat'])->row()->id_bagian_perangkat;
    $id_bagian_baru = $this->edit_perangkat($where['id_perangkat'])->row()->id_bagian;
    $id_perangkat = $this->edit_perangkat($where['id_perangkat'])->row()->id_perangkat;
    //
    $query  = $this->db->query("SELECT qr_code FROM perangkat WHERE id_perangkat='$id_perangkat'");
    $ambil = $query->row_array();
    unlink('./assets/images/' . $ambil['qr_code']);
    //
    $this->db->delete('perangkat', $where);
    $this->db->delete('bagian_perangkat', array('id_bagian_perangkat' => $id_bagian_perangkat));
    $this->db->delete('bagian_perangkat', array('id_bagian_perangkat' => $id_bagian_baru));

    return 1;
  }

  function max_number()
  {
    $date = date("Y-m-d");
    $tahun_terima = explode("-", $date);
    //print_r ($tahun_terima[0]);
    $query  = $this->db->query("select max(nomor_perangkat) as nomor from perangkat where nomor_perangkat and tahun_terima='$tahun_terima[0]'");
    return $query;
  }

  function edit_perangkat_baru($data, $where)
  {
    $this->db->update('perangkat', $data, $where);
    return 1;
  }
  function edit_perangkat_histori_baru($data, $where)
  {
    $this->db->update('perangkat_histori', $data, $where);
    return 1;
  }

  function tampil_data_perangkat_qrcode($where)
  {
    $this->db->select('*');
    $this->db->select('bagian.bagian as bagian');
    //$this->db->select('bagian_baru.bagian as bagian_baru');
    $this->db->from('perangkat');
    $this->db->join('bagian', 'perangkat.id_bagian = bagian.id_bagian');
    //$this->db->join('bagian as bagian_baru', 'perangkat.id_bagian_baru = bagian_baru.id_bagian', 'LEFT');
    $this->db->where('id_perangkat', $where);
    return $this->db->get();
  }
  public function cek_perangkat_pengajuan($id_pengajuan,$kantor,$id_master_perangkat)
    {
        //JOIN 'perangkat' dan 'jenis'
        $this->db->select('*');
        $this->db->from('perangkat');
        $this->db->join('pengajuan_lelang', 'perangkat.id_pengajuan = pengajuan_lelang.id_pengajuan');
        $this->db->join('master_prgkt_dinamis', 'master_prgkt_dinamis.id_prgkt_dinamis = pengajuan_lelang.id_prgkt_dinamis');
        //$this->db->order_by('id_master_prgkt', 'desc');
        $this->db->where('perangkat.id_master_kantor', $kantor);
        $this->db->where('perangkat.id_pengajuan', $id_pengajuan);
        $this->db->where('master_prgkt_dinamis.id_master_prgkt', $id_master_perangkat);
        $this->db->where('status', 'aktif');
        return $this->db->get();
    }
}
