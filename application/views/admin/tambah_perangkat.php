<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'tambah_perangkat')) ?>
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
            <h1 class="m-0 text-dark">Tambah Perangkat</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <form role="form" id="quickForm" action="<?= base_url('Panel/tambah_aksi_perangkat') ?>" method="post">
            <div class="card-body">
              <div class="form-group">
                <label>Jenis Perangkat*</label>
                  <input type="text" name="jns_prgkt" class="form-control col-md-10" id="id_jns_prgkt" data-toggle="modal" data-target="#modal-xl" placeholder="pilih jenis perangkat" style="caret-color: transparent !important;" onkeydown="return false;" autocomplete="off" required>
                  <input type="hidden" name="id_master_prgkt" id ="id_master_prgkt">
              </div>
              <div class="form-group">
                <label>Tipe*</label>
                <input type="text" name="tipe" class="form-control col-md-10" id="id_tipe" style="caret-color: transparent !important;" onkeydown="return false;" required>
              </div>
              <div class="form-group">
                <label>Detail</label>
                <textarea type="text" class="form-control col-md-10" cols="10" rows="5" name="detail" id="id_detail"></textarea>
              </div>
              <div class="form-group">
                <label>Kepemilikan</label>
                <select class="form-control col-md-10" name="kepemilikan" id="id_kepemilikan" OnChange="f_kepemilikan(this)" required>
                  <option value=''>Pilih kepemilikan</option>
                  <option value="SW">Sewa</option>
                  <option value="TI">Inventaris</option>
                  <option value="P">Non Sewa dan Inventaris</option>
                </select>
              </div>
              <div class="form-group" id="id_sewa"></div>
              <div class="form-group">
                <label>Nomor SP/SPK</label>
                <input type="text" name="nospk" class="form-control col-md-10" id="id_nospk" />
              </div>
              <div class="form-group">
                <label>Pilih Dokumen Pengajuan</label>
                <input type="text" name="pildok" class="form-control col-md-10" id="id_pildok" data-toggle="modal" data-target="#modal-xl1" placeholder="pilih dokumen pengajuan" readonly>
                <input type="hidden" name="id_pengajuan" id="id_pengajuan" value="">
              </div>
              <div class="form-group">
                <label>Bagian*</label>
                <div id="bagian">
                  <select class="form-control col-md-10"  name="id_bagian" required>
                    <?php
                    foreach ($bagian as $b) {
                      echo "<option value='" . $b->id_bagian . "'>" . $b->bagian . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label>Tanggal Terima*</label>
                <input type="text" name="tgl_terima" class="form-control col-md-10" id="datepicker" autocomplete="off"  required >
              </div>
              <div class="form-group">
                <label>Status*</label>
                <select class="form-control col-md-10" name="status" id="id_status" required>
                  <option value="aktif">Aktif</option>
                  <option value="rusak">Rusak</option>
                  <option value="non aktif">Non Aktif</option>
                  <!--option value="nonaktif">Non Aktif</option-->
                </select>
                <input type="hidden" name="qr_code">
              </div>
              <div class="form-group">
                <label>Level Kritis*</label>
                <select class="form-control col-md-10" name="kritis" id="kritis" required>
                  <option value="1">Tidak Kritis</option>
                  <option value="2">Sedang</option>
                  <option value="3">Kritis</option>
                </select>
              </div>
              <div class="form-group">
                <label>Nama Pengguna</label>
                  <input type="text" name="nama_pengguna" class="form-control col-md-10" id="id_nama_pengguna" />
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

  <!--Modal Jenis Perangkat-->
  <div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pilih jenis & tipe perangkat</h4>
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
                <th width="20px">Pilih</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
               foreach ($perangkat as $p) {?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $p->jns_prgkt ?></td>
                  <td><?= $p->tipe_prgkt ?></td>
                  <td><?= $p->status ?></td>
                  <td>
                    <button class="btn btn-xs btn-info" id="select" data-id_master_prgkt="<?= $p->id_master_prgkt ?>" data-jns="<?= $p->jns_prgkt ?>" data-tipe="<?= $p->tipe_prgkt ?>">
                      <i class="fa fa-check"></i>Pilih
                    </button>
                  </td>
                </tr>
              <?php $i++; } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!--Modal Pilih Dokumen Pengajuan-->
  <div class="modal fade" id="modal-xl1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pilih Dokumen Pengajuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!--Tabel pengajuan yang statusnya sudah terealisasi-->
          <table id="datatables1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Bagian</th>
                <th>Nomor Memo</th>
                <th>Tanggal Memo</th>
                <th>Status</th>
                <th>Terdaftar/Jumlah</th>
                <th width="20px">Pilih</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pengajuan_lelang as $pl) { ?>
                <tr>
                  <td>
                    <?php
                    $tmp = $this->m_pengajuan->get_id_bagian($pl->id_bagian_pengajuan);
                    foreach ($tmp as $b) {
                      echo $b->bagian . '<br>';
                    }
                    ?>
                  </td>
                  <td><?= $pl->no_memo ?></td>
                  <td><?= $pl->tgl_memo ?></td>
                  <td><?= $pl->status_proses ?></td>
                  <?php $terdaftar = $this->db->get_where("perangkat", array("id_pengajuan" => $pl->id_pengajuan))->num_rows(); ?>
                  <td><?=$terdaftar  .'/'.$pl->jumlah?></td>
                  <td>
                    <?php if($terdaftar==$pl->jumlah) {
                      echo '<button class="btn btn-xs btn-danger">
                      <i class="fa fa-check"></i>Penuh
                    </button>';
                    } else{?>
                    <button class="btn btn-xs btn-info" id="pilih" data-pildok="<?= $pl->no_memo ?>" data-id_dok="<?= $pl->id_pengajuan ?>">
                      <i class="fa fa-check"></i>Pilih
                    </button>
                    <?php }?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <br><br>
          <b><i>NB: Jika nomor memo kosong maka tidak perlu dipilih</i></b>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <script type="text/javascript">
    function f_kepemilikan(a) {
      var x = a.value;
      if (x == 'SW') {
        document.getElementById("id_sewa").innerHTML = "<div class='form-group'> <label>Nomor Perangkat Sewa Dari Vendor</label> <input type='text' name='noprgkt_vendor' class='form-control col-md-10' id='id_noprgkt_vendor'/> </div>";
      } else if (x == 'TI') {
        document.getElementById("id_sewa").innerHTML = "<div class='form-group'> <label>Nomor Inventaris</label> <input type='text' name='no_inventaris' class='form-control col-md-10' id='id_no_inventaris'/> </div>";
      } else {
        document.getElementById("id_sewa").innerHTML = "";
      }
    }
  </script>
  <script>
    $(function() {
      $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        maxDate: 0
      });
    });
    $( "#datepicker" ).keyup(function() {
  e.preventDefault()
});
  </script>
