<?php
//controller ini berfungsi untuk menampilkan isi dari qrcode tanpa login ke webnya
class History extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		// $this->load->library('form_validation');

		// if (empty($this->session->userdata('login'))) {
		// 	redirect(base_url('user/index'));
		// }

        $this->load->model(array('m_perangkat', 'm_histori', 'm_pengajuan', 'm_master_prgkt'));
        //$data['perangkat'] = $this->m_perangkat->tampil_perangkat()->result();
	}
  
    function histori_perangkat($id_perangkat)
	{
		$this->load->library('encryption');

		$encode = base64_decode($id_perangkat);
		$decrypt = $this->encryption->decrypt($encode);
		// $explodeURL = str_replace("/", "%2F", $id_perangkat);
		// $decrypt = $this->encryption->decrypt($explodeURL);
		// echo $decrypt;
		// die();

		// start show halaman qr code baru
		$where = $decrypt;
      	$data['perangkat'] = $this->m_perangkat->tampil_data_perangkat_qrcode($where)->row();
      	$id_master_prgkt = $this->m_perangkat->tampil_data_perangkat_qrcode($where)->row()->id_master_prgkt;
      	$data['perangkat_jns'] = $this->m_master_prgkt->edit_mstrprgkt($id_master_prgkt)->row();
		// echo json_encode($data['perangkat']); die();
		// end show halaman qr code baru


		$data['perangkat_h'] = $this->m_histori->tampil_mutasi_perangkat_h($decrypt)->result();
		$data['ajukan_h'] = $this->m_histori->tampil_ajukan_h($decrypt)->result();
		$id_pengajuan = $this->db->get_where('perangkat', array('id_perangkat' => $decrypt))->row()->id_pengajuan;
		$data['pengajuan_h'] = $this->m_histori->tampil_pengajuan_h($id_pengajuan)->result();

		// echo json_encode($this->m_pengajuan->get_id_bagian('2c27b3af716b1df3fcca'));
		// $tes = $this->m_histori->tampil_pengajuan_h($id_pengajuan)->row()->id_bagian_pengajuan;
		// $tes1 = $this->m_pengajuan->get_id_bagian($tes);
		// echo json_encode($tes);
		// echo "<br>";		
		// echo json_encode($tes1);
		// echo "<br>";	
		// echo $id_pengajuan;
		// echo "<br>";
		// echo json_encode($data['pengajuan_h']);
		// die();


		//echo "<pre>";
		//var_dump($data['ajukan_h']); return 1;
		$this->load->view('admin/show_qr_code', $data);
	}
}
?>
