<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'tambah_hari_libur')) ?>     
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Hari Libur</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         <form role="form" id="" method="post" action="<?php echo base_url().'Panel/tambah_aksi_hrlbr' ?>">
            <div class="card-body">
              <div class="form-group">
                  <label>Tanggal*</label>
                    <input type="text" name="tgl_libur" id="datepicker" class="form-control col-md-5" autocomplete="off" required>
              </div>
              <div class="form-group">
                  <label>Keterangan*</label>
                    <input type="text" name="ket" class="form-control col-md-5" id="id_ket" required>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
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

<script>
    $(function() {
      $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
</script>
</footer>
</html>