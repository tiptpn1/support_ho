<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/navigation_admin.php", array('page' => 'hari_libur')) ?>
</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Hari libur</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <?php if ($this->session->userdata('role') == 1) { ?>
                                <li class="breadcrumb-item"><a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Panel/tambah_hari_libur">Tambah</a></li>
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
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <?php if ($this->session->userdata('role') == 1) { ?>
                                            <th>Aksi</th>
                                        <?php  } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($hari_libur as $a) {
                                        echo '<tr>';
                                        echo '<td>' . $i . '</td>';
                                        echo '<td>' . date("d-m-Y", strtotime($a->tgl_libur)) . '</td>';
                                        echo '<td>' . $a->ket . '</td>';
                                        if ($this->session->userdata('role') == 1) {
                                            echo "
                                            <td>
                                                <a class='btn btn-warning' href='" . base_url('Panel/ubah_hari_libur/') . $a->id_hari_libur . "'><i class='fa fa-edit'></i></a>
                                                <a class='btn btn-danger' onclick='return confirm_delete()' href='" . base_url('Panel/hapus_hari_libur/') . $a->id_hari_libur . "'><i class='fa fa-trash'></i></a>
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