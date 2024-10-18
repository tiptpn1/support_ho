<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/navigation_admin.php", array('page' => 'histori_perangkat')) ?>
</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Riwayat Perangkat</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info"><br>
                        <h4 style="color: blue;">&nbsp;&nbsp;&nbsp;Pengajuan</h4>
                        <div class="card-body">
                            <table id="datatables2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bagian</th>
                                        <th>Nomor Memo</th>
                                        <th>Tanggal Memo</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $k = 1;
                                    foreach ($pengajuan_h as $a) {

                                        echo '<tr>';
                                        echo '<td>' . $k . '</td>';
                                        echo '<td>';
                                        //echo "$this->db->get_where('bagian', array('id_bagian' => $id))->row()";
                                        ctk_bagian_multiple($this->m_pengajuan->get_id_bagian($a->id_bagian_pengajuan));
                                        echo '</td>';
                                        echo '<td>' . $a->no_memo . '</td>';
                                        echo '<td>' . date("d-m-Y", strtotime($a->tgl_memo)) . '</td>';
                                        echo '<td>' . $a->status_proses . '</td>';
                                        echo "
                                        <td>
                                            <a class='btn btn-success' href='" . base_url('assets/upload/') . $a->upload_file . "'><i class='fa fa-download'></i></a>
                                        </td>";
                                        echo '</tr>';
                                        $k++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!--div class="card-body">
                            <//?php
                            $i = 1;
                            foreach ($pengajuan_h as $a) { ?>
                                <div class="form-group row">
                                    <label for="id_bagian" class="col-sm-2 col-form-label">Bagian</label>
                                    <div class="col-sm-10" align="left">
                                        <input type="text" class="form-control col-md-10" name="id_bagian" id="id_bagian" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_nomemo" class="col-sm-2 col-form-label">Nomor Memo</label>
                                    <div class="col-sm-10" align="left">
                                        <input type="text" class="form-control col-md-10" name="nomemo" id="id_nomemo" value="<//?php echo $a->no_memo ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_tgl_memo" class="col-sm-2 col-form-label">Tanggal Memo</label>
                                    <div class="col-sm-10" align="left">
                                        <input type="date" class="form-control col-md-10" name="tgl_memo" id="id_tgl_memo" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_terdaftar_jumlah" class="col-sm-2 col-form-label">Terdaftar/Jumlah</label>
                                    <div class="col-sm-10" align="left">
                                        <input type="text" class="form-control col-md-10" name="terdaftar_jumlah" id="id_terdaftar_jumlah" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_terdaftar_jumlah" class="col-sm-2 col-form-label">Download File</label>
                                    <div class="col-sm-10" align="left">
                                        <a class="btn btn-info" href="<//?php echo base_url('assets/upload/') ?>"><i class='fa fa-download'></i></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_status_proses" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10" align="left">
                                        <input type="text" class="form-control col-md-10" name="status_proses" id="id_status_proses" value="">
                                    </div>
                                </div>
                            <//?php $i++;
                            }
                            ?>
                        </div-->
                    </div><br>
                    <!-- /.card -->
                    <div class="card card-info"><br>
                        <h4 style="color: blue;">&nbsp;&nbsp;&nbsp;Mutasi</h4>
                        <div class="card-body">
                            
                            <table id="datatables" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bagian</th>
                                        <th>Tanggal</th>
                                        <th>No perangkat TI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $j = 1;
                                    foreach ($perangkat_h as $b) {
                                        echo '<tr>';
                                        echo '<td>' . $j . '</td>';
                                        echo '<td>' . $b->bagian . '</td>';
                                        echo '<td>' . date("d-m-Y H:i:s", strtotime($b->waktu)) . '</td>';
                                        echo '<td>' . $b->no_prgkt_ti . '</td>';
                                        echo '</tr>';
                                        $j++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div><br>
                    <!-- /.card -->
                    <div class="card card-info"><br>
                        <h4 style="color: blue;">&nbsp;&nbsp;&nbsp;Riwayat Perbaikan</h4>
                        <div class="card-body">
                            <table id="datatables1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Servis</th>
                                        <th>Tanggal</th>
                                        <th>Kerusakan/Layanan</th>
                                        <th>Uraian kerusakan</th>
                                        <th>Perbaikan/Solusi</th>
                                        <th>Status</th>
                                        <th>Biaya</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $k = 1;
                                    foreach ($ajukan_h as $c) {
                                        echo '<tr>';
                                        echo '<td>' . $k . '</td>';
                                        echo '<td>' . $c->kode_servis . '</td>';
                                        echo '<td>' . date("d-m-Y H:i:s", strtotime($c->waktu)) . '</td>';
                                        echo '<td>' . $c->jns_kerusakan . '</td>';
                                        echo '<td>' . $c->uraian . '</td>';
                                        echo '<td>' . $c->uraian_solusi . '</td>';
                                        echo '<td>' . $c->status . '</td>';
                                        echo '<td>' . rupiah($c->biaya) . '</td>';
                                        echo "<td>
                                            <a id='detail' class='btn btn-info' data-toggle='modal' data-id_ajukan='$c->id_ajukan' data-target='#modal-lg'><i class='fa fa-eye'></i></a>
                                        </td>";
                                        echo '</tr>';
                                        $k++;
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
    <!--Modal detail-->
  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detail_tiket" class="detail_tiket">
          <!-- Ambil dari Ajax -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
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

    <script type="text/javascript">
        $(function() {
            $("#datatables1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });

        $(function() {
            $("#datatables2").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>

    <!-- Detail Popup -->
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#detail', function() {
                var id_ajukan = $(this).data('id_ajukan');
                $.ajax({
                    url: "<?php echo base_url('ajax/detail_tiket') ?>",
                    type: 'GET',
                    data: {
                        'id_ajukan': id_ajukan
                    },
                    success: function(result) {
                        $("#detail_tiket").html(result);
                    }
                });
                $('#modal-lg').modal('show');
            })
        })
    </script>

</footer>

</html>