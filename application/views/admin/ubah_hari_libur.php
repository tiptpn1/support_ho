<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_hari_libur')) ?>     
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Hari Libur</h1>
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
              <form class="form-horizontal" method="post" action="<?php echo base_url().'Panel/ubah_aksi_hrlbr'; ?>">
                <input type="hidden" name="id_hari_libur" value="<?=$hari_libur->id_hari_libur?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10" align="right">
                      <input type="text" class="form-control col-md-10" name="tgl_libur" id="datepicker" value="<?=$hari_libur->tgl_libur?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10" align="right">
                      <input type="text" class="form-control col-md-10" name="ket" id="id_ket" value="<?=$hari_libur->ket?>" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
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

<script>
    $(function() {
      $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
</script>
</footer>
</html>