<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'ubah_tiket')) ?>



</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Tiket Keluhan</h1>
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
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url() . 'Panel/ubah_aksi_tiket'; ?>">
              <input type="hidden" name="id_ajukan" value="<?= $kelola_tiket->id_ajukan ?>">
              <div class="card-body">
                <!--div class="form-group row">
                  <label for="tgl" class="col-sm-2 col-form-label">Tanggal</label>
                  <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" name="tgl" id="datetimepicker" value="<//?= $kelola_tiket->tanggal ?>" required>
                  </div>
                </div-->
                <div class="form-group row">
                  <label for="id_kd_servis" class="col-sm-2 col-form-label">Kode Servis</label>
                  <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" name="kd_servis" id="id_kd_servis" value="<?= $kelola_tiket->kode_servis ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_nama" class="col-sm-2 col-form-label">Nama *</label>
                  <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" name="nama" id="id_nama" value="<?= $kelola_tiket->nama ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bagian" class="col-sm-2 col-form-label">Bagian *</label>
                  <div class="col-sm-10" align="left">
                    <select name="bagian" class="form-control col-md-10" required>
                      <option value="">Pilih Bagian</option>
                      <?php
                      foreach ($bagian as $b) {
                        echo "<option value='" . $b->id_bagian . "'";
                        if ($b->id_bagian == $kelola_tiket->id_bagian) echo "selected";
                        echo ">" . $b->bagian . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                 <!--
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10" align="left">
                    <input type="email" class="form-control col-md-10" name="email" id="id_email" value="//$kelola_tiket->email ?>">
                  </div>
                </div>-->
                <div class="form-group row">
                  <label for="jns_kerusakan" class="col-sm-2 col-form-label">Jenis Layanan *</label>
                  <div class="col-sm-10" align="left">
                    <select class="form-control col-md-10" name="jns_kerusakan" id="id_jns_kerusakan" required>
                      <option value="">Pilih jenis layanan</option>
                      <?php
                      $layanan = $this->M_master_layanan->filter()->result();
                      //$data = $this->m_perangkat->max_number()->result();
                      foreach ($layanan as $lay) {
                        if ($kelola_tiket->jns_kerusakan == $lay->jns_layanan) {
                          echo "<option class='warna' value='" . $lay->jns_layanan . "' selected>"  . $lay->jns_layanan . "</option>";
                        } else {
                          echo "<option class='warna' value='" . $lay->jns_layanan . "'>"  . $lay->jns_layanan . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="konek" class="col-sm-2 col-form-label konek">Hardware/Software sudah terdaftar?</label>
                  <div class="col-sm-10" align="left">
                    <select class="form-control col-md-10" name="konek_master_perangkat" id="id_konek_m_perangkat">
                      <option value="">Pilih</option>
                      <option value="y" <?php if ($kelola_tiket->konek_had_soft == "y") echo "selected" ?>>Ya</option>
                      <option value="t" <?php if ($kelola_tiket->konek_had_soft == "t") echo "selected" ?>>Tidak</option>
                    </select>
                  </div>
                </div>
                <?php if ($kelola_tiket->jns_kerusakan == "hardware") {
                  echo "
                    <div class='form-group row'>
                    <label for='jns_prgkt' class='col-sm-2 col-form-label'>Jenis Perangkat</label>
                    <div class='col-sm-10' align='left'>
                    <select type='text' class='form-control col-md-10' name='id_master_jns' id='id_jns_prgkt'><option value=''>Pilih jenis perangkat</option>";
                  $id_master_jns = $this->m_master_jns->tampil_mstrjns()->result();
                  foreach ($id_master_jns as $j) {
                    echo "<option value='" . $j->id_master_jns . "'";
                    if ($j->id_master_jns == $kelola_tiket->id_master_jns) echo "selected";
                    echo ">" . $j->jns_prgkt . "</option>";
                  }
                  echo "</select>";
                  echo "</div>";
                  echo "</div>";
                } else {
                  echo "<input type='hidden' name='id_master_jns' id='id_jns_prgkt' value='$kelola_tiket->id_master_jns'>";
                }
                ?>
                <div class="form-group row">
                  <label for="uraian" class="col-sm-2 col-form-label">Uraian Kerusakan *</label>
                  <div class="col-sm-10" align="left">
                    <textarea type="text" class="form-control col-md-10" cols="10" rows="5" name="uraian" id="id_uraian" required><?php echo $kelola_tiket->uraian; ?></textarea>
                  </div>
                </div>
                <!--jns prgkt klo hardware belom-->

                <div class="form-group row">
                  <label for="pilprgkt" class="col-sm-2 col-form-label perangkat">Pilih Perangkat * </label>
                  <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" name="nama_prgkt" id="nama_pilprgkt" data-toggle="modal" data-target="#modal-xl2" placeholder="pilih perangkat" value="<?php echo ($this->m_perangkat->edit_perangkat($kelola_tiket->id_perangkat)->row() == NULL) ? "" : $this->m_perangkat->edit_perangkat($kelola_tiket->id_perangkat)->row()->jns_prgkt . '(' . $this->m_perangkat->edit_perangkat($kelola_tiket->id_perangkat)->row()->no_prgkt_ti . '-' . $this->m_perangkat->edit_perangkat($kelola_tiket->id_perangkat)->row()->no_prgkt_vendor . '' .   ")" ?>" style="caret-color: transparent !important;" onkeydown="return false;" autocomplete="off">
                    <!--value="<//?= $this->m_perangkat->edit_perangkat($kelola_tiket->id_perangkat)->row()->jns_prgkt ?>"-->
                    <input type="hidden" name="id_pilprgkt" id="id_pilprgkt" value="<?= $kelola_tiket->id_perangkat ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="prioritas" class="col-sm-2 col-form-label">Prioritas *</label>
                  <div class="col-sm-10" align="left">
                    <select class="form-control col-md-10" name="prioritas" id="id_prioritas" required>
                      <option value="">Pilih prioritas</option>
                      <option value="utama" <?php if ($kelola_tiket->prioritas == "utama") echo "selected" ?>>utama</option>
                      <option value="sedang" <?php if ($kelola_tiket->prioritas == "sedang") echo "selected" ?>>sedang</option>
                      <option value="rendah" <?php if ($kelola_tiket->prioritas == "rendah") echo "selected" ?>>rendah</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pengguna" class="col-sm-2 col-form-label">Kepentingan *</label>
                  <div class="col-sm-10" align="left">
                    <select class="form-control col-md-10" name="pengguna" id="id_pengguna" required>
                      <option value="">Pilih Kepentingan</option>
                      <option value="bagian" <?php if ($kelola_tiket->pengguna_layanan == "bagian") echo "selected" ?>>Bagian</option>
                      <option value="perusahaan" <?php if ($kelola_tiket->pengguna_layanan == "perusahaan") echo "selected" ?>>Perusahaan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_solusi" class="col-sm-2 col-form-label">Pelaksana *</label>
                  <div class="col-sm-10" align="left">
                    <select class="form-control col-md-10" name="solusi" id="id_solusi" OnChange="f_solusi(this)" required>
                      <option value="">Pilih Pelaksana</option>
                      <option value="Internal" <?php if ($kelola_tiket->solusi == "Internal") echo "selected" ?>>Internal</option>
                      <option value="Rekanan" <?php if ($kelola_tiket->solusi == "Rekanan") echo "selected" ?>>Rekanan</option>
                    </select>
                  </div>
                </div>
                <div id="id_rekanan"></div>
                <div class="form-group row">
                  <label for="id_status" class="col-sm-2 col-form-label">Status *</label>
                  <div class="col-sm-10" align="left">
                    <?php
                    $sts = $kelola_tiket->status;
                    // 1 berarti disabled
                    switch ($sts) {
                      case "":
                        $s_blm = 1;
                        $s_ant = 0;
                        $s_tgn = 0;
                        $s_sls = 0;
                        break;
                      case "Belum ditangani":
                        $s_blm = 0;
                        $s_ant = 0;
                        $s_tgn = 0;
                        $s_sls = 0;
                        break;
                      case "Antrian":
                        $s_blm = 0;
                        $s_ant = 0;
                        $s_tgn = 0;
                        $s_sls = 0;
                        break;
                      case "Sedang ditangani":
                        $s_blm = 0;
                        $s_ant = 0;
                        $s_tgn = 0;
                        $s_sls = 0;
                        break;
                      case "Selesai";
                        $s_blm = 0;
                        $s_ant = 0;
                        $s_tgn = 0;
                        $s_sls = 0;
                        break;
                    }
                    ?>
                    <select class="form-control col-md-10" name="status" id="id_status" OnChange="f_status(this)" required>
                      <option value="">Pilih status</option>
                      <!--onclick="alert_urut()"-->
                      <!-- <option value="Belum ditangani" <?php if ($kelola_tiket->status == "Belum ditangani") echo "selected" ?><?php if ($s_blm) echo "disabled" ?>>Belum ditangani</option> -->
                      <option value="Antrian" <?php if ($kelola_tiket->status == "Antrian") echo "selected" ?><?php if ($s_ant) echo "disabled" ?>>Antrian (Direspon)</option>
                      <option value="Sedang ditangani" <?php if ($kelola_tiket->status == "Sedang ditangani") echo "selected" ?><?php if ($s_tgn) echo "disabled" ?>>Sedang ditangani</option>
                      <option value="Selesai" <?php if ($kelola_tiket->status == "Selesai") echo "selected" ?><?php if ($s_sls) echo "disabled" ?>>Selesai</option>

                    </select>
                  </div>
                </div>
                <input type="hidden" class="form-control col-md-10" name="w_antrian" value="<?= $kelola_tiket->waktu_antrian ?>">
                <input type="hidden" class="form-control col-md-10" name="w_ditangani" value="<?= $kelola_tiket->waktu_ditangani ?>">
                <input type="hidden" class="form-control col-md-10" name="w_selesai" value="<?= $kelola_tiket->waktu_selesai ?>">
                <div id="id_biaya"></div>
                <div class="form-group row">
                  <label for="id_disposisi" class="col-sm-2 col-form-label">Disposisi Kepala Bagian</label>
                  <div class="col-sm-10" align="left">
                    <input type="text" class="form-control col-md-10" name="disposisi" id="id_disposisi" value="<?= $kelola_tiket->disposisi ?>">
                  </div>
                </div>
                <br>
                <b><i>NB : Pastikan data yang anda masukkan sudah lengkap dan benar</i></b>
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

  <!--Modal Pilih Perangkat-->
  <div class="modal fade" id="modal-xl2">
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
                <th>Tipe</th>
                <th>Nama Pengguna</th>
                <th>No. Perangkat TI</th>
                <th>No. Perangkat Vendor</th>
                <th>No. SP/SPK</th>
                <th>Bagian</th>
                <th>Status</th>
                <!--th>Bagian Baru</th>
                <th>No. Perangkat Baru</th-->
                <!--th style="width: 100px">QR Code</th-->
                <th>Pilih</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($perangkat as $p) { ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $this->m_master_prgkt->edit_mstrprgkt($p->id_master_prgkt)->row()->jns_prgkt ?></td>
                  <td><?= $this->m_perangkat->edit_perangkat($p->id_perangkat)->row()->tipe_prgkt ?></td>
                  <!--td><//?= $p->jns_prgkt ?></td>
                  <td><//?= $p->tipe_prgkt ?></td-->
                  <td><?= $p->nama_pengguna ?></td>
                  <td><?= $p->no_prgkt_ti ?></td>
                  <td><?= $p->no_prgkt_vendor ?></td>
                  <td><?= $p->no_spk ?></td>
                  <td><?= $p->bagian ?></td>
                  <td><?= $p->status ?></td>
                  <!--td><//?= $p->bagian_baru ?></td>
                  <td><//?= $p->no_prgkt_baru ?></td-->
                  <!--td>
                    <img style="width: 100px;" src="<//?php echo base_url() . 'assets/images/' . $p->qr_code; ?>">
                  </td-->
                  <td>
                    <button class="btn btn-xs btn-info" id="pilih" data-id_pilprgkt="<?= $p->id_perangkat ?>" data-no_prgkt_ti="<?= $p->no_prgkt_ti ?>" data-no_prgkt_vendor="<?= $p->no_prgkt_vendor ?>" data-nama_prgkt="<?= $this->m_master_prgkt->edit_mstrprgkt($p->id_master_prgkt)->row()->jns_prgkt ?>">
                      <i class="fa fa-check"></i>Pilih
                    </button>
                  </td>
                </tr>
              <?php
                $i++;
              } ?>
            </tbody>
          </table>
          <br><br>
          <?php if ($this->session->userdata('role') == 1) { ?>
            <b><i>NB: Klik tambah jika perangkat yang Anda cari tidak ada</i></b>
          <?php } ?>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <!--button type="button" class="btn btn-success">Tambah</button-->
          <?php if ($this->session->userdata('role') == 1) { ?>
            <?php $link = '?go=panel/ubah_tiket/' . $this->uri->segment(3); ?>
            <a class="btn btn-primary btn-lg" href="<?php echo base_url() ?>Panel/tambah_perangkat<?= $link ?>">Tambah</a>
            <!--setelah pindah halaman balik lagi kesini-->
          <?php } ?>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <script type="text/javascript">
    function f_solusi(a) {
      var x = a.value;
      console.log(x);
      if (x == 'Rekanan' || a == 'Rekanan') {
        document.getElementById("id_rekanan").innerHTML = "<div class='form-group row'> <label for='uraian_solusi' class='col-sm-2 col-form-label'>Uraian Solusi *</label> <div class='col-sm-10' align='left'> <textarea type='text' class='form-control col-md-10' cols='10' rows='5' name='uraian_solusi' id='id_uraian_solusi' placeholder='Masukkan solusi' required><?php echo $kelola_tiket->uraian_solusi; ?></textarea> </div></div> <div class='form-group row'> <label for='uraian_solusi' class='col-sm-2 col-form-label'>Root Cause Analysis *</label> <div class='col-sm-10' align='left'> <textarea type='text' class='form-control col-md-10' cols='10' rows='5' name='uraian_rca' id='id_rca' placeholder='Masukkan Root Cause Analysis' required><?php echo $kelola_tiket->uraian_rca; ?></textarea> </div></div><div class='form-group row'> <label for='vendor' class='col-sm-2 col-form-label'>Vendor *</label> <div class='col-sm-10' align='left'> <input type='text' class='form-control col-md-10' cols='10' rows='5' id='id_vendor' name='vendor' placeholder='vendor' value='<?= $kelola_tiket->vendor ?>' required> </div> </div> <div class='form-group row'> <label for='nosp' class='col-sm-2 col-form-label'>No SP/SPK *</label> <div class='col-sm-10' align='left'> <input type='text' class='form-control col-md-10' cols='10' rows='5' name='nospk' id='id_nosp' placeholder='No SP/SPK' value='<?= $kelola_tiket->no_spk ?>' required> </div> </div> <div class='form-group row'> <label for='uploadsp' class='col-sm-2 col-form-label'>Upload SP/SPK</label> <div class='col-sm-10' align='left'> <input type='file' class='form-control col-md-10' cols='10' rows='5' name='upload_spk' accept='image/jpg, image/jpeg, image/png, application/pdf'><input type='hidden'  id='lama'  name='lama'  value='<?= $kelola_tiket->upload_spk ?>'> </div> </div>";
      } else if (x == 'Internal' || a == 'Internal') {
        document.getElementById("id_rekanan").innerHTML = "<div class='form-group row'> <label for='id_nama_ti' class='col-sm-2 col-form-label'>Nama Petugas TI *</label> <div class='col-sm-10' align='left'> <input type='text' class='form-control col-md-10' name='nama_ti' id='id_nama_ti' value='<?= $kelola_tiket->nama_ti ?>' required> </div> </div><div class='form-group row'> <label for='uraian_solusi' class='col-sm-2 col-form-label'>Uraian Solusi *</label> <div class='col-sm-10' align='left'> <textarea type='text' class='form-control col-md-10' cols='10' rows='5' name='uraian_solusi' id='id_uraian_solusi' placeholder='Masukkan solusi' required><?php echo $kelola_tiket->uraian_solusi; ?></textarea> </div> </div><div class='form-group row'> <label for='rca' class='col-sm-2 col-form-label'>Root Cause Analysis *</label> <div class='col-sm-10' align='left'> <textarea type='text' class='form-control col-md-10' cols='10' rows='5' name='uraian_rca' id='id_rca' placeholder='Masukkan Root Cause Analysis' required><?php echo $kelola_tiket->uraian_rca; ?></textarea> </div> </div><div class='form-group row'> <label for='nosp' class='col-sm-2 col-form-label'>No Form Support *</label> <div class='col-sm-10' align='left'> <input type='text' class='form-control col-md-10' cols='10' rows='5' name='nospk' id='id_nosp' placeholder='No SP/SPK' value='<?= $kelola_tiket->no_spk ?>' required> </div> </div> <div class='form-group row'> <label for='uploadsp' class='col-sm-2 col-form-label'>Upload Form Support</label> <div class='col-sm-10' align='left'> <input type='file' class='form-control col-md-10' cols='10' rows='5' name='upload_spk' accept='image/jpg, image/jpeg, image/png, application/pdf'>";
      } else {
        document.getElementById("id_rekanan").innerHTML = "";
      }
    }
  </script>
  <?php
  // Awal form di load
  if ($kelola_tiket->solusi == "Rekanan") {
    echo '<script type="text/javascript">f_solusi("Rekanan");</script>';
  } else if ($kelola_tiket->solusi == "Internal") {
    echo '<script type="text/javascript">f_solusi("Internal");</script>';
  }
  ?>
  <script type="text/javascript">
    function f_status(b) {
      var y = b.value;
      if (y == 'Sedang ditangani' || b == 'Sedang ditangani') {
        document.getElementById("id_biaya").innerHTML = "<div class='form-group row'> <label class='col-sm-2 col-form-label'>Biaya</label> <div style='padding-left: 8px;'><input type='text' class='form-control' style='width: 50px;'  id='rp' name='rp' value='Rp' readonly> </div> <div><input type='text' style='width: 200px;' id='rupiah' name='biaya' class='form-control' placeholder='Biaya' value='<?= uang($kelola_tiket->biaya) ?>'> </div> </div>"; //oninput='do_formatRupiah()'
      } else if (y == 'Selesai' || b == 'Selesai') {
        document.getElementById("id_biaya").innerHTML = "<div class='form-group row'> <label class='col-sm-2 col-form-label'>Biaya</label> <div style='padding-left: 8px;'><input type='text' class='form-control' style='width: 50px;'  id='rp' name='rp' value='Rp' readonly> </div> <div><input type='text' style='width: 200px;' id='rupiah' name='biaya' class='form-control' placeholder='Biaya' value='<?= $kelola_tiket->biaya ?>'> </div> <div><input type='text' style='width: 50px;' id='formatrp' name='formatrp' class='form-control' value=',00' readonly> </div> </div>"; //oninput='do_formatRupiah()'
      } else {
        document.getElementById("id_biaya").innerHTML = "";
      }
    }

    //setting required perangkat soft dan had
    var jenis = $("#id_jns_kerusakan").val();
    // alert(jenis);
    if (jenis == "Software" || jenis == "Hardware") {
      //$("#nama_pilprgkt").prop('required',true);
      $("#nama_pilprgkt, .perangkat").show();
    } else {
      $("#nama_pilprgkt, .perangkat").hide();
      $("#id_konek_m_perangkat, .konek").hide();
      $("#nama_pilprgkt").prop('required', false);
    }

    $('#id_konek_m_perangkat').on('change', function() {
      var konek = $("#id_konek_m_perangkat").val();
      if (konek == "y") {
        $("#nama_pilprgkt, .perangkat").show();
        $("#nama_pilprgkt").prop('required', true);
      } else {
        $("#nama_pilprgkt, .perangkat").remove();
        $("#nama_pilprgkt").prop('required', false);
      }
      //alert(konek);
    });

    //select change jenis layanan
    $('#id_jns_kerusakan').on('change', function() {
      var jenis = $("#id_jns_kerusakan").val();
      if (jenis == "Software" || jenis == "Hardware") {
        $("#id_konek_m_perangkat, .konek").show();
        //$("#nama_pilprgkt, .perangkat").show();
        //$("#nama_pilprgkt").prop('required',true);
      } else {
        //$("#nama_pilprgkt, .perangkat").remove();
        $("#id_konek_m_perangkat, .konek").hide();

      }

      //alert(jenis);
    });
  </script>

  <?php
  // Awal form di load
  if ($kelola_tiket->status == "Sedang ditangani") {
    echo '<script type="text/javascript">f_status("Sedang ditangani");</script>';
  } else if ($kelola_tiket->status == "Selesai") {
    echo '<script type="text/javascript">f_status("Selesai");</script>';
  }
  ?>

</body>
<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>
  <!--rupiah>
  <script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
  </script>
  <rupiah-->

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table1').DataTable({
        "scrollX": true
      });
      $('#datetimepicker').datetimepicker({
        format: 'dd-mm-yyyy hh:ii'
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '#pilih', function() {
        var id_perangkat = $(this).data('id_pilprgkt');
        var nama_prgkt = $(this).data('nama_prgkt');
        var no_prgkt_ti = $(this).data('no_prgkt_ti');
        var no_prgkt_vendor = $(this).data('no_prgkt_vendor');

        //
        $('#nama_pilprgkt').val(nama_prgkt + '( ' + no_prgkt_ti + '-' + no_prgkt_vendor + ' )');
        $('#id_pilprgkt').val(id_perangkat);
        $('#modal-xl2').modal('hide');
      })
    })
  </script>
  <script>
    $(function() {
      $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy H:i'
      });
    });
  </script>
  <!--script type="text/javascript">
    function alert_urut() {
      var x = "Status yang diilih harus urut";
    }
  </script-->

</footer>

</html>