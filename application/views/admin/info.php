<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'info')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Info dan Pemberitahuan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php if ($this->session->userdata('role') == 1) { ?>
                <li class="breadcrumb-item"><a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Panel/tambah_info">Tambah</a></li>
              <?php } ?>
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
                    <th>Isi Pemberitahuan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($info as $a) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $a->isi_info . '</td>';
                    echo '<td>' . date("d-m-Y H:i:s", strtotime($a->tanggal)) . '</td>';
                    echo '<td>' . $a->status . '</td>';
                    if ($this->session->userdata('role') == 1) {
                      echo "
                          <td>
                            <a class='btn btn-warning' href='" . base_url('Panel/ubah_info/') . $a->id_info . "'><i class='fa fa-edit'></i></a>
                            <a class='btn btn-danger' onclick='return confirm_delete()' href='" . base_url('Panel/hapus_info/') . $a->id_info . "'><i class='fa fa-trash'></i></a>
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
</footer>

</html>