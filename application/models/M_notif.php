<?php 
 
class M_notif extends CI_Model{
    public function input_data_notif($data){
        return $this->db->insert('notif', $data);
    }
    public function tampil_notif(){
        $this->db->select('*');
        $this->db->from('notif');
        $this->db->join('ajukan_keluhan', 'notif.id_ajukan = ajukan_keluhan.id_ajukan');
        return $this->db->get();
    }
}