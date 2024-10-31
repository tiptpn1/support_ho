<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("template/header.php", array('navbar' => 'pengaduan_cybersecurity')) ?>
</head>

<body>
	<section class="hero-wrap hero-wrap-2" style="background-image:url(<?php echo base_url('assets/images/bg_1.jpg') ?>);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread">Pengaduan Cybersecurity</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="ftco-section">
		<div class="container">
			<div class="row no-gutters justify-content-center mb-5">
				<section class="ftco-section ftco-no-pt ftco-no-pb ftco-consult">
					<div class="container">
						<div class="row d-flex no-gutters align-items-stretch	consult-wrap">
							<div class="wrap-about align-items-stretch d-flex">
								<div class="ftco-animate bg-primary align-self-stretch px-4 py-5 w-100">
									<h2 class="heading-white mb-4" id="ajukan">Ajukan Keluhan</h2>
									<!--?php echo form_open('user/send', ['method'=>'post', 'enctype'=>'multipart/form-data']) ?-->
									<!--?php echo form_open('captcha')?-->
									<form class="appointment-form ftco-animate" enctype="multipart/form-data" method="post" action="<?php echo base_url() . 'user/tambah_pengajuan_cybersecurity' ?>">
										<div class="form-group">
											<div class="row">
												<div class="col-5">
													<div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
														<div style="display: flex; flex-direction: row; gap: 8px;">
															<div>
																<input type="checkbox" class="form-control" name="is_anonymous" id="anonym" size="20px">
															</div>
															<div style="align-self: center;">Ajukan Secara Anonymous</div>
														</div>
													</div>
												</div>
												<!-- <div class="col-9">
												
												</div> -->
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-3">
													<div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
														Nama
													</div>
												</div>
												<div class="col-9">
													<input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="<?php echo $this->session->flashdata('nama') ?>" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-3">
													<div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
														Departemen
													</div>
												</div>
												<div class="col-9">
													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="ion-ios-arrow-down"></span></div>
															<!-- <select name="kantor" class="form-control" id="kantor" required> -->
															<select class="form-control" name="kantor" id="kantor" OnChange="f_kantor(this)" required>
																<option value="" class="warna">Pilih Departemen</option>
																<?php foreach ($kantor as $a) { ?>
																	<option value="<?= $a->id_master_kantor; ?>" class="warna" <?= ($this->session->flashdata('id_master_kantor') == $a->id_master_kantor) ? 'selected' : '' ?>>
																		<?= $a->nama_master_kantor_baru; ?> </option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-3">
													<div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
														Bagian / Kebun
													</div>
												</div>
												<div class="col-9">
													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="ion-ios-arrow-down"></span></div>
															<select class="form-control" name="bagian" id="bagian" required>
																<option value="" class="warna">Pilih Bagian</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-3">
													<div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
														Nomor Handphone
													</div>
												</div>
												<div class="col-9">
													<input type="text" class="form-control" id="noHp" name="hp" placeholder="Masukkan Nomor Hp" autocomplete="off" value="<?php echo $this->session->flashdata('hp') ?>" required>
												</div>
											</div>
										</div>

										<!-- <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
                      Email
                    </div>
                  </div>
                  <div class="col-9">
                    <input type="email" class="form-control" name="email" placeholder="Masukkan Email*" autocomplete="off" value="<?php //echo $this->session->flashdata('email') 
																																	?>">
                  </div>
                </div>
              </div> -->
										<div class="form-group">
											<div class="row">
												<div class="col-3">
													<div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
														Jenis Layanan
													</div>
												</div>
												<div class="col-9">
													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="ion-ios-arrow-down"></span></div>
															<select name="jns_kerusakan" id="id_jns_kerusakan" class="form-control" onchange="f_jns_kerusakan(this.value)" required>
																<option value="" class="warna">Pilih jenis layanan</option>
																<?php
																$layanan = $this->m_master_layanan->filter()->result();
																foreach ($layanan as $lay) {
																?>
																	<option class="warna" value="<?= $lay->jns_layanan; ?>" <?= ($this->session->flashdata('jns_kerusakan') == $lay->jns_layanan) ? 'selected' : '' ?>>
																		<?= $lay->jns_layanan; ?>
																	</option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-3">
													<div id="id_hardware_label" style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
													</div>
												</div>
												<div class="col-9" id="id_hardware_select"></div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-3">
													<div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-100%);  color:white">
														Uraian Masalah
													</div>
												</div>
												<div class="col-9">
													<textarea name="uraian_kerusakan" id="uraian_kerusakan" cols="30" rows="5" class="form-control" placeholder="Masukkan Uraian Permasalahan" required><?php echo $this->session->flashdata('uraian') ?></textarea>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label style="margin: 0; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">Upload File<br><small style="color:brown;">*jpg/jpeg/png/pdf</small></label>
											<input type="file" class="form-control col-md-10" id="file" name="upload_file" accept=".jpg, .jpeg, .png, .pdf">
										</div>
										<?php
										if ($this->session->flashdata('notif')) {
											echo $this->session->flashdata('notif');
										}
										?>
										<p><?php echo $img ?></p><br>
										<input type="text" name="captcha" class="form-control" autocomplete="off" placeholder="Masukkan huruf/angka di atas" required />
										<div class="form-check form-check-inline" style="display:-webkit-inline-box;">
											<input type="checkbox" name="sla" value="y" required class="form-check-input">
											<div style="padding-left:5px;">
												<label style="color:yellow;"> Dengan memilih, Anda setuju dengan Service Level Agreement (SLA) IT Support. Informasi SLA selengkapnya dapat dilihat <a href="<?php echo base_url(); ?>User/sla" style="color:red;">di sini.</a></label><br>
											</div>
										</div>

										<div class="form-group">
											<input type="submit" name="submit" id="buttonSubmitKeluhan" value="Ajukan" class="btn btn-secondary py-3 px-4">
										</div>
										<p style="color:yellow;">*Dengan mengisi email yang valid, Anda akan mendapat notifikasi progress penanganan keluhan Anda melalui email. Apabila tidak ada di Inbox, silakan periksa folder Spam</p>
									</form>
									<!--?php echo form_close(); ?-->
									<!--?php echo form_close(); ?-->
								</div>
							</div>
							<!-- <div class="col-md-7 wrap-about ftco-animate align-items-stretch d-flex">
								<div class="bg-white p-5">
									<h2 class="mb-4">Prosedur <br>Pengaduan keluhan cybersecurity</h2>
									<div class="row">
										<div class="col-lg-6">
											<div class="services">
												<div class="icon mt-2 d-flex align-items-center"><span class="flaticon-collaboration"></span></div>
												<div class="text media-body" style="text-align: justify;">
													<h3>1. Ajukan Keluhan</h3>
													<p>Apabila terdapat permasalahan perangkat komputer karyawan, baik hardware, software, kuota email, dan penambahan user internet dapat mengajukan pengaduan melalui layanan Aplikasi IT Support. Karyawan yang mengisi alamat email dengan benar dapat memonitor progress penanganan melalui email.</p>
												</div>
											</div>
											<div class="services">
												<div class="icon mt-2"><span class="flaticon-analysis"></span></div>
												<div class="text media-body" style="text-align: justify;">
													<h3>2. Pengecekan oleh Sub Bagian TI</h3>
													<p>Sub Bagian TI akan menerima notifikasi dari keluhan yang telah diajukan, kemudian menghubungi karyawan yang bersangkutan dan melalukan pengecekan jika diperlukan.</p>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="services">
												<div class="icon mt-2"><span class="flaticon-handshake"></span></div>
												<div class="text media-body" style="text-align: justify;">
													<h3>3. Persetujuan dari Bagian Pengadaan & Umum</h3>
													<p>Bagian Pengadaan & Umum menyetujui penanganan atas keluhan yang diajukan.</p>
												</div>
											</div>
											<br><br><br>
											<div class="services">
												<br><br><br>
												<div class="icon mt-2"><span class="flaticon-search-engine"></span></div>
												<div class="text media-body" style="text-align: justify;">
													<h3>4. Pengerjaan</h3>
													<p>Pengerjan terhadap keluhan yang telah diajukan beserta pemberitahuan kepada karyawan tentang kemajuan penanganan keluhan yang telah diajukan.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
						</div>
					</div>
				</section>
			</div>
		</div>
	</section>
</body>
<footer>
<script>
		const regex = /^[a-zA-Z0-9.,\s]*$/;
		function checkValueIsNotValid() {
			result = idInput.filter((item) => {
				value = $(`#${item}`).val();
				return !regex.test(value);
			});

			return result.length > 0;
		}
		
		$(document).ready(function() {
			idInput = ['nama', 'noHp', 'uraian_kerusakan'];
			idInput.map((id) => {
				$(`#${id}`).on('input', function () {
					// handling submit button
					if (checkValueIsNotValid()) {
						$('#buttonSubmitKeluhan').prop('disabled', true);
					} else {
						$('#buttonSubmitKeluhan').prop('disabled', false);
					}

					// handling msg
					val = $(this).val();
					if (!regex.test(val)) {
						$(`#error-${id}`).remove();
						$(this).closest('div.form-group').append(`<div id="error-${id}" class="text-danger"><small><em>Tidak boleh ada karakter selain huruf, angka, tanda titik (.), dan tanda koma (,)</em></small></div>`)
					} else {
						$(`#error-${id}`).remove();
					}
				});
			});
		});
		
	</script>
	<script type="text/javascript">
		function f_kantor() {
			var dropDown = document.getElementById("bagian");
			var dropDown2 = document.getElementById("id_jns_kerusakan");
			dropDown.selectedIndex = null;
			dropDown2.selectedIndex = null;
			document.getElementById("id_hardware_select").innerHTML = "<input type='hidden' class='form-control' name='id_master_jns'>"
		}
	</script>
	<script>
		function f_jns_kerusakan(a) {
			// var x = a.value;
			// if (a == 'Hardware') {
			// 	if (!document.getElementById("id_master_jns")) {
			// 		document.getElementById("id_hardware_select").innerHTML = "<select name='id_master_jns' id='id_master_jns' class='form-control' required></select>";
			// 		$(document).ready(function() {
			// 			$('#id_master_jns').select2();
			// 		});
			// 	}
			// } else {
			// 	document.getElementById("id_hardware_select").innerHTML = "<input type='hidden' class='form-control' name='id_master_jns'>";
			// }
		}
	</script>
	<script>
		$(document).ready(function() {
			$("#kantor").val("<?= $this->session->flashdata('id_master_kantor') ?>").trigger('change');
			$("#bagian").val("<?= $this->session->flashdata('id_bagian') ?>").trigger('change');
			f_jns_kerusakan("<?= $this->session->flashdata('jns_kerusakan') ?>");
			$("#id_jns_kerusakan").val("<?= $this->session->flashdata('jns_kerusakan') ?>").trigger('change');
			$("#id_master_jns").val("<?= $this->session->flashdata('id_master_jns') ?>").trigger('change');
			<?php if (!$this->session->flashdata('nama') && $this->session->flashdata('uraian')) { ?>
				$('#anonym').prop('checked', true).trigger('change');
			<?php } ?>
		});

		$("#kantor").change(function() {

			// variabel dari nilai combo box kendaraan
			var id_master_kantor = $("#kantor").val();

			// Menggunakan ajax untuk mengirim dan dan menerima data dari server
			$.ajax({
				url: "<?php echo base_url(); ?>user/get_bagian",
				method: "POST",
				data: {
					id_master_kantor: id_master_kantor
				},
				async: false,
				dataType: 'json',
				success: function(data) {
					var html = '';
					var i;
					html += '<option value="" class="warna">Pilih Bagian</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].id_bagian + '" class="warna">' + data[i].bagian + '</option>';
					}
					$('#bagian').html(html);

				}
			});
		});
	</script>
	<script>
		$("#id_jns_kerusakan").change(function() {

			// variabel dari nilai combo box kendaraan
			var id_master_kantor = $("#kantor").val();

			// Menggunakan ajax untuk mengirim dan dan menerima data dari server
			$.ajax({
				url: "<?php echo base_url(); ?>user/get_jenis",
				method: "POST",
				data: {
					id_master_kantor: id_master_kantor
				},
				async: false,
				dataType: 'json',
				success: function(data2) {
					var html = '';
					var i;
					html += '<option value="" class="warna">Pilih Jenis Perangkat</option>';
					for (i = 0; i < data2.length; i++) {
						html += '<option value="' + data2[i].id_master_jns + '" class="warna"' + '>' + data2[i].jns_prgkt + '</option>';
					}
					$('#id_master_jns').html(html);
				}
			});
		});
	</script>
	<script>
		$('#anonym').on('change', function() {
			checked = this.checked;
			id_nullable_input = ['nama', 'kantor', 'bagian', 'noHp'];
			if (checked) {
				id_nullable_input.map((id) => {
					$(`#${id}`).prop('disabled', true);
				});
			} else {
				id_nullable_input.map((id) => {
					$(`#${id}`).prop('disabled', false);
				});
			}
		});
	</script>

	<?php if ($this->session->flashdata('error')) { ?>
		<script type="text/javascript">
			Swal.fire({
				icon: "error",
				title: "Captcha salah!",
				text: 'Mohon masukkan kembali data yang benar.',
				timer: 5000,
				button: false
			});
		</script>
	<?php }  ?>
	
	<?php if ($this->session->flashdata('serverError')) { ?>
		<script type="text/javascript">
			Swal.fire({
				icon: "error",
				title: "Server Error",
				text: 'Server sedang mengalami error, silakan coba beberapa saat lagi.',
				timer: 5000,
				button: false
			});
		</script>
	<?php }  ?>

	<?php
	if ($this->session->flashdata('valid')) { ?>
		<script type="text/javascript">
			Swal.fire({
				title: 'Data berhasil tersimpan',
				timer: 5000,
				button: false
			});
		</script>
	<?php } ?>

	<?php if ($this->session->flashdata('errorFile') || $this->session->flashdata('errorChar')) { 
			$message = $this->session->flashdata('errorFile')? 'Format file tidak sesuai.' : ($this->session->flashdata('errorChar')? 'Pastikan inputan nama, nomor handphone, dan uraian masalah tidak ada simbol selain titik (.) dan (,)' : '');
			?>
    <script type="text/javascript">
      Swal.fire({
        icon: "error",
        title: "Gagal Ajukan Keluhan",
        text: '<?= $message ?>',
        timer: 5000,
        button: false
      });
    </script>
  <?php }  ?>

	<?php $this->load->view("template/footer.php") ?>

</footer>

</html>
