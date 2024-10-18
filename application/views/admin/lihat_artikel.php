<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'lihat_artikel')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <br><br>
          <div class="col-lg-8 ftco-animate" style="padding-left: 70px">
            <?php if ($this->session->userdata('role') == 1) { ?>
              <h2 class="mb-3"><?php echo $artikel->judul; ?></h2>
              <span class="fas fa-calendar"> <?php echo date("d-m-Y H:i:s", strtotime($artikel->tanggal)); ?></span>
              <span class="fas fa-user"> <?php echo $this->m_daftar_pengguna->edit_pengguna($artikel->id_user)->row()->username; ?></span><br><br>
              <div>
                <img src="<?= base_url(); ?>assets/upload/<?php echo $artikel->banner; ?>" alt="" class="img-fluid">
              </div><br>
              <div><?php echo $artikel->isi; ?></div>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>
</footer>

</html>