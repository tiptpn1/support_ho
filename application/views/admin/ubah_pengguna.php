<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_pengguna')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Pengguna</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- Horizontal Form -->
          <div class="card card-info">
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url() . 'Panel/ubah_aksi_pengguna/' . $daftar_pengguna->id_user ?>">
              <input type="hidden" name="id_user" value="<?= $daftar_pengguna->id_user ?>">
              <div class="card-body">
                <div class="form-group row <?= form_error('username') ? 'has-error' : null ?>">
                  <label for="username" class="col-sm-2 col-form-label">Nama Pengguna</label>
                  <div class="col-sm-10" align="right">
                    <input type="text" class="form-control col-md-10" name="username" id="id_username" placeholder="Nama Pengguna" value="<?= $daftar_pengguna->username ?>">
                    <?= form_error('username') ?>
                  </div>
                </div>
                <div class="form-group row <?= form_error('email') ? 'has-error' : null ?>">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10" align="right">
                    <input type="email" class="form-control col-md-10" name="email" id="id_email" placeholder="Email" value="<?= $daftar_pengguna->email ?>">
                    <?= form_error('email') ?>
                  </div>
                </div>
                <!-- <div class="form-group row <?= form_error('password') ? 'has-error' : null ?>">
                  <label for="password" class="col-sm-2 col-form-label">Kata Sandi</label>
                  <div class="col-sm-10" align="right">
                    <input type="password" class="form-control col-md-10" name="password" id="id_password" placeholder="Kata Sandi" value="<?= $this->input->post('password') ?>">
                    <?= form_error('password') ?>
                  </div>
                </div>
                <div class="form-group row <?= form_error('confirmPassword') ? 'has-error' : null ?>">
                  <label for="confirmPassword" class="col-sm-2 col-form-label">Konfirmasi Kata Sandi</label>
                  <div class="col-sm-10" align="right">
                    <input type="password" class="form-control col-md-10" name="confirmPassword" id="id_confirmPassword" placeholder="Konfirmasi Kata Sandi" value="<?= $this->input->post('confirmPassword') ?>">
                    <?= form_error('confirmPassword') ?>
                  </div>
                </div> -->
                <div class="form-group row <?= form_error('role') ? 'has-error' : null ?>">
                  <label for="role" class="col-sm-2 col-form-label">Role</label>
                  <div class="col-sm-10" align="right">
                    <select class="form-control col-md-10" name="role" id="id_role">
                      <?php $role = $this->input->post('role') ?? $daftar_pengguna->role ?>
                      <option value="1">Admin</option>
                      <option value="2" <?= $role == 2 ? 'selected' : null ?>>Teknisi</option>
                    </select>
                    <?= form_error('role') ?>
                  </div>
                </div>
                <div class="form-group row <?= form_error('status') ? 'has-error' : null ?>">
                  <label for="status" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10" align="right">
                    <select class="form-control col-md-10" name="status" id="id_status">
                      <?php $status = $this->input->post('status') ?? $daftar_pengguna->status ?>
                      <option value="aktif">Aktif</option>
                      <option value="nonaktif">Non Aktif</option>
                    </select>
                    <?= form_error('status') ?>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <!--a type="submit" class="btn btn-success" name="submit" href="<?php echo base_url(); ?>Panel/daftar_pengguna">Simpan</a-->
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->
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