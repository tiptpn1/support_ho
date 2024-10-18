<?php

class M_info extends CI_Model
{
    public function tampil_info($filter)
    {
        if ($this->session->userdata('id_master_kantor') != 1) {
            $this->db->where('id_master_kantor', $filter['id_kantor']);
        }
        $this->db->order_by('id_info', 'desc');
        return $this->db->get('info');
    }
    public function tampil_info_aktif()
    {
        $this->db->order_by('id_info', 'desc');
        $this->db->where('status', 'aktif');
        return $this->db->get('info');
    }
    public function baca_info($id)
    {
        return $this->db->get_where('info', array('id_info' => $id))->row();
    }
    public function input_data_info($data)
    {
        $this->db->insert('info', $data);
    }
    public function edit_info($id_info)
    {
        $this->db->select('*');
        $this->db->from('info');
        $this->db->where('id_info', $id_info);
        return $this->db->get();
    }
    public  function edit_aksi_info($data, $where)
    {
        return $this->db->update('info', $data, $where);
    }
    public function hapus_data_info($where)
    {
        return $this->db->delete('info', $where);
    }
}
