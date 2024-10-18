<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'profil')) ?>     
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
              <div class="card-body box-profile">
                <div >
                  <img src="<?=base_url()?>assets/images/komen.png" class="blog-img mr-4" style="width: 200px"></a>
                </div>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Nama :</b> <a><input type="text" name="" value="admin"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email :</b> <a><input type="text" name="" value="admin@gmail.com"></a>
                  </li>
                </ul>
                <button type="submit" class="btn btn-primary btn-sm"><b>Simpan</b></button>
                <a href="<?php echo base_url(); ?>Panel/ubah_sandi" class="btn btn-danger btn-sm"><b>Ubah Kata Sandi</b></a>
              </div>
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