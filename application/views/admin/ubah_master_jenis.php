<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_master_jenis')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Master Jenis Perangkat</h1>
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
            <form class="form-horizontal" method="post" action="<?php echo base_url() . 'Panel/ubah_aksi_mstrjns'; ?>">
              <input type="hidden" name="id_master_jns" value="<?= $master_jenis->id_master_jns ?>">
              <div class="card-body">
                <div class="form-group row">
                  <label for="nmprgkt" class="col-sm-2 col-form-label">Nama/Jenis Perangkat</label>
                  <div class="col-sm-10" align="right">
                    <input type="text" class="form-control col-md-10" name="jns_prgkt" id="id_jns_prgkt" value="<?= $master_jenis->jns_prgkt ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Master Group Perangkat*</label>
                  <div class="col-sm-10" align="right">
                    <select name="master_group" class="form-control col-md-10" id="master_group" required>
                      <option value="" class="warna">Pilih Master Group</option>
                      <?php
                      foreach ($group as $g) {
                        // echo "<option value='" . $group->id_group . "'>" . $group->group_perangkat . "</option>";
                        if ($g->id_group == $master_jenis->id_group) {
                          echo "<option value='" . $g->id_group . "' selected>" . $g->group_perangkat . "</option>";
                        } else {
                          echo "<option value='" . $g->id_group . "'>" . $g->group_perangkat . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                  <div class="col-sm-10" align="right">
                    <input type="text" class="form-control col-md-10" name="ket" id="id_ket" value="<?= $master_jenis->ket ?>">
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
</footer>

</html>