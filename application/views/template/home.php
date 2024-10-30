<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("template/header.php") ?>
</head>

<body>
  <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image:url(<?php echo base_url('assets/images/bg_1.jpg') ?>);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate mb-md-5">
            <span class="subheading">Selamat Datang di</span>
            <h1 class="mb-4">Aplikasi IT Support</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image:url(<?php echo base_url('assets/images/bg_2.jpg') ?>);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate mb-md-5">
            <span class="subheading">PT Perkebunan Nusantara I</span>
            <h1 class="mb-4">Melayani dengan sepenuh hati</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pt ftco-no-pb ftco-consult">
    <div class="container">
      <div class="row d-flex no-gutters align-items-stretch	consult-wrap">
        <div class="col-md-5 wrap-about align-items-stretch d-flex">
          <div class="ftco-animate bg-primary align-self-stretch px-4 py-5 w-100">
            <h2 class="heading-white mb-4" id="ajukan">Ajukan Keluhan</h2>
            <!--?php echo form_open('user/send', ['method'=>'post', 'enctype'=>'multipart/form-data']) ?-->
            <!--?php echo form_open('captcha')?-->
            <form class="appointment-form ftco-animate" enctype="multipart/form-data" method="post" action="<?php echo base_url() . 'user/tambah_aksi_ajukan' ?>">
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
                      Nama
                    </div>
                  </div>
                  <div class="col-9">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="<?php echo $this->session->flashdata('nama') ?>" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
                      Departemen
                    </div>
                  </div>
                  <div class="col-9">
                    <div class="form-field">
                      <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <!-- <select name="kantor" class="form-control" id="kantor" required> -->
                        <select class="form-control" name="kantor" id="kantor" OnChange="f_kantor(this)" required>
                            <option value="" class="warna">Pilih Departemen</option>
                            <?php foreach ($kantor as $a) { ?>
                                <option value="<?= $a->id_master_kantor; ?>" class="warna" <?= ($this->session->flashdata('id_master_kantor') == $a->id_master_kantor) ? 'selected' : '' ?>>
                                <?= $a->nama_master_kantor_baru; ?> </option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
                      Bagian / Kebun
                    </div>
                  </div>
                  <div class="col-9">
                    <div class="form-field">
                      <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select class="form-control" name="bagian" id="bagian" required>
                          <option value="" class="warna">Pilih Bagian</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
                      Nomor Handphone
                    </div>
                  </div>
                  <div class="col-9">
                    <input type="text" class="form-control" name="hp" id="noHp" placeholder="Masukkan Nomor Hp" autocomplete="off" value="<?php echo $this->session->flashdata('hp') ?>" required>
                  </div>
                </div>
              </div>
              
              <!-- <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
                      Email
                    </div>
                  </div>
                  <div class="col-9">
                    <input type="email" class="form-control" name="email" placeholder="Masukkan Email*" autocomplete="off" value="<?php //echo $this->session->flashdata('email') ?>">
                  </div>
                </div>
              </div> -->
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
                      Jenis Layanan
                    </div>
                  </div>
                  <div class="col-9">
                    <div class="form-field">
                      <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="jns_kerusakan" id="id_jns_kerusakan" class="form-control" onchange="f_jns_kerusakan(this.value)" required>
                          <option value="" class="warna">Pilih jenis layanan</option>
                          <?php
                          $layanan = $this->m_master_layanan->filter()->result();
                          foreach ($layanan as $lay) {
                          ?>
                            <option class="warna" value="<?= $lay->jns_layanan; ?>" <?= ($this->session->flashdata('jns_kerusakan') == $lay->jns_layanan) ? 'selected' : '' ?>>
                                <?= $lay->jns_layanan; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div id="id_hardware_label" style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">
                    </div>
                  </div>
                  <div class="col-9" id="id_hardware_select"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div style="margin: 0; position: absolute; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-100%);  color:white">
                      Uraian Masalah
                    </div>
                  </div>
                  <div class="col-9">
                    <textarea name="uraian_kerusakan" id="uraian_kerusakan" cols="30" rows="5" class="form-control" placeholder="Masukkan Uraian Permasalahan" required><?php echo $this->session->flashdata('uraian') ?></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label style="margin: 0; top: 50%;  -ms-transform: translateY(-50%);  transform: translateY(-50%);  color:white">Upload File<br><small style="color:brown;">*jpg/jpeg/png/pdf</small></label>
                <input type="file" class="form-control col-md-10" id="file" name="upload_file" accept=".jpg, .jpeg, .png, .pdf">
              </div>
              <?php
              if ($this->session->flashdata('notif')) {
                echo $this->session->flashdata('notif');
              }
              ?>
              <p><?php echo $img ?></p><br>
              <input type="text" name="captcha" class="form-control" autocomplete="off" placeholder="Masukkan huruf/angka di atas" required />
              <div class="form-check form-check-inline" style="display:-webkit-inline-box;">
                <input type="checkbox" name="sla" value="y" required class="form-check-input">
                <div style="padding-left:5px;">
                  <label style="color:yellow;"> Dengan memilih, Anda setuju dengan Service Level Agreement (SLA) IT Support. Informasi SLA selengkapnya dapat dilihat <a href="<?php echo base_url(); ?>User/sla" style="color:red;">di sini.</a></label><br>
                </div>
              </div>

              <div class="form-group">
                <input type="submit" name="submit" id="buttonSubmitKeluhan" value="Ajukan" class="btn btn-secondary py-3 px-4">
              </div>
              <p style="color:yellow;">*Dengan mengisi email yang valid, Anda akan mendapat notifikasi progress penanganan keluhan Anda melalui email. Apabila tidak ada di Inbox, silakan periksa folder Spam</p>
            </form>
            <!--?php echo form_close(); ?-->
            <!--?php echo form_close(); ?-->
          </div>
        </div>
        <div class="col-md-7 wrap-about ftco-animate align-items-stretch d-flex">
          <div class="bg-white p-5">
            <h2 class="mb-4">Prosedur <br>Pengaduan keluhan perangkat</h2>
            <div class="row">
              <div class="col-lg-6">
                <div class="services">
                  <div class="icon mt-2 d-flex align-items-center"><span class="flaticon-collaboration"></span></div>
                  <div class="text media-body" style="text-align: justify;">
                    <h3>1. Ajukan Keluhan</h3>
                    <p>Apabila terdapat permasalahan perangkat komputer karyawan, baik hardware, software, kuota email, dan penambahan user internet dapat mengajukan pengaduan melalui layanan Aplikasi IT Support. Karyawan yang mengisi alamat email dengan benar dapat memonitor progress penanganan melalui email.</p>
                  </div>
                </div>
                <div class="services">
                  <div class="icon mt-2"><span class="flaticon-analysis"></span></div>
                  <div class="text media-body" style="text-align: justify;">
                    <h3>2. Pengecekan oleh Sub Bagian TI</h3>
                    <p>Sub Bagian TI akan menerima notifikasi dari keluhan yang telah diajukan, kemudian menghubungi karyawan yang bersangkutan dan melalukan pengecekan jika diperlukan.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="services">
                  <div class="icon mt-2"><span class="flaticon-handshake"></span></div>
                  <div class="text media-body" style="text-align: justify;">
                    <h3>3. Persetujuan dari Bagian Pengadaan & Umum</h3>
                    <p>Bagian Pengadaan & Umum menyetujui penanganan atas keluhan yang diajukan.</p>
                  </div>
                </div>
                <br><br><br>
                <div class="services">
                  <br><br><br>
                  <div class="icon mt-2"><span class="flaticon-search-engine"></span></div>
                  <div class="text media-body" style="text-align: justify;">
                    <h3>4. Pengerjaan</h3>
                    <p>Pengerjan terhadap keluhan yang telah diajukan beserta pemberitahuan kepada karyawan tentang kemajuan penanganan keluhan yang telah diajukan.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-intro ftco-no-pb img" style="background-image:url(<?php echo base_url('assets/images/bg_3.jpg') ?>);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10 text-center heading-section heading-section-white ftco-animate">
          <h2 class="mb-0">Tentang kami</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-about ftco-no-pt ftco-no-pb ftco-counter" id="section-counter">
    <div class="container consult-wrap">
      <div class="row d-flex align-items-stretch">
        <div class="col-md-6 wrap-about align-items-stretch d-flex">
          <div class="img" style="background-image:url(<?php echo base_url('assets/images/about.jpg') ?>);"></div>
        </div>
        <div class="col-md-6 wrap-about ftco-animate py-md-5 pl-md-5">
          <div class="heading-section mb-4">
            <span class="subheading">Aplikasi IT Support</span>
            <h2>Melayani, memperbaiki, dan tanggap</h2>
          </div>
          <p>Selamat datang di Aplikasi IT Support</p>
          <div class="tabulation-2 mt-4">
            <ul class="nav nav-pills nav-fill d-md-flex d-block">
              <li class="nav-item">
                <a class="nav-link active py-2" data-toggle="tab" href="#home1"><span class="ion-ios-home mr-2"></span> Deskripsi</a>
              </li>
            </ul>
            <div class="tab-content bg-light rounded mt-2">
              <div class="tab-pane container p-0 active" id="home1">
                <p align="justify">Layanan ini digunakan untuk karyawan PT Perkebunan Nusantara I apabila terdapat permasalahan pada perangkat komputer milik Perusahaan yang digunakan. Baik itu perangkat keras (hardware) maupun perangkat lunak (software), kuota email, dan penambahan user internet</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-intro ftco-no-pb img" style="background-image:url(<?php echo base_url('assets/images/bg_1.jpg') ?>);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9 col-md-8 d-flex align-items-center heading-section heading-section-white ftco-animate">
          <h2 class="mb-3 mb-md-0">Ada permasalahan dengan perangkat komputer anda?</h2>
        </div>
        <div class="col-lg-3 col-md-4 ftco-animate">
          <p class="mb-0"><a href="#ajukan" class="btn btn-secondary py-3 px-4">Ajukan keluhan</a></p>
        </div>
      </div>
    </div>
  </section>

  <!-- <section class="ftco-section testimony-section">
    <div class="container-fluid px-md-5">
      <div class="row justify-content-center mb-5">
        <div class="col-md-8 text-center heading-section ftco-animate">
          <span class="subheading">INFO</span>
          <h2 class="mb-4">PEMBERITAHUAN</h2>
        </div>
      </div>
      <div class="row ftco-animate justify-content-center">
        <div class="col-md-12">
          <div class="carousel-testimony owl-carousel">
            <?php foreach ($info as $in) {  ?>
              <div class="item">
                <div class="testimony-wrap d-flex">
                  <div class="text pl-4">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                    <p><?php echo $in->isi_info; ?></p>
                    <p class="name"><?php echo $this->m_daftar_pengguna->edit_pengguna($in->id_user)->row()->username; ?></p>
                    <span class="position"><?php echo date("d-m-Y H:i:s", strtotime($in->tanggal)) ?></span>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <hr>


  <!-- <section class="ftco-section testimony-section">
    <div class="container-fluid px-md-5">
      <div class="row justify-content-center mb-5">
        <div class="col-md-8 text-center heading-section ftco-animate">
          <span class="subheading">Berita</span>
          <h2 class="mb-4">Artikel Terbaru</h2>
        </div>
      </div>
      <div class="row ftco-animate justify-content-center">
        <div class="col-md-12">
          <div class="carousel-testimony owl-carousel">
            <?php foreach ($data->result() as $a) {  ?>
              <div class="item">
                <div class="testimony-wrap d-flex">
                  <div class="text p-9">
                    <h3 class="heading"><a href="#"><?php echo $a->judul; ?></a></h3>
                    <p><?php echo (str_word_count("$a->isi") > 10 ? substr("$a->isi", 0, 200) . "[..]" : "$a->isi") ?></p>
                    <p class="mb-0"><a href="<?php echo base_url('User/artikel/') . $a->id_artikel ?>" class="btn btn-primary">Baca Selengkapnya <span class="ion-ios-arrow-round-forward"></span></a></p>
                    <p class="ml-auto mb-0">
                      <a href="#" class="mr-2"><?php echo $this->m_daftar_pengguna->edit_pengguna($a->id_user)->row()->username; ?></a> -->
                      <!--a href="#" class="fa-eye"><span class="icon-chat"></span> 2</a-->
                      <!--jml_view belom-->
                    <!-- </p>
                    <span class="position"><?php echo date("d-m-Y H:i:s", strtotime($in->tanggal)) ?></span>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <script type="text/javascript">
    function f_kantor() {
      var dropDown = document.getElementById("bagian");
      var dropDown2 = document.getElementById("id_jns_kerusakan");
      dropDown.selectedIndex = null;
      dropDown2.selectedIndex = null;
      document.getElementById("id_hardware_select").innerHTML = "<input type='hidden' class='form-control' name='id_master_jns'>"
    }
  </script>
  <script>
    function f_jns_kerusakan(a) {
      // var x = a.value;
      if (a == 'Hardware') {
        if(!document.getElementById("id_master_jns")){
          document.getElementById("id_hardware_select").innerHTML = "<select name='id_master_jns' id='id_master_jns' class='form-control' required></select>";
          $(document).ready(function() {
            $('#id_master_jns').select2();
          });
        }
      } else {
        document.getElementById("id_hardware_select").innerHTML = "<input type='hidden' class='form-control' name='id_master_jns'>";
      }
    }
  </script>
  <script>

  $(document).ready(function () {
			$("#kantor").val("<?= $this->session->flashdata('id_master_kantor') ?>").trigger('change');
      $("#bagian").val("<?= $this->session->flashdata('id_bagian') ?>").trigger('change');
      f_jns_kerusakan("<?=$this->session->flashdata('jns_kerusakan')?>");
      $("#id_jns_kerusakan").val("<?= $this->session->flashdata('jns_kerusakan') ?>").trigger('change');
      $("#id_master_jns").val("<?= $this->session->flashdata('id_master_jns') ?>").trigger('change');
	});

    $("#kantor").change(function() {

      // variabel dari nilai combo box kendaraan
      var id_master_kantor = $("#kantor").val();

      // Menggunakan ajax untuk mengirim dan dan menerima data dari server
      $.ajax({
        url: "<?php echo base_url(); ?>user/get_bagian",
        method: "POST",
        data: {
          id_master_kantor: id_master_kantor
        },
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          html += '<option value="" class="warna">Pilih Bagian</option>';
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].id_bagian + '" class="warna">' + data[i].bagian + '</option>';
          }
          $('#bagian').html(html);
          
        }
      });
    });

  </script>
  <script>
    $("#id_jns_kerusakan").change(function() {

      // variabel dari nilai combo box kendaraan
      var id_master_kantor = $("#kantor").val();

      // Menggunakan ajax untuk mengirim dan dan menerima data dari server
      $.ajax({
        url: "<?php echo base_url(); ?>user/get_jenis",
        method: "POST",
        data: {
          id_master_kantor: id_master_kantor
        },
        async: false,
        dataType: 'json',
        success: function(data2) {
          var html = '';
          var i;
          html += '<option value="" class="warna">Pilih Jenis Perangkat</option>';
          for (i = 0; i < data2.length; i++) {
            html += '<option value="' + data2[i].id_master_jns + '" class="warna"' + '>' + data2[i].jns_prgkt + '</option>';
          }
          $('#id_master_jns').html(html);
        }
      });
    });
  </script>
</body>

<footer>
	<script>
		const regex = /^[a-zA-Z0-9.,]*$/;
		function checkValueIsNotValid() {
			result = idInput.filter((item) => {
				value = $(`#${item}`).val();
				return !regex.test(value);
			});

			return result.length > 0;
		}
		
		$(document).ready(function() {
			idInput = ['nama', 'noHp', 'uraian_kerusakan'];
			idInput.map((id) => {
				$(`#${id}`).on('input', function () {
					// handling submit button
					if (checkValueIsNotValid()) {
						$('#buttonSubmitKeluhan').prop('disabled', true);
					} else {
						$('#buttonSubmitKeluhan').prop('disabled', false);
					}

					// handling msg
					val = $(this).val();
					if (!regex.test(val)) {
						$(`#error-${id}`).remove();
						$(this).closest('div.form-group').append(`<div id="error-${id}" class="text-danger"><small><em>Tidak boleh ada karakter selain huruf, angka, tanda titik (.), dan tanda koma (,)</em></small></div>`)
					} else {
						$(`#error-${id}`).remove();
					}
				});
			});
		});
		
	</script>
  <?php $this->load->view("template/footer.php") ?>

     <?php if ($this->session->flashdata('error')) { ?>
    <script type="text/javascript">
      Swal.fire({
        icon: "error",
        title: "Captcha salah!",
        text: 'Mohon masukkan kembali data yang benar.',
        timer: 5000,
        button: false
      });
    </script>
  <?php }  ?>
	<?php if ($this->session->flashdata('serverError')) { ?>
		<script type="text/javascript">
			Swal.fire({
				icon: "error",
				title: "Server Error",
				text: 'Server sedang mengalami error, silakan coba beberapa saat lagi.',
				timer: 5000,
				button: false
			});
		</script>
	<?php }  ?>
     <?php if ($this->session->flashdata('errorFile') || $this->session->flashdata('errorChar')) { 
			$message = $this->session->flashdata('errorFile')? 'Format file tidak sesuai.' : ($this->session->flashdata('errorChar')? 'Pastikan inputan nama, nomor handphone, dan uraian masalah tidak ada simbol selain titik (.) dan (,)' : '');
			?>
    <script type="text/javascript">
      Swal.fire({
        icon: "error",
        title: "Gagal Ajukan Keluhan",
        text: '<?= $message ?>',
        timer: 5000,
        button: false
      });
    </script>
  <?php }  ?>

</footer>

</html>
