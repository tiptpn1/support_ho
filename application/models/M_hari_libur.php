<?php

class M_hari_libur extends CI_Model
{
    public function is_exist($tanggal)
    {
        return $this->db->get_where('hari_libur', array('tgl_libur' => $tanggal))->num_rows();
    }
    public function tampil_hari_libur()
    {
        $this->db->select('*');
        $this->db->from('hari_libur');
        $this->db->order_by('id_hari_libur', 'desc');
        return $this->db->get();
    }

    public function input_data_hrlbr($data)
    {
        $this->db->insert('hari_libur', $data);
    }

    public function get_id_hrlbr()
    {
        $this->db->select('*');
        $this->db->from('hari_libur');
        $this->db->order_by('id_hari_libur', 'desc');
        return $this->db->get();
    }

    public function edit_hari_libur($id_hari_libur)
    {
        $this->db->select('*');
        $this->db->from('hari_libur');
        $this->db->where('id_hari_libur', $id_hari_libur);
        return $this->db->get();
    }

    public  function edit_aksi_hrlbr($data, $where)
    {
        $this->db->where('id_hari_libur', $where['id_hari_libur']);
        return $this->db->update('hari_libur', $data);
    }

    public function hapus_data_hrlbr($where)
    {
        return $this->db->delete('hari_libur', $where);
    }
}
