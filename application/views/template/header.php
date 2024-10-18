<!DOCTYPE html>
<html lang="en">

<head>
	<title>IT Support PT Perkebunan Nusantara I</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/animate.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/magnific-popup.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/aos.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/ionicons.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/flaticon.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/icomoon.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.css">
	<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
	<!-- select2 -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

	<script>
		$(function() {
			$("#datepicker").datepicker();
		});
	</script>
</head>

<body>
	<div class="bg-top navbar-light d-flex flex-column-reverse">
		<div class="container py-1">
			<div class="row no-gutters d-flex align-items-center align-items-stretch">
				<div class="col-md-4 d-flex align-items-center ">
					<a class="navbar-brand" href="<?php echo base_url(); ?>User/index"><img src="<?= base_url() ?>assets/images/logo-ptpn.png" alt="PT Perkebunan Nusantara I" style="height: 80px;"></a>
				</div>
				<div class="col-lg-8 d-block">
					<div class="row d-flex">
						<div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
							<div class="icon d-flex justify-content-center align-items-center"><span class="ion-ios-paper-plane"></span></div>
							<div class="text">
								<span>Email</span>
								<span style="font-size: smaller;"><a href="mailto:it.support@ptpn1.co.id">it.support@ptpn1.co.id</a></span>
							</div>
						</div>
						<div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
							<div class="icon d-flex justify-content-center align-items-center"><span class="ion-ios-call"></span></div>
							<div class="text">
								<span>Telepon</span>
								<span style="color: #00bdaa; font-size: smaller;">+62 852-9785-7571 </span>
							</div>
						</div>
						<div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
							<div class="icon d-flex justify-content-center align-items-center"><span class="ion-ios-time"></span></div>
							<div class="text">
								<span>Jam Operasional</span>
								<span style="color: #00bdaa; font-size: smaller;">7 x 24 Jam</span>
								<!-- <span style="color: #00bdaa">Jumat | 7:30 - 15:00</span> -->
								<span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="top-social-menu py-2 bg-light" style="position: sticky;">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="social mb-0">
							<a href="#"><i class="ion-logo-twitter"></i><span class="sr-only">Twitter</span></a>
							<a href="#"><i class="ion-logo-facebook"></i><span class="sr-only">Facebook</span></a>
							<a href="#"><i class="ion-logo-instagram"></i><span class="sr-only">Instagram</span></a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light sticky-top" id="ftco-navbar">
		<div class="container d-flex align-items-center">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>
			<!-- <form action="#" class="searchform order-lg-last">
          	<div class="form-group d-flex">
            	<input type="text" class="form-control pl-3" placeholder="Search">
            	<button type="submit" placeholder="" class="form-control search"><span class="ion-ios-search"></span></button>
          	</div>
          </form> -->
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item <?php if ($navbar == 'index') echo 'active' ?>"><a href="<?php echo base_url(); ?>User/index" class="nav-link">Beranda</a></li>
					<li class="nav-item <?php if ($navbar == 'daftar_antrian') echo 'active' ?>"><a href="<?php echo base_url(); ?>User/daftar_antrian" class="nav-link">Daftar Antrian</a></li>
					<li class="nav-item <?php if ($navbar == 'faq') echo 'active' ?>"><a href="<?php echo base_url(); ?>User/faq" class="nav-link">FAQ</a></li>
					<li class="nav-item <?php if ($navbar == 'sla') echo 'active' ?>"><a href="<?php echo base_url(); ?>User/sla" class="nav-link">SLA</a></li>
					<li class="nav-item" data-toggle="modal" data-target="#mylogin"><a href="#" class="nav-link"><span class="glyphicon glyphicon-log-in"></span>Masuk</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->

	<!-- Modal login -->
	<div id="mylogin" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<img src="<?= base_url() ?>assets/images/logo-ptpn.png" width="20%" height="20%">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?= base_url('auth/login_aksi'); ?>">
						<div class="form-group">
							<input type="text" class="form-control" name="username" id="username" placeholder="Nama pengguna">
							<small><span class="text-danger"><?= form_error('username'); ?></span></small>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Kata sandi" autocomplete="off">
							<small><span class="text-danger"><?= form_error('password'); ?></span></small>
						</div>
						<div class="form-group">
							<select name="kantor" class="form-control" required>
								<option value="">Pilih Departemen</option>
								<?php
								$kantor = $this->m_user->tampil_kantor()->result();
								foreach ($kantor as $unit) {
									echo "<option value='" . $unit->id_master_kantor . "'>" . $unit->nama_master_kantor_baru . "</option>";
								}
								?>
								<small><span class="text-danger"><?= form_error('kantor'); ?></span></small>
							</select>
						</div>
						<div class="form-group">
							<?php
							if ($this->session->flashdata('notif')) {
								echo $this->session->flashdata('notif');
							}
							?>
							<p><?php echo $img ?></p><br>
							<input type="text" name="captcha2" class="form-control" autocomplete="off" placeholder="Masukkan huruf/angka di atas" required />
						</div>

						<div class="modal-footer">
							<a href="<?php echo base_url(); ?>Auth/forgot_password">Lupa password ?</a>
							<!--button type="button" class="btn btn-success"><a href="<?php //echo base_url(); 
																						?>Admin/laporan_grafik">Masuk</a></button-->
							<button type="submit" name="login" class="btn btn-primary">Masuk</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal Login -->
</body>

</html>