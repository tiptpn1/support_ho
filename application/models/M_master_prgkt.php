<?php

class M_master_prgkt extends CI_Model
{
    public function input_data_mstrprgkt($data)
    {
        return $this->db->insert('master_prgkt', $data);
    }
    public function tampil_mstrprgkt($id_departemen)
    {
        //JOIN 'perangkat' dan 'jenis'
        $this->db->select('*');
        $this->db->from('master_prgkt');
        $this->db->join('master_jns', 'master_prgkt.id_master_jns = master_jns.id_master_jns');
        $this->db->join('master_kantor', 'master_kantor.id_master_kantor = master_prgkt.id_master_kantor');
        $this->db->where('master_kantor.id_master_kantor', $id_departemen);
        $this->db->order_by('id_master_prgkt', 'desc');
        return $this->db->get();
    }
    public function tampil_mstrprgkt_aktif($id_departemen)
    {
        //JOIN 'perangkat' dan 'jenis'
        $this->db->select('*');
        $this->db->from('master_prgkt');
        $this->db->join('master_jns', 'master_prgkt.id_master_jns = master_jns.id_master_jns');
        $this->db->order_by('id_master_prgkt', 'desc');
        $this->db->where('master_prgkt.id_master_kantor', $id_departemen);
        $this->db->where('status', 'aktif');
        return $this->db->get();
    }
    public function edit_mstrprgkt($id_master_prgkt)
    {
        $this->db->select('*');
        $this->db->from('master_prgkt');
        $this->db->join('master_jns', 'master_prgkt.id_master_jns = master_jns.id_master_jns');
        $this->db->where('id_master_prgkt', $id_master_prgkt);
        return $this->db->get();
    }
    public function edit_aksi($data, $where)
    {
        return $this->db->update('master_prgkt', $data, $where);
    }
    public function hapus_data_mstrprgkt($where)
    {
        return $this->db->delete('master_prgkt', $where);
    }
}
