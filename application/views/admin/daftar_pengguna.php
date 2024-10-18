<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'daftar_pengguna')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Panel/tambah_pengguna">Tambah</a></li>
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
                    <th>Nama Pengguna</th>
                    <th>Unit Kerja</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <?php if ($this->session->userdata('role') == 1) { ?>
                      <th>Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($daftar_pengguna as $a) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $a->username . '</td>';
                    echo '<td>' . $a->nama_master_kantor_baru . '</td>';
                    echo '<td>' . $a->email . '</td>';
                    if ($a->role == 1) {
                      echo "<td>Admin</td>";
                    } else {
                      echo "<td>Teknisi</td>";
                    }
                    echo '<td>' . $a->role_status . '</td>';
                    if ($this->session->userdata('role') == 1) {
                      echo "
                          <td>
                            <a class='btn btn-warning' href='" . base_url('Panel/ubah_pengguna/') . $a->id_user . "' title='edit'><i class='fa fa-edit'></i></a>
                            <a class='btn btn-primary' onclick='return confirm_reset()' href='" . base_url('Panel/reset_pass_pengguna/') . $a->id_user . "' title='reset password'><i class='fa fa-key'></i></a>
                            <a class='btn btn-danger' onclick='return confirm_delete()' href='" . base_url('Panel/hapus_pengguna/') . $a->id_user . "'title='reset password'><i class='fa fa-trash'></i></a>
                          </td>";
                      echo '</tr>';
                    }
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
</body>
<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>
  <script type="text/javascript">
    function confirm_delete() {
      var x = confirm("Apakah Anda yakin ingin menghapus data?")
      if (x) {
        return true;
      } else {
        return false;
      }
    }
  </script>
  <script type="text/javascript">
    function confirm_reset() {
      var x = confirm("Apakah Anda yakin ingin reset password? Pasword akan berubah menjadi default yaitu '123456'")
      if (x) {
        return true;
      } else {
        return false;
      }
    }
  </script>
</footer>

</html>