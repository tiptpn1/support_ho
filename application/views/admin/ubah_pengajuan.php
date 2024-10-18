<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_pengajuan')) ?>
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
            <h1 class="m-0 text-dark">Ubah Pengajuan ( Lelang )</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- Horizontal Form -->
          <div class="card card-info">
            <!-- form start -->
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?= base_url('Panel/ubah_aksi_pengajuan') ?>">
              <input type="hidden" name="id_pengajuan" value="<?= $pengajuan_lelang->id_pengajuan ?>">
              <div class="card-body">
                <div class="form-group row">
                  <label for="bagian" class="col-sm-2 col-form-label">Bagian</label>
                  <div class="col-sm-10">
                    <select class="form-control col-md-10 js-example-basic-multiple" name="id_bagian[]" multiple="multiple" required>
                      <?php
                      foreach ($bagian as $b) {
                        $tmp_found = "no";
                        $tmp = $this->m_pengajuan->get_id_bagian($pengajuan_lelang->id_bagian_pengajuan);
                        foreach ($tmp as $c) {
                          if ($b->id_bagian == $c->id_bagian) {
                            echo "<option value='" . $b->id_bagian . "' selected>" . $b->bagian . "</option>";
                            $tmp_found = "yes";
                            continue;
                          }
                        };
                        if ($tmp_found == "yes") continue;
                        else echo "<option value='" . $b->id_bagian . "'>" . $b->bagian . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nomemo" class="col-sm-2 col-form-label">Nomor Memo</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control col-md-10" name="nomemo" id="id_nomemo" value="<?= $pengajuan_lelang->no_memo ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_tgl_memo" class="col-sm-2 col-form-label">Tanggal Memo</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control col-md-10" name="tgl_memo" id="datepicker" value="<?= date("d-m-Y", strtotime($pengajuan_lelang->tgl_memo)) ?>" required>
                  </div>
                </div>
                <div class="dinamisForm">
                  <input name="id_prgkt_dinamis" type="hidden" value="<?= $pengajuan_lelang->id_prgkt_dinamis ?>">
                  <?php
                  $jumlah_perangkat = 0;
                  $tmp = $this->m_pengajuan->get_prgkt_dinamis($pengajuan_lelang->id_pengajuan);
                  foreach ($tmp as $key => $value) { ?>
                    <div class="form-group row" id="<?=($key+1)?>">
                        <label class="col-sm-2 col-form-label">Master Perangkat</label>
                        <div class="col-sm-3">
                          <input type="hidden" id="id_master_prgkt<?=($key+1)?>" name="id_master_prgkt[]" value="<?=$value->id_master_prgkt?>">
                          <input type="text" id="nama_master_prgkt($key+1)" name="nama_master_prgkt[]" data-id="1" class="form-control master_prgkt col-md-10" autocomplete="off" value="<?=$value->jns_prgkt . '-' . $value->tipe_prgkt?>" required>
                        </div>
                        <label>Jumlah</label>
                        <div class="row col-2">
                          <input type="text" id="id_jml($key+1)" name="jml1[]" class="jumlah_perangkat form-control col-md-10" autocomplete="off" value="<?=$value->jml1?>" required>
                        </div>
                      <?php if ($key==0): ?>
                        <button class="add_project_file btn-sm"><i class='fa fa-plus'></i></button>
                      <?php else: ?>
                        <button class="remove_project_file"><i class="fa fa-trash"></i></button>
                      <?php endif ?>
                    </div>
                  <?php } ?>
                </div>
                <!--prcoban-->

                <div class="form-group row">
                  <label for="jumlah" class="col-sm-2 col-form-label">Total</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control col-md-10" name="total" id="total" value="<?= $pengajuan_lelang->jumlah ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Upload File</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control col-md-10" id="file" name="upload_file" accept=".jpg, .png, .pdf, .rar, .zip/*">
                    <input type="hidden" id="old" name="old" value="<?= $pengajuan_lelang->upload_file ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="status_proses" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control col-md-10" name="status_proses" id="id_status_proses" required>
                      <option value=''>Pilih status</option>
                      <option value="Belum pengadaan" <?php if ($pengajuan_lelang->status_proses == "Belum pengadaan") echo "selected" ?>>Belum pengadaan</option>
                      <option value="Proses pengadaan" <?php if ($pengajuan_lelang->status_proses == "Proses pengadaan") echo "selected" ?>>Proses pengadaan</option>
                      <option value="Terealisasi" <?php if ($pengajuan_lelang->status_proses == "Terealisasi") echo "selected" ?>>Terealisasi</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--Modal perangkat-->
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
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

      var uploadField = document.getElementById("file");

      uploadField.onchange = function() {
        if (this.files[0].size > 5242880) {
          alert("File terlalu besar, Silahkan upload kembali. Max 5 MB");
          this.value = "";
        };
      };

    });
  </script>
  <script>
    $(function() {
      $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>

  <script>
    var array_id = [1];
    var jumlah_perangkat = <?=($key+1)?>;
    console.log(jumlah_perangkat);
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
        '<div class="form-group row" id="' + jumlah_perangkat + '">' +
        '<label class="col-sm-2 col-form-label">Master Perangkat</label>' +
        '<div class="col-sm-3">'+
        '<input type="hidden" id="id_master_prgkt' + jumlah_perangkat + '" name="id_master_prgkt[]">' +
        '<input type="text" id="nama_master_prgkt' + jumlah_perangkat + '" name="nama_master_prgkt[]" data-id="' + jumlah_perangkat + '" class="master_prgkt form-control col-md-10" autocomplete="off" required>' +
        '</div>' +
        '<label>Jumlah</label>' +
        '<div class="row col-2">'+
        '<input type="text" id="id_jml' + jumlah_perangkat + '" name="jml1[]" class="jumlah_perangkat form-control col-md-10" autocomplete="off" required>' +
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
    function loadXMLDoc(a, i) {
      var d = document.getElementById("id_master_prgkt" + i).value;
    }
  </script>
</footer>

</html>