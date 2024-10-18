<?php

class M_daftar_kantor extends CI_Model
{
	public function tampil_daftar_kantor()
	{
		return $this->db->get('master_kantor');
	}
	public function get($id = null)
	{
		$this->db->from('users');
		if ($id != null) {
			$this->db->where('id_user', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function tambah_data_kantor($post)
	{
		$params['nama_master_kantor'] = $post['nama_master_kantor'];
		$params['kode_master_kantor'] = $post['kode_master_kantor'];

		$this->db->insert('master_kantor', $params);
	}
	public function edit_kantor($id_master_kantor)
	{
		$this->db->select('*');
		$this->db->from('master_kantor');
		$this->db->where('id_master_kantor', $id_master_kantor);
		return $this->db->get();
	}

	public function edit_data_kantor($post)
	{

		$params['kode_master_kantor'] = $post['kode_master_kantor'];
		$params['nama_master_kantor'] = $post['nama_master_kantor'];
		$id = $post['id_master_kantor'];
		$this->db->where('id_master_kantor', $id);
		$this->db->update('master_kantor', $params);
	}
	public function hapus_data_kantor($where)
	{
		return $this->db->delete('master_kantor', $where);
	}
}
