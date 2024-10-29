<?php

class M_user extends CI_Model
{

  function tampil_ajukan_keluhan()
  {
    $this->db->select('*');
    $this->db->from('ajukan_keluhan');
    $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
    return $this->db->get();
  }

  function tampil_kantor()
  {
    return $this->db->get('master_kantor');
  }

  function tampil_bagian()
  {
    return $this->db->get('bagian');
  }
  function tampil_bagian2($idBagian)
  {
    return $this->db->get_where('bagian', array('id_master_kantor' => $idBagian))->result_array();
  }

  function tampil_mstrjns()
  {
    return $this->db->get('master_jns');
  }

  function tampil_mstrjns2($idkantor)
  {
    return $this->db->get_where('master_jns', array('id_master_kantor' => $idkantor))->result_array();
  }

  function input_data_ajukan($data)
  {
    $this->db->insert('ajukan_keluhan', $data);

    require FCPATH . 'vendor/autoload.php';

    $options = array(
      'cluster' => 'ap1',
      'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
      'ad8644ee3904a2aa602c',
      'e1c81b3d76ee382ff2e0',
      '1016439',
      $options
    );

    //$data['message'] = 'INFO : ada pengajuan tiket keluhan baru. Silahkan cek pengelolaan tiket';
    $data[] = 'Notifikasi pengajuan tiket keluhan baru. Silahkan cek pengelolaan tiket';
    $pusher->trigger('my-channel', 'my-event', $data);
  }

	function input_data_ajukan_cybersecurity($data)
  {
    $this->db->insert('ajukan_keluhan_keamanan_siber', $data);

    require FCPATH . 'vendor/autoload.php';

    $options = array(
      'cluster' => 'ap1',
      'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
      'ad8644ee3904a2aa602c',
      'e1c81b3d76ee382ff2e0',
      '1016439',
      $options
    );

    //$data['message'] = 'INFO : ada pengajuan tiket keluhan baru. Silahkan cek pengelolaan tiket';
    $data[] = 'Notifikasi pengajuan tiket pengaduan cybersecurity baru. Silahkan cek pengelolaan tiket';
    $pusher->trigger('my-channel', 'my-event', $data);
  }

  function tampil_kelola_tiket()
  {
    $this->db->select('*');
    $this->db->from('ajukan_keluhan');
    $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
    $this->db->join('master_kantor', 'ajukan_keluhan.id_master_kantor = master_kantor.id_master_kantor');
    $this->db->order_by('id_ajukan desc');
    //$this->db->join('master_jns', 'ajukan_keluhan.id_master_jns = master_jns.id_master_jns', 'left');
    return $this->db->get();
  }

  function bagian2($id_bagian)
  {

    $bagian = "<option value='0' class='warna'>Pilih Bagian</option>";

    $this->db->order_by('name', 'ASC');
    $bag = $this->db->get_where('bagian', array('id_master_kantor' => $id_bagian));

    foreach ($bag->result_array() as $data) {
      $bagian .= "<option value='$data[id_bagian]'>$data[bagian]</option>";
    }
  }
}
