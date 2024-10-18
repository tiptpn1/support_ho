<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'tambah_pengajuan')) ?>
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

  <!-- -->
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Pengajuan ( Lelang )</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <form role="form" id="quickForm" enctype="multipart/form-data" action="<?= base_url('Panel/tambah_aksi_pengajuan') ?>" method="post">
            <div class="card-body">
              <div class="form-group">
                <label>Bagian*</label>
                <br>
                <select class="form-control col-md-10 js-example-basic-multiple" name="id_bagian[]" multiple="multiple" required>
                  <?php
                  foreach ($bagian as $b) {
                    echo "<option value='" . $b->id_bagian . "'>" . $b->bagian . "</option>";
                  }
                  ?>
                </select>

              </div>
              <div class="form-group">
                <label>Nomor Memo*</label>
                <input type="text" name="nomemo" class="form-control col-md-10" id="id_nomemo">
              </div>
              <div class="form-group">
                <label>Tanggal Memo*</label>
                <input type="text" name="tgl_memo" class="form-control col-md-10" id="datepicker" autocomplete="off">
              </div>
              <div class="dinamisForm">
                <div class="row" id="id_dinamis">
                  <div class="form-group col-3">
                    <label>Master Perangkat*</label>
                    <input type="hidden" id="id_master_prgkt1" name="id_master_prgkt[]">
                    <input type="text" id="nama_master_prgkt1" name="nama_master_prgkt[]" data-id="1" class="form-control master_prgkt col-md-10" autocomplete="off" required>
                  </div>
                  <div class="form-group col-2">
                    <label>Jumlah*</label>
                    <input type="text" id="id_jml1" name="jml[]" class="jumlah_perangkat form-control col-md-10" autocomplete="off" required>
                  </div>
                  <button class="add_project_file btn-sm"><i class='fa fa-plus'></i></button>
                </div>
              </div>
              <label>Total</label>
              <input type="text" id="total" name="total" class="form-control col-md-10" placeholder="Total" readonly="">
              <!--button class="btn btn-info" onclick="getTotal()">tes</button-->
              <!--div class="form-group">
                <label>Total*</label>
                <input type="text" name="jumlah" class="form-control col-md-10" id="id_jumlah" required>
              </div-->
              <div class="form-group">
                <label>Upload File</label>
                <input type="file" class="form-control col-md-10" id="file" name="upload_file" accept=".jpg, .jpeg, .png, .pdf, .rar, .zip/*">
              </div>
              <div class="form-group">
                <label>Status*</label>
                <select class="form-control col-md-10" name="status_proses" id="id_status_proses" required>
                  <option value=''>Pilih status</option>
                  <option value="Belum pengadaan">Belum pengadaan</option>
                  <option value="Proses pengadaan">Proses pengadaan</option>
                  <option value="Terealisasi">Terealisasi</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--Modal  master perangkat-->
  <div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pilih Perangkat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table id="datatables" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Perangkat</th>
                <th>Tipe Perangkat</th>
                <th>Status</th>
                <?php if ($this->session->userdata('role') == 1) { ?>
                  <th>Pilih</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>

              <?php
              $i = 1;
              foreach ($perangkat as $p) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $p->jns_prgkt . '</td>';
                echo '<td>' . $p->tipe_prgkt . '</td>';
                echo '<td>' . $p->status . '</td>';
                if ($this->session->userdata('role') == 1) {
                  echo "<td>
                    <button class='btn btn-xs btn-info' id='pilih' data-id_master_prgkt='$p->id_master_prgkt' data-jns_prgkt='$p->jns_prgkt' data-tipe_prgkt='$p->tipe_prgkt'>
                      <i class='fa fa-check'></i>Pilih
                    </button>
                    </td>";
                }
                echo "</tr>";
                $i++;
              }
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
        theme: "classic"
      });
    });
  </script>
  <script>
    var array_id = [1];
    var jumlah_perangkat = 1;
    var open;
    var temp_last_id = 0;

    // remove value array
    Array.prototype.remove = function() {
      var what, a = arguments,
        L = a.length,
        ax;
      while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
          this.splice(ax, 1);
        }
      }
      return this;
    };

    // Add new input with associated 'remove' link when 'add' button is clicked.
    $('.add_project_file').click(function(e) {
      e.preventDefault();

      jumlah_perangkat++;

      $(".dinamisForm").append(
        '<div class="row" id="' + jumlah_perangkat + '">' +
        '<div class="form-group col-3">' +
        '<label>Master Perangkat*</label>' +
        '<input type="hidden" id="id_master_prgkt' + jumlah_perangkat + '" name="id_master_prgkt[]">' +
        '<input type="text" id="nama_master_prgkt' + jumlah_perangkat + '" name="nama_master_prgkt[]" data-id="' + jumlah_perangkat + '" class="master_prgkt form-control col-md-10" autocomplete="off" required>' +
        '</div>' +
        '<div class="form-group col-2">' +
        '<label>Jumlah*</label>' +
        '<input type="text" id="id_jml' + jumlah_perangkat + '" name="jml[]" class="jumlah_perangkat form-control col-md-10" autocomplete="off" required>' +
        '</div>' +
        '<button class="remove_project_file"><i class="fa fa-trash"></i></button>' +
        '</div>'
      );



      array_id.push(jumlah_perangkat);
      $(this).trigger('create');
      // alert("id element :" + array_id);
      getSumJumlahPerangkat();

    });

    // Remove parent of 'remove' link when link is clicked.
    $('.dinamisForm').on('click', '.remove_project_file', function(e) {
      e.preventDefault();
      var parentId = $(this).parent().attr('id');
      //var tampung_id = ["#id_dinamis" + jumlah_perangkat];

      jumlah_perangkat = jumlah_perangkat - 1;
      //

      $(this).parent().remove();
      array_id.remove(parseInt(parentId));

      getSumJumlahPerangkat();
      hitungTotal();

      // var sum = getSumJumlahPerangkat();
      // $("#total").val(sum);
    });

    function getSumJumlahPerangkat() {
      $(".jumlah_perangkat").keyup(function() {
        hitungTotal();
      });
    }

    function hitungTotal() {
      var total = 0;
      $(".jumlah_perangkat").each(function() {
        var value_perangkat = $(this).val();
        if (value_perangkat != '') {
          total += parseInt(value_perangkat);
        }
      });
      $("#total").val(total);
    }



    $(document).ready(function() {
      getSumJumlahPerangkat();
    });



    // function getSumJumlahPerangkat() {
    //   var sum = 0;
    //   var total_row = array_id.length;
    //   if (total_row > 0) {
    //     for (var i = 0; i <= total_row; i++) {
    //       alert[array_id[i]];
    //       sum += parseInt($("#id_jml" + array_id[i]).val()) ? parseInt($("#id_jml" + array_id[i]).val()) : 0;
    //     }
    //   }
    //   return sum;
    // }

    // $(document).ready(function() {
    //   $(this).keydown(function() {
    //     setTimeout(function() {
    //       var sum = getSumJumlahPerangkat();
    //       $("#total").val(sum);
    //     });
    //   });
    // });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {

      $(document).on('click', '#pilih', function() {
        var id_master_prgkt = $(this).data('id_master_prgkt');
        var jns_prgkt = $(this).data('jns_prgkt');
        var tipe_prgkt = $(this).data('tipe_prgkt');
        //console.log(id_master_prgkt);
        $("#id_master_prgkt" + open).val(id_master_prgkt);
        $('#nama_master_prgkt' + open).val(jns_prgkt + "-" + tipe_prgkt);
        //open.val(id_master_prgkt);
        $('#modal-xl').modal('hide');
      });

      $(document).on('click', '.master_prgkt', function() {
        open = $(this).data('id');
        //console.log(open);
        $('#modal-xl').modal('show');
      });

    })
  </script>

  <script>
    $(function() {
      $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>

  <script>
    var uploadField = document.getElementById("file");

    uploadField.onchange = function() {
      if (this.files[0].size > 5242880) {
        alert("File terlalu besar, Silahkan upload kembali. Max 5 MB");
        this.value = "";
      };
    };
  </script>

</footer>

</html>