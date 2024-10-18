<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PT Perkebunan Nusantara I | Cetak Label</title>
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
<style>
    .card {
        width: 95mm;
        height: 24mm;
        padding: 1mm;
        margin: 0px 0px 0px 0px;
    }

    .location {
        width: 73mm;
        padding: 5px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        height: 100%;
        vertical-align: middle;
        float: right;
        display: inline;
        font-size: 110%;
        position: absolute;
        top: 0mm;
        left: 23mm;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .qr {
        margin: 2px;
        width: 22mm;
        height: 22mm;
    }
</style>

<body>
    <div class="card" style="border: 0.5px solid grey">
        <div class="qr">
            <?php
            foreach ($perangkat as $p) {
                echo "<img style='width: 20mm;' id='qrcode' data-toggle='modal' data-gambar='" . $p->qr_code . "' data-id_prgkt='" . $p->id_perangkat . "' data-target='#modal-default' src='" . base_url() . 'assets/images/' . $p->qr_code . "'> </div>"
            ?>
                <div class='location'>
                    <p class="mb-0">PT Perkebunan Nusantara I</p>
                    <hr class="my-0" style="border: 1px solid grey">
                    <p class="my-0 py-0"><small class="m-0" style="margin-top: 0%; font-size: 70%;"><b>No</b> : <?= $p->no_prgkt_ti; ?></small></p>
                    <p class="my-0 py-0"><small style="margin-top: 0%; font-size: 70%;"><b>Inv</b> :<?= $p->no_inventaris; ?></small></p>
                </div>
            <?php } ?>
        </div>
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
        <script>
            window.print();
        </script>
</body>


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
<!--Data Tables
<script src="https://cdn.datatables.net/v/bs4/dt-1.11.2/datatables.min.js"></script>-->
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
    //Pusher.logToConsole = true;

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

    $(document).ready(function() {
        var baseUrl = $('#base-url').data('url'); //Mengambil data value base_url dri elemen html
        var table = $('#datatables-kantor');
        table.DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'order': [
                [0, 'desc']
            ],
            'ajax': {
                'url': table.data('url'),
                'type': 'post'
            },
            'deferRender': true,
            'aLengthMenu': [
                [10, 15, 50],
                [10, 15, 50]
            ],
            'columns': [{
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    'data': 'nama_master_kantor'
                },
                {
                    'data': 'kode_master_kantor'
                },
                {
                    'render': function(data, type, row) { //Tampilkan kolom Action
                        var html = '<a class="btn btn-sm badge-success float-left mr-2" href="' + baseUrl + 'Panel/ubah_kantor/' + row.id_master_kantor + '">Edit</a>';
                        html += '<a class="btn btn-sm badge-danger float-left" href="' + baseUrl + 'Panel/hapus_kantor/' + row.id_master_kantor + '">Delete</a>';
                        return html;
                    }
                }

            ]
        });
    });

    $(document).ready(function() {
        var baseUrl = $('#base-url').data('url'); //Mengambil data value base_url dri elemen html
        var table = $('#datatables-bagian');
        table.DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'order': [
                [0, 'desc']
            ],
            'ajax': {
                'url': table.data('url'),
                'type': 'post'
            },
            'deferRender': true,
            'aLengthMenu': [
                [10, 15, 50],
                [10, 15, 50]
            ],
            'columns': [{
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    'data': 'bagian'
                },
                {
                    'data': 'kode_bag_baru'
                },
                {
                    'data': 'nama_master_kantor'
                },
                {
                    'render': function(data, type, row) { //Tampilkan kolom Action
                        var html = '<a class="btn btn-sm badge-success float-left mr-2" href="' + baseUrl + 'Panel/ubah_bagian/' + row.id_bagian + '">Edit</a>';
                        html += '<a class="btn btn-sm badge-danger float-left" href="' + baseUrl + 'Panel/hapus_bagian/' + row.id_bagian + '">Delete</a>';
                        return html;
                    }
                }

            ]
        });
    });


    $(document).ready(function() {
        $('#datatables0').DataTable({
            "scrollX": true
        });
    });
</script>