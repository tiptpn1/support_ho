<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'tambah_info')) ?>     
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Info dan Pemberitahuan</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         <form role="form" id="quickForm" method="post" action="<?php echo base_url().'Panel/tambah_aksi_info' ?>">
            <div class="card-body">
              <div class="form-group">
                  <label>Isi Pemberitahuan</label>
                    <textarea type="text" class="form-control col-md-5" cols="10" rows="5" name="isi_info" id="id_info" placeholder="Masukkan info atau pemberitahuan terbaru"></textarea>
              </div>
              <div class="form-group">
                  <label>Status*</label>
                    <select class="form-control col-md-5" name="status" id="id_status">
                       <option value="aktif">Aktif</option>
                       <option value="nonaktif">Non Aktif</option>
                    </select>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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