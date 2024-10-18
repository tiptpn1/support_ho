<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'daftar_kantor')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Kantor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Panel/tambah_kantor">Tambah</a></li>
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
              <table id="datatables-kantor" class="table table-bordered table-hover" data-url="<?= base_url('panel/get_data_kantor'); ?>">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Unit Kerja</th>
                    <th>Kode Unit Kerja</th>
                    <th>Actions</th>
                  </tr>
                </thead>
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