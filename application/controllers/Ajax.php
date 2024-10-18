<?php

class Ajax extends CI_Controller
{
	public function bagian_selected_biasa()
	{
		$this->load->model('m_pengajuan');
		$id 		= $_REQUEST['id_pengajuan'];
		//
		$dipilih			= $this->m_pengajuan->edit_pengajuan($id)->row();
		$dipilih_id_bagian	= $dipilih->id_bagian_pengajuan;
		//
		$bagian		= $this->m_pengajuan->tampil_bagian()->result();
		//
		echo '<select class="form-control col-md-10" name="id_bagian" required>';
		foreach ($bagian as $b) {
			$tmp_found = "no";
			$tmp = $this->m_pengajuan->get_id_bagian($dipilih_id_bagian);
			foreach ($tmp as $c) {
				if ($b->id_bagian == $c->id_bagian) {
					echo "<option value='" . $b->id_bagian . "'>" . $b->bagian . "</option>";
					$tmp_found = "yes";
					continue;
				}
			};
			if ($tmp_found == "yes") continue;
		}
		echo "</select>";
	}
	public function bagian_selected()
	{
		$this->load->model('m_pengajuan');
		$id 		= $_REQUEST['id_pengajuan'];
		//
		$dipilih			= $this->m_pengajuan->edit_pengajuan($id)->row();
		$dipilih_id_bagian	= $dipilih->id_bagian_pengajuan;
		//
		$bagian		= $this->m_pengajuan->tampil_bagian()->result();
		//
		echo '<select class="form-control col-md-10 js-example-basic-multiple-2" name="id_bagian[]" multiple="multiple" required>';
		foreach ($bagian as $b) {
			$tmp_found = "no";
			$tmp = $this->m_pengajuan->get_id_bagian($dipilih_id_bagian);
			foreach ($tmp as $c) {
				if ($b->id_bagian == $c->id_bagian) {
					echo "<option value='" . $b->id_bagian . "' selected>" . $b->bagian . "</option>";
					$tmp_found = "yes";
					continue;
				}
			};
			if ($tmp_found == "yes") continue;
			else echo "<option value='" . $b->id_bagian . "'>" . $b->bagian . "</option>";
		}
		echo "</select>";
		//Select2
		echo '<script type="text/javascript">';
		echo '$(document).ready(function() {';
		echo "$('.js-example-basic-multiple-2').select2({";
		echo 'theme: "classic"';
		echo '});';
		echo '});';
		echo '</script>';
	}
	public function bagian_baru_selected_perangkat()
	{
		$this->load->model('m_perangkat');
		$id 			= $_REQUEST['id_bagian'];
		//Data semua bagian
		$bagian_all		= $this->db->get('bagian')->result();
		//
		echo '<select class="form-control col-md-10 js-example-basic-multiple" name="id_bagian_baru[]" multiple="multiple" required>';
		foreach ($bagian_all as $b) {
			$tmp_found = "no";
			//Bagian yang sedang diedit
			$bagian = $this->m_perangkat->get_id_bagian($id);
			//Loop selected
			foreach ($bagian as $c) {
				if ($b->id_bagian == $c->id_bagian) {
					echo "<option value='" . $b->id_bagian . "' selected>" . $b->bagian . "</option>";
					$tmp_found = "yes";
					continue;
				}
			};
			if ($tmp_found == "yes") continue;
			else echo "<option value='" . $b->id_bagian . "'>" . $b->bagian . "</option>";
		}
		echo "</select>";
		//Select2

		echo '<script type="text/javascript">';
		echo '$(document).ready(function() {';
		echo "$('.js-example-basic-multiple').select2({";
		echo 'theme: "classic"';
		echo '});';
		echo '});';
		echo '</script>';
	}

	public function print_formkeluhan()
	{
		//$this->load->model('m_kelola_tiket');
		$this->load->model(array('m_kelola_tiket', 'm_perangkat'));
		//$id_ajukan = "182";
		$id_ajukan = $this->input->get('id_ajukan', TRUE);
		$p['data'] = $this->m_kelola_tiket->edit_kelola_tiket($id_ajukan)->row();
		//print_r($this->db->last_query($p['data']));
		$this->load->library('fungsi');
		$p['perangkat'] = $this->m_perangkat->tampil_aktif_perangkat_cetak($p['data']->id_perangkat)->row();
		//echo '<pre>',print_r($p['perangkat']),'</pre>';
		//die();
		$html      = $this->load->view('admin/cetak_keluhan', $p, true);
		$this->fungsi->PdfGenerator($html, null, 'A4', 'potrait');
	}
	

	public function detail_tiket()
	{
		$this->load->model(array('m_kelola_tiket', 'm_perangkat'));
		$id_ajukan = $this->input->get('id_ajukan', TRUE);
		$data = $this->m_kelola_tiket->edit_kelola_tiket($id_ajukan)->row();
		$data1 = $this->m_kelola_tiket->ambil_nama_bagian($id_ajukan)->row();
		$data2 = $this->m_kelola_tiket->ambil_nama_jnsprgkt($id_ajukan)->row();
		$data3 = $this->m_kelola_tiket->tampil_pilprgkt($id_ajukan)->row();
		//pilih perangkat masih salah,harusnya kn itu nyambung ke perangkat,tp perangkat belum nyambung ke mater_prgkt idnya yg pas pop up
		echo'
		<form class="form-horizontal">
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Servis</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->kode_servis.'" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->nama.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Bagian</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data1->bagian.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->email.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Layanan</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->jns_kerusakan.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Perangkat</label>
				<div class="col-sm-10" align="left">'; ?><?php if($data2 == NULL){
					echo'
					<input type="text" class="form-control col-md-10" value="-" readonly>'; ?>
					<?php }else{
						echo '<input type="text" class="form-control col-md-10" value="'.$data2->jns_prgkt.'" readonly>';
					}?><?php echo'
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Uraian Kerusakan</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->uraian.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih perangkat</label>
                <div class="col-sm-10" align="left">'; ?><?php if($data3 == NULL){
				echo'<input type="text" class="form-control col-md-10" value="-" readonly >'; ?>
				<?php }else{
					echo'
					<input type="text" class="form-control col-md-10" readonly value="'.$data3->jns_prgkt .'('. $data3->no_prgkt_ti .'-'. $data3->no_prgkt_vendor .')' .'">';
				} ?><?php echo'
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Prioritas</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->prioritas.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Kepentingan</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->pengguna_layanan.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Pelaksana</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->solusi.'" readonly>
                </div>
			</div>'; ?><?php if($data->solusi == 'Internal'){
			echo'
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Uraian Solusi</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->uraian_solusi.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Petugas TI</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->nama_ti.'" readonly>
                </div>
			</div>'; }else{
			echo '<div class="form-group row">
                <label class="col-sm-2 col-form-label">Uraian Solusi</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->uraian_solusi.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Vendor</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->vendor.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">No SP/SPK</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->no_spk.'" readonly>
                </div>
			</div>'; }?> <?php echo'
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->status.'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Biaya</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.rupiah($data->biaya).'" readonly>
                </div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Download Dokumen Keluhan</label>
                <div class="col-sm-10" align="left">
				<a href="'.base_url('assets/dokumen/'.$data->upload_dokumen).'" target="_blank"><p>Download Dokumen</p></a>
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Disposisi Kepala Bagian</label>
                <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" value="'.$data->disposisi.'" readonly>
                </div>
            </div>
		</form>';
	}
}
