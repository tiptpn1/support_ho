<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'kelola_tiket')) ?>
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pengelolaan Tiket</h1>
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
              <div style="width: 100%; overflow-x: auto;">
              <table id="datatables-tiket" class="table table-bordered table-hover" data-url="<?= base_url('panel/get_tiket'); ?>">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode servis</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Bagian</th>
                    <!--th>Email</th-->
                    <th>Jenis Layanan</th> 
                    <!-- <th>Jenis Perangkat</th> -->
                    <th>Uraian</th>
                    <!--th>Pilih Perangkat</th-->
                    <th>No SP/SPK</th>
                    <th>Prioritas</th>
                    <th>Evidence</th>
                    <!--th>Cost Center</th>
                    <th>Solusi Petugas TI</th>
                    <th>Solusi Rekanan</th>
                    <th>Biaya</th-->
                    <th>Status</th>
                    <th colspan="4">Waktu respon</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- PDF Modal -->
  <div class="modal fade" id="PdfModal" class="PdfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="font-weight:bold" id="exampleModalLongTitle">Preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modal-pdf">
          <script type="text/javascript">
            $(document).on("click", ".pilih-modal", function() {
              var id = $(this).data('id_ajukan');
              $('.modal-pdf').html('<embed src="<?php echo base_url('ajax/print_formkeluhan?id_ajukan=') ?>' + id +
                '" frameborder="0" width="100%" height="400px">');
            });
          </script>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!--Modal detail-->
  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detail_tiket" class="detail_tiket">
          <!-- Ambil dari Ajax -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal -->

	<!-- Modal reset password -->
	<div class="modal fade" id="modal-resetPassword">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reset Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" class="detail_tiket">
					<form method="post" id="formResetPassword">
							<h4 style="text-align: center;">Form Reset Password</h4>
							<div class="alert alert-danger" style="display: none;" id="errorMessage" role="alert"></div>
							<div class="form-group <?=form_error('passwordlama') ? 'text-danger' : null ?>">
									<input type="password" class="form-control col-md-15" placeholder="Masukkan password lama" required name="passwordlama" id="passwordlama" />
									<?=form_error('password1', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group <?=form_error('password1') ? 'text-danger' : null ?>">
									<input type="password" class="form-control col-md-15" minlength="8" placeholder="Masukkan password baru" required name="password1" id="password1" />
									<?=form_error('password1', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group <?=form_error('password2') ? 'text-danger' : null ?>">
									<input type="password" class="form-control col-md-15" minlength="8" placeholder="Ulangi password baru" required name="password2" id="password2" />
									<?=form_error('password2', '<small class="text-danger">', '</small>'); ?>
									<small id="errorKonfirmPass" class="text-danger"></small>
							</div>
							<div style="text-align: center;">
									<button type="submit" id="buttonSubmitResetPassword" class="btn btn-primary" name="submit">Reset Password</button>
							</div>
					</form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
	<!-- /.modal -->


</body>
<footer>
  <script>
    // $(document).ready(function() 
    // {
    //         $('#data-table').DataTable(
    //           {
    //             "processing": true,
    //             "serverSide": true,
    //             "responsive":true,
    //             "pagingType": "full_numbers",
    //             "paging": true,
    //             "lengthMenu": [10, 25, 50, 75, 100],
    //             "ajax": {
    //                 "url": "<?php //echo site_url('panel/get_tiket'); 
                                ?>",
    //                 "type": "POST"
    //             },
    //             "columns": [
    //                 {"data": "id_ajukan"},
    //                 {"data": "kode_servis"},
    //                 {"data": "tanggal"},
    //                 {"data": "nama"},
    //                 {"data": "bagian"},
    //                 {"data": "jns_kerusakan"},
    //                 {"data": "jns_prgkt"},
    //                 {"data": "uraian"},
    //                 {"data": "no_spk"},
    //                 {"data": "prioritas"},
    //                 {"data": "waktu2"}
    //             ]
    //         });

    //       //   $.ajax({
    //       //     url: "<?php //echo site_url('panel/jarak_waktu'); 
                          ?>",
    //       //     method: "POST",
    //       //     data: { status: "active" },
    //       //     success: function(response) {
    //       //         var formattedStatus = JSON.parse(response);
    //       //         // Gunakan formattedStatus dalam JavaScript sesuai kebutuhan Anda
    //       //         console.log(formattedStatus);
    //       //     }
    //       // });
    // });
    //     $(document).ready(function() {
    //     $('#data-table').DataTable({
    //       "processing": true,
    //                 "serverSide": true,
    //                 "responsive":true
    //     });
    // });
  </script>
  <?php $this->load->view("admin/footer_admin.php") ?>
  <?php if ($this->session->flashdata('not')) { ?>
    <script type="text/javascript">
      Swal.fire({
        title: 'Data berhasil tersimpan',
        html: '<p style="color:#FF0000;">Namun Email yang dimasukkan teridentifikasi tidak valid sehingga tidak dapat menerima laporan progress tiket</p>',
        timer: 5000,
        button: false
      });
    </script>
  <?php }
  if ($this->session->flashdata('valid')) { ?>
    <script type="text/javascript">
      Swal.fire({
        title: 'Data berhasil tersimpan',
        timer: 5000,
        button: false
      });
    </script>
  <?php }
  if (0) { ?>
    <script type="text/javascript">
      Swal.fire({
        title: 'Data tidak berhasil tersimpan',
        timer: 5000,
        button: false
      });
    </script>
  <?php } ?>
  <script>
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
