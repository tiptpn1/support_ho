<?php

class M_daftar_pengguna extends CI_Model
{
	public function tampil_daftar_pengguna($kantor)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('master_kantor', 'master_kantor.id_master_kantor = users.id_master_kantor');
		if ($this->session->userdata('id_master_kantor') != 1) {
			$this->db->where('users.id_master_kantor', $kantor);
		}
		// $query = $this->db->get();
		return $this->db->get();
	}
	public function get_list_kantor()
	{
		$this->db->select('*');
		$this->db->from('master_kantor');
		$query = $this->db->get();
		return $query;
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
	public function tambah_data_pengguna($post,$kantor)
	{
		$params['username'] = $post['username'];
		$params['id_master_kantor'] = $kantor;
		$params['email'] = $post['email'];
		$params['password'] = md5($post['password']);
		$params['role'] = $post['role'];
		$params['role_status'] = $post['role_status'];

		$this->db->insert('users', $params);
	}
	public function edit_pengguna($id_user)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('master_kantor', 'master_kantor.id_master_kantor = users.id_master_kantor');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		return $query;
	}
	/*public  function edit_data_pengguna($data, $where){
        return $this->db->update('users', $data, $where);
	}*/
	public function edit_data_pengguna($post,$kantor)
	{
		$params['username'] = $post['username'];
		$params['email'] = $post['email'];
		$params['id_master_kantor'] = $kantor;
		if (!empty($post['password'])) {
			$params['password'] = md5($post['password']);
		}
		$params['role'] = $post['role'];
		$params['role_status'] = $post['status'];
		$this->db->where('id_user', $post['id_user']);
		$this->db->update('users', $params);
	}
	public function hapus_data_pengguna($where)
	{
		return $this->db->delete('users', $where);
	}
	public function reset_pass_pengguna($where)
	{
		$default['password'] = md5(123456);
		$this->db->where('id_user', $where['id_user']);
		$this->db->update('users', $default);
	}
}
