<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'tambah_master_layanan')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Master Layanan</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <form role="form" id="quickForm" method="post" action="<?php echo base_url() . 'Panel/tambah_aksi_master_layanan' ?>">
            <div class="card-body">
              <div class="form-group">
                <label>Jenis Layanan*</label>
                <input type="text" name="jnslayanan" class="form-control col-md-5" id="id_jnslayanan">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="ket" class="form-control col-md-5" id="id_ket">
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
</footer>

</html>