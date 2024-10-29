<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT Perkebunan Nusantara I | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!--link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqvmap/jqvmap.min.css"-->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--Data Tables
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.2/datatables.min.css"/>-->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!--jquery-ui-->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.css">
  <!--Datetimepicker-->
  <link rel="stylesheet" href="<?= base_url() ?>assets/datetimepicker/bootstrap-datetimepicker.min.css">
  <!--Swetalert-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!--Swetalert-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

</head>

<body class="hold-transition sidebar-collapse sidebar-mini layout-fixed"> <!--ngatur collapse-->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-navy sticky-top">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i> Menu</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown list-notifikasi">
          <?php if ($this->session->id_ajukan = true) { ?>
            <!--a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-danger navbar-badge"><?= sizeof(list_notifikasi()) ?></span>
            </a-->
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              <?php
              if (sizeof(list_notifikasi()) == 0) {
              ?>
                <a href="#" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media">
                    <div class="media-body">

                      <h3 class="dropdown-item-title">
                        Tidak ada Notifikasi
                      </h3>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
              <?php
              } else { ?>
                <?php foreach (list_notifikasi() as $ln) : ?>
                  <a href="#" class="dropdown-item notifikasi" data-id="<?= $ln['id'] ?>">
                    <!--notifikasi  class hapus aja-->
                    <!-- Message Start -->
                    <div class="media">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?= $ln['nama'] ?>
                        </h3>
                        <p class="text-sm"><?= $ln['jns_kerusakan'] ?></p>
                        <p class="float-right text-sm text-muted"><i class="far fa-clock mr-1"></i> <?= date("d-m-Y H:i:s", strtotime($ln->tanggal)); ?></p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                <?php endforeach ?>
              <?php } ?>
            </div>
          <?php } ?>
        </li>
        <li class="nav-item dropdown">
          <div style="display: flex; flex-direction: row; gap: 10px;">
						<button class="btn  nav-link btn-link" data-toggle="modal" data-target="#modal-resetPassword">
							<i class="fas fa-user-shield"> Reset Password</i>
						</button>
						<a class="nav-link" href="<?= base_url('auth/logout'); ?>">
							<i class="fas fa-power-off"> Keluar</i>
						</a>
					</div>
          <!--div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<//?php echo base_url(); ?>Panel/profil" class="dropdown-item">
            <div class="media">
              <i class="fas fa-user"></i>
              <div class="media-body">
                <h3 class="dropdown-item-title">Profil</h3>
              </div>
            </div>
          </a>
          <a href="<//?= base_url('auth/logout');?>" class="dropdown-item">
            <div class="media">
              <i class="fas fa-power-off"></i>
              <div class="media-body">
                <h3 class="dropdown-item-title">Keluar</h3>
              </div>
            </div>
          </a>
        </div-->
        </li>
        <!--li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li-->
      </ul>
    </nav>
    <!-- /.navbar -->

		<!-- Modal reset password -->
	<div class="modal fade" id="modal-resetPassword">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reset Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" class="detail_tiket">
					<form method="post" id="formResetPassword">
							<h4 style="text-align: center;">Form Reset Password</h4>
							<div class="alert alert-danger" style="display: none;" id="errorMessage" role="alert"></div>
							<div class="form-group <?=form_error('passwordlama') ? 'text-danger' : null ?>">
									<input type="password" class="form-control col-md-15" placeholder="Masukkan password lama" required name="passwordlama" id="passwordlama" />
									<?=form_error('password1', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group <?=form_error('password1') ? 'text-danger' : null ?>">
									<input type="password" class="form-control col-md-15" minlength="8" placeholder="Masukkan password baru" required name="password1" id="password1" />
									<?=form_error('password1', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group <?=form_error('password2') ? 'text-danger' : null ?>">
									<input type="password" class="form-control col-md-15" minlength="8" placeholder="Ulangi password baru" required name="password2" id="password2" />
									<?=form_error('password2', '<small class="text-danger">', '</small>'); ?>
									<small id="errorKonfirmPass" class="text-danger"></small>
							</div>
							<div style="text-align: center;">
									<button type="submit" id="buttonSubmitResetPassword" class="btn btn-primary" name="submit">Reset Password</button>
							</div>
					</form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
	<!-- /.modal -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url(); ?>Panel/laporan_grafik" class="brand-link">
        <img src="<?= base_url() ?>assets/images/logo-ptpn.png" alt="PT Perkebunan Nusantara I" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PT Perkebunan Nusantara I</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url() ?>assets/images/komen.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $this->session->userdata('username');  ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview <?php if ($page == 'perangkat' || $page == 'pengajuan_lelang' || $page == 'master_perangkat' || $page == 'master_jenis' || $page == 'master_layanan' || $page == 'bar_qr_code') echo 'menu-open' ?>">
              <a href="#" class="nav-link  <?php if ($page == 'perangkat' || $page == 'pengajuan_lelang' || $page == 'master_perangkat' || $page == 'master_jenis' || $page == 'master_layanan' || $page == 'bar_qr_code') echo 'active' ?>">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Pengelolaan Perangkat
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Panel/master_group_perangkat" class="nav-link <?php if ($page == 'master_group_perangkat') echo 'active' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Group Perangkat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Panel/master_jenis" class="nav-link <?php if ($page == 'master_jenis') echo 'active' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Jenis Perangkat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Panel/master_perangkat" class="nav-link <?php if ($page == 'master_perangkat') echo 'active' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Perangkat Keras</p>
                  </a>
                </li>
                <?php if ($this->session->userdata('id_master_kantor') == 1) { ?>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>Panel/master_layanan" class="nav-link <?php if ($page == 'master_layanan') echo 'active' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Master Layanan</p>
                    </a>
                  </li>
                <?php } ?>
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Panel/pengajuan_lelang" class="nav-link <?php if ($page == 'pengajuan_lelang') echo 'active' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengajuan ( Lelang )</p>
                  </a>
                </li>
                <li class="nav-item ">
                  <a href="<?php echo base_url(); ?>Panel/perangkat" class="nav-link <?php if ($page == 'perangkat') echo 'active' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Perangkat</p>
                  </a>
                </li>


                <!--li class="nav-item">
                <a href="<?php //echo base_url(); 
                          ?>Panel/bar_qr_code" class="nav-link <?php //if($page =='bar_qr_code') echo 'active'
                                                                ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barcode</p>
                </a>
              </li-->
              </ul>
            </li>
            <li class="nav-item ">
              <a href="<?php echo base_url(); ?>Panel/kelola_tiket" class="nav-link <?php if ($page == 'kelola_tiket') echo 'active' ?>">
                <i class="nav-icon fas fa-laptop"></i>
                <p>
                  Pengelolaan Tiket
                </p>
              </a>
            </li>
            <li class="nav-item ">
              <a href="<?php echo base_url(); ?>Panel/kelola_tiket_cybersecurity" class="nav-link <?php if ($page == 'kelola_tiket_cybersecurity') echo 'active' ?>">
                <i class="nav-icon fas fa-laptop-code"></i>
                <p>
                  Pengelolaan Tiket Cybersecurity
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview <?php if ($page == 'laporan_grafik' || $page == 'laporan_tabel') echo 'menu-open' ?>">
              <a href="#" class="nav-link <?php if ($page == 'laporan_grafik' || $page == 'laporan_tabel') echo 'active' ?>">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Laporan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Panel/laporan_grafik" class="nav-link <?php if ($page == 'laporan_grafik') echo 'active' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Grafik</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Panel/laporan_tabel" class="nav-link <?php if ($page == 'laporan_tabel') echo 'active' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Tabel</p>
                  </a>
                </li>
              </ul>
            </li>
            <?php if ($this->session->userdata('role') == 1) { ?>
              <li class="nav-item ">
                <a href="<?php echo base_url(); ?>Panel/hari_libur" class="nav-link <?php if ($page == 'hari_libur') echo 'active' ?>">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    Hari libur
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="<?php echo base_url(); ?>Panel/kelola_artikel" class="nav-link <?php if ($page == 'kelola_artikel') echo 'active' ?>">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Pengelolaan Artikel
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="<?php echo base_url(); ?>Panel/info" class="nav-link <?php if ($page == 'info') echo 'active' ?>">
                  <i class="nav-icon fas fa-bullhorn"></i>
                  <p>
                    Pengelolaan Info
                  </p>
                </a>
              </li>
              <!--<li class="nav-item <?php if ($page == 'daftar_pengguna' || $page == 'list_role') echo 'menu-open' ?>">
                <a href="<?php echo base_url(); ?>Panel/daftar_pengguna" class="nav-link <?php if ($page == 'daftar_pengguna' || $page == 'list_role') echo 'active' ?>">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Pengelolaan Pengguna
                    i class="right fas fa-angle-left"></i>
                  </p>
                </a>-->
              <!--ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<//?php echo base_url(); ?>Panel/daftar_pengguna" class="nav-link <//?php if($page =='daftar_pengguna') echo 'active'?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<//?php echo base_url(); ?>Panel/list_role" class="nav-link <//?php if($page =='list_role') echo 'active'?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role/Hak Akses</p>
                </a>
              </li>
            </ul-->
              </li>
              <li class="nav-item has-treeview <?php if ($page == 'daftar_pengguna' || $page == 'daftar_kantor' || $page == 'daftar_bagian') echo 'menu-open' ?>">
                <a href="#" class="nav-link <?php if ($page == 'daftar_pengguna' || $page == 'daftar_kantor' || $page == 'daftar_bagian') echo 'active' ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Master Data
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php if ($this->session->userdata('id_master_kantor') == 1) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url(); ?>Panel/daftar_kantor" class="nav-link <?php if ($page == 'daftar_kantor') echo 'active' ?>">
                        <i class="far fa-building nav-icon"></i>
                        <p>Departemen</p>
                      </a>
                    </li>
                  <?php } ?>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>Panel/daftar_bagian" class="nav-link <?php if ($page == 'daftar_bagian') echo 'active' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Bagian/Unit</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>Panel/daftar_pengguna" class="nav-link <?php if ($page == 'daftar_pengguna' || $page == 'list_role') echo 'active' ?>">
                      <i class="far fa-user nav-icon"></i>
                      <p>User</p>
                    </a>
                  </li>

                </ul>
              </li>
            <?php } ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
</body>

</html>
