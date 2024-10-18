<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_master_perangkat')) ?>     
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Master Perangkat Keras</h1>
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
              <form class="form-horizontal" method="post" action="<?=base_url('Panel/ubah_aksi_mstrprgkt')?>">
                <input type="hidden" name="id_master_prgkt" value="<?=$master_prgkt->id_master_prgkt?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="jnsprgkt" class="col-sm-2 col-form-label">Jenis Perangkat</label>
                    <div class="col-sm-10" align="right">
                      <select class="form-control col-md-10" name="id_master_jns" id="id_jnsprgkt" required>
                        <option value=''>Pilih jenis perangkat</option>
                          <?php  
                            foreach($master_jenis as $d){
                              echo "<option value='".$d->id_master_jns."'";
                              if($d->id_master_jns == $master_prgkt->id_master_jns) echo "selected";
                              echo ">".$d->jns_prgkt."</option>";
                            }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tipe" class="col-sm-2 col-form-label">Tipe Perangkat</label>
                    <div class="col-sm-10" align="right">
                      <input type="text" class="form-control col-md-10" name="tipe" id="id_tipe" value="<?=$master_prgkt->tipe_prgkt?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10" align="right">
                      <select class="form-control col-md-10" name="status" id="id_status" required>
                       <option value=''>Pilih status</option>
                       <option value="aktif" <?php if($master_prgkt->status=="aktif") echo "selected"?>>Aktif</option>
                       <option value="nonaktif" <?php if($master_prgkt->status=="nonaktif") echo "selected"?>>Non Aktif</option>
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