<?php 
 
class M_master_layanan extends CI_Model{
	public function tampil_master_layanan(){
		return $this->db->get('master_layanan');
	}
	public function input_data_master_layanan($data){
		$this->db->insert('master_layanan', $data);
	}
	public function edit_master_layanan($id_master_layanan){
		$this->db->select('*');
        $this->db->from('master_layanan');
        $this->db->where('id_master_layanan', $id_master_layanan);
        return $this->db->get();
	}
	public function edit_aksi_master_layanan($data, $where){
		return $this->db->update('master_layanan', $data, $where);
	}
	public function hapus_data_master_layanan($where){
		return $this->db->delete('master_layanan', $where);
	}
	function filter()
  	{
	$query  = $this->db->query("select * from master_layanan where status='aktif'");
	//print_r($query);
	//die();
    return $query;
	}
}