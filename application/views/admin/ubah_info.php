<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_info')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Info dan Pemberitahuan</h1>
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
            <form class="form-horizontal" method="post" action="<?php echo base_url() . 'Panel/ubah_aksi_info'; ?>">
              <input type="hidden" name="id_info" value="<?= $info->id_info ?>">
              <div class="card-body">
                <div class="form-group row">
                  <label for="isiinfo" class="col-sm-2 col-form-label">Isi pemberitahuan</label>
                  <div class="col-sm-10" align="right">
                    <textarea type="text" class="form-control col-md-10" cols="10" rows="5" name="isi_info" id="id_info"><?= $info->isi_info ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="status" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10" align="right">
                    <select name="status" class="form-control col-md-10" id="id_status" required>
                      <option value=''>Pilih status</option>
                      <option value="aktif" <?php if ($info->status == "aktif") echo "selected" ?>>Aktif</option>
                      <option value="nonaktif" <?php if ($info->status == "nonaktif") echo "selected" ?>>Non Aktif</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-footer -->
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