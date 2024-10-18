<?php

class M_master_jns extends CI_Model
{
    public function tampil_mstrjns($id_departemen)
    {
        // $this->db->order_by('id_master_jns', 'desc');
        // return $this->db->get('master_jns');

        $this->db->select('*');
        $this->db->from('master_jns');
        $this->db->join('master_group_perangkat', 'master_jns.id_group = master_group_perangkat.id_group');
        // $this->db->join('master_kantor', 'master_kantor.id_master_kantor = master_jns.id_master_kantor', 'left');
        $this->db->where('master_jns.id_master_kantor', $id_departemen);
        $this->db->order_by('id_master_jns', 'desc');
        return $this->db->get();
    }

    public function input_data_mstrjns($data)
    {
        $this->db->insert('master_jns', $data);
    }

    public function edit_mstrjns($id_master_jns)
    {
        $this->db->select('*');
        $this->db->from('master_jns');
        $this->db->where('id_master_jns', $id_master_jns);
        return $this->db->get();
    }

    public  function edit_aksi_mstrjns($data, $where)
    {
        return $this->db->update('master_jns', $data, $where);
    }

    /*public function update_data_mstrjns($where, $data, $table){
    	$this->db->where($where);
    	$this->db->update($table, $data);
    }*/

    public function hapus_data_mstrjns($where)
    {
        return $this->db->delete('master_jns', $where);
    }
}
