<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_bagian')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Bagian</h1>
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
          <form role="form" id="quickForm" method="post" action="<?php echo base_url() . 'Panel/ubah_aksi_bagian/' . $daftar_bagian->id_bagian ?>">
            <div class="card-body">
              <div class="form-group <?= form_error('bagian') ? 'text-danger' : null ?>">
                <label>Nama Bagian</label>
                <input type="text" name="bagian" value="<?= $daftar_bagian->bagian ?>" class="form-control col-md-5" id="bagian" required>
                <?= form_error('bagian') ?>
              </div>
              <div class="form-group <?= form_error('kode_bag_baru') ? 'text-danger' : null ?>">
                <label>Kode Bagian</label>
                <input type="text" name="kode_bag_baru" value="<?= $daftar_bagian->kode_bag_baru ?>" class="form-control col-md-5" id="kode_bag_baru" required>
                <?= form_error('kode_bag_baru') ?>
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