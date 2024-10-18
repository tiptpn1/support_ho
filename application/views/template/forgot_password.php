<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("template/header.php", array('navbar' => 'forgot_password')) ?>
</head>

<body>
    <section class="ftco-section" style="background-image:url(<?php echo base_url('assets/images/image_6.jpg') ?>);">
        <div class="container">
            <div class="row no-gutters justify-content-center mb-5">
                <form method="post" action="<?php echo base_url(); ?>auth/forgot_password">
                    <h4 style="text-align: center;">Lupa Password</h4>
                    <!--div class="form-group <?= form_error('username') ? 'text-danger' : null ?>">
                        <input type="text" class="form-control col-md-15" placeholder="Masukkan Username" required="" name="username" id="username" />
                    </div><br-->
                    <div class="form-group <?= form_error('email') ? 'text-danger' : null ?>">
                        <input type="email" class="form-control col-md-15" placeholder="Masukkan Email" required="" name="email" id="email" />
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div><br>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary" name="submit">Kirim Link Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
<footer>
    <?php $this->load->view("template/footer.php") ?>
</footer>

</html>