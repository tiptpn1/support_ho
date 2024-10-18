<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'tambah_artikel')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Artikel</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <form role="form" id="" method="post" enctype="multipart/form-data" action="<?php echo base_url() . 'Panel/tambah_aksi_artikel' ?>">
            <div class="card card-outline card-info">
              <div class="card-header">
                <!-- tools box -->
                <!-- /. tools -->
                <div class="form-group form-horizontal">
                  <input type="text" class="form-control" name="judul" placeholder="Judul">
                </div>
                <div class="form-group form-horizontal">
                  <p>Banner Artikel</p>
                  <input type="file" class="form-control" name="banner" / accept=".jpg,  .jpeg, .png">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body pad">
                <div class="mb-3">
                  <textarea class="textarea" name="isi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</body>
<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>
</footer>

</html>