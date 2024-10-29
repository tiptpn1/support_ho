<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_user', 'm_artikel', 'm_daftar_pengguna', 'm_info', 'm_kelola_tiket', 'm_master_layanan', 'm_kelola_tiket_cybersecurity'));
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->library('pagination');
		//$this->load->library('mailer');
	}

	public function index()
	{
		//$data['bagian']=$this->m_user->tampil_data();
		//$data1['jenis_kerusakan']=$this->m_user->tampil_data1();
		//$this->load->view('template/home'); //$data);
		//$data['ajukan_keluhan'] = $this->m_user->tampil_ajukan_keluhan()->result();
		//$this->load->view('template/home', array('img'=>$this->create_captcha(), 'navbar'=>'index'));

		//konfigurasi pagination
		$config['base_url'] = site_url('user/index'); //site url
		$config['total_rows'] = $this->db->count_all('artikel'); //total row
		$config['per_page'] = 6;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		// Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);

		$data = array(
			'img'		=> $this->create_captcha(),
			'navbar'	=> 'index',
			'artikel'	=> $this->m_artikel->tampil_artikel2()->result(),
			'info' 		=> $this->m_info->tampil_info_aktif()->result(),
			'page' 		=> ($this->uri->segment(3)) ? $this->uri->segment(3) : 0,
			'data' 		=> $this->m_artikel->page_artikel($config["per_page"], ($this->uri->segment(3)) ? $this->uri->segment(3) : 0),
			'pagination' => $this->pagination->create_links(),
			'kantor'	=> $this->m_user->tampil_kantor()->result()
		);
		//print_r($data['page']);  return 1;

		$this->load->view('template/home', $data);
	}

	/*public function kelola_artikel()
	{
			$data['artikel'] = $this->m_artikel->tampil_artikel()->result();
			$this->load->view('admin/kelola_artikel', $data);
	}*/

	function create_captcha()
	{
		$options = array(
			'img_path' => './captcha/',
			'img_url' => base_url() . 'captcha/',
			'img_width' => '150',
			'img_height' => 60,
			'word_length' => 6,
			'pool'          => '234567890ABCDEFGHJKLMNPQRSTUVWXYZ',
			'font_size'     => 15,
			'font_path' => FCPATH . 'assets/verdana-font-family/verdana.ttf',
			'expiration' => 60,
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 255, 255)
			)
		);
		$cap = create_captcha($options);
		$img = $cap['image'];
		$this->session->set_userdata('captchaword', $cap['word']);
		return $img;
		//return $cap;
	}

	function check_captcha()
	{
		if ($this->input->post('captcha') == $this->session->userdata('captchaword')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_captcha', 'Captcha yang anda masukkan salah!');
			return FALSE;
		}
	}

	public function tambah_aksi_ajukan()
	{
		$data['bagian']	= $this->m_user->tampil_bagian()->result();
		//Waktu sekarang
		date_default_timezone_set("Asia/Jakarta");
		$waktu_sekarang		= date('Y-m-d H:i:s');

		//echo date("d-m-Y", strtotime($waktu_sekarang));
		//
		//$next_id = $this->db->query('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "k3new" AND TABLE_NAME = "ajukan_keluhan"')->row()->AUTO_INCREMENT;
		$data['max_number'] = $this->m_kelola_tiket->max_number()->result();
		//print_r ($data['max_number']);

		if (isset($data['max_number']) != NULL) {
			$next_id = $data['max_number'][0]->nomor_servis + 1;
			//$format=$no.'/'.$next_id.'/'.$date_split[0];
		} else {
			$next_id = '1';
			//$format=$no.'/'.$date_split[1].'/'.$date_split[0];
		}
		$bagian = $this->input->post('bagian');
		$kantor = $this->input->post('kantor');
		$tahun = date('Y');

		$config['upload_path']          = './assets/dokumen';
		$config['allowed_types']        = 'jpg|jpeg|png|pdf|zip|rar';
		$new_name = time() . $_FILES["upload_file"]['name'];
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('upload_file')) {
			$data = [
				'kode_servis' => $next_id,
				'format_nomor' => '32' . '/' . $next_id . '/' . $tahun,
				'nama' => $this->input->post('nama'),
				'id_bagian' => $bagian,
				'id_master_kantor' => $kantor,
				'tanggal' => $waktu_sekarang,
				//'email' => $this->input->post('email'),
				'jns_kerusakan' => $this->input->post('jns_kerusakan'),
				'id_master_jns' => $this->input->post('id_master_jns'),
				'uraian' => $this->input->post('uraian_kerusakan'),
				'tahun' => $tahun,
				'nomor_hp' => $this->input->post('hp'),
				'upload_dokumen' => $this->upload->data('file_name')
			];
			if ($this->input->post('captcha') == $this->session->userdata('captchaword')) {
				//print_r($data); die();	
				$this->m_user->input_data_ajukan($data, 'ajukan_keluhan');
				//$this->send();
				//$this->session->set_flashdata('success', "Data berhasil disimpan. Silahkan mengecek kotak masuk/sapam email anda untuk mendapatkan update keluhan.");
				$this->session->set_flashdata('valid', 'bbb');
				redirect(base_url('daftar_antrian'));
				//header('Location: 'user/daftar_antrian);
				//$this->session->set_flashdata('success', "Data berhasil disimpan");
				//redirect("", 'refresh');
				//return TRUE;
			} else {
				$data = [
					'kode_servis' => $next_id,
					'nama' => $this->input->post('nama'),
					'id_bagian' => $this->input->post('bagian'),
					'id_master_kantor' => $this->input->post('kantor'),
					'tanggal' => $waktu_sekarang,
					'hp' => $this->input->post('hp'),
					//'email' => $this->input->post('email'),
					'jns_kerusakan' => $this->input->post('jns_kerusakan'),
					'id_master_jns' => $this->input->post('id_master_jns'),
					'uraian' => $this->input->post('uraian_kerusakan'),
					// 'notif' => '<p style="color:red;"><b>Captcha salah, mohon masukkan kembali data yang benar. </b></p>'
				];
				$this->session->set_flashdata('error', 'aaa');
				$this->session->set_flashdata($data);
				//echo "<script>alert('Captcha salah!')</script>";
				// return redirect()->back()->withInput();
				redirect('user/index', $data);
			}
		} else {
			$data = [
				'kode_servis' => $next_id,
				'format_nomor' => 'DPTI' . '/' . $next_id . '/' . $tahun,
				'nama' => $this->input->post('nama'),
				'id_bagian' => $bagian,
				'id_master_kantor' => $kantor,
				'tanggal' => $waktu_sekarang,
				//'email' => $this->input->post('email'),
				'jns_kerusakan' => $this->input->post('jns_kerusakan'),
				'id_master_jns' => $this->input->post('id_master_jns'),
				'uraian' => $this->input->post('uraian_kerusakan'),
				'tahun' => $tahun,
				'nomor_hp' => $this->input->post('hp'),
				'upload_dokumen' => $this->upload->data('file_name')
			];
			if ($this->input->post('captcha') == $this->session->userdata('captchaword')) {
				//print_r($data); die();	
				$this->m_user->input_data_ajukan($data, 'ajukan_keluhan');
				//$this->send();
				//$this->session->set_flashdata('success', "Data berhasil disimpan. Silahkan mengecek kotak masuk/sapam email anda untuk mendapatkan update keluhan.");
				$this->session->set_flashdata('valid', 'bbb');
				redirect(base_url('daftar_antrian'));
				//header('Location: 'user/daftar_antrian);
				//$this->session->set_flashdata('success', "Data berhasil disimpan");
				//redirect("", 'refresh');
				//return TRUE;
			} else {
				$data = [
					'kode_servis' => $next_id,
					'nama' => $this->input->post('nama'),
					'id_bagian' => $this->input->post('bagian'),
					'id_master_kantor' => $this->input->post('kantor'),
					'tanggal' => $waktu_sekarang,
					//'email' => $this->input->post('email'),
					'hp' => $this->input->post('hp'),
					'jns_kerusakan' => $this->input->post('jns_kerusakan'),
					'id_master_jns' => $this->input->post('id_master_jns'),
					'uraian' => $this->input->post('uraian_kerusakan'),
					// 'notif' => 'Captcha salah, mohon masukkan kembali data yang benar.'
				];
				$this->session->set_flashdata('error', 'aaa');
				$this->session->set_flashdata($data);
				// $this->session->set_flashdata('selected_kantor', $this->input->post('kantor'));
            	// $this->session->set_flashdata('selected_bagian', $this->input->post('bagian'));
            	// $this->session->set_flashdata('selected_jns_kerusakan', $this->input->post('jns_kerusakan'));

				//echo "<script>alert('Captcha salah!')</script>";
				redirect('user/index');
			}
		}
	}

	public function send()
	{
		if ($_POST['email']) {
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => '127.0.0.1', //127.0.0.1 
				'smtp_port' => 25,
				'smtp_user' => 'it.support@ptpn1.co.id',   //ti.ptpn12@ptpn12.com
				'smtp_pass' => 'Akhlak123',
				'mailtype' => 'html',
				'smtp_timeout' => 100,
				'charset' => 'iso-8859-1'
			);

			$nama = $_POST['nama'];
			$id_kel = $this->m_kelola_tiket->get_id_ajukan()->row()->id_ajukan;
			$bagian = $this->m_kelola_tiket->ambil_nama_bagian($id_kel)->row()->bagian;
			$kantor = $this->m_kelola_tiket->ambil_nama_kantor($id_kel)->row()->nama_master_kantor;
			$email = $_POST['email'];
			$jns_kerusakan = $_POST['jns_kerusakan'];
			$uraian_kerusakan = $_POST['uraian_kerusakan'];
			$id_master_jns = $this->m_user->tampil_mstrjns()->result();
			$perangkat = $_POST['id_master_jns'];
			foreach ($id_master_jns as $j) {
				if ($perangkat == $j->id_master_jns) {
					$perangkat = $j->jns_prgkt;
					//echo $perangkat;
				}
				//echo "id=" . $j->id_master_jns . "nama=" . $j->jns_prgkt . "";
			}
			$email_region = $this->m_kelola_tiket->ambil_email_admin_reg($id_kel)->row()->email;
			$this->load->library('mailer', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('it.support@ptpn1.co.id', 'Support TI-PTPN I');
			$this->email->to($email);  //diganti email TI PT APN
			$this->email->cc($email_region);  //diganti email admin region terkait
			$this->email->subject('Notifikasi Support TI');
			$this->email->message('
					Karyawan PTPN I telah mengajukan keluhan di Support TI :<br>
					Nama 			: ' . $nama . '<br>
					Unit Kerja		: ' . $kantor . '<br>
					Bagian          : ' . $bagian . '<br>
					Email           : ' . $email . '<br>
					Jenis Layanan   : ' . $jns_kerusakan . '<br>
					Perangkat	    : ' . $perangkat . '<br>
					Uraian Kerusakan: ' . $uraian_kerusakan . '	<br><br>
					Untuk selanjut dapat menghubungi Bagian TI pada ' . $kantor . ' untuk konfirmasi.				
			');
			//$dot_count = substr_count($email, ".")+substr_count($nama, ".")+substr_count($uraian_kerusakan, ".");
			//for ($i=1; $i <= $dot_count; $i++) { 
			//$this->email->set_newline("\r\n"); 
			//aaaa
			//}
			if (!$this->email->send()) {
				//show_error("anda salah email");
				//$this->session->set_flashdata('email','<p style="color:red;"><b>Email yang Anda Inputkan Salah. </b></p>');
				$this->session->set_flashdata('not', 'aaaa');
				redirect(base_url('daftar_antrian'));
			} else {
				$this->session->set_flashdata('valid', 'bbb');
				redirect(base_url('daftar_antrian'));
			}
		} else {
			$nama = $_POST['nama'];
			$id_kel = $this->m_kelola_tiket->get_id_ajukan()->row()->id_ajukan;
			$bagian = $this->m_kelola_tiket->ambil_nama_bagian($id_kel)->row()->bagian;
			$kantor = $this->m_kelola_tiket->ambil_nama_kantor($id_kel)->row()->nama_master_kantor;
			$jns_kerusakan = $_POST['jns_kerusakan'];
			$uraian_kerusakan = $_POST['uraian_kerusakan'];
			$id_master_jns = $this->m_user->tampil_mstrjns()->result();
			$perangkat = $_POST['id_master_jns'];
			foreach ($id_master_jns as $j) {
				if ($perangkat == $j->id_master_jns) {
					$perangkat = $j->jns_prgkt;
					//echo $perangkat;
				}
				//echo "id=" . $j->id_master_jns . "nama=" . $j->jns_prgkt . "";
			}
			$this->session->set_flashdata('success', "Data berhasil disimpan. Silahkan mengecek email untuk update keluhan anda.");
			redirect('user/daftar_antrian');
		}
	}

	public function daftar_antrian($filter = null)
	{
		//$id_master_kantor = $this->input->post('id_master_kantor');
		$data['get_list_kantor'] = $this->m_daftar_pengguna->get_list_kantor()->result();
		$data['total'] = $this->db->count_all('ajukan_keluhan'); //total row
		$data['img'] = $this->create_captcha();
		$data['filter'] = $this->input->post('filter');
		//$data = array('img'=>$this->create_captcha(), 'navbar'=>'daftar_antrian');
		$this->load->view('template/daftar_antrian',  $data);
	}

	public function get_tiket()
	{
		/*
		| Select As
		*/
	
		$this->datatables->table('ajukan_keluhan');
		$this->datatables->select('kode_servis, tanggal, nama, nama_master_kantor_baru, bagian, email, jns_kerusakan, uraian, status');
		/*
		| Join Clause
		| $this->datatables->join('table', 'condition', 'type')
		| By default parameter type adalah null, anda bisa menambahkan INNER JOIN dll
		*/
		$this->datatables->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian', 'left');
		$this->datatables->join('master_kantor', 'ajukan_keluhan.id_master_kantor = master_kantor.id_master_kantor', 'left');
		// if ($filter != null) {
		// 	$this->datatables->where('ajukan_keluhan.id_master_kantor', $filter);
		// }
		echo $this->datatables->draw();
	}

	public function faq()
	{
		//$data['daftar_antrian'] = $this->m_user->tampil_kelola_tiket()->result();
		//$data = array('img'=>$this->create_captcha(), 'navbar'=>'daftar_antrian');
		$data['img'] = $this->create_captcha();
		$this->load->view('template/faq', $data);
	}

	public function sla()
	{
		//$data['daftar_antrian'] = $this->m_user->tampil_kelola_tiket()->result();
		//$data = array('img'=>$this->create_captcha(), 'navbar'=>'daftar_antrian');
		$data['img'] = $this->create_captcha();
		$this->load->view('template/sla', $data);
	}

	public function pengaduan_cybersecurity()
	{
		$data['img'] = $this->create_captcha();
		$data['kantor']	= $this->m_user->tampil_kantor()->result();
		$this->load->view('template/pengaduan_cybersecurity', $data);
	}

	public function set_old_data_pengaduan_cyber_security($next_id, $waktu_sekarang)
	{
		$this->session->set_flashdata('kode_servis', $next_id);
		$this->session->set_flashdata('nama', $this->input->post('nama'));
		$this->session->set_flashdata('id_bagian', $this->input->post('bagian'));
		$this->session->set_flashdata('id_master_kantor', $this->input->post('kantor'));
		$this->session->set_flashdata('tanggal', $waktu_sekarang);
		$this->session->set_flashdata('hp', $this->input->post('hp'));
		$this->session->set_flashdata('jns_kerusakan', $this->input->post('jns_kerusakan'));
		$this->session->set_flashdata('id_master_jenis', $this->input->post('id_master_jenis'));
		$this->session->set_flashdata('uraian', $this->input->post('uraian_kerusakan'));
	}

	public function  tambah_pengajuan_cybersecurity()
	{
		// set time zone
		date_default_timezone_set('Asia/Jakarta');

		// get waktu sekarang
		$waktu_sekarang = date('Y-m-d H:i:s');
		$tahun = date('Y');
		
		// tiket
		$data['max_number'] = $this->m_kelola_tiket_cybersecurity->max_number()->result();
		if (isset($data['max_number']) != NULL) {
			$next_id = $data['max_number'][0]->nomor_servis + 1;
			//$format=$no.'/'.$next_id.'/'.$date_split[0];
		} else {
			$next_id = '1';
			//$format=$no.'/'.$date_split[1].'/'.$date_split[0];
		}

		// cek captcha
		if  ($this->input->post('captcha') != $this->session->userdata('captchaword')) {
			
			
			$this->session->set_flashdata('error', 'aaa');
			$this->set_old_data_pengaduan_cyber_security($next_id, $waktu_sekarang);
			return redirect('user/pengaduan_cybersecurity');
		}

		// upload file
		$config['upload_path']          = './assets/dokumen_cybersecurity';
		$config['allowed_types']        = 'jpg|jpeg|png|pdf|zip|rar';
		$new_name = time() . $_FILES["upload_file"]['name'];
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);

		if (isset($_POST['is_anonymous'])) {
			$data = [
				'kode_servis' => $next_id,
				'format_nomor' => '32' . '/' . $next_id . '/' . $tahun,
				// 'nama' => $this->input->post('nama'),
				// 'id_bagian' => $this->input->post('bagian'),
				// 'id_master_kantor' => $this->input->post('kantor'),
				'tanggal' => $waktu_sekarang,
				//'email' => $this->input->post('email'),
				'jns_kerusakan' => $this->input->post('jns_kerusakan'),
				'id_master_jns' => $this->input->post('id_master_jns'),
				'uraian' => $this->input->post('uraian_kerusakan'),
				'tahun' => $tahun,
				'is_anonymous' => 1,
				// 'nomor_hp' => $this->input->post('hp'),
			];
		} else {
			$data = [
				'kode_servis' => $next_id,
				'format_nomor' => '32' . '/' . $next_id . '/' . $tahun,
				'nama' => $this->input->post('nama'),
				'id_bagian' => $this->input->post('bagian'),
				'id_master_kantor' => $this->input->post('kantor'),
				'tanggal' => $waktu_sekarang,
				//'email' => $this->input->post('email'),
				'jns_kerusakan' => $this->input->post('jns_kerusakan'),
				'id_master_jns' => $this->input->post('id_master_jns'),
				'uraian' => $this->input->post('uraian_kerusakan'),
				'tahun' => $tahun,
				'nomor_hp' => $this->input->post('hp'),
				'is_anonymous' => 0,
			];
		}

		// cek apakah submit anonym atau tidak
		if ($this->upload->do_upload('upload_file')) {
			$data['upload_dokumen'] = $this->upload->data('file_name');
		}

		$this->m_user->input_data_ajukan_cybersecurity($data);
		$this->session->set_flashdata('valid', 'bbb');
		return redirect('user/pengaduan_cybersecurity');
	}

	public function artikel($id)
	{
		$data = array(
			'navbar'  => '',
			'artikel' => $this->m_artikel->baca($id),
			'img' => $this->create_captcha()
		);
		// var_dump($data['artikel']);
		// die();
		$this->load->view('template/artikel', $data);
	}

	function get_bagian()
	{
		$id_master_kantor = $this->input->post('id_master_kantor');
		$data = $this->m_user->tampil_bagian2($id_master_kantor);
		echo json_encode($data);
	}
	function get_jenis()
	{
		$id_master_kantor = $this->input->post('id_master_kantor');
		$data = $this->m_user->tampil_mstrjns2($id_master_kantor);
		echo json_encode($data);
	}
}
