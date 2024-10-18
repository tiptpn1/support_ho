<?php

class M_daftar_bagian extends CI_Model
{
	public function tampil_daftar_bagian($kantor)
	{
		$this->db->select('*');
		$this->db->from('bagian');
		$this->db->join('master_kantor', 'master_kantor.id_master_kantor = bagian.id_master_kantor');
		$this->db->where('bagian.id_master_kantor', $id);
		$query = $this->db->get();
		return $query;
	}
	
	public function tambah_data_bagian($post,$kantor)
	{
		$params['bagian'] = $post['bagian'];
		$params['kode_bag_baru'] = $post['kode_bag_baru'];
		$params['id_master_kantor'] = $kantor;

		$this->db->insert('bagian', $params);
	}

	public function edit_bagian($id_bagian)
	{
		$this->db->select('*');
		$this->db->from('bagian');
		$this->db->join('master_kantor', 'master_kantor.id_master_kantor = bagian.id_master_kantor');
		$this->db->where('id_bagian', $id_bagian);
		$query = $this->db->get();
		return $query;
	}

	public function edit_data_bagian($post,$kantor)
	{

		$params['bagian'] = $post['bagian'];
		$params['kode_bag_baru'] = $post['kode_bag_baru'];
		$params['id_master_kantor'] = $kantor;
		$id = $post['id_bagian'];
		$this->db->where('id_bagian', $id);
		$this->db->update('bagian', $params);
	}

	public function hapus_data_bagian($where)
	{
		return $this->db->delete('bagian', $where);
	}

	public function count_bagian() {
        return $this->db->count_all('bagian');
    }
}
