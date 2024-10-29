<?php
class M_kelola_tiket_cybersecurity extends CI_Model {
	function max_number()
    {
        $date = date("Y-m-d");
        $tahun_terima = explode("-", $date);
        //print_r ($tahun_terima[0]);
        $query  = $this->db->query("select max(kode_servis) as nomor_servis from ajukan_keluhan_keamanan_siber where kode_servis and tahun='$tahun_terima[0]'");
        return $query;
    }

	public function edit_kelola_tiket($id_ajukan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan_keamanan_siber');
        $this->db->join('bagian', 'ajukan_keluhan_keamanan_siber.id_bagian = bagian.id_bagian', 'left');
        //$this->db->join('perangkat', 'ajukan_keluhan_keamanan_siber.id_perangkat = perangkat.id_perangkat');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }

	public function hapus_data_tiket($where)
    {
        $id = $this->edit_kelola_tiket($where['id_ajukan'])->row()->id_ajukan;
        $query  = $this->db->query("SELECT upload_dokumen, upload_spk FROM ajukan_keluhan_keamanan_siber WHERE id_ajukan='$id'");
        $ambil = $query->row_array();
        if ($ambil['upload_dokumen'] != NULL) {
            unlink('./assets/dokumen_cybersecurity/' . $ambil['upload_dokumen']);
        }
        if ($ambil['upload_spk'] != NULL) {
            unlink('./assets/upload/' . $ambil['upload_spk']);
        }
        //print_r($ambil); die();
        $this->db->delete('ajukan_keluhan_keamanan_siber', $where);
        return 1;
    }

	function tampil_bagian($kantor)
    {
        //return $this->db->get('bagian');
        $this->db->select('*');
        $this->db->from('bagian');
        $this->db->where('id_master_kantor', $kantor);
        return $this->db->get();
    }

	public  function edit_aksi_tiket($data, $where)
    {
        return $this->db->update('ajukan_keluhan_keamanan_siber', $data, $where);
    }

	function ambil_nama_kantor($id_ajukan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan_keamanan_siber');
        $this->db->join('master_kantor', 'ajukan_keluhan_keamanan_siber.id_master_kantor = master_kantor.id_master_kantor');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }

	function ambil_nama_bagian($id_ajukan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan_keamanan_siber');
        $this->db->join('bagian', 'ajukan_keluhan_keamanan_siber.id_bagian = bagian.id_bagian');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }
}
?>
