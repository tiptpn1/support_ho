<?php

class M_artikel extends CI_Model
{
    public function tampil_artikel($filter)
    {
        // // filter petugas
        // if ($this->session->userdata('role') != 1) {
        // }
        // // filter admin non HO
        if ($this->session->userdata('id_master_kantor') != 1) {
            $this->db->where('id_master_kantor', $filter['id_kantor']);
        }
        $this->db->order_by('id_artikel', 'desc');
        return $this->db->get('artikel');
    }
    public function tampil_artikel2()
    {
        // // filter petugas
        // if ($this->session->userdata('role') != 1) {
        // }
        // // filter admin non HO
        $this->db->order_by('id_artikel', 'desc');
        return $this->db->get('artikel');
    }
    function page_artikel($limit, $start)
    {
        $this->db->order_by('id_artikel', 'desc');
        $query = $this->db->get('artikel', $limit, $start);
        return $query;
    }
    public function baca($id)
    {
        //return $this->db->get_where('artikel', array('id_artikel' => $id))->row();
        // $this->db->select('*');
        // $this->db->from('artikel');
        $query = $this->db->get_where('artikel', array('id_artikel' => $id))->row();;
        return $query;
    }
    public function baca_artikel($id)
    {
        $jml_view_sebelum = $this->db->get_where('artikel', array('id_artikel' => $id))->row()->jumlah_view;
        $jml_view_setelah = $jml_view_sebelum + 1;
        return $this->db->update('artikel', $jumlah_view = $jml_view_setelah, 'id_artikel');
    }
    public function input_data_artikel($data)
    {
        $this->db->insert('artikel', $data);
    }
    public function edit_artikel($id_artikel)
    {
        $this->db->select('*');
        $this->db->from('artikel');
        $this->db->where('id_artikel', $id_artikel);
        return $this->db->get();
    }
    public  function edit_aksi_artikel($data, $where)
    {
        return $this->db->update('artikel', $data, $where);
    }
    public function hapus_data_artikel($where)
    {
        $id = $this->edit_artikel($where['id_artikel'])->row()->id_artikel;
        $query  = $this->db->query("SELECT banner FROM artikel WHERE id_artikel='$id'");
        $ambil = $query->row_array();
        if ($ambil['banner'] != NULL) {
            unlink('./assets/upload/' . $ambil['banner']);
        }
        //print_r($ambil); die();
        return $this->db->delete('artikel', $where);
        return 1;
    }
}
