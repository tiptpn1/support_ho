<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("template/header.php", array('navbar' => 'forgot_password')) ?>
</head>

<body>
    <section class="ftco-section" style="background-image:url(<?php echo base_url('assets/images/image_6.jpg')?>);">
        <div class="container">
            <div class="row no-gutters justify-content-center mb-5">
                <form method="post" action="<?php echo base_url(); ?>auth/changePassword">
                    <h4 style="text-align: center;">Reset Password</h4>
                    <div class="form-group <?=form_error('password1') ? 'text-danger' : null ?>">
                        <input type="password" class="form-control col-md-15" placeholder="Masukkan password" required="" name="password1" id="password1" />
                        <?=form_error('password1', '<small class="text-danger">', '</small>'); ?>
                    </div><br>
                    <div class="form-group <?=form_error('password2') ? 'text-danger' : null ?>">
                        <input type="password" class="form-control col-md-15" placeholder="Ulangi password" required="" name="password2" id="password2" />
                        <?=form_error('password2', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary" name="submit">Ubah Password</button>
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