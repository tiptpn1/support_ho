<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'perangkat')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Perangkat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php
              // Cek role user
              if ($this->session->userdata('role') == 1) { // Jika role-nya admin
              ?>
                <li class="breadcrumb-item">
                  <a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Panel/tambah_perangkat">Tambah</a>
                </li>
                <li class="breadcrumb-item">
                  <a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Panel/export_excel">Excel</a>
                </li>
              <?php } ?>
            </ol>
          </div><!-- /.col -->
          <!--span class="fas fa-arrow-left" style="color: blue"><a href="">  Kembali kelola tiket</a></span-->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div style="width: 100%; overflow-x: auto;">
              <table id="datatables" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Jenis Perangkat</th>
                    <th>Tipe</th>
                    <th>Bagian</th>
                    <th>Kepemilikan</th>
                    <th>No. Perangkat TI</th>
                    <th>No. Perangkat Vendor</th>
                    <th>No. Inventaris</th>
                    <th>No. SP/SPK</th>
                    <th>Dok.Pengajuan</th>
                    <th>Detail</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <!--th>Bagian Baru</th>
                    <th>No. Perangkat TI Baru</th-->
                    <th>QR Code</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($perangkat as $p) {
                    $gambar = $p->qr_code;
                    echo '<tr>';
                    echo '<td id="nomer" data-id_prgkt="' . $p->id_perangkat . '">' . $i . '</td>';
                    echo ($this->m_master_prgkt->edit_mstrprgkt($p->id_master_prgkt)->row() == NULL) ? "<td>-</td>" : '<td>' . $this->m_master_prgkt->edit_mstrprgkt($p->id_master_prgkt)->row()->jns_prgkt . '</td>';
                    echo ($this->m_master_prgkt->edit_mstrprgkt($p->id_master_prgkt)->row() == NULL) ? "<td>-</td>" : '<td>' . $this->m_master_prgkt->edit_mstrprgkt($p->id_master_prgkt)->row()->tipe_prgkt . '</td>';
                    //echo '<td>' . $p->jns_prgkt . '</td>';
                    //echo '<td>' . $p->tipe_prgkt . '</td>';
                    echo '<td>' . $p->bagian . '</td>';
                    echo '<td>' . $p->kepemilikan . '</td>';
                    echo '<td>' . $p->no_prgkt_ti . '</td>';
                    echo '<td>' . $p->no_prgkt_vendor . '</td>';
                    echo '<td>' . $p->no_inventaris . '</td>';
                    echo '<td>' . $p->no_spk . '</td>';
                    //echo '<td>' . $this->m_pengajuan->edit_pengajuan($p->pil_dok)->row()->no_memo . '</td>';
                    echo ($this->m_pengajuan->edit_pengajuan($p->id_pengajuan)->row() == NULL) ? "<td>-</td>" : '<td>' . $this->m_pengajuan->edit_pengajuan($p->id_pengajuan)->row()->no_memo . '</td>';
                    /*echo '<td>';
                    ctk_bagian_multiple($this->m_perangkat->get_id_bagian($p->id_bagian_perangkat));
                    echo '</td>';*/
                    echo '<td>' . $p->detail . '</td>';
                    echo '<td>' . $p->nama_pengguna . '</td>';
                    echo '<td>' . $p->status . '</td>';
                    //echo '<td>' . $p->bagian_baru . '</td>';
                    /*echo '<td>';
                    ctk_bagian_multiple($this->m_perangkat->get_id_bagian($p->id_bagian_baru));
                    echo '</td>';*/
                    //echo '<td>' . $p->no_prgkt_baru . '</td>';
                    /*echo '<td>'.base_url().'assets/imags/'.$p->qr_code;.'</td>';*/

                    // backup kode


                    echo "
                      <td>
                        <img style='width: 100px;' id='qrcode' data-toggle='modal' data-gambar='" . $p->qr_code . "' data-id_prgkt='" . $p->id_perangkat . "' data-target='#modal-default' src='" . base_url() . 'assets/images/' . $p->qr_code . "'></td>
                      </td>";

                    if ($this->session->userdata('role') == 1) {
                      echo "
                      <td>
                        <a class='btn btn-info' href='" . base_url('Panel/histori_perangkat/') . $p->id_perangkat . "'><i class='fa fa-list'></i></a>
                        <a class='btn btn-warning' href='" . base_url('Panel/ubah_perangkat/') . $p->id_perangkat . "'><i class='fa fa-edit'></i></a>
                        <a class='btn btn-danger' onclick='return confirm_delete()' href='" . base_url('Panel/hapus_perangkat/') . $p->id_perangkat . "'><i class='fa fa-trash'></i></a>";
                    }
                    echo " <a class='btn btn-primary' title='cetak label perangkat' target='_blank' href='" . base_url('Panel/cetak_label/') . $p->id_perangkat . "'><i class='fa fa-print'></i></a>
                      </td></tr>";

                    if ($this->session->userdata('role') == 2) {
                      echo "
                      <td>
                        <a class='btn btn-info' href='" . base_url('Panel/histori_perangkat/') . $p->id_perangkat . "'><i class='fa fa-list'></i></a>
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
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '#qrcode', function() {
        var file_gambar = $(this).data('gambar');
        var id_prgkt = $(this).data('id_prgkt');
        $('#img-qr').html('<img src="<?= base_url(); ?>assets/images/qrcode_new' + id_prgkt + '.png">');
        $('#print-qr').html('<a class="btn btn-primary" href="<?php echo base_url('Panel/qrcode_print/') ?>' + id_prgkt + '">Cetak</a>');
        $('#modal-default').modal('show');
      })
    })
  </script>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg" style="width: 25%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">QR Code</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <center>
          <div class="modal-body" id="img-qr">
            <!--ini diisi js-->
          </div>
        </center>
        <div class="modal-footer right" id="print-qr">
          <!--button type="button" class="btn btn-default">Simpan</button-->
          <!--ini diisi js-->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
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