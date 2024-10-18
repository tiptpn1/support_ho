<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        if (empty($this->session->userdata('login'))) {
            redirect(base_url('user/index'));
        }

        $this->load->model(array('m_master_jns', 'm_master_prgkt', 'm_pengajuan', 'm_perangkat', 'm_kelola_tiket', 'm_master_layanan', 'm_list_role', 'm_daftar_pengguna', 'm_artikel', 'm_info', 'm_histori'));
    }

    public function index()
    {
        $this->load->view('test');
        //unlink("./assets/images/1597831448.png");
        //unlink("./assets/upload/Hustle_Loft_Coworking.png");
        //echo $this->m_kelola_tiket->biaya_layanan('refill');
        
        //$query = $this->db->get('pengajuan_lelang', array('id_pengajuan' => $id_pengajuan))->row()->upload_file;
        //print_r($this->db->last_query()); exit;
    }
    public function test()
    {
        //$this->load->model('m_hari_libur');
        //$input_1 = "2020-08-21";
        //echo $this->m_hari_libur->is_exist($input_1);
    }
}
