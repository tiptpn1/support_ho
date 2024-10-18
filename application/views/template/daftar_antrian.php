<!DOCTYPE html>
<html lang="en">

<head>
  <?php 
  $this->load->view("template/header.php", array('navbar' => 'daftar_antrian'));
  $this->session->sess_destroy();
  $this->load->view("template/js.php");
  ?>
</head>

<body>
  <section class="hero-wrap hero-wrap-2" style="background-image:url(<?php echo base_url('assets/images/bg_1.jpg') ?>);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-2 bread">Daftar Antrian</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="ftco-section">
      <div class="container">
        <div class="row no-gutters justify-content-center mb-5">
            <!-- DATA TABLE-->
               <table id="datatables_antrian" class="table table-bordered table-hover" data-url="<?= base_url('User/get_tiket'); ?>">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Servis</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>Departemen</th>
                      <th>Bagian</th>
                      <!--th>Email</th-->
                      <th>Layanan</th>
                      <th>Uraian Keluhan</th>
                      <th>Status</th>
                      <!--th>Wkt. Respon</th-->
                    </tr>
                  </thead>
                </table>
            </div>
        </div>
    </section>
</body>
<footer>
  <?php $this->load->view("template/footer.php") ?>
  <?php //if ($this->session->flashdata('not')) { ?>
    //<script type="text/javascript">
      //Swal.fire({
        //title: 'Data berhasil tersimpan',
        //html: '<p style="color:#FF0000;">Namun Email yang dimasukkan teridentifikasi tidak valid sehingga tidak dapat menerima laporan progress tiket</p>',
        //timer: 5000,
        //button: false
      //});
    //</script>
  <?php // }  ?>
  <?php if ($this->session->flashdata('valid')) { ?>
    <script type="text/javascript">
      Swal.fire({
        title: 'Data berhasil tersimpan',
        timer: 5000,
        button: false
      });
    </script>
  <?php }  ?>
</footer>
</html>
