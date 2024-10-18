<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'tambah_pengguna')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Pengguna</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <form role="form" id="quickForm" method="post" action="<?php echo base_url() . 'Panel/tambah_aksi_pengguna' ?>">
            <div class="card-body">
              <div class="form-group <?= form_error('username') ? 'text-danger' : null ?>">
                <label>Nama Pengguna*</label>
                <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control col-md-5" id="id_username" required>
                <?= form_error('username') ?>
              </div>
              <div class="form-group <?= form_error('email') ? 'text-danger' : null ?>">
                <label>Email*</label>
                <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control col-md-5" id="id_email" required>
                <?= form_error('email') ?>
              </div>
              <div class="form-group <?= form_error('password') ? 'text-danger' : null ?>">
                <label>Kata Sandi*</label>
                <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control col-md-5" id="id_password" required>
                <?= form_error('password') ?>
              </div>
              <div class="form-group <?= form_error('confirmPassword') ? 'text-danger' : null ?>">
                <label>Konfirmasi Kata Sandi*</label>
                <input type="password" name="confirmPassword" value="<?= set_value('confirmPassword') ?>" class="form-control col-md-5" id="id_confirmPassword" required>
                <?= form_error('confirmPassword') ?>
              </div>
              <div class="form-group <?= form_error('role') ? 'text-danger' : null ?>">
                <label>Role*</label>
                <select class="form-control col-md-5" name="role" id="id_role" required>
                  <option value="">Pilih role</option>
                  <option value="1" <?= set_value('role') == 1 ? "selected" : null ?>>Admin</option>
                  <option value="2" <?= set_value('role') == 2 ? "selected" : null ?>>Teknisi</option>
                </select>
                <?= form_error('role') ?>
              </div>
              <div class="form-group <?= form_error('role_status') ? 'text-danger' : null ?>">
                <label>Status*</label>
                <select class="form-control col-md-5" name="role_status" id="role_status" required>
                  <option value="">Pilih status</option>
                  <option value="aktif" <?= set_value('role_status') == "aktif" ? "selected" : null ?>>Aktif</option>
                  <option value="nonaktif" <?= set_value('role_status') == "nonaktif" ? "selected" : null ?>>Non Aktif</option>
                </select>
                <?= form_error('role_status') ?>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <!--a type="submit" class="btn btn-success" name="simpan" href="<?php echo base_url(); ?>Admin/daftar_pengguna">Simpan</a-->
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</body>
<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>
</footer>

</html>