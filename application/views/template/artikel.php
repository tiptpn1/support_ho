<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("template/header.php") ?>
</head>

<body>
  <section class="hero-wrap hero-wrap-2" style="background-image:url(<?php echo base_url('assets/images/bg_1.jpg') ?>);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 text-center">
          <h1 class="mb-2 bread">ARTIKEL</h1>
          <p class="breadcrumbs"><span class="mr-2">Beranda<i class="ion-ios-arrow-forward"></i></span> <span class="mr-2">Artikel<i class="ion-ios-arrow-forward"></i></span></p>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8" style="padding-left: 70px">
          <h2 class="mb-3"><?php echo $artikel->judul; ?></h2>
          <span class="icon-calendar"> <?php echo date("d-m-Y H:i:s", strtotime($artikel->tanggal)); ?></span>
          <span class="icon-person"> <?php echo $this->m_daftar_pengguna->edit_pengguna($artikel->id_user)->row()->username; ?></span><br><br>
          <div>
            <img src="<?= base_url(); ?>assets/images/<?php echo $artikel->banner; ?>" alt="" class="img-fluid">
          </div><br>
          <p><?php echo $artikel->isi; ?></p>

        </div>
      </div>
    </div>
  </section>
</body>
<footer>
  <?php $this->load->view("template/footer.php") ?>
</footer>

</html>