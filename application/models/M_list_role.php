<?php 
 
class M_list_role extends CI_Model{

	public function tampil_hak_akses(){
		return $this->db->get('hak_akses');
	}

	public function input_data_role($data)
    {
        $this->db->insert('role', $data);
    }

    public function tampil_role(){
		$this->db->select('*');
        $this->db->from('role');
    	$this->db->join('hak_akses', 'role.id_hak_akses = hak_akses.id_hak_akses');
    	return $this->db->get();
	}

}