</body>
<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>
  <!--script type="text/javascript">
  function post_value(s,x){
    document.getElementById('id_jnsprgkt').value=s;
    document.getElementById('id_tipe').value=x;
    return false;
  }
</script-->

  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '#select', function() {
        var id_master_prgkt = $(this).data('id_master_prgkt');
        var jns_prgkt = $(this).data('jns');
        var tipe_prgkt = $(this).data('tipe');
        
        $('#id_master_prgkt').val(id_master_prgkt);
        $('#id_jns_prgkt').val(jns_prgkt);
        $('#id_tipe').val(tipe_prgkt);
        $('#modal-xl').modal('hide');
      })
    })
  </script>

  <!-- JS Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
        theme: "classic"
      });
    });
  </script>
  
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '#pilih', function() {
        //var status_proses = $(this).data('pildok');
        var no_memo = $(this).data('pildok');
        var id_dok = $(this).data('id_dok');
        //$('#id_pildok').val(status_proses);
        $('#id_pildok').val(no_memo);
        //hidden 
        $('#id_pengajuan').val(id_dok);

        $.ajax({
          url: "<?php echo base_url('ajax/bagian_selected_biasa') ?>",
          type: 'POST',
          data: {
            'id_pengajuan': id_dok
          },
          success: function(result) {
            $("#bagian").html(result);
          }
        });
        $('#modal-xl1').modal('hide');
      })
    })
  </script>

  <script type="text/javascript">
    $(function() {
      $("#datatables1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>



</footer>

</html>