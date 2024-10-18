<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_sandi')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profil</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <form method="post" action="<?php echo base_url() . 'Auth/exe_ubah_password' ?>">
            <div class="card-body box-profile">
              <div>
                <img src="<?= base_url() ?>assets/images/komen.png" class="blog-img mr-4" style="width: 200px"></a>
              </div>
              <table style="width: 400px">
                <tr style="height: 50px">
                  <td><b>Nama</b></td>
                  <td><input type="text" name="username" value="<?php echo $this->session->userdata('username');  ?>" readonly></td>
                </tr>
                <tr style="height: 50px">
                  <td><b>Password lama</b></td>
                  <td><input type="password" name="passlama" value=""></td>
                </tr>
                <tr style="height: 50px">
                  <td><b>Password baru</b></td>
                  <td><input type="password" name="passbaru" value=""></td>
                </tr>
              </table>
              <!--form>
                <div class="form-group">
                  <label for="formGroupExampleInput">Example label</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Another label</label>
                  <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
                </div>
              </form-->
              <br>
              <button type="submit" class="btn btn-primary btn-sm"><b>Simpan</b></button>
            </div>
            </form>
          </div>
        </div>
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