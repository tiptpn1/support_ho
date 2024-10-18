<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_perangkat')) ?>
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
            <h1 class="m-0 text-dark">Ubah Perangkat</h1>
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
            <form class="form-horizontal" method="post" action="<?= base_url('Panel/ubah_aksi_perangkat') ?>">
              <input type="hidden" name="id_perangkat" value="<?= $perangkat->id_perangkat ?>">
              <div class="card-body">
                <div class="form-group row">
                  <label for="ubahjnsprgkat" class="col-sm-2 col-form-label">Jenis Perangkat</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id_master_prgkt" id="id_master_prgkt" value="<?= $perangkat->id_master_prgkt ?>">
                    <input type="text" class="form-control col-md-10" name="jns_prgkt" id="id_jns_prgkt" value="<?= $this->m_master_prgkt->edit_mstrprgkt($perangkat->id_master_prgkt)->row()->jns_prgkt ?>" data-toggle="modal" data-target="#modal-xl" style="caret-color: transparent !important;" onkeydown="return false;" autocomplete="off" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tipe" class="col-sm-2 col-form-label">Tipe</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control col-md-10" name="tipe" id="id_tipe" value="<?= $this->m_master_prgkt->edit_mstrprgkt($perangkat->id_master_prgkt)->row()->tipe_prgkt ?>" style="caret-color: transparent !important;" onkeydown="return false;" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_detail" class="col-sm-2 col-form-label">Detail</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control col-md-10" cols="10" rows="5" name="detail" id="id_detail"><?= $perangkat->detail ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="kepemilikan" class="col-sm-2 col-form-label">Kepemilikan</label>
                  <div class="col-sm-10">
                    <select class="form-control col-md-10" name="kepemilikan" id="id_kepemilikan" OnChange="f_kepemilikan(this)" required>
                      <option value=''>Pilih kepemilikan</option>
                      <option value="Sewa" <?php if ($perangkat->kepemilikan == "Sewa")  echo "selected" ?>>Sewa</option>
                      <option value="Inventaris" <?php if ($perangkat->kepemilikan == "Inventaris") echo "selected" ?>>Inventaris</option>
                      <option value="P"<?php if ($perangkat->kepemilikan == "P") echo "selected" ?>>Pribadi</option>
                    </select>
                  </div>
                </div>
                <div class="form-group" id="id_sewa"></div>
                <div class="form-group row">
                  <label for="nospk" class="col-sm-2 col-form-label">Nomor SP/SPK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control col-md-10" name="nospk" id="id_nospk" value="<?= $perangkat->no_spk ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nospk" class="col-sm-2 col-form-label">Tanggal Terima*</label>
                  <div class="col-sm-10">
                  <?php 
                  $tgl=$perangkat->tgl_terima;
                  $tgl_split=explode("-",$tgl);
                  $tgl_terima=$tgl_split[2]."-".$tgl_split[1]."-".$tgl_split[0];
                  ?>
                  <input type="text" name="tgl_terima" class="form-control col-md-10" id="datepicker" autocomplete="off" value="<?php print_r ($tgl_terima); ?>" readonly> 
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pildok" class="col-sm-2 col-form-label">Pilih Dokumen Pengajuan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control col-md-10" name="pildok" id="id_pildok" value="<?= $this->m_pengajuan->edit_pengajuan($perangkat->id_pengajuan)->row()->no_memo ?? '' ?>" data-toggle="modal" data-target="#modal-xl1" readonly>
                    <input type="hidden" name="id_pengajuan" id="id_pengajuan" value="<?= $perangkat->id_pengajuan ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bagian" class="col-sm-2 col-form-label">Bagian</label>
                  <div class="col-sm-10" id="bagian">
                    <select class="form-control col-md-10" name="id_bagian" required>
                    <?php
                    foreach ($bagian as $b) {
                      if ($b->id_bagian == $perangkat->id_bagian) {
                        echo "<option value='" . $b->id_bagian . "' selected>" . $b->bagian . "</option>";
                      } else {
                        echo "<option value='" . $b->id_bagian . "'>" . $b->bagian . "</option>";
                      }
                    }
                    ?>
                    </select>
                  </div>
                </div>
                <!--status cek lagi krn muncul pop up aktif,rusak,mutasi bukan aktif nonaktif-->
                <div class="form-group row">
                  <label for="status" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                    <!--select name="status_perangkat" class="form-control col-md-10" OnChange="f_sts_prngkt(this)" id="id_sts_prngkt">
                        <option value="aktif">Aktif</option>
                        <option value="rusak">Rusak</option>
                        <option value="mutasi">Mutasi</option>
                      </select-->

                    <select class="form-control col-md-10" name="status" id="id_sts_prngkt" required>
                      <option value=''>Pilih status</option>
                      <option value="aktif" <?php if ($perangkat->status == "aktif") echo "selected" ?>>Aktif</option>
                      <option value="rusak" <?php if ($perangkat->status == "rusak") echo "selected" ?>>Rusak</option>
                      <option value="non aktif" <?php if ($perangkat->status == "non aktif") echo "selected" ?>>Non Aktif</option>
                    </select>
                    <input type="hidden" name="qr_code">
                  </div>
                </div>
                <div class="form-group row">
                      <label for="level" class="col-sm-2 col-form-label">Level Kritis*</label>
                      <div class="col-sm-10">
                      <select class="form-control col-md-10" name="kritis" id="kritis" required>
                        <option value="1" <?php if ($perangkat->level == "1") echo "selected" ?>>Tidak Kritis</option>
                        <option value="2" <?php if ($perangkat->level == "2") echo "selected" ?>>Sedang</option>
                        <option value="3" <?php if ($perangkat->level == "3") echo "selected" ?>>Kritis</option>
                      </select>
                      </div>
                    </div>
                <div class="form-group row">
                  <label for="id_nama_pengguna" class="col-sm-2 col-form-label">Nama Pengguna</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control col-md-10" name="nama_pengguna" id="id_nama_pengguna" value="<?= $perangkat->nama_pengguna ?>">
                  </div>
                </div>

                <?php if ($perangkat->status == "mutasi") {
                  echo "<div class='form-group row'>
                    <label for='bagian_baru' class='col-sm-2 col-form-label'>Bagian Baru</label>
                    <div class='col-sm-10'>
                    <select class='form-control col-md-10' name='id_bagian_baru' required>";
                  foreach ($bagian as $b) {
                    echo "<option value='" . $b->id_bagian . "' selected>" . $b->bagian . "</option>";
                  }
                  echo "</select>
                    </div>
                  </div><div class='form-group row'>
                    <label for='noprgkt_baru' class='col-sm-2 col-form-label'>Nomor Perangkat Baru</label>
                    <div class='col-sm-10'>
                      <input type='text' class='form-control col-md-10' name='noprgkt_baru' id='id_noprgkt_baru' value='$perangkat->no_prgkt_baru''>
                    </div>
                  </div>";
                ?>
                  <!--?php endforeach; ?-->
                <?php } ?>


                </select>
                <!--div class="form-group row" id="id_bagian_baru_2"></div-->
                <div class="form-group row">
                  <label for="pildok">Apakah perangkat ini ingin dimutasi?  </label>
                  <div class="col-sm-10">
                    <table>
                      <tr>
                        <td><input type="radio" id="id_mutasi" name="mutasi" value="mutasi" OnChange="f_sts_prngkt(this)"><label for="id_mutasi">Ya</label></td>
                        <td><input type="radio" id="id_mutasi" name="mutasi" value="tidak" OnChange="f_sts_prngkt(this)"><label for="id_mutasi">Tidak</label></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="form-group row" id="id_bagian_baru"></div>
                <div class="form-group row" id="id_no_inv_baru"></div>
              </div>

              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <p>
                  <?php 
                    $nomor=$perangkat->no_prgkt_ti;
                    $nomor_split=explode("/",$nomor);
                    //print_r($nomor_split[1]); 
                    
                  ?> 
                </p>
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
                <th>Jenis Perangkat</th>
                <th>Tipe Perangkat</th>
                <th>Status</th>
                <th width="20px">Pilih</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data_perangkat as $p) { ?>
                <tr>
                  <td><?= $p->jns_prgkt ?></td>
                  <td><?= $p->tipe_prgkt ?></td>
                  <td><?= $p->status ?></td>
                  <td>
                    <button class="btn btn-xs btn-info" id="select" data-id_master_prgkt="<?= $p->id_master_prgkt ?>" data-jns="<?= $p->jns_prgkt ?>" data-tipe="<?= $p->tipe_prgkt ?>">
                      <i class="fa fa-check"></i>Pilih
                    </button>
                  </td>
                </tr>
              <?php } ?>
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
                    //if($pl->id_bagian_pengajuan ==)
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
                  <td><?= $terdaftar  . '/' . $pl->jumlah ?></td>
                  <td>
                    <?php if ($terdaftar == $pl->jumlah) {
                      echo '<button class="btn btn-xs btn-danger">
                      <i class="fa fa-check"></i>Penuh
                    </button>';
                    } else { ?>
                      <button class="btn btn-xs btn-info" id="pilih" data-pildok="<?= $pl->no_memo ?>" data-id_dok="<?= $pl->id_pengajuan ?>">
                        <i class="fa fa-check"></i>Pilih
                      </button>
                    <?php } ?>
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
</body>
<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>
  <script type="text/javascript">
    function f_sts_prngkt(a) {
      var x = a.value;
      if (x == 'mutasi') {
        document.getElementById("id_bagian_baru").innerHTML = "<label class='col-sm-2 col-form-label'>Bagian Baru</label> <div class='col-sm-10'><select class='form-control col-md-10' name='id_bagian_baru' id='id_bagian_baru'> <?php foreach ($bagian as $f) {
        echo "<option value='" . $f->id_bagian . "'>" . $f->bagian . "</option>";
        } ?> </select> </div></div>";
        document.getElementById("id_no_inv_baru").innerHTML = "<label class='col-sm-2 col-form-label'>Nomor Inventaris Baru</label><div class='col-sm-10'><input type='text' class='form-control col-md-10' name='noprgkt_baru' id='id_noprgkt_baru' value=''></div>";
      } else {
        document.getElementById("id_bagian_baru").innerHTML = ""
        document.getElementById("id_no_inv_baru").innerHTML = "";
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
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '#select', function() {
        var id_master_prgkt = $(this).data('id_master_prgkt');
        var jns_prgkt = $(this).data('jns');
        var tipe_prgkt = $(this).data('tipe');
        var status = $(this).data('status');

        $('#id_master_prgkt').val(id_master_prgkt);
        $('#id_jns_prgkt').val(jns_prgkt);
        $('#id_tipe').val(tipe_prgkt);
        //$('#id_sts_prngkt').val(status);
        $('#modal-xl').modal('hide');
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

  <!--script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '#pilih', function() {
        var status_proses = $(this).data('pildok');
        $('#id_pildok').val(status_proses);
        $('#modal-xl1').modal('hide');
      })
    })
  </script-->

  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '#pilih', function() {
        //var status_proses = $(this).data('pildok');
        var no_memo = $(this).data('pildok'); //no memo
        var id_dok = $(this).data('id_dok'); //id pengajuan
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
<?php 
  $nomor=$perangkat->no_prgkt_ti;
  //print_r($nomor);
  //die();
?>
  <script type="text/javascript">
  $( document ).ready(function() {
    var x = "<?php echo $perangkat->kepemilikan; ?>";
    $("#id_kepemilikan").val(x);
    if (x == "Sewa") {
        document.getElementById("id_sewa").innerHTML = "<div class='form-group row'><label class='col-sm-2 col-form-label'>Nomor Perangkat TI</label><div class='col-sm-10'><table><tr><td><input type='text' name='nomor' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[0] ?>'/></td><td><input type='text' class='form-control' name='milik' id='id_noprgkt_ti' value='<?= $nomor_split[1] ?>' readonly/></td><td><input type='text' name='bulan' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[2] ?>' readonly /></td><td><input type='text'  class='form-control' name='tahun' id='id_noprgkt_ti' value='<?= $nomor_split[3] ?>' readonly/></td></tr></table></div></div> <div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Perangkat Sewa Dari Vendor</label><div class='col-sm-10'> <input type='text' name='noprgkt_vendor' class='form-control col-md-10' id='id_noprgkt_vendor' value='<?= $perangkat->no_prgkt_vendor ?>'/> </div></div>";
      //alert("SW");
      } else if (x == "Inventaris"){
       // alert("INV");
        document.getElementById("id_sewa").innerHTML = "<div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Perangkat TI</label><div class='col-sm-10'><table><tr><td><input type='text' name='nomor' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[0] ?>'/></td><td><input type='text' class='form-control' name='milik' id='id_noprgkt_ti' value='<?= $nomor_split[1] ?>' readonly/></td><td><input type='text' name='bulan' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[2] ?>' readonly /></td><td><input type='text'  class='form-control' name='tahun' id='id_noprgkt_ti' value='<?= $nomor_split[3] ?>' readonly/></td></tr></table> </div></div> <div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Inventaris</label><div class='col-sm-10'> <input type='text' name='no_inventaris' class='form-control col-md-10' id='id_no_inventaris' value='<?= $perangkat->no_inventaris ?>'/> </div></div>";
      } else if (x == "P"){
        document.getElementById("id_sewa").innerHTML = "<div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Perangkat Pribadi</label><div class='col-sm-10'><table><tr><td><input type='text' name='nomor' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[0] ?>'/></td><td><input type='text' class='form-control' name='milik' id='id_noprgkt_ti' value='<?= $nomor_split[1] ?>' readonly/></td><td><input type='text' name='bulan' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[2] ?>' readonly /></td><td><input type='text'  class='form-control' name='tahun' id='id_noprgkt_ti' value='<?= $nomor_split[3] ?>' readonly/></td></tr></table> </div></div> <div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Inventaris</label><div class='col-sm-10'> <input type='text' name='no_inventaris' class='form-control col-md-10' id='id_no_inventaris' value='<?= $perangkat->no_inventaris ?>'/> </div></div>";
        //alert("kosong");
      }
      else{
        document.getElementById("id_sewa").innerHTML = "";
         //alert("kosong")
      }
});
    function f_kepemilikan(a) {
      var x = a.value;
    //alert(x);
      if (x == "Sewa") {
        document.getElementById("id_sewa").innerHTML = "<div class='form-group row'><label class='col-sm-2 col-form-label'>Nomor Perangkat TI</label><div class='col-sm-10'><table><tr><td><input type='text' name='nomor' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[0] ?>'/></td><td><input type='text' class='form-control' name='milik' id='id_noprgkt_ti' value='<?= $nomor_split[1] ?>' readonly/></td><td><input type='text' name='bulan' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[2] ?>' readonly /></td><td><input type='text'  class='form-control' name='tahun' id='id_noprgkt_ti' value='<?= $nomor_split[3] ?>' readonly/></td></tr></table></div></div> <div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Perangkat Sewa Dari Vendor</label><div class='col-sm-10'> <input type='text' name='noprgkt_vendor' class='form-control col-md-10' id='id_noprgkt_vendor' value='<?= $perangkat->no_prgkt_vendor ?>'/> </div></div>";
      //alert("SW");
      } else if (x == "Inventaris"){
       // alert("INV");
        document.getElementById("id_sewa").innerHTML = "<div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Perangkat TI</label><div class='col-sm-10'><table><tr><td><input type='text' name='nomor' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[0] ?>'/></td><td><input type='text' class='form-control' name='milik' id='id_noprgkt_ti' value='<?= $nomor_split[1] ?>' readonly/></td><td><input type='text' name='bulan' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[2] ?>' readonly /></td><td><input type='text'  class='form-control' name='tahun' id='id_noprgkt_ti' value='<?= $nomor_split[3] ?>' readonly/></td></tr></table> </div></div> <div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Inventaris</label><div class='col-sm-10'> <input type='text' name='no_inventaris' class='form-control col-md-10' id='id_no_inventaris' value='<?= $perangkat->no_inventaris ?>'/> </div></div>";
      } else if (x == "P"){
        document.getElementById("id_sewa").innerHTML = "<div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Perangkat Pribadi</label><div class='col-sm-10'><table><tr><td><input type='text' name='nomor' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[0] ?>'/></td><td><input type='text' class='form-control' name='milik' id='id_noprgkt_ti' value='<?= $nomor_split[1] ?>' readonly/></td><td><input type='text' name='bulan' class='form-control' id='id_noprgkt_ti' value='<?= $nomor_split[2] ?>' readonly /></td><td><input type='text'  class='form-control' name='tahun' id='id_noprgkt_ti' value='<?= $nomor_split[3] ?>' readonly/></td></tr></table> </div></div> <div class='form-group row'> <label class='col-sm-2 col-form-label'>Nomor Inventaris</label><div class='col-sm-10'> <input type='text' name='no_inventaris' class='form-control col-md-10' id='id_no_inventaris' value='<?= $perangkat->no_inventaris ?>'/> </div></div>";
        //alert("kosong");
      }
      else{
        document.getElementById("id_sewa").innerHTML = "";
         //alert("kosong")
      }
    }
  </script>
  <?php
  // Awal form di load
  // if ($perangkat->kepemilikan == "Sewa") {
  //   echo '<script type="text/javascript">f_kepemilikan("Sewa");</script>';
  // } else if ($perangkat->kepemilikan == "Inventaris") {
  //   echo '<script type="text/javascript">f_kepemilikan("Inventaris");</script>';
  // }else{
  //   echo '<script type="text/javascript">f_kepemilikan("P");</script>';
  // }
  ?>


</footer>

</html>