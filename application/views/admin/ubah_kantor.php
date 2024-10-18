<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_kantor')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Unit Kerja</h1>
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

          <!-- form start -->
          <form role="form" id="quickForm" method="post" action="<?php echo base_url() . 'Panel/ubah_aksi_kantor/' . $daftar_kantor->id_master_kantor ?>">
            <div class="card-body">
              <div class="form-group <?= form_error('nama_master_kantor') ? 'text-danger' : null ?>">
                <label>Nama Unit Kerja</label>
                <input type="text" name="nama_master_kantor" value="<?= $daftar_kantor->nama_master_kantor ?>" class="form-control col-md-5" id="nama_master_kantor">
                <?= form_error('nama_master_kantor') ?>
              </div>
              <div class="form-group <?= form_error('kode_master_kantor') ? 'text-danger' : null ?>">
                <label>Kode Unit Kerja</label>
                <input type="text" name="kode_master_kantor" value="<?= $daftar_kantor->kode_master_kantor ?>" class="form-control col-md-5" id="kode_master_kantor">
                <?= form_error('kode_master_kantor') ?>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <!--a type="submit" class="btn btn-success" name="submit" href="<?php echo base_url(); ?>Panel/daftar_kantor">Simpan</a-->
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <!-- /.card-footer -->
          </form>
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