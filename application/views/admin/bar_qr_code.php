<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'bar_qr_code')) ?>     
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cetak Bar Code atau Qr Code</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="card-body">
          <div class="form-group">
            <label>Nomor perangkat/inventaris*</label>
              <input type="text" name="noprgkt" class="form-control col-md-5" id="id_noprgkt">
          </div>
          <div class="form-group">
            <label>Bagian*</label>
              <select class="form-control col-md-5" name="bagian" id="id_bagian">
                <option value="sekper">Sekretaris Perusahaan</option>
                <option value="spi">SPI</option>
                <option value="tanaman_tahunan">Tanaman Tahunan</option>
                <option value="tanaman_semusim">Tanaman Semusim</option>
                <option value="tekpol">Teknik dan pengolahan</option>
                <option value="dkk">dkk...</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary btn-sm"><b>Buat Barcode/QRcode</b></button>
          </div>
          <div style="padding-left: 20px">
          <img src="<?=base_url()?>assets/images/contohbarcode.jpg" width="200px"><br><br>
          <button type="submit" class="btn btn-primary btn-sm"><b>Print Barcode/QRcode</b></button>
          </div>
          <br>
      </div>
    </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</body>
<footer>
<?php $this->load->view("admin/footer_admin.php") ?>
</footer>
</html>