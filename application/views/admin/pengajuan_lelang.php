<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'pengajuan_lelang')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pengajuan ( Lelang )</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php if ($this->session->userdata('role') == 1) { ?>
                <li class="breadcrumb-item"><a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Panel/tambah_pengajuan">Tambah</a></li>
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
                    <th>Bagian</th>
                    <th>Nomor Memo</th>
                    <th>Tanggal Memo</th>
                    <th>Status</th>
                    <th>Terdaftar/Jumlah</th>
                    <?php if ($this->session->userdata('role') == 1) { ?>
                      <th>Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($pengajuan_lelang as $ajuan) {

                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>';
                    ctk_bagian_multiple($this->m_pengajuan->get_id_bagian($ajuan->id_bagian_pengajuan));                 
                    echo '</td>';?>
                    <?php if($ajuan->no_memo!=NULL){
                    echo '<td>' . $ajuan->no_memo . '</td>';
                    }else{
                      echo "<td></td>";
                    }?>
                    <?php if($ajuan->tgl_memo!=NULL){
                    echo '<td>' . date("d-m-Y", strtotime($ajuan->tgl_memo)) . '</td>';
                    }else{
                      echo "<td></td>";
                    }
                    echo '<td>' . $ajuan->status_proses . '</td>';
                    $terdaftar = $this->db->get_where("perangkat", array("id_pengajuan" => $ajuan->id_pengajuan))->num_rows();
                    echo '<td>' . $terdaftar      .'/'.$ajuan->jumlah . '</td>';?>
                    <?php
                    if ($this->session->userdata('role') == 1) {
                      echo "
                          <td>"?>
                          <?php
                          if ($ajuan->upload_file  != NULL) {
                            echo "<a class='btn btn-success' href='" . base_url('assets/upload/') . $ajuan->upload_file . "' download><i class='fa fa-download'></i></a>";
                          }
                          echo " <a class='btn btn-warning' href='" . base_url('Panel/ubah_pengajuan/') . $ajuan->id_pengajuan . "'><i class='fa fa-edit'></i></a>
                            <a class='btn btn-danger' onclick='return confirm_delete()' href='" . base_url('Panel/hapus_pengajuan/') . $ajuan->id_pengajuan . "'><i class='fa fa-trash'></i></a>
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