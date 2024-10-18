<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'list_role')) ?>     
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Hak Akses</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambah_role">Tambah</button></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="datatables" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Role</th>
                    <th>Hak Akses</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      $i=1;
                      foreach($role as $r){
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$r->role.'</td>';
                        echo '<td>'.$r->nama_hak_akses.'</td>';
                        echo "
                          <td>
                            <a class='btn btn-warning' href='".base_url('Panel/ubah_role/').$r->role_id."'>Ubah</a>
                            <a class='btn btn-danger' onclick='return confirm_delete()' href='".base_url('Panel/hapus_role/').$r->role_id."'>Hapus</a>
                          </td>";
                        echo '</tr>';
                        $i++;
                  }
                  ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--Modal Jenis Perangkat-->
<div class="modal fade" id="tambah_role">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Role Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
      </div>
      <div class="modal-body">
          <form role="form" method="post" action="<?php echo base_url().'Panel/tambah_aksi_role' ?>">
              <div class="form-group">
                  <label>Nama Role : </label>
                  <input type="text" class="form-control col-md-5" name="role" id="role" placeholder="Masukkan nama role" />
              </div>
              <div class="row">
                  <div class="form-group">
                  &nbsp;&nbsp;&nbsp;&nbsp;<label>Hak Akses :</label>
                  </div>
                    <?php foreach ($hak_akses as $a): ?>
                      <div class="col-lg-4">
                        <input type='checkbox' name='hak_akses' id="hak_akses" value=<?php echo "$a->id_hak_akses";?>><?php echo "$a->nama_hak_akses"; ?>
                      </div>
                    <?php endforeach ?>
                </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</body>
<footer>
<?php $this->load->view("admin/footer_admin.php") ?>

<script type="text/javascript">
  function confirm_delete() {
        var x=confirm("Apakah Anda yakin ingin menghapus data?")
        if (x) {
            return true;
        } else {
            return false;
        }
    }
</script>
</footer>
</html>