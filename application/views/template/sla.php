<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("template/header.php", array('navbar' => 'sla')) ?>     
</head>

<body>
	<section class="hero-wrap hero-wrap-2" style="background-image:url(<?php echo base_url('assets/images/bg_1.jpg')?>);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">SLA</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row no-gutters justify-content-center mb-5">
                <div>
                    <img src="<?php echo base_url("assets/images/sla.jpg"); ?>" width="1000">
                </div>
            </div>
        </div>
    </section>
</body>
<footer>
<?php $this->load->view("template/footer.php") ?>

</footer>
</html>