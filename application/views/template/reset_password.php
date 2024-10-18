<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'resetpassword')) ?>     
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reset Password</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="ftco-section" style="background-image:url(<?php echo base_url('assets/images/image_6.jpg')?>);">
        <div class="container">
            <div class="row no-gutters justify-content-center mb-5">
                <form method="post" action="<?php echo base_url(); ?>panel/resetpass">
                    <h4 style="text-align: center;">Form Reset Password</h4>
                    <div class="form-group <?=form_error('passwordlama') ? 'text-danger' : null ?>">
                        <input type="password" class="form-control col-md-15" placeholder="Masukkan password lama" required="" name="passwordlama" id="passwordlama" />
                        <?=form_error('password1', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group <?=form_error('password1') ? 'text-danger' : null ?>">
                        <input type="password" class="form-control col-md-15" placeholder="Masukkan password baru" required="" name="password1" id="password1" />
                        <?=form_error('password1', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group <?=form_error('password2') ? 'text-danger' : null ?>">
                        <input type="password" class="form-control col-md-15" placeholder="Ulangi password baru" required="" name="password2" id="password2" />
                        <?=form_error('password2', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary" name="submit">Reset Password</button>
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
<?php if ($this->session->userdata('pass_cek')==1) { ?>
              <script type="text/javascript">
               Swal.fire({
                title:'Password Lama Salah',
                timer: 5000,
                button: false
               });
              </script>
                <?php } else if ($this->session->userdata('pass_cek')==2){?>
              <script type="text/javascript">
               Swal.fire({
                title:'Ulangi Password Salah',
                timer: 5000,
                button: false
               });
              </script>
                <?php } else if ($this->session->userdata('pass_cek')==3){?>
              <script type="text/javascript">
               Swal.fire({
                title:'Password Baru Tidak Boleh Sama Dengan Password Lama',
                timer: 5000,
                button: false
               });
              </script>
                <?php } else if ($this->session->userdata('pass_cek')==4){?>
              <script type="text/javascript">
               Swal.fire({
                title:'Password Wajib Terdiri dari Minimal 5 Karakter, Angka, dan Huruf Besar',
                timer: 5000,
                button: false
               });
              </script>
                <?php } else if ($this->session->userdata('pass_cek')==5){?>
              <script type="text/javascript">
               Swal.fire({
                title:'Password Baru Tersimpan',
                timer: 5000,
                button: false
               });
              </script>
                <?php } else {$this->session->unset_userdata('pass_cek');} $this->session->unset_userdata('pass_cek');?>
              <script>
</footer>
</html>