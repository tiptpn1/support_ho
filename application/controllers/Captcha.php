<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//tidak terpakai, dipindah ke controller User.php
class Captcha extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('captcha');
        $this->load->library('form_validation');
    }

    public function index(){
        $this->load->view('template/home');
    }
	 /*function create_captcha(){
        $options = array(
		        'img_path' => './captcha/',
		        'img_url' => base_url().'captcha/',
		        'img_width' => '120',
		        'img_height' => 55,
		        'word_length' => 5,
		        'pool'          => '0123456789',
		        'expiration' => 60
		    );
        $cap = create_captcha($options);
        $image=$cap['image'];
        $this->session->set_userdata('captchaword', $cap['word']);
        return $image;
        //return $cap;
    }

    function check_captcha(){
        if($this->$input->post('captcha') == $this->session->userdata('captchaword')){
            return TRUE;
        } else {
            $this->form_validation->set_message('check_captcha', 'Captcha yang anda input salah!');
            return FALSE;
        }
    }

    function index()
    {
    	$this->form_validation->set_rules('captcha', 'Captcha', 'trim|callback_check_captcha|required');
    	if($this->form_validation->run()==false){
    		$this->load->view('template/home', array('img'=>$this->create_captcha()));
    	}else{
    		echo'Captcha Berhasil';
    	}
    }*/
}
?>