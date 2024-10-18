<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'tambah_master_jenis')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Master Jenis Perangkat</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <form role="form" id="" method="post" action="<?php echo base_url() . 'Panel/tambah_aksi_mstrjns' ?>">
            <div class="card-body">
              <div class="form-group">
                <label>Nama/Jenis Perangkat*</label>
                <input type="text" name="jns_prgkt" class="form-control col-md-5" id="id_master_jns" required>
              </div>
              <div class="form-group">
                <label>Master Group Perangkat*</label>
                <select name="master_group" class="form-control col-md-5" id="master_group">
                  <option value="" class="warna">Pilih Master Group</option>
                  <?php
                  foreach ($master_group_perangkat as $group) {
                    echo "<option value='" . $group->id_group . "'>" . $group->group_perangkat . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="ket" class="form-control col-md-5" id="id_ket">
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
</footer>

</html>