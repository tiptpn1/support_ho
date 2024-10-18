<?php

class M_master_group_perangkat extends CI_Model
{
    public function tampil_mstr_group_perangkat($id_departemen)
    {
        // $this->db->order_by('id_group', 'desc');
        // return $this->db->get('master_group_perangkat');

        $this->db->select('*');
        $this->db->from('master_group_perangkat');
        $this->db->join('master_kantor', 'master_kantor.id_master_kantor = master_group_perangkat.id_master_kantor');
        $this->db->where('master_kantor.id_master_kantor', $id_departemen);
        $this->db->order_by('id_group', 'desc');
        return $this->db->get();
    }

    public function input_data_mstr_group_perangkat($data)
    {
        $this->db->insert('master_group_perangkat', $data);
    }

    public function edit_mstr_group_perangkat($id_mstr_group_perangkat)
    {
        $this->db->select('*');
        $this->db->from('master_group_perangkat');
        $this->db->where('id_group', $id_mstr_group_perangkat);
        return $this->db->get();
    }

    public  function edit_aksi_mstr_group_perangkat($data, $where)
    {
        return $this->db->update('master_group_perangkat', $data, $where);
    }

    /*public function update_data_mstrjns($where, $data, $table){
    	$this->db->where($where);
    	$this->db->update($table, $data);
    }*/

    public function hapus_data_mstr_group_perangkat($where)
    {
        return $this->db->delete('master_group_perangkat', $where);
    }
}
