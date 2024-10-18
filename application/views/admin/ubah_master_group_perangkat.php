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
            <h1 class="m-0 text-dark">Ubah Master Group Perangkat</h1>
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
              <form class="form-horizontal" method="post" action="<?php echo base_url().'Panel/ubah_aksi_mstrgroup_perangkat'; ?>">
                <input type="hidden" name="id_mstr_group_perangkat" value="<?=$master_group_perangkat->id_group?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="nmprgkt" class="col-sm-2 col-form-label">Nama Group Perangkat</label>
                    <div class="col-sm-10" align="right">
                      <input type="text" class="form-control col-md-10" name="group_prgkt" id="id_group" value="<?=$master_group_perangkat->group_perangkat?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10" align="right">
                      <input type="text" class="form-control col-md-10" name="ket" id="id_ket" value="<?=$master_group_perangkat->keterangan?>">
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