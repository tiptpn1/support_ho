<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Notifikasi extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('m_notifikasi');
	}

	public function list_notifikasi(){
		//$data['list_notifikasi'] = $this->m_notif->tampil_notif()->result();
		$data = [
			'id_ajukan' => $this->input->post('id_ajukan'),
		];
		$this->m_notif->input_data_notif()->result($data,'notif');
		//$this->load->view('admin/daftar_notifikasi', $data);
	}
	
	/*function list_notifikasi1(){
        $ci = get_instance();
        return $ci->db->select('n.*,ak.nama')->from('notif n')
        ->join('ajukan_keluhan ak','ak.id_ajukan = n.id_ajukan','left')
        ->where(['n.id_ajukan' => $ci->session->id_ajukan, 'read' => 'N'])->get()->result_array();
    }*/

	/*public function list_notifikasi(){
		if ($this->session->userdata('role') == 1) {
			$data['list_notifikasi'] = $this->m_notif->tampil_notif()->result();
			$this->load->view('admin/list_role', $data);
		}
	}*/
}