<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_master_layanan')) ?>     
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Master Layanan</h1>
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
              <form class="form-horizontal" method="post" action="<?php echo base_url().'Panel/ubah_aksi_master_layanan'; ?>">
                <input type="hidden" name="id_master_layanan" value="<?=$master_layanan->id_master_layanan?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="jnslayanan" class="col-sm-2 col-form-label">Jenis Layanan</label>
                    <div class="col-sm-10" align="right">
                      <input type="text" class="form-control col-md-10" name="jnslayanan" id="id_jnslayanan" placeholder="Jenis Layanan" value="<?=$master_layanan->jns_layanan?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10" align="right">
                      <input type="text" class="form-control col-md-10" name="ket" id="id_ket" placeholder="Keterangan" value="<?=$master_layanan->ket?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10" align="right">
                      <select name="status" class="form-control col-md-10" id="id_status" required>
                       <option value=''>Pilih status</option>
                       <option value="aktif" <?php if($master_layanan->status=="aktif") echo "selected"?>>Aktif</option>
                       <option value="nonaktif" <?php if($master_layanan->status=="nonaktif") echo "selected"?>>Non Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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