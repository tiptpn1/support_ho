<?php

class Auth extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model(array('m_login', 'm_user'));
		//$this->load->model(array('m_master_jns', 'm_master_prgkt', 'm_pengajuan', 'm_perangkat', 'm_kelola_tiket', 'm_master_layanan', 'm_list_role', 'm_daftar_pengguna', 'm_artikel', 'm_info', 'm_histori', 'm_jamkerja', 'm_hari_libur', 'm_tahun', 'M_master_layanan', 'm_user', 'm_master_group_perangkat', 'm_daftar_kantor', 'm_daftar_bagian'));
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function login_aksi()
	{
		$user = $this->input->post('username', true);
		$pass = md5($this->input->post('password', true));
		$kantor = $this->input->post('kantor', true);
		$captcha = $this->input->post('captcha2', true);

		//rule validasi
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('kantor', 'kantor', 'required');
		$this->form_validation->set_rules('captcha2', 'Captcha', 'required');

        if ($captcha != $this->session->userdata('captchaword')) {
				echo '<script type="text/javascript">'; 
				echo 'alert("Captcha salah. Silahkan coba lagi");'; 
				echo 'window.location.href = "/";';
				echo '</script>';
        } else if($this->session->userdata('login_attemp')) {
			$login_attemp = $this->session->userdata('login_attemp');
			if ($login_attemp==4){
				$date_minute = date('i');
				if ($this->session->userdata('minute_now')){
					$cek_minute = $this->session->userdata('minute_now');
					if ($cek_minute == $date_minute) {
						echo '<script type="text/javascript">'; 
						echo 'alert("Harap tunggu 1 Menit untuk Login Lagi.");';
						echo 'window.location.href = "/";';
						echo '</script>';
					} else {
						if ($this->form_validation->run() != FALSE) {
							$where = array(
								'username' => $user,
								'password' => $pass,
								'id_master_kantor' => $kantor,
								'role_status' => 'aktif'
							);

							$cekLogin = $this->m_login->cek_login($where)->num_rows();

							if ($cekLogin > 0) {
								//$row = $cekLogin->row();

								$this->session->unset_userdata('login_attemp');
								$this->session->unset_userdata('minute_now');
								$this->session->unset_userdata('hour_now');

								$sess_data = array(
									'username' => $user,
									'role'	   => $this->m_login->cek_login($where)->row()->role,
									'id_user'  =>  $this->m_login->cek_login($where)->row()->id_user,
									'id_master_kantor'  =>  $this->m_login->cek_login($where)->row()->id_master_kantor,
									'login'    => 'OK'
								);
								$this->session->set_userdata($sess_data);

								redirect(base_url('Panel/laporan_grafik'));
							} else {
								$login_attemp_count = $login_attemp + 1;
                            	$session = array(
                                	'login_attemp' => $login_attemp_count,
                                );
                                $this->session->set_userdata($session);

								echo '<script type="text/javascript">'; 
								echo 'alert("Username/Password salah.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
							}
						} else {
								$login_attemp_count = $login_attemp + 1;
                            	$session = array(
                                	'login_attemp' => $login_attemp_count,
                                );
                                $this->session->set_userdata($session);
                                
								echo '<script type="text/javascript">'; 
								echo 'alert("Username/Password salah.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
						}
					}
				} else {
					if ($this->form_validation->run() != FALSE) {
							$where = array(
								'username' => $user,
								'password' => $pass,
								'id_master_kantor' => $kantor,
								'role_status' => 'aktif'
							);

							$cekLogin = $this->m_login->cek_login($where)->num_rows();
							//$str = $this->db->last_query();
                            //echo $str;
                            //die();

							if ($cekLogin > 0) {
								//$row = $cekLogin->row();

								$this->session->unset_userdata('login_attemp');
								$this->session->unset_userdata('minute_now');
								$this->session->unset_userdata('hour_now');

								$sess_data = array(
									'username' => $user,
									'role'	   => $this->m_login->cek_login($where)->row()->role,
									'id_user'  =>  $this->m_login->cek_login($where)->row()->id_user,
									'id_master_kantor'  =>  $this->m_login->cek_login($where)->row()->id_master_kantor,
									'login'    => 'OK'
								);
								$this->session->set_userdata($sess_data);

								redirect(base_url('Panel/laporan_grafik'));
							} else {
	                            $session = array(
	                            	'minute_now' => $date_minute,
	                            );
                                $this->session->set_userdata($session);
                                
								echo '<script type="text/javascript">'; 
								echo 'alert("Harap tunggu 1 Menit untuk Login Lagi.");';
								echo 'window.location.href = "/";';
								echo '</script>';
							}
						} else {
	                            $session = array(
	                            	'minute_now' => $date_minute,
	                            );
                                $this->session->set_userdata($session);
                                
								echo '<script type="text/javascript">'; 
								echo 'alert("Harap tunggu 1 Menit untuk Login Lagi.");';
								echo 'window.location.href = "/";';
								echo '</script>';
						} 
				}
			} else if ($login_attemp==8) {
				$date_hour = date('H');
				if ($this->session->userdata('hour_now')){
					$cek_hour = $this->session->userdata('hour_now');
					if ($cek_hour == $date_hour) {
						echo '<script type="text/javascript">'; 
						echo 'alert("Sesi Login Sudah Melebihi Batas.\nHarap Tunggu Beberapa Saat untuk Login Lagi.");'; 
						echo 'window.location.href = "/";';
						echo '</script>';
					} else {
						if ($this->form_validation->run() != FALSE) {
							$where = array(
								'username' => $user,
								'password' => $pass,
								'id_master_kantor' => $kantor,
								'role_status' => 'aktif'
							);

							$cekLogin = $this->m_login->cek_login($where)->num_rows();

							if ($cekLogin > 0) {
								//$row = $cekLogin->row();

								$this->session->unset_userdata('login_attemp');
								$this->session->unset_userdata('minute_now');
								$this->session->unset_userdata('hour_now');

								$sess_data = array(
									'username' => $user,
									'role'	   => $this->m_login->cek_login($where)->row()->role,
									'id_user'  =>  $this->m_login->cek_login($where)->row()->id_user,
									'id_master_kantor'  =>  $this->m_login->cek_login($where)->row()->id_master_kantor,
									'login'    => 'OK'
								);
								$this->session->set_userdata($sess_data);

								redirect(base_url('Panel/laporan_grafik'));
							} else {
								$this->session->unset_userdata('login_attemp');
								$this->session->unset_userdata('minute_now');
								$this->session->unset_userdata('hour_now');

								echo '<script type="text/javascript">'; 
								echo 'alert("Username/Password salah.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
							}
						} else {
								$this->session->unset_userdata('login_attemp');
								$this->session->unset_userdata('minute_now');
								$this->session->unset_userdata('hour_now');
                                
								echo '<script type="text/javascript">'; 
								echo 'alert("Username/Password salah.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
						}
					}
				} else {
					if ($this->form_validation->run() != FALSE) {
							$where = array(
								'username' => $user,
								'password' => $pass,
								'id_master_kantor' => $kantor,
								'role_status' => 'aktif'
							);

							$cekLogin = $this->m_login->cek_login($where)->num_rows();

							if ($cekLogin > 0) {
								//$row = $cekLogin->row();

								$this->session->unset_userdata('login_attemp');
								$this->session->unset_userdata('minute_now');
								$this->session->unset_userdata('hour_now');

								$sess_data = array(
									'username' => $user,
									'role'	   => $this->m_login->cek_login($where)->row()->role,
									'id_user'  =>  $this->m_login->cek_login($where)->row()->id_user,
									'id_master_kantor'  =>  $this->m_login->cek_login($where)->row()->id_master_kantor,
									'login'    => 'OK'
								);
								$this->session->set_userdata($sess_data);

								redirect(base_url('Panel/laporan_grafik'));
							} else {
	                            $session = array(
	                            	'hour_now' => $date_hour,
	                            );
                                $this->session->set_userdata($session);

								echo '<script type="text/javascript">'; 
								echo 'alert("Sesi Login Sudah Melebihi Batas.\nHarap Tunggu Beberapa Saat untuk Login Lagi.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
							}
						} else {
	                            $session = array(
	                            	'hour_now' => $date_hour,
	                            );
                                $this->session->set_userdata($session);

								echo '<script type="text/javascript">'; 
								echo 'alert("Sesi Login Sudah Melebihi Batas.\nHarap Tunggu Beberapa Saat untuk Login Lagi.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
						}
				}
			} else {
				if ($this->form_validation->run() != FALSE) {
							$where = array(
								'username' => $user,
								'password' => $pass,
								'id_master_kantor' => $kantor,
								'role_status' => 'aktif'
							);

							$cekLogin = $this->m_login->cek_login($where)->num_rows();

							if ($cekLogin > 0) {
								//$row = $cekLogin->row();

								$this->session->unset_userdata('login_attemp');
								$this->session->unset_userdata('minute_now');
								$this->session->unset_userdata('hour_now');

								$sess_data = array(
									'username' => $user,
									'role'	   => $this->m_login->cek_login($where)->row()->role,
									'id_user'  =>  $this->m_login->cek_login($where)->row()->id_user,
									'id_master_kantor'  =>  $this->m_login->cek_login($where)->row()->id_master_kantor,
									'login'    => 'OK'
								);
								$this->session->set_userdata($sess_data);

								redirect(base_url('Panel/laporan_grafik'));
							} else {
								$login_attemp_count = $login_attemp + 1;
                            	$session = array(
                                	'login_attemp' => $login_attemp_count,
                                );
                                $this->session->set_userdata($session);

								echo '<script type="text/javascript">'; 
								echo 'alert("Username/Password salah.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
							}
						} else {
								$login_attemp_count = $login_attemp + 1;
                            	$session = array(
                                	'login_attemp' => $login_attemp_count,
                                );
                                $this->session->set_userdata($session);
                                
								echo '<script type="text/javascript">'; 
								echo 'alert("Username/Password salah.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
						}
			}
		} else {
			if ($this->form_validation->run() != FALSE) {
							$where = array(
								'username' => $user,
								'password' => $pass,
								'id_master_kantor' => $kantor,
								'role_status' => 'aktif'
							);

							$cekLogin = $this->m_login->cek_login($where)->num_rows();

							if ($cekLogin > 0) {
								//$row = $cekLogin->row();

								$this->session->unset_userdata('login_attemp');
								$this->session->unset_userdata('minute_now');
								$this->session->unset_userdata('hour_now');

								$sess_data = array(
									'username' => $user,
									'role'	   => $this->m_login->cek_login($where)->row()->role,
									'id_user'  =>  $this->m_login->cek_login($where)->row()->id_user,
									'id_master_kantor'  =>  $this->m_login->cek_login($where)->row()->id_master_kantor,
									'login'    => 'OK'
								);
								$this->session->set_userdata($sess_data);

								redirect(base_url('Panel/laporan_grafik'));
							} else {
								$login_attemp_count = 1;
                            	$session = array(
                                	'login_attemp' => $login_attemp_count,
                                );
                                $this->session->set_userdata($session);

								echo '<script type="text/javascript">'; 
								echo 'alert("Username/Password salah.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
							}
						} else {
								$login_attemp_count = 1;
                            	$session = array(
                                	'login_attemp' => $login_attemp_count,
                                );
                                $this->session->set_userdata($session);
                                
								echo '<script type="text/javascript">'; 
								echo 'alert("Username/Password salah.");'; 
								echo 'window.location.href = "/";';
								echo '</script>';
						}
		}


				// if ($this->form_validation->run() != FALSE) {
				// 	$where = array(
				// 		'username' => $user,
				// 		'password' => $pass,
				// 		'role_status' => 'aktif'
				// 	);

				// 	$cekLogin = $this->m_login->cek_login($where)->num_rows();

				// 	if ($cekLogin > 0) {
				// 		//$row = $cekLogin->row();
				// 		$sess_data = array(
				// 			'username' => $user,
				// 			'role'	   => $this->m_login->cek_login($where)->row()->role,
				// 			'id_user'  =>  $this->m_login->cek_login($where)->row()->id_user,
				// 			'login'    => 'OK'
				// 		);

				// 		$this->session->set_userdata($sess_data);

				// 		redirect(base_url('Panel/laporan_grafik'));
				// 	} else {
				// 		echo '<script type="text/javascript">'; 
				// 		echo 'alert("Username/Password salah.");'; 
				// 		echo 'window.location.href = "/support_testing/";';
				// 		echo '</script>';
				// 		// redirect(base_url('user/index'));
				// 	}
				// } else {
				// 		echo '<script type="text/javascript">'; 
				// 		echo 'alert("Username/Password salah.");'; 
				// 		echo 'window.location.href = "/support_testing/";';
				// 		echo '</script>';
				// }
	}

	/*public function login_aksi(){
		$post = $this->input->post(null,TRUE);
		if(isset($post['login'])){
			$this->load->model('m_login');
			$query = $this->m_login->login($post);
			if($query->num_rows() > 0){
				$row = $query -> row();
				//echo $row->username;
				$params = array(
					'id_user' => $row->id_user,
					'role'	 => $row->role
				);
				//print_r($params);
				$this->session->set_userdata($params);
				echo "<script>
				alert ('Login berhasil');
				window.location='".site_url('admin/laporan_grafik')."';
				</script>";
			}else{
				echo "<script>
				alert ('Login gagal, nama pengguna atau kata sandi salah!');
				window.location='".site_url('user/index')."';
				</script>";
			}
		}
	}*/

	public function forgot_password()
	{
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
		$this->form_validation->set_message('valid_email', '%s tidak valid, mohon masukkan email yang benar');

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'img'		=> $this->create_captcha()
			);
			$this->load->view('template/forgot_password',$data);
		} 
		else{
			$email = $this->input->post('email');
			$user = $this->db->get_where('users', ['email' => $email, 'role_status' => 'aktif'])->row_array();
			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token
				];
				$this->db->insert('user_token', $user_token);
				$this->sendEmail($token, 'forgot');

				echo '<script type="text/javascript">'; 
				echo 'alert("Verifikasi Reset Password Berhasil Dikikim.");'; 
				echo 'window.location.href = "/";';
				echo '</script>';
			} else {
				echo '<script type="text/javascript">'; 
				echo 'alert("Email Tidak Terdaftar.");'; 
				echo 'window.location.href = "/";';
				echo '</script>';
			}
		}
	}

	function sendEmail($token, $type)
	{
		
		$config = array(
			'protocol' => 'smtp',  
			'smtp_host' => '127.0.0.1', //127.0.0.1 
			// // 'smtp_pass' => 'tisuppco', 
			'smtp_port' => 25,  
			// // 'smtp_user' => 'ti@ptapn.com',   //ti.ptpn12@ptpn12.co			
			'mailtype' => 'html', 
			'smtp_timeout' => 100,   
			'charset' => 'iso-8859-1'  
		);
		//$this->email->initialize($config);
		$this->load->library('email', $config);
		$this->email->from('ti@ptapn.com', 'Support TI-PTP APN');
		$this->email->subject('Reset Password Support TI');
		$this->email->to($this->input->post('email'));

		if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('
				Karyawan PTPN XII telah mengajukan Reset Password di Support TI. Klik link dibawah ini untuk melakukan Reset Password :<br><br>
					<b><a href = "' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a></b>
					<br><br>Jika Anda tidak meminta pengaturan Reset Password, abaikan email ini atau dapat menghubungi Sub Bagian TI pada Ext 218 dan 500.
					');
		}

		// if (!$this->email->send()) {
		//  show_error($this->email->print_debugger());
		// } else {
		// 	echo 'Success to send email';
		// }
	}

	public function resetpassword(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('users', ['email' => $email])->row_array();

		if($user){
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if($user_token){
				$this->session->set_userdata('reset_email', $email);
				//$this->changePassword();
				redirect(base_url('auth/changePassword'));
				//echo "OK";
			}else{
				$this->session->set_flashdata('message',  '<div class="alert alert-danger" role="alert">Token salah</div>');
				redirect(base_url('auth/forgot_password'));
			}
		}else{
			$this->session->set_flashdata('message',  '<div class="alert alert-danger" role="alert">Reset password gagal</div>');
			redirect(base_url('auth/forgot_password'));
		}
	}

	public function changePassword(){
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]',array('matches' => '%s tidak sesuai dengan password'));
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[5]|matches[password1]', array('matches' => '%s tidak sesuai dengan password'));

		$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/change_password');
		}else{
			$password = md5($this->input->post('password1', true));
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('users');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
			redirect(base_url('user/index'));
			//redirect(base_url('auth/changePassword'));
			//echo "OK";
		}
	}

	public function logout()
	{

		$this->session->sess_destroy();
		redirect(base_url('user/index'));
	}
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
		$image = $cap['image'];
		$this->session->set_userdata('captchaword', $cap['word']);
		return $image;
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
	function ubah_password()
	{
		$this->load->view('admin/ubah_sandi');
	}
	public function exe_ubah_password(){
			$password = md5($this->input->post('passbaru', true));
			$username = $this->session->userdata('username');

			$this->db->set('password', $password);
			$this->db->where('username', $username);
			$this->db->update('users');
			//$str = $this->db->last_query();
            //echo $str;
            //die();
			//$this->session->unset_userdata('username');
			$this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
			redirect(base_url('Auth/ubah_password'));
			//redirect(base_url('auth/changePassword'));
			//echo "OK";
		//}
	}
}
