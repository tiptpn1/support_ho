<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PTPN XII | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!--link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqvmap/jqvmap.min.css"-->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--Data Tables-->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!--jquery-ui-->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.css">
  <!--Datetimepicker-->
  <link rel="stylesheet" href="<?= base_url() ?>assets/datetimepicker/bootstrap-datetimepicker.min.css">
  <!--Swetalert--> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!--Swetalert-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Riwayat Perangkat</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <hr>
            </div><!-- /.container-fluid -->
        </div>
        
        <!-- /.content-header -->

        <!-- Main content -->
        <!-- Main content -->
        <section class="content" style="padding: 25px">
        <div class="card card-info" style="height: auto; margin-top: -20px">
            <span style="padding: 10px;"><b>Info Perangkat</b> : 
                <?php 
                  echo "<br><table>
                  <tr>
                      <td>JnsPrgkt-Tipe-Detail</td>
                      <td>&emsp;: $perangkat_jns->jns_prgkt  &nbsp;-&nbsp;  $perangkat_jns->tipe_prgkt  &nbsp;-&nbsp;  $perangkat->detail</td>
                  </tr>
                  <tr>
                      <td>Bagian</td>
                      <td>&emsp;: $perangkat->bagian</td>
                  </tr>
                  <tr>
                      <td>No Perangkat TI</td>
                      <td>&emsp;: $perangkat->no_prgkt_ti</td>
                  </tr>
                  <tr>
                      <td>Nama</td>
                      <td>&emsp;: $perangkat->nama_pengguna</td>
                  </tr></table>
                  ";
                ?>
            </span>
        </div>

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
<footer><br>
  <strong>&emsp;Hak Cipta &copy; 2020.</strong>
  PT Perkebunan Nusantara XII.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!--script src="<//?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script-->
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!--script src="<?= base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script-->
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<!--Data Tables-->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!--Validation-->
<script src="<?= base_url() ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!--Chart Js-->
<!--script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script-->

<script src="https://js.pusher.com/6.0/pusher.min.js"></script>

<!-- DateTimePicker-->
<script src="<?= base_url() ?>assets/datetimepicker/bootstrap-datetimepicker.min.js"></script>

<script>
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('ad8644ee3904a2aa602c', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    //alert(JSON.stringify(data));
    $.ajax({
      method: "POST",
      url: "<?= base_url('notifikasi/list_notifikasi') ?>",
      success: function(response) {
        $("#list-notifikasi").html(response);
      }
    })
  });
</script>

<script type="text/javascript">
  $(function() {
    $("#datatables").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#datatables0').DataTable({
      "scrollX": true
    });
  });
</script>

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