<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Panel extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->library('pagination');


		if (empty($this->session->userdata('login'))) {
			redirect(base_url('user/index'));
		}

		$this->load->model(array('m_master_jns', 'm_master_prgkt', 'm_pengajuan', 'm_perangkat', 'm_kelola_tiket', 'm_master_layanan', 'm_list_role', 'm_daftar_pengguna', 'm_artikel', 'm_info', 'm_histori', 'm_jamkerja', 'm_hari_libur', 'm_tahun', 'M_master_layanan', 'm_user', 'm_master_group_perangkat', 'm_daftar_kantor', 'm_daftar_bagian', 'm_kelola_tiket_cybersecurity'));
	}


	public function perangkat()
	{

		$this->load->library('ciqrcode');
		$this->load->library('encryption');
		$kantor = $this->session->userdata('id_master_kantor');
		$data['perangkat'] = $this->m_perangkat->tampil_perangkat($kantor)->result();
		$this->load->view('admin/perangkat', $data);
	}

	public function cetak_label($id_perangkat = null)
	{

		$this->load->library('ciqrcode');
		$this->load->library('encryption');
		$kantor = $this->session->userdata('id_master_kantor');
		$data['perangkat'] = $this->m_perangkat->tampil_perangkat($kantor, $id_perangkat)->result();
		$this->load->view('admin/cetak_label', $data);
	}
	
	public function getJamMasuk($input_1_hari) {
	    $this->load->helper('url');
	    
	    $ci = get_instance();
        $ci->load->model('m_jamkerja');
        $ci->load->model('m_hari_libur');
        
        $harian_masuk = $ci->m_jamkerja->r_masuk($input_1_hari);
        
        $data = array(
            "harian_masuk" => $harian_masuk
            );
        $json_data = json_encode($data);
        $this->output
            ->set_content_type('application/json');
        echo($json_data);
        exit();
	}
	
	public function getJamSelesai($input_1_hari) {
	    $this->load->helper('url');
	    
	    $ci = get_instance();
        $ci->load->model('m_jamkerja');
        $ci->load->model('m_hari_libur');
        
        $harian_selesai     = $ci->m_jamkerja->r_keluar($input_1_hari);
        $data = array(
            "harian_selesai" => $harian_selesai
            );
        $json_data = json_encode($data);
        $this->output
            ->set_content_type('application/json');
        echo($json_data);
        exit();
	}


	public function tambah_perangkat()
	{
		if ($this->session->userdata('role') == 1) {
			$kantor = $this->session->userdata('id_master_kantor');
			$data['perangkat']	= $this->m_master_prgkt->tampil_mstrprgkt_aktif($kantor)->result();
			$data['pengajuan_lelang'] = $this->m_perangkat->tampil_pilih_dokumen($kantor)->result();
			$data['bagian']	= $this->m_pengajuan->tampil_bagian2($kantor)->result();
			// $data= $this->m_perangkat->cek_perangkat_pengajuan($kantor)->result();
			// $hitung_perangkat=count($data);
			// print_r($this->db->last_query());
			// die();
			//$data['max_number'] = $this->m_perangkat->max_number()->result();
			//print_r ($data['max_number'][0]->nomor+1);
			//die();
			//$date=date("Y-m-d");
			//$date_split =explode("-",$date);
			//if(isset($data['max_number'])){
			//$no = $data['max_number'][0]->nomor+1;
			//$no = str_pad($no,3,'0',STR_PAD_LEFT);
			//$data['format']=$no.'/'.$date_split[1].'/'.$date_split[0];
			//}else{
			//$no=1;
			//$no = str_pad($no,3,'0',STR_PAD_LEFT);
			//$data['format']=$no.'/'.$date_split[1].'/'.$date_split[0];
			//}
			//echo $format;
			//die();
			//Halaman sebelumnya
			if ($this->input->get('go') != NULL) {
				$this->session->set_userdata('link', $this->input->get('go'));
			}

			$this->load->view('admin/tambah_perangkat', $data);
		}
	}
	public function tambah_aksi_perangkat()
	{

		if ($this->session->userdata('role') == 1) {
			date_default_timezone_set("Asia/Jakarta");
			$data['max_number'] = $this->m_perangkat->max_number()->result();
			if (isset($data['max_number'])) {
				$no = $data['max_number'][0]->nomor + 1;
				//$format=$no.'/'.$date_split[1].'/'.$date_split[0];
			} else {
				$no = 1;
				//$format=$no.'/'.$date_split[1].'/'.$date_split[0];
			}
			$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
			$bln = $array_bln[date('n')];
			//echo $bln;

			$milik = $this->input->post('kepemilikan');
			if ($milik == "SW") {
				$kepemilikan = "Sewa";
			} elseif ($milik == "TI") {
				$kepemilikan = "Inventaris";
			} else {
				$kepemilikan = "P";
			}
			//$nomor= $this->input->post('nomor');
			//$nomor_split=explode('/',$nomor);

			$tgl_terima = $this->input->post('tgl_terima');
			$terima_split = explode('-', $tgl_terima);
			$format_tgl = $terima_split[2] . '-' . $terima_split[1] . '-' . $terima_split[0];
			$format = $no . '/' . $milik . '/' . $bln . '/' . $terima_split[2];

			//print_r($format_tgl);
			//die();

			$kantor = $this->session->userdata('id_master_kantor');
			//$id_pengajuan=$this->input->post('id_pengajuan');
			//$id_master_perangkat=$this->input->post('id_master_prgkt');
			//$data1 = $this->m_perangkat->cek_perangkat_pengajuan($id_pengajuan,$kantor,$id_master_perangkat)->result();
			// print_r($this->db->last_query());
			// die();
			// $hitung_perangkat=count($data1);
			// if($id_pengajuan != NULL)
			// {
			// 	if($id_master_perangkat != NULL)
			//  	{
			// 		if ($hitung_perangkat == $data1[0]->jml1)
			// 		{
			// 			echo '<script>alert("Jenis perangkat tidak terdaftar atau sudah terpenuhi dari data lelang yang anda pilih"); window.location.href="'.base_url().'Panel/tambah_perangkat";</script>';
			// 			die();
			// 		}
			//  	}
			// }

			$data = array(
				//'id_perangkat' => $this->input->post('id_perangkat'),
				'id_master_prgkt' => $this->input->post('id_master_prgkt'),
				//'jns_prgkt' => $this->input->post('jns_prgkt'),
				//'tipe_prgkt' => $this->input->post('tipe'),
				'detail' => $this->input->post('detail'),
				'no_prgkt_ti' => $format ?? '',
				'no_inventaris' => $this->input->post('no_inventaris') ?? '',
				'no_prgkt_vendor' => $this->input->post('noprgkt_vendor') ?? '',
				'no_spk' => $this->input->post('nospk'),
				'id_pengajuan' => $this->input->post('id_pengajuan'),
				'id_bagian' => $this->input->post('id_bagian'),
				'id_master_kantor' => $kantor,
				'status' => $this->input->post('status'),
				'nama_pengguna' => $this->input->post('nama_pengguna'),
				'tgl_input' => date('Y-m-d H:i:s'),
				'tgl_terima' => $format_tgl,
				'tahun_terima' => date('Y'),
				'nomor_perangkat' => $no,
				'kepemilikan' => $kepemilikan,
				'level' => $this->input->post('kritis')
			);

			$this->load->library('ciqrcode'); //pemanggilan library QR CODE

			// $config['cacheable']    = true; //boolean, the default is true
			// $config['cachedir']     = 'assets/'; //string, the default is application/cache/
			// $config['errorlog']     = 'assets/'; //string, the default is application/logs/
			// $config['imagedir']     = 'assets/images/'; //direktori penyimpanan qr code
			// $config['quality']      = true; //boolean, the default is true
			// $config['size']         = '1024'; //interger, the default is 1024
			// $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
			// $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
			// $this->ciqrcode->initialize($config);

			// $id_baru = $this->m_perangkat->get_id_perangkat()->row()->id_perangkat;

			//$tmp_nama_bagian = $this->m_perangkat->bagian_byID($data['id_bagian'])->bagian;
			/*$i = 1;
			$tmp_nama_bagian_text = '';
			foreach ($data['id_bagian'] as $b) {
				if ($i == 1)
					$tmp_nama_bagian_text .= $this->m_perangkat->bagian_byID($b)->bagian;
				else
					$tmp_nama_bagian_text .= ',' . $this->m_perangkat->bagian_byID($b)->bagian;
				$i++;
			}*/
			//
			//$params['data'] = $data['no_prgkt_ti'] . '_' . $data['no_prgkt_vendor'] . '_' . $tmp_nama_bagian; //data yang akan di jadikan QR CODE
			//
			// $id_baru_prgkt = $this->m_perangkat->get_id_perangkat()->row()->id_perangkat;
			// $data['qr_code'] = 'qrcode_new'.$id_baru_prgkt.'.png';
			// //var_dump($data);
			//
			$this->load->library('encryption');
			// echo $id_prgkt;
			// die();
			$this->m_perangkat->input_data_perangkat($data);
			$id_prgkt = $this->m_perangkat->get_id_perangkat()->row()->id_perangkat;

			$data['qr_code'] = 'qrcode_new' . $id_prgkt . '.png';

			$where = array(
				'id_perangkat' => $id_prgkt
			);
			$this->m_perangkat->edit_aksi_perangkat($data, $where);

			// $params['data'] = base_url('History/histori_perangkat/') . base64_encode($this->encryption->encrypt($id_prgkt));

			// echo $params['data'];
			// die();

			// $data['qr_code'] = 'qrcode_new'.$id_prgkt.'.png'; //buat name 
			// $params['level'] = 'H'; //H=High
			// $params['size'] = 10;
			// $params['savename'] = FCPATH . $config['imagedir'] . $data['qr_code']; //simpan image QR CODE ke folder assets/images/

			// $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE*/

			$this->ciqrcode->generate(array(
				'data'		=>	base_url('History/histori_perangkat/') . base64_encode($this->encryption->encrypt($id_prgkt)),
				'savename'	=>	'assets/images/qrcode_new' . ($id_prgkt) . '.png'
			));


			//Histori
			$data_terakhir = $this->db->order_by('id_perangkat', 'desc')->get('perangkat')->row();
			$this->db->insert('perangkat_histori', $data_terakhir);

			//Redirect
			if ($this->session->userdata('link') != NULL) {
				redirect($this->session->userdata('link'));
			} else {
				redirect('Panel/perangkat');
			}
		}
	}

	public function ubah_perangkat($id_perangkat)
	{
		if ($this->session->userdata('role') == 1) {
			$kantor = $this->session->userdata('id_master_kantor');
			$data['perangkat'] = $this->m_perangkat->edit_perangkat($id_perangkat)->row();
			
			$data['data_perangkat']	= $this->m_master_prgkt->tampil_mstrprgkt($kantor)->result();
			$data['pengajuan_lelang'] = $this->m_perangkat->tampil_pilih_dokumen($kantor)->result();
			$data['bagian'] = $this->m_perangkat->tampil_bagian($kantor)->result();
			$id_pengajuan 			= $data['perangkat']->id_pengajuan;
			$id_bagian_pengajuan	= $this->db->get_where('pengajuan_lelang', array('id_pengajuan' => $id_pengajuan))->row()->id_bagian_pengajuan ?? '';
			$data['bagian_2'] 		= $this->db->get_where('bagian_pengajuan', array('id_bagian_pengajuan' => $id_bagian_pengajuan))->result();

			$this->load->view('admin/ubah_perangkat', $data);
		}
	}
	public function ubah_aksi_perangkat()
	{
		if ($this->session->userdata('role') == 1) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl_terima = $this->input->post('tgl_terima');
			$terima_split = explode('-', $tgl_terima);
			$format_tgl = $terima_split[2] . '-' . $terima_split[1] . '-' . $terima_split[0];

			$month = sprintf('%2d', $terima_split[1]);
			//echo $month;
			$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
			$bln = $array_bln[intval($month)];

			//print_r($bln);
			// die();
			$milik = $this->input->post('kepemilikan');
			if ($milik == "Sewa") {
				$kepemilikan = "SW";
			} elseif ($milik == "Inventaris") {
				$kepemilikan = "TI";
			} else {
				$kepemilikan = "P";
			}
			$nomor = $this->input->post('nomor');
			$bulan = $bln;
			$tahun = $terima_split[2];
			$arr = [$nomor, $kepemilikan, $bulan, $tahun];
			//print_r($arr);
			//die();
			$gabung = implode("/", $arr);

			//print_r(date("Y-m-d H:i:s"));
			//die();

			$data = array(
				'id_master_prgkt' => $this->input->post('id_master_prgkt'),
				//'jns_prgkt' => $this->input->post('jns_prgkt'),
				//'tipe_prgkt' => $this->input->post('tipe'),
				'detail' => $this->input->post('detail'),
				'kepemilikan' => $milik,
				'no_prgkt_ti' => $gabung ?? '',
				'no_prgkt_vendor' => $this->input->post('noprgkt_vendor') ?? '',
				'no_inventaris' => $this->input->post('no_inventaris') ?? '',
				'no_spk' => $this->input->post('nospk'),
				'id_pengajuan' => $this->input->post('id_pengajuan'),
				'id_bagian' => $this->input->post('id_bagian'),
				'status' => $this->input->post('status'),
				'nama_pengguna' => $this->input->post('nama_pengguna'),
				'tgl_input' => date('Y-m-d H:i:s'),
				'tgl_terima' => $format_tgl,
				'tahun_terima' => date('Y'),
				'nomor_perangkat' => $this->input->post('nomor'),
				'level' => $this->input->post('kritis')
				//	'id_bagian_baru' => $this->input->post('id_bagian_baru'),
				//	'no_prgkt_baru' => $this->input->post('noprgkt_baru')
			);
			if ($this->input->post('mutasi') == 'mutasi') {
				$data['id_bagian']		= $this->input->post('id_bagian_baru');
				$data['no_inventaris']	= $this->input->post('noprgkt_baru');
			};
			$where = array(
				'id_perangkat' => $this->input->post('id_perangkat')
			);

			$this->load->library('ciqrcode'); //pemanggilan library QR CODE

			// $config['cacheable']    = true; //boolean, the default is true
			// $config['cachedir']     = 'assets/'; //string, the default is application/cache/
			// $config['errorlog']     = 'assets/'; //string, the default is application/logs/
			// $config['imagedir']     = 'assets/images/'; //direktori penyimpanan qr code
			// $config['quality']      = true; //boolean, the default is true
			// $config['size']         = '1024'; //interger, the default is 1024
			// $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
			// $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
			// $this->ciqrcode->initialize($config);
			//unlink('./assets/images/' . $data['qr_code']);
			$id = $this->input->post('id_perangkat');

			// echo $id;
			// die();


			$data['qr_code'] = 'qrcode_new' . $id . '.png'; //name file
			//print_r($data['qr_code']); die();
			//unlink('./assets/images/' . $data['qr_code']);

			$query  = $this->db->query("SELECT qr_code FROM perangkat WHERE id_perangkat='$id'");
			$ambil = $query->row_array();
			//print_r($ambil); die();
			if ($ambil['qr_code'] != NULL) {
				//echo "tes"; die();
				unlink('./assets/images/' . $ambil['qr_code']);
			}

			/*if ($data['no_prgkt_baru'] != NULL) {
				$params['data'] = $data['no_prgkt_baru'] . '_' . $this->m_perangkat->bagian_byID($data['id_bagian_baru'])->bagian; //data yang akan di jadikan QR CODE
			} else {
				$params['data'] = $data['no_prgkt'] . '_' . $this->m_perangkat->bagian_byID($data['id_bagian'])->bagian; //data yang akan di jadikan QR CODE
			}*/

			//
			//$params['data'] = $data['no_prgkt'] . '_' . $tmp_nama_bagian_text;

			/*if ($data['no_prgkt_baru'] != NULL) {
				$i = 1;
				$tmp_nama_bagian_baru_text = '';
				foreach ($data['id_bagian_baru'] as $b) {
					if ($i == 1)
						$tmp_nama_bagian_baru_text .= $this->m_perangkat->bagian_byID($b)->bagian;
					else
						$tmp_nama_bagian_baru_text .= ',' . $this->m_perangkat->bagian_byID($b)->bagian;
					$i++;
				}
				//
				$params['data'] = $data['no_prgkt_baru'] . '_' . $tmp_nama_bagian_baru_text; //data yang akan di jadikan QR CODE
			} else {
				$i = 1;
				$tmp_nama_bagian_text = '';
				foreach ($data['id_bagian'] as $b) {
					if ($i == 1)
						$tmp_nama_bagian_text .= $this->m_perangkat->bagian_byID($b)->bagian;
					else
						$tmp_nama_bagian_text .= ',' . $this->m_perangkat->bagian_byID($b)->bagian;
					$i++;
				}
				//
				$params['data'] = $data['no_prgkt'] . '_' . $tmp_nama_bagian_text; //data yang akan di jadikan QR CODE
			}*/


			//

			//echo "<pre>"; print_r($data);die();
			//if ($this->input->post('mutasi') == 'mutasi') {
			if (1) {
				//--- Insert histori dulu
				//$data_asli = $this->db->get_where('perangkat', array('id_perangkat' => $this->input->post('id_perangkat')))->row();
				if ($this->input->post('mutasi') == 'mutasi') {
					$data_h = $data;
					$data_h['id_perangkat'] = $this->input->post('id_perangkat');
					$this->db->insert('perangkat_histori', $data_h);
					//	echo 'CEKKKK ->>> ' . $this->db->last_query();				die();
				}
			}
			//--- Baru update di tabel utama
			//unlink('./assets/images/' . $data['qr_code']);
			// echo json_encode($data); 
			// echo json_encode($where); 
			// die();
			$this->load->library('encryption');
			$this->m_perangkat->edit_aksi_perangkat($data, $where);
			// $id_prgkt = $this->m_perangkat->get_id_perangkat()->row()->id_perangkat;
			// $params['data'] = base_url('History/histori_perangkat/') . base64_encode($this->encryption->encrypt($id_prgkt));
			// $params['level'] = 'H'; //H=High
			// $params['size'] = 10;
			// $params['savename'] = $config['imagedir'] . $data['qr_code']; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate(array(
				'data'		=>	base_url('History/histori_perangkat/') . base64_encode($this->encryption->encrypt($id)),
				'savename'	=>	'assets/images/qrcode_new' . $id . '.png'
			));

			// $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			//$this->m_perangkat->mutasi_terakhir($id_perangkat);
			redirect('Panel/perangkat');
		}
	}
	//COBA
	public function qrcode_print($id)
	{
		$this->load->library('fungsi');
		$data['QRprint'] = $this->m_perangkat->tampil_nama_prgkt($id);
		$html = $this->load->view('admin/qrcode_print', $data, true);
		
		$this->fungsi->PdfGenerator($html, 'qrcode', 'A4', 'landscape');
	}
	function histori_perangkat($id_perangkat)
	{
		$data['perangkat_h'] = $this->m_histori->tampil_mutasi_perangkat_h($id_perangkat)->result();
		$data['ajukan_h'] = $this->m_histori->tampil_ajukan_h($id_perangkat)->result();
		$id_pengajuan = $this->db->get_where('perangkat', array('id_perangkat' => $id_perangkat))->row()->id_pengajuan;
		$data['pengajuan_h'] = $this->m_histori->tampil_pengajuan_h($id_pengajuan)->result();
		//echo "<pre>";
		//var_dump($data['ajukan_h']); return 1;
		$this->load->view('admin/histori_perangkat', $data);
	}
	public function hapus_perangkat($id_perangkat)
	{
	    //print_r($id_perangkat);
	    //die();
		if ($this->session->userdata('role') == 1) {
			$where = array('id_perangkat' => $id_perangkat);
			$this->m_perangkat->hapus_data_perangkat($where);
			//redirect(base_url.'Panel/perangkat');
			redirect(base_url() . 'Panel/perangkat');
		}
	}
	//BATAS
	public function pengajuan_lelang()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		$data['pengajuan_lelang'] = $this->m_pengajuan->tampil_pengajuan_lelang($kantor)->result();
		//$data['total'] = $this->m_pengajuan->tampil_prgkt_dinamis()->result();
		/*$data['total'] = $this->db->get_where("master_prgkt_dinamis", array("id_prgkt_dinamis" => $data['pengajuan_lelang']->id_prgkt_dinamis))->result();
		foreach ($data['total'] as $t) {
			echo "hai";
		}*/
		$this->load->view('admin/pengajuan_lelang', $data);
	}
	public function tambah_pengajuan()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			$data['bagian']	= $this->m_pengajuan->tampil_bagian2($kantor)->result();
			$data['perangkat'] = $this->m_master_prgkt->tampil_mstrprgkt_aktif($kantor)->result();
			$this->load->view('admin/tambah_pengajuan', $data);
		}
	}
	public function tambah_aksi_pengajuan()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			$tmp_id_dinamis = md5(date("Y-m-d H:i:s"));
			// $tmp_id = md5(date('Y-m-d H:i:s'));
			// foreach ($this->input->post('id_perangkat') as $key => $value) {
			// 	echo $value." ".$this->input->post('jml1')[$key]."<br>";
			// }die();

			//upload
			//date_default_timezone_set("Asia/Jakarta");
			//$waktu_sekarang		= date('Y-m-d');
			$config['upload_path']          = './assets/upload';
			$config['allowed_types']        = 'jpg|jpeg|png|pdf|zip|rar';
			//$field_name = $waktu_sekarang."_".$_FILES['upload_file']['name'];
			$new_name = time() . $_FILES["upload_file"]['name'];
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('upload_file')) {
				$data = [
					'id_bagian' => $this->input->post('id_bagian'),
					'no_memo' => $this->input->post('nomemo') ??  NULL,
					'tgl_memo' => ($this->input->post('tgl_memo') != NULL) ? date("Y-m-d", strtotime($this->input->post('tgl_memo'))) : NULL,
					'jumlah' => $this->input->post('total'),
					'status_proses' => $this->input->post('status_proses'),
					'id_prgkt_dinamis' => $tmp_id_dinamis,
					'id_master_prgkt' => $this->input->post('id_master_prgkt'),
					'id_master_kantor' => $kantor,
					'jml' => $this->input->post('jml')

				];
			} else {
				$data = [
					'id_bagian' => $this->input->post('id_bagian'),
					//'id_bagian_pengajuan' => $tmp_id,
					'no_memo' => $this->input->post('nomemo'),
					'tgl_memo' => date("Y-m-d", strtotime($this->input->post('tgl_memo'))),
					'jumlah' => $this->input->post('total'),
					//'upload_file' => $waktu_sekarang."_".$_FILES['upload_file']['name'],
					//'upload_file' => $this->input->post('upload_file'),
					//'upload_file' => $this->upload->data(),
					//'upload_file' => $this->upload->do_upload($field_name),
					'upload_file' => $this->upload->data('file_name'),
					'status_proses' => $this->input->post('status_proses'),
					'id_prgkt_dinamis' => $tmp_id_dinamis,
					'id_master_prgkt' => $this->input->post('id_master_prgkt'),
					'id_master_kantor' => $kantor,
					'jml' => $this->input->post('jml')
				];
			}

			//echo '<pre>';
			//print_r($data); die();

			//echo '<pre>';
			//print_r($this->input->post('id_bagian'));


			$this->m_pengajuan->input_data_pengajuan($data);
			//Data terakhir
			$data_histori = $this->db->order_by('id_pengajuan', 'desc')->get('pengajuan_lelang')->row();
			//Insert ke histori
			// echo "<pre>";
			// print_r($data_histori);
			// die();
			//Histori
			$this->db->insert('pengajuan_lelang_histori', $data_histori);
			//Redirect
			if ($data['status_proses'] == "Terealisasi") {
				redirect('panel/tambah_perangkat');
			} else {
				redirect('panel/pengajuan_lelang');
			}

			//var_dump($data_asli); die();
			//$this->db->insert('pengajuan_lelang_histori', $data_asli);
		}
	}
	public function ubah_pengajuan($id_pengajuan)
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			$data['pengajuan_lelang'] = $this->m_pengajuan->edit_pengajuan($id_pengajuan)->row();
			$data['perangkat']		= $this->m_master_prgkt->tampil_mstrprgkt($kantor)->result();
			$data['bagian'] 		= $this->m_pengajuan->tampil_bagian()->result();
			//$data['perangkat']		= $this->m_master_prgkt->tampil_mstrprgkt()->result();

			$this->load->view('admin/ubah_pengajuan', $data);
		}
	}
	public function ubah_aksi_pengajuan()
	{
		if ($this->session->userdata('role') == 1) {
			$tmp_id_dinamis = $this->input->post('id_prgkt_dinamis');


			//if ($_FILES['upload_file'] != '') {
			$data = array(
				'id_bagian' => $this->input->post('id_bagian'),
				'no_memo'	=> $this->input->post('nomemo'),
				'tgl_memo' => date("Y-m-d", strtotime($this->input->post('tgl_memo'))),
				'jumlah'	=> $this->input->post('total'),
				//'upload_file' => $_FILES['upload_file']['name'],
				//'upload_file' => $this->input->post('new_name'),
				//'upload_file' => $this->input->get('file_name'),
				//'file_name' => 'upload_file'['file_name'],

				'status_proses' => $this->input->post('status_proses'),
				'id_prgkt_dinamis' => $tmp_id_dinamis,
				'id_master_prgkt' => $this->input->post('id_master_prgkt'),
				'jml1' => $this->input->post('jml1')
			);

			//Jika ada file 
			if ($_FILES['upload_file']['name'] != "") {
				$config['upload_path']    = './assets/upload/';
				$config['allowed_types']  = 'jpg|jpeg|png|pdf|zip|rar';
				$new_name = time() . $_FILES["upload_file"]['name'];
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);

				//Upload
				if (!$this->upload->do_upload('upload_file')) {
					echo "upload gagal";
					var_dump($this->upload->display_errors());
					die();
				} else {
					$data['upload_file'] = $this->upload->data('file_name');
				}
				// $id_pengajuan = $this->input->post('id_pengajuan');
				$id = $this->input->post('id_pengajuan');
				$query  = $this->db->query("SELECT upload_file FROM pengajuan_lelang WHERE id_pengajuan='$id'");

				$ambil = $query->row_array();
				if ($ambil['upload_file'] != NULL) {

					unlink('./assets/upload/' . $ambil['upload_file']);
				}
			} else {
				$data['upload_file'] = $this->input->post('old');
			}
			//End file

			/*} else {
				$data = array(
					'id_bagian' => $this->input->post('id_bagian'),
					'no_memo'	=> $this->input->post('nomemo'),
					'tgl_memo' => $this->input->post('tgl_memo'),
					'jumlah'	=> $this->input->post('total'),
					//'upload_file' => $_FILES['upload_file']['name'],
					'status_proses' => $this->input->post('status_proses'),
					'id_prgkt_dinamis' => $tmp_id_dinamis,
					'id_master_prgkt' => $this->input->post('id_master_prgkt'),
					'jml1' => $this->input->post('jml1')
				);
			}*/

			$where = array(
				'id_pengajuan' => $this->input->post('id_pengajuan')
			);

			//echo '<pre>';
			//print_r($data); die();

			//histori yg lama
			/*$data_asli = $this->db->get_where('pengajuan_lelang', array('id_pengajuan' => $this->input->post('id_pengajuan')))->row();
			$this->db->insert('pengajuan_lelang_histori', $data_asli);*/

			//$this->m_pengajuan->edit_aksi_pengajuan($data);
			//Data terakhir
			//$data_histori = $this->db->order_by('id_pengajuan', 'desc')->get('pengajuan_lelang')->row();
			//Insert ke histori

			//Histori
			//$this->db->insert('pengajuan_lelang_histori', $data_histori);

			/*if (1) {
				//--- Insert histori dulu
				//$data_asli = $this->db->get_where('pengajuan_lelang', array('id_pengajuan' => $this->input->post('id_pengajuan')))->row();
				$data_h = $data;
				$data_h['id_pengajuan'] = $this->input->post('id_pengajuan');
				$this->db->insert('pengajuan_lelang_histori', $data_h);
				//	echo 'CEKKKK ->>> ' . $this->db->last_query();				die();
			}
			//--- Baru update di tabel utama*/
			$this->m_pengajuan->edit_aksi_pengajuan($data, $where);

			//
			$data_asli = $this->db->get_where('pengajuan_lelang', array('id_pengajuan' => $this->input->post('id_pengajuan')))->row();
			$this->db->insert('pengajuan_lelang_histori', $data_asli);


			if ($data['status_proses'] == "Terealisasi") {
				redirect('panel/tambah_perangkat');
			} else {
				redirect('panel/pengajuan_lelang');
			}
		}
	}
	public function hapus_pengajuan($id_pengajuan)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_pengajuan' => $id_pengajuan);

			$this->m_pengajuan->hapus_data_pengajuan($where);
			redirect('panel/pengajuan_lelang');
		}
	}
	//BATAS
	public function master_perangkat()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		$data['perangkat']		= $this->m_master_prgkt->tampil_mstrprgkt($kantor)->result();
		$this->load->view('admin/master_perangkat', $data);
	}
	public function tambah_master_perangkat()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			//Ambil data master jenis
			$data['master_jenis'] = $this->m_master_jns->tampil_mstrjns($kantor)->result();
			$this->load->view('admin/tambah_master_perangkat', $data);
		}
	}
	public function tambah_aksi_mstrprgkt()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			$data = [
				'id_master_jns' => $this->input->post('id_master_jns'),
				'id_master_kantor' => $kantor,
				'tipe_prgkt' => $this->input->post('tipe'),
				'status' => $this->input->post('status')
			];

			$this->m_master_prgkt->input_data_mstrprgkt($data);
			redirect('Panel/master_perangkat');
		}
	}
	public function ubah_master_perangkat($id_master_prgkt)
	{
		if ($this->session->userdata('role') == 1) {
			$kantor = $this->session->userdata('id_master_kantor');
			$data['master_prgkt']	= $this->m_master_prgkt->edit_mstrprgkt($id_master_prgkt)->row();
			$data['master_jenis'] = $this->m_master_jns->tampil_mstrjns($kantor)->result();
			$this->load->view('admin/ubah_master_perangkat', $data);
		}
	}
	public function ubah_aksi_mstrprgkt()
	{
		if ($this->session->userdata('role') == 1) {
			$data = array(
				'id_master_jns' => $this->input->post('id_master_jns'),
				'tipe_prgkt'	=> $this->input->post('tipe'),
				'status'		=> $this->input->post('status')
			);
			$where = array(
				'id_master_prgkt' => $this->input->post('id_master_prgkt')
			);

			$this->m_master_prgkt->edit_aksi($data, $where);
			redirect('Panel/master_perangkat');
		}
	}
	public function hapus_mstrprgkt($id_master_prgkt)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_master_prgkt' => $id_master_prgkt);
			$this->m_master_prgkt->hapus_data_mstrprgkt($where);
			redirect('Panel/master_perangkat');
		}
	}
	//BATAS GROUP
	public function master_group_perangkat()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		$data['master_group_perangkat'] = $this->m_master_group_perangkat->tampil_mstr_group_perangkat($kantor)->result();
		$this->load->view('admin/master_group_perangkat', $data);
	}
	public function tambah_master_group_perangkat()
	{
		$data['get_list_kantor'] = $this->m_daftar_pengguna->get_list_kantor()->result();
		if ($this->session->userdata('role') == 1) {
			$this->load->view('admin/tambah_master_group_perangkat', $data);
		}
	}
	public function tambah_aksi_mstrgroup_perangkat()
	{
		if ($this->session->userdata('role') == 1) {
			$kantor = $this->session->userdata('id_master_kantor');
			$data = [
				'group_perangkat' => $this->input->post('group_prgkt'),
				'id_master_kantor' => $kantor,
				'keterangan' => $this->input->post('ket'),
			];

			$this->m_master_group_perangkat->input_data_mstr_group_perangkat($data, 'master_group_perangkat');
			redirect('Panel/master_group_perangkat');
		}
	}
	public function ubah_master_group_perangkat($id_mstr_group_perangkat)
	{
		if ($this->session->userdata('role') == 1) {
			$data['master_group_perangkat'] = $this->m_master_group_perangkat->edit_mstr_group_perangkat($id_mstr_group_perangkat)->row();
			$this->load->view('admin/ubah_master_group_perangkat', $data);
		}
	}
	public function ubah_aksi_mstrgroup_perangkat()
	{
		if ($this->session->userdata('role') == 1) {
			$data = array(
				'group_perangkat'	=> $this->input->post('group_prgkt'),
				'keterangan' => $this->input->post('ket')
			);
			$where = array(
				'id_group' => $this->input->post('id_mstr_group_perangkat')
			);

			$this->m_master_group_perangkat->edit_aksi_mstr_group_perangkat($data, $where);
			redirect('Panel/master_group_perangkat');
		}
	}
	public function hapus_mstrgroup_perangkat($id_master_jns)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_group' => $id_master_jns);
			$this->m_master_group_perangkat->hapus_data_mstr_group_perangkat($where);
			redirect('Panel/master_group_perangkat');
		}
	}
	//BATAS
	public function master_jenis()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		$data['master_jenis'] = $this->m_master_jns->tampil_mstrjns($kantor)->result();
		// var_dump($data);
		// die();
		$this->load->view('admin/master_jenis', $data);
	}
	public function tambah_master_jenis()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		$data['master_group_perangkat'] = $this->m_master_group_perangkat->tampil_mstr_group_perangkat($kantor)->result();
		if ($this->session->userdata('role') == 1) {
			$this->load->view('admin/tambah_master_jenis', $data);
		}
	}
	public function tambah_aksi_mstrjns()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			$data = [
				'jns_prgkt' => $this->input->post('jns_prgkt'),
				'id_master_kantor' => $kantor,
				'id_group' => $this->input->post('master_group'),
				'ket' => $this->input->post('ket'),
			];

			$this->m_master_jns->input_data_mstrjns($data, 'master_jns');
			redirect('Panel/master_jenis');
		}
	}
	public function ubah_master_jenis($id_master_jns)
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			$data['group'] = $this->m_master_group_perangkat->tampil_mstr_group_perangkat($kantor)->result();
			$data['master_jenis'] = $this->m_master_jns->edit_mstrjns($id_master_jns)->row();
			// var_dump($data['master_jenis']);
			// die();
			$this->load->view('admin/ubah_master_jenis', $data);
		}
	}
	public function ubah_aksi_mstrjns()
	{
		if ($this->session->userdata('role') == 1) {
			$data = array(
				'jns_prgkt'	=> $this->input->post('jns_prgkt'),
				'id_group' => $this->input->post('master_group'),
				'ket' => $this->input->post('ket')
			);
			$where = array(
				'id_master_jns' => $this->input->post('id_master_jns')
			);

			$this->m_master_jns->edit_aksi_mstrjns($data, $where);
			redirect('Panel/master_jenis');
		}
	}
	public function hapus_mstrjns($id_master_jns)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_master_jns' => $id_master_jns);
			$this->m_master_jns->hapus_data_mstrjns($where);
			redirect('Panel/master_jenis');
		}
	}
	//BATAS
	public function master_layanan()
	{
		$data['master_layanan'] = $this->m_master_layanan->tampil_master_layanan()->result();
		$this->load->view('admin/master_layanan', $data);
	}
	public function tambah_master_layanan()
	{
		if ($this->session->userdata('role') == 1) {
			$this->load->view('admin/tambah_master_layanan');
		}
	}
	public function tambah_aksi_master_layanan()
	{
		if ($this->session->userdata('role') == 1) {
			$data = [
				'jns_layanan' => $this->input->post('jnslayanan'),
				'ket' => $this->input->post('ket'),
				'status' => $this->input->post('status')
			];

			$this->m_master_layanan->input_data_master_layanan($data, 'master_layanan');
			redirect('Panel/master_layanan');
		}
	}
	public function ubah_master_layanan($id_master_layanan)
	{
		if ($this->session->userdata('role') == 1) {
			$data['master_layanan'] = $this->m_master_layanan->edit_master_layanan($id_master_layanan)->row();
			$this->load->view('admin/ubah_master_layanan', $data);
		}
	}
	public function ubah_aksi_master_layanan()
	{
		if ($this->session->userdata('role') == 1) {
			$data = array(
				'jns_layanan' => $this->input->post('jnslayanan'),
				'ket'	=> $this->input->post('ket'),
				'status'	=> $this->input->post('status')
			);
			$where = array(
				'id_master_layanan' => $this->input->post('id_master_layanan')
			);

			$this->m_master_layanan->edit_aksi_master_layanan($data, $where);
			redirect('Panel/master_layanan');
		}
	}
	public function hapus_master_layanan($id_master_layanan)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_master_layanan' => $id_master_layanan);
			$this->m_master_layanan->hapus_data_master_layanan($where);
			redirect('Panel/master_layanan');
		}
	}
	//BATAS
	public function bar_qr_code()
	{
		$this->load->view('admin/bar_qr_code');
	}

	public function kelola_tiket()
	{
		//$url1=$_SERVER['REQUEST_URI'];
		//header("Refresh: 60; URL=$url1");
		//$kantor = $this->session->userdata('id_master_kantor');
		//$data['kelola_tiket'] = $this->m_kelola_tiket->tampil_kelola_tiket($kantor)->result();
		// var_dump($data);//$data = $this->m_kelola_tiket->tampil_kelola_tiket()->result();
		// var_dump($data);
		//die();
		// $result = array();
		// foreach ($data as $row) {
		//    $result[] = array(
		//         $row->tanggal
		//     );
		// }


		// Tampilkan data dalam format JSON
		//echo json_encode(array('data' => $result));
		//$json=json_encode(array("data" => $data['kelola_tiket']));
		//die();
		//$data['kelola_tiket'] = $this->m_kelola_tiket->tampil_kelola_tiket('ajukan_keluhan', 'order by prioritas, tanggal')->result();
		$this->load->view('admin/kelola_tiket');
	}
	public function get_tiket()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		/*
		| Select As
		*/
		$this->datatables->table('ajukan_keluhan');
		$this->datatables->select('id_ajukan,kode_servis,tanggal, nama, nama_master_kantor_baru, bagian,jns_kerusakan, uraian,no_spk,prioritas,upload_dokumen,status,waktu_antrian,waktu_ditangani,waktu_selesai,waktu_total');

		/*
		| Join Clause
		| $this->datatables->join('table', 'condition', 'type')
		| By default parameter type adalah null, anda bisa menambahkan INNER JOIN dll
		*/
		$this->datatables->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian', 'left');
		$this->datatables->join('master_kantor', 'ajukan_keluhan.id_master_kantor = master_kantor.id_master_kantor', 'left');
		$this->datatables->where(['ajukan_keluhan.id_master_kantor' => $kantor]);
		
		echo $this->datatables->draw();
	}


	public function ubah_tiket($id_ajukan)
	{
		$id_departemen = $this->session->userdata('id_master_kantor');
		//Hapus link
		$this->session->unset_userdata('link');
		//
		$data['kelola_tiket'] = $this->m_kelola_tiket->edit_kelola_tiket($id_ajukan)->row();
		$data['perangkat'] = $this->m_perangkat->tampil_aktif_perangkat($id_departemen)->result();
		$data['bagian'] = $this->m_kelola_tiket->tampil_bagian($id_departemen)->result();

		$this->load->view('admin/ubah_tiket', $data);
	}

	public function ubah_aksi_tiket()
	{
		$data = array(
			'id_ajukan' => $this->input->post('id_ajukan'),
			'kode_servis'	=> $this->input->post('kd_servis'),
			'nama' => $this->input->post('nama'),
			'id_bagian' => $this->input->post('bagian'),
			//'email' => $this->input->post('email'),
			'jns_kerusakan' => $this->input->post('jns_kerusakan'),
			'id_master_jns' => $this->input->post('id_master_jns'),
			'id_perangkat' => $this->input->post('id_pilprgkt'),
			'uraian' => $this->input->post('uraian'),
			'prioritas' => $this->input->post('prioritas'),
			'status' => $this->input->post('status'),
			'waktu_antrian' => $this->input->post('w_antrian'),
			'waktu_ditangani' => $this->input->post('w_ditangani'),
			'waktu_selesai' => $this->input->post('w_selesai'),
			'pengguna_layanan' => $this->input->post('pengguna'),
			'disposisi' => $this->input->post('disposisi'),
			'konek_had_soft' => $this->input->post('konek_master_perangkat'),
			'solusi' => $this->input->post('solusi'),
			'uraian_solusi' => $this->input->post('uraian_solusi'),
			'uraian_rca' => $this->input->post('uraian_rca'),
			'nama_ti' => $this->input->post('nama_ti') ?? '',
			'vendor' => $this->input->post('vendor') ?? '',
			'no_spk' => $this->input->post('nospk') ?? '',
			//'upload_spk' => $_FILES['upload_spk']['name'] ?? '',
			//'upload_spk' => $this->input->post($data['upload_spk']) ?? '',
			'status' => $this->input->post('status'),
			//'biaya' => $this->input->post('biaya') ?? '',
			'biaya' => (int) preg_replace("/[^0-9]/", "", $this->input->post('biaya')) ?? '',
			//'biaya' => str_replace('.', '', substr($this->input->post('biaya'), 4)),
		);
		// if($this->input->post('konek_master_perangkat')  != NULL)
		// {
		// 	$data['konek_master_perangkat'] = $this->input->post('konek_master_perangkat');
		// }


		if (0) {
			$config['upload_path']  = './assets/upload';
			$config['allowed_types'] = 'jpg|png|pdf';
			$config['max_size']     = '5000';
			$this->load->library('upload',  $config);
			if (!$this->upload->do_upload('upload_spk')) {
				echo "upload gagal";
				die();
			} else {
				$data['upload_spk'] = $this->upload->data('file_name');
			}
		} else {

			if (isset($_FILES['upload_spk']) && $_FILES['upload_spk']['name'] != NULL) {

				$config['upload_path']	= './assets/upload';
				$config['allowed_types'] = 'jpg|jpeg|png|pdf';
				$config['max_size']     = '5000';
				///

				$this->load->library('upload',  $config);
				if (!$this->upload->do_upload('upload_spk')) {
					echo "upload gagal";
					echo $this->upload->display_errors();
					die();
				} else {

					//upload_spk diubah
					$data['upload_spk'] = $this->upload->data('file_name');
					$id_ajukan = $this->input->post('id_ajukan');

					$query = $this->db->get_where('ajukan_keluhan', array('id_ajukan' => $id_ajukan));
					$ambil = $query->row()->upload_spk;
					if ($ambil != NULL) unlink('./assets/upload/' . $ambil);
					// print_r($ambil); die();
					//echo $ambil;
				}
			} else {
				$data['upload_spk'] = $this->input->post('lama');
				//$data['upload_spk'] = $this->upload->data('file_name');
			}
		}
		//print_r($this->db->last_query()); exit;
		//$loc = "./assets/upload/".$data['upload_spk'];
		//var_dump($loc); die();

		//Jika ada file
		/*if(empty($_FILES['upload_spk'])){
			$config['upload_path']	= './assets/upload';
			$config['allowed_types'] = 'jpg|png|pdf';

			$this->load->library('upload',  $config);
			if (!$this->upload->do_upload('upload_spk')) {
				echo "upload gagal";
				die();
			} else {
				//upload_spk diubah
				$data['upload_spk'] = $this->upload->data('file_name');
			}
		}*/

		/*yg dipake  upload lama
		if ($data['upload_spk'] == '') {
		} else {
			$config['upload_path']	= './assets/upload';
			$config['allowed_types'] = 'jpg|png|pdf';

			$this->load->library('upload',  $config);
			if (!$this->upload->do_upload('upload_spk')) {
				echo "upload gagal";
				die();
			} else {
				$data['upload_spk'] = $this->upload->data('file_name');
			}
		}*/
		//var_dump($this->upload->data('file_name'));
		//die();
		//Waktu sekarang
		date_default_timezone_set("Asia/Jakarta");
		$waktu_sekarang		= date('Y-m-d H:i:s');
		//echo date("d-m-Y", strtotime($waktu_sekarang));

		if ($this->input->post('status') == "Antrian") {
			$sts_skrng = $this->m_kelola_tiket->edit_kelola_tiket($this->input->post('id_ajukan'))->row()->status;
			$sts_baru  = $this->input->post('status');
			if ($sts_skrng == $sts_baru) {
			} else {
				$data['waktu_antrian']		= $waktu_sekarang;
				$data['waktu_ditangani']	= NULL;
				$data['waktu_selesai']		= NULL;
			}
		} else if ($this->input->post('status') == "Sedang ditangani") {
			$sts_skrng = $this->m_kelola_tiket->edit_kelola_tiket($this->input->post('id_ajukan'))->row()->status;
			$sts_baru  = $this->input->post('status');
			if ($sts_skrng == $sts_baru) {
			} else {
				if ($data['waktu_antrian'] == NULL) {
					$data['waktu_antrian']		= $waktu_sekarang;
					$data['waktu_ditangani']	= $waktu_sekarang;
					$data['waktu_selesai']	= NULL;
				} else {
					$data['waktu_ditangani'] 		= $waktu_sekarang;
					$data['waktu_selesai']			= NULL;
				}
			}
		} else if ($this->input->post('status') == "Selesai") {
			$sts_skrng = $this->m_kelola_tiket->edit_kelola_tiket($this->input->post('id_ajukan'))->row()->status;
			$sts_baru  = $this->input->post('status');
			if ($sts_skrng == $sts_baru) {
			} else {
				if ($data['waktu_antrian'] == NULL && $data['waktu_ditangani'] == NULL && $data['waktu_selesai'] == NULL) {
					$data['waktu_antrian']		= $waktu_sekarang;
					$data['waktu_ditangani']	= $waktu_sekarang;
					$data['waktu_selesai'] 		= $waktu_sekarang;
				} else if ($data['waktu_ditangani'] == NULL && $data['waktu_selesai'] == NULL) {
					$data['waktu_ditangani']	= $waktu_sekarang;
					$data['waktu_selesai'] 		= $waktu_sekarang;
				} else {
					$data['waktu_selesai'] 		= $waktu_sekarang;
				}
			}
		}
		//
		$where = array(
			'id_ajukan' => $this->input->post('id_ajukan')
		);
		//histori lama
		/*$data_asli = $this->db->get_where('ajukan_keluhan', array('id_ajukan' => $this->input->post('id_ajukan')))->row();

		if ($data_asli->prioritas != '') {
			//Histori
			$data_h = $data;
			$data_h['id_ajukan'] =  $this->input->post('id_ajukan');
			$this->db->insert('ajukan_keluhan_histori', $data_h);
		}*/
		//

		$kd_servis = $this->input->post('kd_servis');
		$cek_kd = $this->m_histori->tampil_kd($kd_servis)->row();
		if ($cek_kd == NULL) {
			$this->m_kelola_tiket->edit_aksi_tiket($data, $where);
			$data_asli = $this->db->get_where('ajukan_keluhan', array('id_ajukan' => $this->input->post('id_ajukan')))->row();
			$this->db->insert('ajukan_keluhan_histori', $data_asli);
			//$this->send();
		} else {
			$this->m_kelola_tiket->edit_aksi_tiket($data, $where);
			$data_asli = $this->db->select('id_ajukan,kode_servis,nama, id_bagian,tanggal,email,jns_kerusakan,id_master_jns,id_perangkat,uraian,prioritas,status,pengguna_layanan,solusi,uraian_solusi,nama_ti,vendor,biaya,no_spk,upload_spk,disposisi,waktu_antrian,waktu_ditangani,waktu_selesai,lama_penanganan,tahun');
			//$data_asli = $this->db->get_where('ajukan_keluhan_histori', array('kode_servis' => $this->input->post('kd_servis')))->row();
			$data_asli = $this->db->get_where('ajukan_keluhan', array('id_ajukan' => $this->input->post('id_ajukan')))->row();
			//echo json_encode($data_asli);
			//die();
			$this->db->where('id_ajukan', $this->input->post('id_ajukan'));
			$this->db->update('ajukan_keluhan_histori', $data_asli);
			//$this->send();
		}

		//Data yang diedit barusan
		//redirect('Panel/kelola_tiket');
		//redirect(base_url("Panel/kelola_tiket"));
		//header('Location: '.$uri, TRUE, $code);
		redirect('Panel/kelola_tiket', 'refresh');
	}
	public function send()
	{
		if ($_POST['email']) {
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => '127.0.0.1', //127.0.0.1 
				'smtp_port' => 25,
				// 'smtp_user' => 'ti@ptapn.com',   //ti.ptpn12@ptpn12.com
				// 'smtp_pass' => 'tisuppco',
				'mailtype' => 'html',
				'smtp_timeout' => 100,
				'charset' => 'iso-8859-1'
			);

			$nama = $_POST['nama'];
			//$id_kel = $this->m_kelola_tiket->get_id_ajukan()->row()->id_ajukan;
			$id_keluhan = $this->input->post('id_ajukan');
			$bagian = $this->m_kelola_tiket->ambil_nama_bagian($id_keluhan)->row()->bagian;
			$email = $_POST['email'];
			$jns_kerusakan = $_POST['jns_kerusakan'];
			$uraian_kerusakan = $_POST['uraian'];
			$status =  $_POST['status'];
			$id_master_jns = $this->m_user->tampil_mstrjns()->result();
			$perangkat = $_POST['id_master_jns'];
			foreach ($id_master_jns as $j) {
				if ($perangkat == $j->id_master_jns) {
					$perangkat = $j->jns_prgkt;
					//echo $perangkat;
				}
				//echo "id=" . $j->id_master_jns . "nama=" . $j->jns_prgkt . "";
			}
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('ti@ptapn.com', 'Support TI-PT APN');
			$this->email->to($email);  //diganti email TI PT APN
			$this->email->cc('ti@ptapn.com');  //diganti email TI PT APN
			$this->email->subject('Notifikasi Support TI');
			$this->email->message('
					Karyawan PT APN telah mengajukan keluhan di Support TI :<br>
					Nama 			: ' . $nama . '<br>
					Bagian          : ' . $bagian . '<br>
					Email           : ' . $email . '<br>
					Jenis Layanan   : ' . $jns_kerusakan . '<br>
					Perangkat	    : ' . $perangkat . '<br>
					Uraian Kerusakan: ' . $uraian_kerusakan . '	<br>
					Status          : ' . $status . '	<br><br>
					Untuk selanjut dapat menghubungi Sub Bagian TI pada Ext 218 dan 500	
			');
			//$dot_count = substr_count($email, ".")+substr_count($nama, ".")+substr_count($uraian_kerusakan, ".");
			//for ($i=1; $i <= $dot_count; $i++) { 
			//$this->email->set_newline("\r\n"); 
			//}
			if ($this->email->send() == FALSE) {
				//show_error("anda salah email");
				//$this->session->set_flashdata('email','<p style="color:red;"><b>Email yang Anda Inputkan Salah. </b></p>');
				$this->session->set_flashdata('not', 'aaaa');
				redirect(base_url("Panel/kelola_tiket"));
			} else {
				$this->session->set_flashdata('valid', 'bbb');
				redirect(base_url("Panel/kelola_tiket"));
			}
			// else{
			// 	$this->session->set_flashdata('notvalid','ccc');
			// 	redirect(base_url("Panel/kelola_tiket"));
			// }
		} else {
			$nama = $_POST['nama'];
			$id_kel = $this->m_kelola_tiket->get_id_ajukan()->row()->id_ajukan;
			$bagian = $this->m_kelola_tiket->ambil_nama_bagian($id_kel)->row()->bagian;
			$jns_kerusakan = $_POST['jns_kerusakan'];
			$uraian_kerusakan = $_POST['uraian'];
			$id_master_jns = $this->m_user->tampil_mstrjns()->result();
			$perangkat = $_POST['id_master_jns'];
			foreach ($id_master_jns as $j) {
				if ($perangkat == $j->id_master_jns) {
					$perangkat = $j->jns_prgkt;
					//echo $perangkat;
				}
				//echo "id=" . $j->id_master_jns . "nama=" . $j->jns_prgkt . "";
			}
			$this->session->set_flashdata('success', "Data berhasil disimpan");
			redirect(base_url("Panel/kelola_tiket"));
		}
	}
	public function hapus_tiket($id_ajukan)
	{
		$where = array('id_ajukan' => $id_ajukan);
		$this->m_kelola_tiket->hapus_data_tiket($where);
		//redirect('Panel/kelola_tiket');
		redirect(base_url('Panel/kelola_tiket'));
	}
	//BATAS
	public function hari_libur()
	{
		$data['hari_libur'] = $this->m_hari_libur->tampil_hari_libur()->result();
		$this->load->view('admin/hari_libur', $data);
	}
	public function tambah_hari_libur()
	{
		if ($this->session->userdata('role') == 1) {
			$this->load->view('admin/tambah_hari_libur');
		}
	}
	public function tambah_aksi_hrlbr()
	{
		if ($this->session->userdata('role') == 1) {
			$data = [
				'tgl_libur' => date("Y-m-d", strtotime($this->input->post('tgl_libur'))),
				'ket' => $this->input->post('ket'),
			];
			$this->m_hari_libur->input_data_hrlbr($data, 'hari_libur');
			redirect('Panel/hari_libur');
		}
	}
	public function ubah_hari_libur($id_hari_libur)
	{
		if ($this->session->userdata('role') == 1) {
			$data['hari_libur'] = $this->m_hari_libur->edit_hari_libur($id_hari_libur)->row();
			$this->load->view('admin/ubah_hari_libur', $data);
		}
	}
	public function ubah_aksi_hrlbr()
	{
		if ($this->session->userdata('role') == 1) {
			$data = [
				'tgl_libur'	=> date("Y-m-d", strtotime($this->input->post('tgl_libur'))),
				'ket' => $this->input->post('ket')
			];
			$where = [
				'id_hari_libur' => $this->input->post('id_hari_libur')
			];
			$this->m_hari_libur->edit_aksi_hrlbr($data, $where);
			redirect('Panel/hari_libur');
		}
	}
	public function hapus_hari_libur($id_hari_libur)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_hari_libur' => $id_hari_libur);
			$this->m_hari_libur->hapus_data_hrlbr($where);
			redirect('Panel/hari_libur');
		}
	}
	public function laporan_grafik()
	{
		//$data = ['tahun' => $this->input->post('tahun')];

		if ($this->input->post()) {
			$tahun = $this->input->post('tahun');
			$kantor = $this->session->userdata('id_master_kantor');
			//$tahun=$_POST["tahun"];
			//var_dump($tahun); die();
			//$tahun = $this->input->post('tahun');
			//$data['grafik']=$this->m_kelola_tiket->cari($tahun);
			//$data['hasil_rekanan'] = $this->m_kelola_tiket->jml_jns_layanan_rekanan($tahun);
			$data['hasil_inex'] = $this->m_kelola_tiket->jml_jns_layanan_inex($tahun, $kantor);
			$data['bar_biaya'] = $this->m_kelola_tiket->biaya_bagian($tahun, $kantor);
			$data['pie_biaya'] = $this->m_kelola_tiket->get_data_biaya($tahun, $kantor);
			$data['pie_keluhan'] = $this->m_kelola_tiket->pie_bagian_keluhan($tahun, $kantor);
			$data['bagian']	= $this->m_pengajuan->tampil_bagian()->result();
			$data['jns_layanan'] = $this->m_master_layanan->tampil_master_layanan()->result();
			$data['kelola_tiket'] = $this->m_kelola_tiket->tampil_kelola_tiket($kantor)->result();
		} else {
			$tahun = (new DateTime)->format("Y");
			$kantor = $this->session->userdata('id_master_kantor');
			//var_dump($tahun); die();
			//$data['hasil_rekanan'] = $this->m_kelola_tiket->jml_jns_layanan_rekanan($tahun);
			$data['hasil_inex'] = $this->m_kelola_tiket->jml_jns_layanan_inex($tahun, $kantor);
			//echo $this->db->last_query($data['hasil_internal']);
			//die();cb
			$data['bar_biaya'] = $this->m_kelola_tiket->biaya_bagian($tahun, $kantor);
			$data['pie_biaya'] = $this->m_kelola_tiket->get_data_biaya($tahun, $kantor);
			$data['pie_keluhan'] = $this->m_kelola_tiket->pie_bagian_keluhan($tahun, $kantor);
			$data['bagian']	= $this->m_pengajuan->tampil_bagian()->result();
			$data['jns_layanan'] = $this->m_master_layanan->tampil_master_layanan()->result();
			$data['kelola_tiket'] = $this->m_kelola_tiket->tampil_kelola_tiket($kantor)->result();
		}
		// echo '<pre>', print_r($data), '</pre>';
		// die();
		$this->load->view('admin/laporan_grafik', $data);
		//print_r($this->db->last_query()); exit;
	}
	public function laporan_tabel()
	{
		//cari jenis all layanan dan all bagian
		// if($this->input->post('cetak') == NULL && $this->input->post('tgl_awal') && $this->input->post('tgl_akhir') && $this->input->post('bagian')  && $this->input->post('layanan'))
		// {
		// 	$layanan = $this->input->post('layanan');
		// 	$bagian = $this->input->post('bagian');
		// 	$awal = $this->input->post('tgl_awal');
		// 	$akhir = $this->input->post('tgl_akhir');
		// 	$awal_s=explode('-',$awal);
		// 	$tgl_awal=$awal_s[2].'-'.$awal_s[1].'-'.$awal_s[0];
		// 	$akhir_s=explode('-',$akhir);
		// 	$tgl_akhir=$akhir_s[2].'-'.$akhir_s[1].'-'.$akhir_s[0];
		// 	$tahun=date("Y");
		// 	// var_dump($bagian);
		// 	 //die();
		// 	$data['tampil'] = $this->m_kelola_tiket->tampil_selesai($tgl_awal,$tgl_akhir,$bagian,$layanan);
		// 	$data['kel_selesai'] = $this->m_kelola_tiket->keluhan_selesai($tgl_awal,$tgl_akhir,$bagian,$layanan);
		// 	$data['jml_internal'] = $this->m_kelola_tiket->internal($tgl_awal,$tgl_akhir,$bagian,$layanan);
		// 	$data['jml_rekanan'] = $this->m_kelola_tiket->rekanan($tgl_awal,$tgl_akhir,$bagian,$layanan);
		// 	$data['b_layanan'] = $this->m_kelola_tiket->biaya_perlayanan($tgl_awal,$tgl_akhir,$bagian,$layanan);
		// 	$data['biaya_tahun'] = $this->m_kelola_tiket->biaya_tahunan_semua($tahun);
		// 	$this->load->view('admin/laporan_tabel', $data);
		// 	//print_r($this->db->last_query()); exit;
		// }

		//if($this->input->post('cetak') == "excel" && $this->input->post('tgl_awal') && $this->input->post('tgl_akhir') && $this->input->post('layanan') && $this->input->post('perangkat') == NULL)
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->input->post('laporan') != NULL) {
			if ($this->input->post('laporan') == "bagian") {
				//cari jenis all layanan dan all bagian format excel
				$layanan = $this->input->post('layanan');
				$bagian = $this->input->post('bagian');
				$awal = $this->input->post('tgl_awal');
				$akhir = $this->input->post('tgl_akhir');
				$this->excel_jenislayanan($awal, $akhir, $bagian, $layanan, $kantor);
			} elseif ($this->input->post('laporan') == "layanan") {
				//cari jenis all layanan format excel
				$layanan = $this->input->post('layanan');
				$bagian = $this->input->post('bagian');
				$awal = $this->input->post('tgl_awal');
				$akhir = $this->input->post('tgl_akhir');
				$this->excel_jenislayananaja($awal, $akhir, $bagian, $layanan, $kantor);
			} elseif ($this->input->post('laporan') == "perangkat") {
				$data = [
					$awal = $this->input->post('tgl_awal'),
					$akhir = $this->input->post('tgl_akhir'),
					$perangkat = $this->input->post('perangkat'),
					$bagian = $this->input->post('bagian'),
					$this->cari_perangkat($awal, $akhir, $perangkat, $bagian, $kantor)
				];
				//echo json_encode($data);die();	
			}
			//perangkat2
			else { //cari perangkat format excel
				$pemel = $this->input->post('pemel');
				$bagian = $this->input->post('bagian');
				$tahun = $this->input->post('tahun');
				//echo "coba2";die();
				$this->excel_perangkat2($bagian, $pemel, $tahun, $kantor);
			}
		} elseif ($tahun = $this->input->post('tahun') != NULL) {
			$tahun = $tahun = $this->input->post('tahun');
			//var_dump($tahun); die();
			$data['tampil'] = $this->m_kelola_tiket->tampil_selesai_semua($tahun, $kantor);
			$data['kel_selesai'] = $this->m_kelola_tiket->keluhan_selesai_semua($tahun, $kantor);
			$data['jml_internal'] = $this->m_kelola_tiket->internal_semua($tahun, $kantor);
			$data['jml_rekanan'] = $this->m_kelola_tiket->rekanan_semua($tahun, $kantor);
			$data['b_layanan'] = $this->m_kelola_tiket->biaya_perlayanan_semua($tahun, $kantor);
			$data['biaya_tahun'] = $this->m_kelola_tiket->biaya_tahunan_semua($tahun, $kantor);
			//var_dump($data['biaya_tahun']); die();
			$this->load->view('admin/laporan_tabel', $data);
			//print_r($this->db->last_query()); exit;
		} else {
			$tahun = (new DateTime)->format("Y");
			//var_dump($tahun); die();
			$data['tampil'] = $this->m_kelola_tiket->tampil_selesai_semua($tahun, $kantor);
			$data['kel_selesai'] = $this->m_kelola_tiket->keluhan_selesai_semua($tahun, $kantor);
			$data['jml_internal'] = $this->m_kelola_tiket->internal_semua($tahun, $kantor);
			$data['jml_rekanan'] = $this->m_kelola_tiket->rekanan_semua($tahun, $kantor);
			$data['b_layanan'] = $this->m_kelola_tiket->biaya_perlayanan_semua($tahun, $kantor);
			$data['biaya_tahun'] = $this->m_kelola_tiket->biaya_tahunan_semua($tahun, $kantor);
			//var_dump($data['biaya_tahun']); die();
			$this->load->view('admin/laporan_tabel', $data);
			//print_r($this->db->last_query()); exit;
		}


		//pencarian pengguna perangkat + layanan+ bagian
		// elseif($this->input->post('cetak') == "excel" && $this->input->post('perangkat') && $this->input->post('tgl_awal') && $this->input->post('tgl_akhir') && $this->input->post('bagian'))
		// {
		// 	$data = [
		// 		$awal = $this->input->post('tgl_awal'),
		// 		$akhir = $this->input->post('tgl_akhir'),
		// 		$perangkat=$this->input->post('perangkat'),
		// 		$bagian=$this->input->post('bagian'),
		// 		$this->cari_perangkat($awal,$akhir,$perangkat,$bagian),
		// 	];
		// 	echo json_encode($data);die();
		// }
		// else {
		// 	$tahun = (new DateTime)->format("Y");
		// 	//var_dump($tahun); die();
		// 	$data['tampil'] = $this->m_kelola_tiket->tampil_selesai_semua($tahun);
		// 	$data['kel_selesai'] = $this->m_kelola_tiket->keluhan_selesai_semua($tahun);
		// 	$data['jml_internal'] = $this->m_kelola_tiket->internal_semua($tahun);
		// 	$data['jml_rekanan'] = $this->m_kelola_tiket->rekanan_semua($tahun);
		// 	$data['b_layanan'] = $this->m_kelola_tiket->biaya_perlayanan_semua($tahun);
		// 	$data['biaya_tahun'] = $this->m_kelola_tiket->biaya_tahunan_semua($tahun);
		// 	//var_dump($data['biaya_tahun']); die();
		// 	$this->load->view('admin/laporan_tabel', $data);
		// 	//print_r($this->db->last_query()); exit;
		// }
	}
	//BATAS
	public function kelola_artikel()
	{
		$filter['id_user'] = $this->session->userdata('id_user');
		$filter['id_kantor'] = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			$data['artikel'] = $this->m_artikel->tampil_artikel($filter)->result();
			$this->load->view('admin/kelola_artikel', $data);
		}
	}
	public function tambah_artikel()
	{
		if ($this->session->userdata('role') == 1) {
			$this->load->view('admin/tambah_artikel');
		}
	}
	public function tambah_aksi_artikel()
	{
		if ($this->session->userdata('role') == 1) {
			$kantor = $this->session->userdata('id_master_kantor');
			//Waktu sekarang
			date_default_timezone_set("Asia/Jakarta");
			$waktu_sekarang		= date('Y-m-d H:i:s');

			$data = [
				'judul' => $this->input->post('judul'),
				'tanggal' => $waktu_sekarang,
				'isi' => $this->input->post('isi'),
				'id_user' => $this->session->userdata('id_user'),
				'banner' => $_FILES['banner'],
				'id_master_kantor' => $kantor,
				'status' => 0
			];


			if ($_FILES['banner'] == NULL) {
				$this->m_artikel->input_data_artikel($data, 'artikel');
				redirect('Panel/kelola_artikel');
			} else {
				$config['upload_path']	= './assets/upload';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$new_name = time() . $_FILES["banner"]['name'];
				$config['file_name'] = $new_name;

				$this->load->library('upload',  $config);
				if (!$this->upload->do_upload('banner')) {
					$data['banner'] = NULL;
					$this->m_artikel->input_data_artikel($data, 'artikel');
					redirect('Panel/kelola_artikel');
				} else {
					$data['banner'] = $this->upload->data('file_name');
				}
				$this->m_artikel->input_data_artikel($data, 'artikel');
				redirect('Panel/kelola_artikel');
			}
		}
	}
	public function ubah_artikel($id_artikel)
	{
		if ($this->session->userdata('role') == 1) {
			$data['artikel'] = $this->m_artikel->edit_artikel($id_artikel)->row();
			$this->load->view('admin/ubah_artikel', $data);
		}
	}
	public function ubah_aksi_artikel()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			date_default_timezone_set("Asia/Jakarta");
			$waktu_sekarang		= date('Y-m-d H:i:s');

			$data = [
				'judul' => $this->input->post('judul'),
				'tanggal' => $waktu_sekarang,
				'isi' => $this->input->post('isi'),
				'id_user' => $this->session->userdata('id_user'),
				'banner' => $_FILES['banner'],
				'id_master_kantor' => $kantor
			];

			if ($_FILES['banner']['name'] != NULL) {

				$config['upload_path']	= './assets/upload';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$new_name = time() . $_FILES["banner"]['name'];
				$config['file_name'] = $new_name;

				$this->load->library('upload',  $config);
				if (!$this->upload->do_upload('banner')) {
					echo "upload gagal";
					echo $this->upload->display_errors();
					die();
				} else {

					// diubah
					$data['banner'] = $this->upload->data('file_name');
					$id_artikel = $this->input->post('id_artikel');

					$query = $this->db->get_where('artikel', array('id_artikel' => $id_artikel));
					$ambil = $query->row()->banner;
					if ($ambil != NULL) unlink('./assets/images/' . $ambil);
					//print_r($ambil); die();
					//echo $ambil;
				}
			} else {
				$data['banner'] = $this->input->post('lama');
				//$data['upload_spk'] = $this->upload->data('file_name');
			}
			//


			$where = array(
				'id_artikel' => $this->input->post('id_artikel')
			);

			$this->m_artikel->edit_aksi_artikel($data, $where);
			redirect('Panel/kelola_artikel');
		}
	}
	public function lihat_artikel($id)
	{
		if ($this->session->userdata('role') == 1) {
			$data['artikel'] = $this->m_artikel->baca($id);
			$this->load->view('admin/lihat_artikel', $data);
		}
	}
	public function hapus_artikel($id_artikel)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_artikel' => $id_artikel);
			$this->m_artikel->hapus_data_artikel($where);
			redirect('Panel/kelola_artikel');
		}
	}
	//BATAS
	public function info()
	{
		$filter['id_user'] = $this->session->userdata('id_user');
		$filter['id_kantor'] = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			$data['info'] = $this->m_info->tampil_info($filter)->result();
			$data['info_aktif'] = $this->m_info->tampil_info_aktif($filter)->result();
			$this->load->view('admin/info', $data);
		}
	}
	public function tambah_info()
	{
		if ($this->session->userdata('role') == 1) {
			$this->load->view('admin/tambah_info');
		}
	}
	public function tambah_aksi_info()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			date_default_timezone_set("Asia/Jakarta");
			$waktu_sekarang		= date('Y-m-d H:i:s');

			$data = [
				'isi_info' => $this->input->post('isi_info'),
				'tanggal' => $waktu_sekarang,
				'id_user' => $this->session->userdata('id_user'),
				'status' => $this->input->post('status'),
				'id_master_kantor' => $kantor

			];

			$this->m_info->input_data_info($data, 'info');
			redirect('Panel/info');
		}
	}
	public function ubah_info($id_info)
	{
		if ($this->session->userdata('role') == 1) {
			$data['info'] = $this->m_info->edit_info($id_info)->row();
			$this->load->view('admin/ubah_info', $data);
		}
	}
	public function ubah_aksi_info()
	{
		if ($this->session->userdata('role') == 1) {
			date_default_timezone_set("Asia/Jakarta");
			$waktu_sekarang		= date('Y-m-d H:i:s');

			$data = array(
				'isi_info' => $this->input->post('isi_info'),
				'tanggal' => $waktu_sekarang,
				'id_user' => $this->session->userdata('id_user'),
				'status' => $this->input->post('status')
			);
			$where = array(
				'id_info' => $this->input->post('id_info')
			);

			$this->m_info->edit_aksi_info($data, $where);
			redirect('Panel/info');
		}
	}
	public function hapus_info($id_info)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_info' => $id_info);
			$this->m_info->hapus_data_info($where);
			redirect('Panel/info');
		}
	}
	//BATAS
	public function daftar_pengguna()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			$data['daftar_pengguna'] = $this->m_daftar_pengguna->tampil_daftar_pengguna($kantor)->result();
			$this->load->view('admin/daftar_pengguna', $data);
		}
	}
	public function tambah_pengguna()
	{
		if ($this->session->userdata('role') == 1) {
			$this->load->view('admin/tambah_pengguna');
		}
	}
	public function tambah_aksi_pengguna()
	{
		if ($this->session->userdata('role') == 1) {

			$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[users.username]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|regex_match[/^.*(?=.{5,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/]');
			$this->form_validation->set_rules(
				'confirmPassword',
				'Konfirmasi Password',
				'required|matches[password]',
				array('matches' => '%s tidak sesuai dengan password')
			);
			$this->form_validation->set_rules('role', 'Role', 'required');
			$this->form_validation->set_rules('role_status', 'Status', 'required');
			$this->form_validation->set_rules('kantor', 'Kantor', 'required');

			$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
			$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
			$this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
			$this->form_validation->set_message('valid_email', '%s tidak valid, mohon masukkan email yang benar');
			$this->form_validation->set_message('regex_match', '%s tidak kombinasi angka, huruf kapital dan huruf kecil');

			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if ($this->form_validation->run() == TRUE) {
				$this->load->view('admin/tambah_pengguna', $this);
			} else {
				$post = $this->input->post(null, FALSE);
				//print_r($post);
				//die();
				$kantor = $this->session->userdata('id_master_kantor');
				$this->m_daftar_pengguna->tambah_data_pengguna($post,$kantor);
				redirect('Panel/daftar_pengguna');
			}
		}
	}
	public function ubah_pengguna($id_user)
	{
		if ($this->session->userdata('role') == 1) {
			$data['daftar_pengguna'] = $this->m_daftar_pengguna->edit_pengguna($id_user)->row();
			$this->load->view('admin/ubah_pengguna', $data);
		}
	}
	public function ubah_aksi_pengguna($id_user = NULL)
	{
		if ($this->session->userdata('role') == 1) {

			$this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|callback_username_check');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			if ($this->input->post('password')) {
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|regex_match[/^.*(?=.{5,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/]');
				$this->form_validation->set_rules(
					'confirmPassword',
					'Konfirmasi Password',
					'matches[password]',
					array('matches' => '%s tidak sesuai dengan password')
				);
			}
			if ($this->input->post('confirmPassword')) {
				$this->form_validation->set_rules(
					'confirmPassword',
					'Konfirmasi Password',
					'matches[password]',
					array('matches' => '%s tidak sesuai dengan password')
				);
			}
			$this->form_validation->set_rules('role', 'Role', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
			$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
			$this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');
			$this->form_validation->set_message('valid_email', '%s tidak valid, mohon masukkan email yang benar');
			$this->form_validation->set_message('regex_match', '%s tidak kombinasi angka, huruf kapital dan huruf kecil');

			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if ($this->form_validation->run() == FALSE) {
				$data['daftar_pengguna'] = $this->m_daftar_pengguna->edit_pengguna($this->input->post('id_user'))->row();
				$query = $this->m_daftar_pengguna->get($id_user);
				if ($query->num_rows()  > 0) {
					$data['row'] = $query->row();
					$this->load->view('admin/ubah_pengguna', $data);
				} else {
					redirect('Panel/daftar_pengguna');
				}
			} else {
				$kantor = $this->session->userdata('id_master_kantor');
				$post = $this->input->post(null, TRUE);
				$this->m_daftar_pengguna->edit_data_pengguna($post,$kantor);
				redirect('Panel/daftar_pengguna');
			}
		}
	}
	public function username_check()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM users WHERE username = '$post[username]' AND id_user != '$post[id_user]'");
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check', '{field} sudah dipakai, silahkan ganti');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function hapus_pengguna($id_user)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_user' => $id_user);
			$this->m_daftar_pengguna->hapus_data_pengguna($where);
			redirect('Panel/daftar_pengguna');
		}
	}
	public function reset_pass_pengguna($id_user)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_user' => $id_user);
			$this->m_daftar_pengguna->reset_pass_pengguna($where);
			redirect('Panel/daftar_pengguna');
		}
	}


	public function list_role()
	{
		if ($this->session->userdata('role') == 1) {
			$data['hak_akses'] = $this->m_list_role->tampil_hak_akses()->result();
			$data['role'] = $this->m_list_role->tampil_role()->result();
			$this->load->view('admin/list_role', $data);
		}
	}
	public function tambah_aksi_role()
	{
		if ($this->session->userdata('role') == 1) {
			//$cekbox = $_POST['hak_akses'];
			//$hakakses = ",".implode(",", $cekbox).",";
			$data = [
				'nama_role' => $this->input->post('role'),
				'id_hak_akses' => $this->input->post('hak_akses')
			];

			$this->m_list_role->input_data_role($data, 'role');
			redirect('Panel/list_role');
		}
	}

	public function profil()
	{
		$this->load->view('admin/profil');
	}

	public function ubah_sandi()
	{
		$this->load->view('admin/ubah_sandi');
	}

	//excel jenis layanan+bagian
	public function excel_jenislayanan($awal, $akhir, $bagian, $layanan, $kantor)
	{

		// print_r($kantor);
		// die();
		$awal_s = explode('-', $awal);
		$tgl_awal = $awal_s[2] . '-' . $awal_s[1] . '-' . $awal_s[0];
		$akhir_s = explode('-', $akhir);
		$tgl_akhir = $akhir_s[2] . '-' . $akhir_s[1] . '-' . $akhir_s[0];

		$data['tampil'] = $this->m_kelola_tiket->tampil_selesai($tgl_awal, $tgl_akhir, $bagian, $layanan, $kantor);
		// $data['layanan'] = $this->m_master_layanan->tampil_master_layanan()->result();

		$layanan_all = false;
		foreach ($layanan as $key => $value) {
			if ($value == "all") {
				$layanan_all = true;
			}
		}

		if ($layanan_all) {
			$data['layanan'] = $this->m_master_layanan->tampil_master_layanan()->result();
		} else {
			$data['layanan'] = $layanan;
		}

		$data['body'] = array();
		foreach ($data['tampil'] as $key => $value) {
			$data['body'][$value->id_bagian]['bagian'] = $value->bagian;
			$data['body'][$value->id_bagian]['layanan'][$value->jns_kerusakan] = ($data['body'][$value->id_bagian]['layanan'][$value->jns_kerusakan] ?? 0) + $value->biaya;
		}
		
		require_once FCPATH . 'vendor/autoload.php';
		//  echo json_encode($data);die();
		$column = range('A', 'Z');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$styleBorder = array(
			'borders' => array(
				'allBorders' => array(
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
				),
			),
		);

		$sheet->setCellValue('A1', 'Laporan Biaya Berdasarkan Bagian');
		$sheet->getStyle('A1')->getFont()->setBold(true);
		$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
		$sheet->setCellValue('A2', 'Tanggal');
		$sheet->setCellValue('B2', $awal . ' Sampai ' . $akhir);
		$sheet->setCellValue('A5', 'No');
		$sheet->setCellValue('B5', 'Bagian');
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->setCellValue('C4', 'Jenis Layanan');
		$sheet->getStyle('C4')->getFont()->setBold(true);
		$sheet->getStyle('C4')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A')->getAlignment()->setHorizontal('center');

		# Looping Header Layanan
		$col = 3;
		foreach ($data['layanan'] as $key => $value) {
			if ($layanan_all) {
				$nama_layanan = $value->jns_layanan;
			} else {
				$nama_layanan = $value;
			}
			$sheet->setCellValueByColumnAndRow($col, 5, $nama_layanan);
			$data['total'][$nama_layanan] = 0;
			$sheet->getColumnDimension($column[$col - 1])->setAutoSize(true);
			$col++;
		}
		$sheet->mergeCells("C4:" . $column[$col - 2] . "4");
		$sheet->mergeCells("A1:" . $column[$col - 2] . "1");
		$sheet->getStyle('A5:' . $column[$col - 2] . '5')->getAlignment()->setHorizontal('center');

		# Looping Bagian
		$row = 6;
		$no = 1;
		foreach ($data['body'] as $key => $value) {
			$sheet->setCellValue("A" . $row, $no);
			$sheet->setCellValue("B" . $row, $value['bagian']);

			#Looping Bagian Layanan Value
			$col = 3;
			foreach ($data['layanan'] as $keys => $values) {
				if ($layanan_all) {
					$nama_layanan = $values->jns_layanan;
				} else {
					$nama_layanan = $values;
				}
				$sheet->setCellValueByColumnAndRow($col, $row, $value['layanan'][$nama_layanan] ?? 0);
				$data['total'][$nama_layanan] = ($data['total'][$nama_layanan] ?? 0) + ($value['layanan'][$nama_layanan] ?? 0);
				$col++;
			}
			$row++;
			$no++;
		}

		# Looping Total
		$sheet->setCellValue("B" . $row, "Total");
		$col = 3;
		foreach ($data['layanan'] as $key => $value) {
			if ($layanan_all) {
				$nama_layanan = $value->jns_layanan;
			} else {
				$nama_layanan = $value;
			}
			$sheet->setCellValueByColumnAndRow($col, $row, $data['total'][$nama_layanan]);
			$col++;
		}

		$sheet->getStyle('A5:' . $column[$col - 2] . $row)->applyFromArray($styleBorder);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan Biaya Setiap Bagian';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	//excel jenis layanan
	public function excel_jenislayananaja($awal, $akhir, $bagian, $layanan, $kantor)
	{
		$awal_s = explode('-', $awal);
		$tgl_awal = $awal_s[2] . '-' . $awal_s[1] . '-' . $awal_s[0];
		$akhir_s = explode('-', $akhir);
		$tgl_akhir = $akhir_s[2] . '-' . $akhir_s[1] . '-' . $akhir_s[0];

		$data['tampil'] = $this->m_kelola_tiket->tampil_selesai($tgl_awal, $tgl_akhir, $bagian, $layanan, $kantor);

		$layanan_all = false;
		foreach ($layanan as $key => $value) {
			if ($value == "all") {
				$layanan_all = true;
			}
		}

		if ($layanan_all) {
			$data['layanan'] = $this->m_master_layanan->tampil_master_layanan()->result();
		} else {
			$data['layanan'] = $layanan;
		}

		// echo json_encode($data);die();
		$data['body'] = array();
		foreach ($data['tampil'] as $key => $value) {
			$data['body'][$value->jns_kerusakan] = ($data['body'][$value->jns_kerusakan] ?? 0) + $value->biaya;
		}

		// echo json_encode($data);die;
		require_once FCPATH . 'vendor/autoload.php';
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$styleBorder = array(
			'borders' => array(
				'allBorders' => array(
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
				),
			),
		);

		$sheet->setCellValue('A1', 'Laporan Biaya Berdasarkan Layanan');
		$sheet->mergeCells("A1:C1");
		$sheet->getStyle('A1')->getFont()->setBold(true);
		$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
		$sheet->setCellValue('A2', 'Tanggal');
		$sheet->setCellValue('B2', $awal . ' Sampai Dengan ' . $akhir);
		$sheet->setCellValue('A4', 'No');
		$sheet->setCellValue('B4', 'Jenis Layanan');
		$sheet->setCellValue('C4', 'Total');
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getStyle('A4:C4')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A')->getAlignment()->setHorizontal('center');

		$row = 5;
		$total = 0;
		foreach ($data['layanan'] as $key => $value) {
			if ($layanan_all) {
				$nama_layanan = $value->jns_layanan;
			} else {
				$nama_layanan = $value;
			}
			$sheet->setCellValue('A' . $row, $key + 1);
			$sheet->setCellValue('B' . $row, $nama_layanan);
			$sheet->setCellValue('C' . $row, $data['body'][$nama_layanan] ?? 0);
			$total = $total + ($data['body'][$nama_layanan] ?? 0);
			$row++;
		}

		$sheet->setCellValue('B' . $row, "Total");
		$sheet->setCellValue('C' . $row, $total);

		$sheet->getStyle('A4:C' . $row)->applyFromArray($styleBorder);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan Biaya Per Jenis Layanan';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	//cari nama perangkat+layanan+bagian
	public function cari_perangkat($awal, $akhir, $perangkat, $bagian, $kantor)
	{
		$awal_s = explode('-', $awal);
		$tgl_awal = $awal_s[2] . '-' . $awal_s[1] . '-' . $awal_s[0];
		$akhir_s = explode('-', $akhir);
		$tgl_akhir = $akhir_s[2] . '-' . $akhir_s[1] . '-' . $akhir_s[0];
		// $pengguna=implode($pengguna);

		$data['tampil'] = $this->m_kelola_tiket->tampil_pengguna_perangkat($tgl_awal, $tgl_akhir, $perangkat, $bagian, $kantor);
		// $data ['pengguna']= $this->m_perangkat->tampil_aktif_perangkat()->result();

		$data['body'] = array();
		foreach ($data['tampil'] as $key => $value) {
			$data['body'][$value->bagian][$value->nama_pengguna][$value->jns_kerusakan] = ($data['body'][$value->bagian][$value->nama_pengguna][$value->jns_kerusakan] ?? 0) + $value->biaya;
		}

		// $a=$this->db->last_query();

		//die();
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$styleBorder = array(
			'borders' => array(
				'allBorders' => array(
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
				),
			),
		);

		$sheet->setCellValue('A1', 'Laporan Biaya Berdasarkan Perangkat');
		$sheet->mergeCells("A1:F1");
		$sheet->getStyle('A1')->getFont()->setBold(true);
		$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
		$sheet->setCellValue('A3', 'Nama Pengguna : ');
		$sheet->setCellValue('B3', implode(", ", $perangkat) != "all" ? implode(", ", $perangkat) : "Semua");
		$sheet->setCellValue('A4', 'Tanggal');
		$sheet->setCellValue('B4', $awal . ' Sampai Dengan ' . $akhir);
		$sheet->setCellValue('A5', 'Bagian');
		$sheet->setCellValue('B5', $bagian != "all" ? $this->m_kelola_tiket->get_bagian_nama($bagian) : "Semua");
		$sheet->setCellValue('B7', 'No');
		$sheet->setCellValue('C7', 'Pengguna');
		$sheet->setCellValue('D7', 'Bagian');
		$sheet->setCellValue('E7', 'Hardware');
		$sheet->setCellValue('F7', 'Software');
		//$sheet->setCellValue('C3', 'Total');
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getStyle('B7:F7')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('B')->getAlignment()->setHorizontal('center');

		$row = 8;
		$total_hardware = 0;
		$total_software = 0;
		$no = 1;
		foreach ($data['body'] as $key => $value) {
			foreach ($value as $keys => $values) {
				$sheet->setCellValue('B' . $row, $no);
				$sheet->setCellValue('C' . $row, $keys);
				$sheet->setCellValue('D' . $row, $key);
				$sheet->setCellValue('E' . $row, $values['Hardware'] ?? 0);
				$sheet->setCellValue('F' . $row, $values['Software'] ?? 0);
				$total_hardware = $total_hardware + ($values['Hardware'] ?? 0);
				$total_software = $total_software + ($values['Software'] ?? 0);
				$row++;
				$no++;
			}
		}

		$sheet->setCellValue('D' . $row, "Total");
		$sheet->setCellValue('E' . $row, $total_hardware);
		$sheet->setCellValue('F' . $row, $total_software);

		$sheet->getStyle('B7:F' . $row)->applyFromArray($styleBorder);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan Biaya Setiap Perangkat';
		// echo json_encode($data);
		// die();

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	//excel perangkat
	public function excel_perangkat2($bagian, $pemel, $tahun, $kantor)
	{


		// $awal_s=explode('-',$awal);
		// $tgl_awal=$awal_s[2].'-'.$awal_s[1].'-'.$awal_s[0];
		// $akhir_s=explode('-',$akhir);
		// $tgl_akhir=$akhir_s[2].'-'.$akhir_s[1].'-'.$akhir_s[0];
		// echo json_encode($bagian);die();

		$data['pemel'] = $this->m_kelola_tiket->excel_pemel($bagian, $pemel, $tahun, $kantor);
		// echo json_encode($data['pemel']);
		// die();
		// $data['layanan'] = $this->m_master_layanan->tampil_master_layanan()->result();

		// $layanan_all = false;
		// foreach ($layanan as $key => $value) {
		// 	if ($value=="all") {
		// 		$layanan_all = true;
		// 	}
		// }

		// if ($layanan_all) {
		// 	$data['layanan'] = $this->m_master_layanan->tampil_master_layanan()->result();
		// }else{
		// 	$data['layanan'] = $layanan;
		// }

		// $data['body'] = array();
		// foreach ($data['tampil'] as $key => $value) {
		// 	$data['body'][$value->id_bagian]['bagian'] = $value->bagian;
		// 	$data['body'][$value->id_bagian]['layanan'][$value->jns_kerusakan] = ($data['body'][$value->id_bagian]['layanan'][$value->jns_kerusakan]??0)+$value->biaya;
		// }
		// $bulan = array (1 =>   'Januari',
		// 	'Februari',
		// 	'Maret',
		// 	'April',
		// 	'Mei',
		// 	'Juni',
		// 	'Juli',
		// 	'Agustus',
		// 	'September',
		// 	'Oktober',
		// 	'November',
		// 	'Desember'
		// );
		//$month = range(date("n", strtotime($awal)),date("n", strtotime($akhir)));

		// $kolom = range('A', 'AD');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// echo json_encode($kolom);die();

		$styleBorder = array(
			'borders' => array(
				'allBorders' => array(
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
				),
			),
		);

		$styleHeader = array(
			'font' => [
				'bold' => true,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical'	=> \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
		);

		$sheet->setCellValue('A1', 'Laporan Pemeliharaan Laptop Inventaris Semua Bagian');
		$sheet->mergeCells("A1:AE3");
		$sheet->getStyle('A1')->getFont()->setBold(true);
		$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
		//$sheet->setCellValue('A2', 'Tanggal',$awal.' Sampai '.$akhir);
		$sheet->getStyle('A2')->getFont()->setBold(true);
		$sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

		$sheet->setCellValue('A4', 'No');
		$sheet->mergeCells("A4:A6");
		$sheet->getColumnDimension('A')->setAutoSize(true);

		$sheet->setCellValue('B4', 'Jenis Perangkat');
		$sheet->mergeCells("B4:B6");
		$sheet->getColumnDimension('B')->setAutoSize(true);

		$sheet->setCellValue('C4', 'No Perangkat');
		$sheet->mergeCells("C4:C6");
		$sheet->getColumnDimension('C')->setAutoSize(true);

		$sheet->setCellValue('D4', 'Pengguna*)');
		$sheet->mergeCells("D4:D6");
		$sheet->getColumnDimension('D')->setAutoSize(true);

		$sheet->setCellValue('E4', 'Pengguna*)');
		$sheet->mergeCells("E4:E6");
		$sheet->getColumnDimension('E')->setAutoSize(true);

		$sheet->setCellValue('F4', 'Type');
		$sheet->mergeCells("F4:F6");
		$sheet->getColumnDimension('F')->setAutoSize(true);

		$sheet->setCellValue('G4', 'Bulan');
		$sheet->mergeCells("G4:AD4");
		$sheet->getColumnDimension('G')->setAutoSize(true);

		$column = 6;
		// //foreach ($month as $key => $value) {
		// 	$sheet->setCellValueByColumnAndRow($column,5, $bulan[$value]);
		// 	$sheet->mergeCellsByColumnAndRow($column,5,$column+1,5);
		// 	$sheet->setCellValueByColumnAndRow($column,6, 'Hari Ini');
		// 	$sheet->setCellValueByColumnAndRow($column+1,6, 'S.d Hari Ini');
		// 	$column = $column+2;
		// }
		//$sheet->mergeCellsByColumnAndRow(6,4,$column-1,4);

		//$sheet->setCellValueByColumnAndRow($column,4, 'Jumlah');
		// $sheet->getColumnDimension($column)->setAutoSize(true);
		//$sheet->mergeCellsByColumnAndRow($column,4,$column,5);
		//$sheet->setCellValueByColumnAndRow($column,6, 'S.d Hari Ini');

		$sheet->setCellValue('G5', 'Januari');
		$sheet->mergeCells("G5:H5");
		$sheet->setCellValue('G6', 'Hari Ini');
		$sheet->setCellValue('H6', 'S.d Hari Ini');
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);

		$sheet->setCellValue('I5', 'Februari');
		$sheet->mergeCells("I5:J5");
		$sheet->setCellValue('I6', 'Hari Ini');
		$sheet->setCellValue('J6', 'S.d Hari Ini');
		$sheet->getColumnDimension('I')->setAutoSize(true);
		$sheet->getColumnDimension('J')->setAutoSize(true);

		$sheet->setCellValue('K5', 'Maret');
		$sheet->mergeCells("K5:L5");
		$sheet->setCellValue('K6', 'Hari Ini');
		$sheet->setCellValue('L6', 'S.d Hari Ini');
		$sheet->getColumnDimension('K')->setAutoSize(true);
		$sheet->getColumnDimension('L')->setAutoSize(true);

		$sheet->setCellValue('M5', 'April');
		$sheet->mergeCells("M5:N5");
		$sheet->setCellValue('M6', 'Hari Ini');
		$sheet->setCellValue('N6', 'S.d Hari Ini');
		$sheet->getColumnDimension('M')->setAutoSize(true);
		$sheet->getColumnDimension('N')->setAutoSize(true);

		$sheet->setCellValue('O5', 'Mei');
		$sheet->mergeCells("O5:P5");
		$sheet->setCellValue('O6', 'Hari Ini');
		$sheet->setCellValue('P6', 'S.d Hari Ini');
		$sheet->getColumnDimension('O')->setAutoSize(true);
		$sheet->getColumnDimension('P')->setAutoSize(true);

		$sheet->setCellValue('Q5', 'Juni');
		$sheet->mergeCells("Q5:R5");
		$sheet->setCellValue('Q6', 'Hari Ini');
		$sheet->setCellValue('R6', 'S.d Hari Ini');
		$sheet->getColumnDimension('Q')->setAutoSize(true);
		$sheet->getColumnDimension('R')->setAutoSize(true);

		$sheet->setCellValue('S5', 'Juli');
		$sheet->mergeCells("S5:T5");
		$sheet->setCellValue('S6', 'Hari Ini');
		$sheet->setCellValue('T6', 'S.d Hari Ini');
		$sheet->getColumnDimension('S')->setAutoSize(true);
		$sheet->getColumnDimension('T')->setAutoSize(true);

		$sheet->setCellValue('U5', 'Agustus');
		$sheet->mergeCells("U5:V5");
		$sheet->setCellValue('U6', 'Hari Ini');
		$sheet->setCellValue('V6', 'S.d Hari Ini');
		$sheet->getColumnDimension('U')->setAutoSize(true);
		$sheet->getColumnDimension('V')->setAutoSize(true);

		$sheet->setCellValue('W5', 'September');
		$sheet->mergeCells("W5:X5");
		$sheet->setCellValue('W6', 'Hari Ini');
		$sheet->setCellValue('X6', 'S.d Hari Ini');
		$sheet->getColumnDimension('W')->setAutoSize(true);
		$sheet->getColumnDimension('X')->setAutoSize(true);

		$sheet->setCellValue('U5', 'Oktober');
		$sheet->mergeCells("Y5:Z5");
		$sheet->setCellValue('Y6', 'Hari Ini');
		$sheet->setCellValue('Z6', 'S.d Hari Ini');
		$sheet->getColumnDimension('Y')->setAutoSize(true);
		$sheet->getColumnDimension('Z')->setAutoSize(true);

		$sheet->setCellValue('AA5', 'November');
		$sheet->mergeCells("AA5:AB5");
		$sheet->setCellValue('AA6', 'Hari Ini');
		$sheet->setCellValue('AB6', 'S.d Hari Ini');
		$sheet->getColumnDimension('AA')->setAutoSize(true);
		$sheet->getColumnDimension('AB')->setAutoSize(true);

		$sheet->setCellValue('AC5', 'Desember');
		$sheet->mergeCells("AC5:AD5");
		$sheet->setCellValue('AC6', 'Hari Ini');
		$sheet->setCellValue('AD6', 'S.d Hari Ini');
		$sheet->getColumnDimension('AC')->setAutoSize(true);
		$sheet->getColumnDimension('AD')->setAutoSize(true);

		$sheet->setCellValue('AE4', 'Jumlah');
		$sheet->mergeCells("AE4:AE5");
		$sheet->setCellValue('AE6', 'S.d Hari Ini');
		$sheet->getColumnDimension('AE')->setAutoSize(true);

		$sheet->getStyle("A1:AE6")->applyFromArray($styleHeader);

		# Looping Header Layanan
		// $col = 3;
		// foreach ($data['layanan'] as $key => $value) {
		// 	if ($layanan_all) {
		// 		$nama_layanan = $value->jns_layanan;
		// 	}else{
		// 		$nama_layanan = $value;
		// 	}
		// 	$sheet->setCellValueByColumnAndRow($col, 5, $nama_layanan);
		// 	$data['total'][$nama_layanan] = 0;
		// 	$sheet->getColumnDimension($column[$col-1])->setAutoSize(true);
		// 	$col++;
		// }
		// $sheet->mergeCells("C4:".$column[$col-2]."4");
		// $sheet->mergeCells("A1:".$column[$col-2]."1");
		// $sheet->getStyle('A5:'.$column[$col-2].'5')->getAlignment()->setHorizontal('center');

		# Looping Bagian
		$row = 7;
		$no = 1;
		$total_hi = array();
		$total_sdhi = array();
		$total_total = 0;

		$sel = array();
		if ($tahun == DATE("Y")) {
			for ($i = 1; $i <= DATE('n'); $i++) {
				if ($i == 1) {
					$sel[1] = array("biaya" => "G", "total" => "H");
				} elseif ($i == 2) {
					$sel[2] = array("biaya" => "I", "total" => "J");
				} elseif ($i == 3) {
					$sel[3] = array("biaya" => "K", "total" => "L");
				} elseif ($i == 4) {
					$sel[4] = array("biaya" => "M", "total" => "N");
				} elseif ($i == 5) {
					$sel[5] = array("biaya" => "O", "total" => "P");
				} elseif ($i == 6) {
					$sel[6] = array("biaya" => "Q", "total" => "R");
				} elseif ($i == 7) {
					$sel[7] = array("biaya" => "S", "total" => "T");
				} elseif ($i == 8) {
					$sel[8] = array("biaya" => "U", "total" => "V");
				} elseif ($i == 9) {
					$sel[9] = array("biaya" => "W", "total" => "X");
				} elseif ($i == 10) {
					$sel[10] = array("biaya" => "Y", "total" => "Z");
				} elseif ($i == 11) {
					$sel[11] = array("biaya" => "AA", "total" => "AB");
				} elseif ($i == 12) {
					$sel[12] = array("biaya" => "AC", "total" => "AD");
				}
			}
		} else {
			$sel[1] = array("biaya" => "G", "total" => "H");
			$sel[2] = array("biaya" => "I", "total" => "J");
			$sel[3] = array("biaya" => "K", "total" => "L");
			$sel[4] = array("biaya" => "M", "total" => "N");
			$sel[5] = array("biaya" => "O", "total" => "P");
			$sel[6] = array("biaya" => "Q", "total" => "R");
			$sel[7] = array("biaya" => "S", "total" => "T");
			$sel[8] = array("biaya" => "U", "total" => "V");
			$sel[9] = array("biaya" => "W", "total" => "X");
			$sel[10] = array("biaya" => "Y", "total" => "Z");
			$sel[11] = array("biaya" => "AA", "total" => "AB");
			$sel[12] = array("biaya" => "AC", "total" => "AD");
		}
		//echo json_encode($data['pemel']);die();
		foreach ($data['pemel'] as $key => $value) {
			// if ($key!=0 && $data['pemel'][$key-1]->nama_pengguna == $value->nama_pengguna) {
			// 	$sheet->setCellValue("A".$row, "");
			// 	$sheet->setCellValue("B".$row, "");
			// 	$sheet->setCellValue("C".$row, "");
			// 	$sheet->setCellValue("D".$row, "");
			// 	$sheet->setCellValue("E".$row, $value->jns_prgkt);
			// }else{
			$sheet->setCellValue("A" . $row, $no);
			$sheet->setCellValue("B" . $row, $value->group_perangkat);
			$sheet->setCellValue("C" . $row, $value->no_prgkt_ti);
			$sheet->setCellValue("D" . $row, $value->nama_pengguna);
			$sheet->setCellValue("E" . $row, $value->bagian);
			$sheet->setCellValue("F" . $row, $value->jns_prgkt);
			$no++;
			// }

			$biaya_array = explode(", ", $value->biaya);
			$solusi_array = explode(", ", $value->solusi);
			$waktu_selesai_array = explode(", ", $value->waktu_selesai);

			$biaya = array();
			$biaya_tot = array();
			$biaya_total = 0;

			if ($value->biaya != NULL && $value->waktu_selesai != NULL) {
				$val_biaya = explode(", ", $value->biaya);
				$val_waktu = explode(", ", $value->waktu_selesai);
				for ($j = 0; $j < count($val_waktu); $j++) {
					$biaya[date("n", strtotime($val_waktu[$j]))][] = $val_biaya[$j];
				}
			}

			$onRow = $row;
			$setRow = array();
			foreach ($sel as $keys => $values) {
				if (!array_key_exists($keys, $total_hi)) {
					$total_hi[$keys] = 0;
				}
				if (!array_key_exists($keys, $total_sdhi)) {
					$total_sdhi[$keys] = 0;
				}
				$setRow[$keys] = $onRow;
				if (array_key_exists($keys, $biaya)) {
					foreach ($biaya[$keys] as $keyss => $valuess) {
						$sheet->setCellValue($values['biaya'] . $setRow[$keys], $valuess);
						$biaya_total = $biaya_total + $valuess;
						$sheet->setCellValue($values['total'] . $setRow[$keys], $biaya_total);

						$total_hi[$keys] = $total_hi[$keys] + $valuess;

						if ($row < $setRow[$keys]) {
							$row++;
						}
						$setRow[$keys]++;
					}
				} else {
					$sheet->setCellValue($values['biaya'] . $setRow[$keys], "-");
					$sheet->setCellValue($values['total'] . $setRow[$keys], $biaya_total);
					$setRow[$keys]++;
				}

				$total_sdhi[$keys] = $total_sdhi[$keys] + $biaya_total;
				$biaya_tot[$keys] = $biaya_total;
			}

			foreach ($sel as $keys => $values) {
				if ($setRow[$keys] <= $row) {
					for ($i = $setRow[$keys]; $i <= $row; $i++) {
						$sheet->setCellValue($values['biaya'] . $i, "-");
						$sheet->setCellValue($values['total'] . $i, $biaya_tot[$keys]);
					}
				}
			}

			for ($i = $onRow; $i <= $row; $i++) {
				if ($i == $onRow) {
					$sheet->setCellValue('AE' . $i, $biaya_total);
					$total_total = $total_total + $biaya_total;
				} else {
					$sheet->setCellValue('AE' . $i, "-");
				}
			}

			# Background Color
			// if ($onRow == $row) {
			// 	$sheet->getStyle('B'.$onRow.':AD'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('92d050');
			// }elseif ($onRow+1 == $row) {
			// 	$sheet->getStyle('B'.$onRow.':AD'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffff00');
			// }elseif ($onRow+2 == $row) {
			// 	$sheet->getStyle('B'.$onRow.':AD'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00b0f0');
			// }else{
			// 	$sheet->getStyle('B'.$onRow.':AD'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbf00');
			// }

			#Looping Bagian Layanan Value
			// $col = 3;
			// foreach ($data['layanan'] as $keys => $values) {
			// 	if ($layanan_all) {
			// 		$nama_layanan = $values->jns_layanan;
			// 	}else{S
			// 		$nama_layanan = $values;
			// 	}
			// 	$sheet->setCellValueByColumnAndRow($col, $row, $value['layanan'][$nama_layanan]??0);
			// 	$data['total'][$nama_layanan] = ($data['total'][$nama_layanan]??0)+($value['layanan'][$nama_layanan]??0);
			// 	$col++;
			// }
			$row++;
		}

		foreach ($sel as $key => $value) {
			$sheet->setCellValue($value['biaya'] . $row, $total_hi[$key]);
			$sheet->setCellValue($value['total'] . $row, $total_sdhi[$key]);
		}
		$sheet->setCellValue('AE' . $row, $total_total);

		# Looping Total
		// $sheet->setCellValue("C".$row, "Total");
		// $col = 3;
		// foreach ($data['pemel'] as $key => $value) {
		// 	if ($layanan_all) {
		// 		$nama_layanan = $value->jns_layanan;
		// 	}else{
		// 		$nama_layanan = $value;
		// 	}
		// 	$sheet->setCellValueByColumnAndRow($col, $row, $data['total'][$nama_layanan]);
		// 	$col++;
		// }

		$sheet->getStyle('A4:AE' . $row)->applyFromArray($styleBorder);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan Biaya Setiap Pemel';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function gantiQrCode()
	{
		$this->load->helper('file');
		delete_files('./assets/images/', TRUE);
		// unlink('./assets/images/'*'.png');
		// die();

		$total_data_di_tabel_perangkat = $this->db->order_by('id_perangkat', "desc")->limit(1)->get('perangkat')->row('id_perangkat');

		for ($i = 1; $i <= $total_data_di_tabel_perangkat; $i++) {

			// START UNLINK QR CODE SEBELUMNYA JIKA SESUAI DENGAN DB MAKA DIHAPUS
			// $query  = $this->db->query("SELECT qr_code FROM perangkat WHERE id_perangkat='$i'");
			// $ambil = $query->row_array();
			// if ($ambil['qr_code'] != NULL) {
			// 	//echo "tes"; die();
			// 	unlink('./assets/images/' . $ambil['qr_code']);
			// }
			// // END

			// START GET KOLOM DATA ID DAN GENEREATE KODE QR CODE baru UNTUK EDIT DENGAN YANG BARU ke database
			// cek data
			$cek_data = $this->db->query("SELECT * FROM perangkat WHERE id_perangkat='$i'")->result();
			// print_r(count($cek_data)); die();
			if (count($cek_data) > 0) {
				$data = array(
					'qr_code' => 'qrcode_new' . $i . '.png'
				);
				$where = array(
					'id_perangkat' => $i
				);

				$edit_data_perangkat = $this->m_perangkat->edit_perangkat_baru($data, $where);
				$edit_data_perangkat = $this->m_perangkat->edit_perangkat_histori_baru($data, $where);

				// START BUAT GAMBAR QR CODE BARU DENGAN DATA KODE QR CODE BARU PADA DATABASE dan di enkripsi
				$this->load->library('ciqrcode');
				$this->load->library('encryption');

				$this->ciqrcode->generate(array(
					'data'		=>	base_url('History/histori_perangkat/') . base64_encode($this->encryption->encrypt($i)),
					'savename'	=>	'assets/images/qrcode_new' . $i . '.png'
				));
				// END				

			} else {
			}

			// END

		}

		redirect('Panel/perangkat');
	}

	public function export_excel()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		require_once FCPATH . 'vendor/autoload.php';
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('B1', 'Export Tabel Perangkat');
		$sheet->getStyle('B1')->getFont()->setBold(true);
		$sheet->mergeCells("B1:O1");
		$sheet->mergeCells("B2:O2");
		$sheet->getStyle('B1')->getAlignment()->setHorizontal('center');

		$sheet->setCellValue('A3', 'No');
		$sheet->setCellValue('B3', 'Jenis Perangkat');
		$sheet->setCellValue('C3', 'Tipe');
		$sheet->setCellValue('D3', 'Bagian');
		$sheet->setCellValue('E3', 'Kepemilikan');
		$sheet->setCellValue('F3', 'No. Perangkat TI');
		$sheet->setCellValue('G3', 'No. Perangkat Vendor');
		$sheet->setCellValue('H3', 'No. Inventaris');
		$sheet->setCellValue('I3', 'No. SP/SPK');
		$sheet->setCellValue('J3', 'Dok. Pengajuan');
		$sheet->setCellValue('K3', 'Detail');
		$sheet->setCellValue('L3', 'Nama');
		$sheet->setCellValue('M3', 'Status');
		$sheet->setCellValue('N3', 'Tanggal Terima');
		$sheet->setCellValue('O3', 'QR Code');

		$sheet->getStyle('A3:O3')->getFont()->setBold(true);

		$query = $this->m_perangkat->tampil_perangkat($kantor)->result();

		$i = 4;
		$j = 4;
		$no = 1;

		foreach ($query as $key => $value) {
			$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$drawing->setPath('assets/images/qrcode_new' . $value->id_perangkat . '.png');
			$drawing->setCoordinates('O' . $j);
			$drawing->setHeight(68);
			$drawing->setWorksheet($spreadsheet->getActiveSheet());
			$j++;
		}

		foreach ($query as $key => $value) {
			$sheet->setCellValue('A' . $i, $no++);
			$sheet->setCellValue('B' . $i, ($this->m_master_prgkt->edit_mstrprgkt($value->id_master_prgkt)->row() == NULL) ? "-" : $this->m_master_prgkt->edit_mstrprgkt($value->id_master_prgkt)->row()->jns_prgkt);
			$sheet->setCellValue('C' . $i, ($this->m_master_prgkt->edit_mstrprgkt($value->id_master_prgkt)->row() == NULL) ? "-" : $this->m_master_prgkt->edit_mstrprgkt($value->id_master_prgkt)->row()->tipe_prgkt);
			$sheet->setCellValue('D' . $i, $value->bagian);
			$sheet->setCellValue('E' . $i, $value->kepemilikan);
			$sheet->setCellValue('F' . $i, $value->no_prgkt_ti);
			$sheet->setCellValue('G' . $i, $value->no_prgkt_vendor);
			$sheet->setCellValue('H' . $i, $value->no_inventaris);
			$sheet->setCellValue('I' . $i, $value->no_spk);
			if ($this->m_pengajuan->edit_pengajuan($value->id_pengajuan)->row() == NULL) {
				$val_pengganti[$key] = ' - ';
			} else {
				$val_pengganti[$key] = $this->m_pengajuan->edit_pengajuan($value->id_pengajuan)->row()->no_memo;
			}
			$sheet->setCellValue('J' . $i, $val_pengganti[$key]);
			$sheet->setCellValue('K' . $i, $value->detail);
			$sheet->setCellValue('L' . $i, $value->nama_pengguna);
			$sheet->setCellValue('M' . $i, $value->status);
			$sheet->setCellValue('N'.$i, $value->tgl_terima);
			$sheet->setCellValue('O' . $i, ' ');
			$sheet->getRowDimension($i)->setRowHeight(50);
			$sheet->getStyle('B' . $i . ':' . 'N' . $i)->getAlignment()->setVertical('center');
			$sheet->getStyle('A' . $i . ':' . 'A' . $i)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A' . $i . ':' . 'A' . $i)->getAlignment()->setVertical('center');
			$i++;
		}

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		$sheet->getColumnDimension('J')->setAutoSize(true);
		$sheet->getColumnDimension('K')->setAutoSize(true);
		$sheet->getColumnDimension('L')->setAutoSize(true);
		$sheet->getColumnDimension('M')->setAutoSize(true);
		$sheet->getColumnDimension('N')->setAutoSize(true);
		$sheet->getColumnDimension('O')->setAutoSize(true);

		$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
		$i = $i - 1;
		$sheet->getStyle('A3:O' . $i)->applyFromArray($styleArray);

		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan Excel Tabel Perangkat';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	//KANTOR

	public function daftar_kantor()
	{
		if ($this->session->userdata('role') == 1) {
			$this->load->view('admin/daftar_kantor');
		}
	}
	public function get_data_kantor()
	{
		/*
		| Select As
		*/
		$this->datatables->table('master_kantor');
		$this->datatables->select('id_master_kantor,kode_master_kantor, nama_master_kantor');

		echo $this->datatables->draw();


		//$this->datatables->add_column('Actions', '<a class="btn btn-warning" href="' . base_url('Panel/ubah_kantor/$1') . '"><i class="fa fa-edit"></i></a>&nbsp;<a class="btn btn-danger" onclick="return confirm_delete()" href="' . base_url('Panel/hapus_kantor/$1') . '"><i class="fa fa-edit"></i></a>', 'id_master_kantor');
	}
	public function tambah_kantor()
	{
		if ($this->session->userdata('role') == 1) {
			$this->load->view('admin/tambah_kantor');
		}
	}
	public function tambah_aksi_kantor()
	{
		if ($this->session->userdata('role') == 1) {

			$this->form_validation->set_rules('nama_master_kantor', 'kode_master_kantor', 'required');
			$this->form_validation->set_rules('kode_master_kantor', 'kode_master_kantor', 'required|max_length[5]');

			$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
			$this->form_validation->set_message('max_length', '{field} maksimal 5 karakter');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin/tambah_kantor');
			} else {
				$post = $this->input->post(null, TRUE);
				$this->m_daftar_kantor->tambah_data_kantor($post);
				redirect('Panel/daftar_kantor');
			}
		}
	}
	public function ubah_kantor($id_master_kantor)
	{
		if ($this->session->userdata('role') == 1) {
			$data['daftar_kantor'] = $this->m_daftar_kantor->edit_kantor($id_master_kantor)->row();
			$this->load->view('admin/ubah_kantor', $data);
		}
	}
	public function ubah_aksi_kantor($id_master_kantor = NULL)
	{
		if ($this->session->userdata('role') == 1) {

			$this->form_validation->set_rules('nama_master_kantor', 'kode_master_kantor', 'required');
			$this->form_validation->set_rules('kode_master_kantor', 'kode_master_kantor', 'required|max_length[5]');

			$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
			$this->form_validation->set_message('max_length', '{field} maksimal 5 karakter');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if ($this->form_validation->run() == FALSE) {
				$data['master_kantor'] = $this->m_daftar_kantor->edit_kantor($this->input->post('id_master_kantor'))->row();
				$query = $this->m_daftar_kantor->get($id_master_kantor);
				if ($query->num_rows()  > 0) {
					$data['row'] = $query->row();
					$this->load->view('admin/ubah_kantor', $data);
				} else {
					redirect('Panel/daftar_kantor');
				}
			} else {
				$post['kode_master_kantor'] = $this->input->post('kode_master_kantor');
				$post['nama_master_kantor'] = $this->input->post('nama_master_kantor');
				$post['id_master_kantor'] = $id_master_kantor;
				$this->m_daftar_kantor->edit_data_kantor($post);
				redirect('Panel/daftar_kantor');
			}
		}
	}
	public function hapus_kantor($id_master_kantor)
	{
		if ($this->session->userdata('role') == 1) {
			$where = array('id_master_kantor' => $id_master_kantor);
			$this->m_daftar_kantor->hapus_data_kantor($where);
			redirect('Panel/daftar_kantor');
		}
	}

	// Bagian
	public function daftar_bagian()
	{
		//$kantor = $this->session->userdata('id_master_kantor');
		if ($this->session->userdata('role') == 1) {
			//$data['daftar_bagian'] = $this->m_daftar_bagian->tampil_daftar_bagian($kantor)->result();
			// var_dump($data);
			$config['base_url'] = site_url('panel/daftar_bagian'); //site url
			$config['total_rows'] = $this->db->count_all('bagian'); //total row
			$config['per_page'] = 10;  //show record per halaman
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
				'page' 		=> ($this->uri->segment(3)) ? $this->uri->segment(3) : 0,
				'pagination' => $this->pagination->create_links()
			);
			//print_r($data['page']);  return 1;

			$this->load->view('admin/daftar_bagian', $data);
		}
	}
	public function get_data_bagian()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		/*
		| Select As
		*/
		$this->datatables->table('bagian AS t1');
		$this->datatables->select('id_bagian,bagian, kode_bag_baru, nama_master_kantor_baru');

		/*
		| Join Clause
		| $this->datatables->join('table', 'condition', 'type')
		| By default parameter type adalah null, anda bisa menambahkan INNER JOIN dll
		*/
		$this->datatables->join('master_kantor AS t2', 't1.id_master_kantor = t2.id_master_kantor', 'left');

		$this->datatables->where(['t1.id_master_kantor' => $kantor]);

		echo $this->datatables->draw();


		//$this->datatables->add_column('Actions', '<a class="btn btn-warning" href="' . base_url('Panel/ubah_bagian/$1') . '"><i class="fa fa-edit"></i></a>&nbsp;<a class="btn btn-danger" onclick="return confirm_delete()" href="' . base_url('Panel/hapus_bagian/$1') . '"><i class="fa fa-edit"></i></a>', 'id_bagian');


	}

	public function tambah_bagian()
	{
		if ($this->session->userdata('role') == 1) 
		{
			$this->load->view('admin/tambah_bagian');
		}
	}
	public function tambah_aksi_bagian()
	{
		if ($this->session->userdata('role') == 1) {

			$this->form_validation->set_rules('bagian', 'bagian', 'required');
			$this->form_validation->set_rules('kode_bag_baru', 'kode_bag_baru', 'required|max_length[15]');
			$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
			$this->form_validation->set_message('max_length', '%s maksimal 15 karakter');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			$kantor = $this->session->userdata('id_master_kantor');

			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/tambah_bagian');
			} 
			else 
			{
				$post = $this->input->post(null, TRUE);
				$this->m_daftar_bagian->tambah_data_bagian($post,$kantor);
				redirect('Panel/daftar_bagian');
			}
		}
	}

	public function ubah_bagian($id_bagian)
	{
		if ($this->session->userdata('role') == 1) {
			$data['daftar_bagian'] = $this->m_daftar_bagian->edit_bagian($id_bagian)->row();
			$this->load->view('admin/ubah_bagian', $data);
		}
	}
	public function ubah_aksi_bagian($id_bagian = NULL)
	{
		if ($this->session->userdata('role') == 1) {

			$this->form_validation->set_rules('bagian', 'bagian', 'required');
			$this->form_validation->set_rules('kode_bag_baru', 'kode_bag_baru', 'required|max_length[5]');
			$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
			$this->form_validation->set_message('max_length', '{field} maksimal 5 karakter');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if ($this->form_validation->run() == TRUE) 
			{
				$data['bagian'] = $this->m_daftar_bagian->edit_bagian($this->input->post('id_bagian'))->row();
				
				
				$query = $this->m_daftar_bagian->edit_bagian($id_bagian);
				if ($query->num_rows()  > 0) 
				{
					$data['row'] = $query->row();
					$this->load->view('admin/ubah_bagian', $data);
				} 
				else 
				{
					redirect('Panel/daftar_bagian');
				}
			} 
			else 
			{
				$kantor = $this->session->userdata('id_master_kantor');
				$post['bagian'] = $this->input->post('bagian');
				$post['kode_bag_baru'] = $this->input->post('kode_bag_baru');
				$post['id_bagian'] = $id_bagian;
				$this->m_daftar_bagian->edit_data_bagian($post,$kantor);
				redirect('Panel/daftar_bagian');
			}
		}
	}

	public function hapus_bagian($id_bagian)
	{
		if ($this->session->userdata('role') == 1) 
		{
			$where = array('id_bagian' => $id_bagian);
			$this->m_daftar_bagian->hapus_data_bagian($where);
			redirect('Panel/daftar_bagian');
		}
	}

	public function resetpass()
	{
		$old_password = $this->input->post('passwordlama');
		$new_password = $this->input->post('password1');
		$konfirmasi_password = $this->input->post('password2');

		if ($old_password == null || $new_password == null || $konfirmasi_password == null) {
			$this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
				'status' => 'failed',
				'message' => 'Password lama tidak boleh kosong!'
			]));
		}

		if (strlen($new_password) < 8) {
			return $this->output
			->set_content_type('application/json')
			->set_output(json_encode([
				'status' => 'failed',
				'message' => 'Password baru setidaknya memiliki 8 karakter',
			]));
		}

		$get_user = $this->db->get_where('users', array('username' => $this->session->userdata('username')))->row();
		
		if (!$get_user) {
			return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
				'status' => 'failed',
				'message' => 'Password lama salah!'
			]));
		}

		if ($get_user->password != md5($old_password)) {
			return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
				'status' => 'failed',
				'message' => 'Password lama salah!'
			]));
		}

		if ($new_password != $konfirmasi_password) {
			return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
				'status' => 'failed',
				'message' => 'Password baru tidak sama dengan konfirmasi password!'
			]));
		}
		
		$this->db->set('password', md5($new_password));
		$this->db->where('username', $get_user->username);
		$this->db->update('users');

		return $this->output
		->set_content_type('application/json')
		->set_output(json_encode([
			'status' => 'success',
			'message' => 'Password berhasil diperbarui'
		]));
	}

	public function kelola_tiket_cybersecurity()
	{
		$this->load->view('admin/kelola_tiket_cybersecurity');
	}

	public function get_tiket_cybersecurity()
	{
		$kantor = $this->session->userdata('id_master_kantor');
		/*
		| Select As
		*/
		$this->datatables->table('ajukan_keluhan_keamanan_siber');
		$this->datatables->select('id_ajukan,kode_servis,tanggal, nama, nama_master_kantor_baru, bagian,jns_kerusakan, uraian,no_spk,prioritas,upload_dokumen,status,waktu_antrian,waktu_ditangani,waktu_selesai,waktu_total');

		/*
		| Join Clause
		| $this->datatables->join('table', 'condition', 'type')
		| By default parameter type adalah null, anda bisa menambahkan INNER JOIN dll
		*/
		$this->datatables->join('bagian', 'ajukan_keluhan_keamanan_siber.id_bagian = bagian.id_bagian', 'left');
		$this->datatables->join('master_kantor', 'ajukan_keluhan_keamanan_siber.id_master_kantor = master_kantor.id_master_kantor', 'left');
		// $this->datatables->where(['ajukan_keluhan_keamanan_siber.id_master_kantor' => $kantor]);
		
		echo $this->datatables->draw();
	}

	public function ubah_tiket_cybersecurity($id_ajukan)
	{
		// $id_departemen = $this->session->userdata('id_master_kantor');
		//Hapus link
		$this->session->unset_userdata('link');
		//
		$data['kelola_tiket'] = $this->m_kelola_tiket_cybersecurity->edit_kelola_tiket($id_ajukan)->row();
		// $data['perangkat'] = $this->m_perangkat->tampil_aktif_perangkat($id_departemen)->result();
		if ($data['kelola_tiket']->id_master_kantor != null) {
			$data['bagian'] = $this->m_kelola_tiket_cybersecurity->tampil_bagian($data['kelola_tiket']->id_master_kantor)->result();
		}

		$this->load->view('admin/ubah_tiket_cybersecurity', $data);
	}

	public function hapus_tiket_cybersecurity($id_ajukan)
	{
		$where = array('id_ajukan' => $id_ajukan);
		$this->m_kelola_tiket_cybersecurity->hapus_data_tiket($where);

		$this->session->set_flashdata('validDelete', 'bbb');

		return redirect(base_url('Panel/kelola_tiket_cybersecurity'));
	}

	public function ubah_aksi_tiket_cybersecurity()
	{
		$data = array(
			'id_ajukan' => $this->input->post('id_ajukan'),
			'kode_servis'	=> $this->input->post('kd_servis'),
			'nama' => $this->input->post('nama'),
			'id_bagian' => $this->input->post('bagian'),
			//'email' => $this->input->post('email'),
			'jns_kerusakan' => $this->input->post('jns_kerusakan'),
			'id_master_jns' => $this->input->post('id_master_jns'),
			'id_perangkat' => $this->input->post('id_pilprgkt'),
			'uraian' => $this->input->post('uraian'),
			'prioritas' => $this->input->post('prioritas'),
			'status' => $this->input->post('status'),
			'waktu_antrian' => $this->input->post('w_antrian'),
			'waktu_ditangani' => $this->input->post('w_ditangani'),
			'waktu_selesai' => $this->input->post('w_selesai'),
			'pengguna_layanan' => $this->input->post('pengguna'),
			'disposisi' => $this->input->post('disposisi'),
			'konek_had_soft' => $this->input->post('konek_master_perangkat'),
			'solusi' => $this->input->post('solusi'),
			'uraian_solusi' => $this->input->post('uraian_solusi'),
			'uraian_rca' => $this->input->post('uraian_rca'),
			'nama_ti' => $this->input->post('nama_ti') ?? '',
			'vendor' => $this->input->post('vendor') ?? '',
			'no_spk' => $this->input->post('nospk') ?? '',
			//'upload_spk' => $_FILES['upload_spk']['name'] ?? '',
			//'upload_spk' => $this->input->post($data['upload_spk']) ?? '',
			'status' => $this->input->post('status'),
			//'biaya' => $this->input->post('biaya') ?? '',
			'biaya' => (int) preg_replace("/[^0-9]/", "", $this->input->post('biaya')) ?? '',
			//'biaya' => str_replace('.', '', substr($this->input->post('biaya'), 4)),
		);
		// if($this->input->post('konek_master_perangkat')  != NULL)
		// {
		// 	$data['konek_master_perangkat'] = $this->input->post('konek_master_perangkat');
		// }


		if (0) {
			$config['upload_path']  = './assets/upload';
			$config['allowed_types'] = 'jpg|png|pdf';
			$config['max_size']     = '5000';
			$this->load->library('upload',  $config);
			if (!$this->upload->do_upload('upload_spk')) {
				echo "upload gagal";
				die();
			} else {
				$data['upload_spk'] = $this->upload->data('file_name');
			}
		} else {

			if (isset($_FILES['upload_spk']) && $_FILES['upload_spk']['name'] != NULL) {

				$config['upload_path']	= './assets/upload';
				$config['allowed_types'] = 'jpg|jpeg|png|pdf';
				$config['max_size']     = '5000';
				///

				$this->load->library('upload',  $config);
				if (!$this->upload->do_upload('upload_spk')) {
					echo "upload gagal";
					echo $this->upload->display_errors();
					die();
				} else {

					//upload_spk diubah
					$data['upload_spk'] = $this->upload->data('file_name');
					$id_ajukan = $this->input->post('id_ajukan');

					$query = $this->db->get_where('ajukan_keluhan_keamanan_siber', array('id_ajukan' => $id_ajukan));
					$ambil = $query->row()->upload_spk;
					if ($ambil != NULL) unlink('./assets/upload/' . $ambil);
					// print_r($ambil); die();
					//echo $ambil;
				}
			} else {
				$data['upload_spk'] = $this->input->post('lama');
				//$data['upload_spk'] = $this->upload->data('file_name');
			}
		}
		date_default_timezone_set("Asia/Jakarta");
		$waktu_sekarang		= date('Y-m-d H:i:s');

		if ($this->input->post('status') == "Antrian") {
			$sts_skrng = $this->m_kelola_tiket_cybersecurity->edit_kelola_tiket($this->input->post('id_ajukan'))->row()->status;
			$sts_baru  = $this->input->post('status');
			if ($sts_skrng == $sts_baru) {
			} else {
				$data['waktu_antrian']		= $waktu_sekarang;
				$data['waktu_ditangani']	= NULL;
				$data['waktu_selesai']		= NULL;
			}
		} else if ($this->input->post('status') == "Sedang ditangani") {
			$sts_skrng = $this->m_kelola_tiket_cybersecurity->edit_kelola_tiket($this->input->post('id_ajukan'))->row()->status;
			$sts_baru  = $this->input->post('status');
			if ($sts_skrng == $sts_baru) {
			} else {
				if ($data['waktu_antrian'] == NULL) {
					$data['waktu_antrian']		= $waktu_sekarang;
					$data['waktu_ditangani']	= $waktu_sekarang;
					$data['waktu_selesai']	    = NULL;
				} else {
					$data['waktu_ditangani'] 		= $waktu_sekarang;
					$data['waktu_selesai']			= NULL;
				}
			}
		} else if ($this->input->post('status') == "Selesai") {
			$sts_skrng = $this->m_kelola_tiket_cybersecurity->edit_kelola_tiket($this->input->post('id_ajukan'))->row()->status;
			$sts_baru  = $this->input->post('status');
			if ($sts_skrng == $sts_baru) {
			} else {
				if ($data['waktu_antrian'] == NULL && $data['waktu_ditangani'] == NULL && $data['waktu_selesai'] == NULL) {
					$data['waktu_antrian']		= $waktu_sekarang;
					$data['waktu_ditangani']	= $waktu_sekarang;
					$data['waktu_selesai'] 		= $waktu_sekarang;
				} else if ($data['waktu_ditangani'] == NULL && $data['waktu_selesai'] == NULL) {
					$data['waktu_ditangani']	= $waktu_sekarang;
					$data['waktu_selesai'] 		= $waktu_sekarang;
				} else {
					$data['waktu_selesai'] 		= $waktu_sekarang;
				}
			}
		}
		//
		$where = array(
			'id_ajukan' => $this->input->post('id_ajukan')
		);
		//histori lama
		/*$data_asli = $this->db->get_where('ajukan_keluhan', array('id_ajukan' => $this->input->post('id_ajukan')))->row();

		if ($data_asli->prioritas != '') {
			//Histori
			$data_h = $data;
			$data_h['id_ajukan'] =  $this->input->post('id_ajukan');
			$this->db->insert('ajukan_keluhan_histori', $data_h);
		}*/
		//

		$kd_servis = $this->input->post('kd_servis');
		// $cek_kd = $this->m_histori->tampil_kd($kd_servis)->row();
		// if ($cek_kd == NULL) {
		// 	$this->m_kelola_tiket->edit_aksi_tiket($data, $where);
		// 	$data_asli = $this->db->get_where('ajukan_keluhan', array('id_ajukan' => $this->input->post('id_ajukan')))->row();
		// 	$this->db->insert('ajukan_keluhan_histori', $data_asli);
		// 	//$this->send();
		// } else {
			$this->m_kelola_tiket_cybersecurity->edit_aksi_tiket($data, $where);
			// $data_asli = $this->db->select('id_ajukan,kode_servis,nama, id_bagian,tanggal,email,jns_kerusakan,id_master_jns,id_perangkat,uraian,prioritas,status,pengguna_layanan,solusi,uraian_solusi,nama_ti,vendor,biaya,no_spk,upload_spk,disposisi,waktu_antrian,waktu_ditangani,waktu_selesai,lama_penanganan,tahun');
			// //$data_asli = $this->db->get_where('ajukan_keluhan_histori', array('kode_servis' => $this->input->post('kd_servis')))->row();
			// $data_asli = $this->db->get_where('ajukan_keluhan', array('id_ajukan' => $this->input->post('id_ajukan')))->row();
			// //echo json_encode($data_asli);
			// //die();
			// $this->db->where('id_ajukan', $this->input->post('id_ajukan'));
			// $this->db->update('ajukan_keluhan_histori', $data_asli);
			//$this->send();
		// }

		return redirect('Panel/kelola_tiket_cybersecurity', 'refresh');
	}
}
