<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'laporan_tabel')) ?>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tabel Rekapitulasi Keluhan</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <form role="form" id="quickForm" action="" method="post">
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">Tahun</label>
                <div class="col-md-3">
                  <select class="form-control" name="tahun" id="tahun">
                    <option value=''>Pilih tahun</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </div>
            <div class="card-body">
            <div class="form-group">
              <div class="form-group row">
              <label class="col-sm-1 col-form-label">Laporan</label>
                <div class="col-md-3">
                  <select class="form-control laporan" name="laporan" id="laporan">
                    <option value=''>Pilih</option>
                    <option value='bagian'>Laporan Biaya Setiap Bagian</option>
                    <option value='layanan'>Laporan Biaya Setiap Layanan</option>                    
                    <option value='perangkat'>Laporan Biaya Setiap Perangkat</option>
                    <!-- <option value='pemel'>Laporan Biaya Pemeliharaan Inventaris</option> -->
                  </select>
                </div>
                <label class="col-sm-1 col-form-label bagian">Bagian</label>
                <div class="col-md-3 bagian">
                  <select class="form-control" name="bagian" id="bag" >
                    <option value=''>Pilih</option>
                    <option value='all'>Semua Bagian</option>
                    <?php
                    $kantor = $this->session->userdata('id_master_kantor');
                    $bagian = $this->m_kelola_tiket->tampil_bagian($kantor)->result();
                    foreach ($bagian as $bag) {
                      echo "<option value='" . $bag->id_bagian . "'>" . $bag->bagian . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <label class="col-sm-1 col-form-label perangkat">Perangkat</label>
                  <div class="col-md-3">
                    <select class="form-control" name="perangkat[]"  multiple="multiple" id="perangkat" >
                      <option value=''>Pilih</option>
                      <option value='all'>Semua Perangkat & Nama</option>
                      <?php
                      $id_departemen = $this->session->userdata('id_master_kantor');
                      $perangkat = $this->m_perangkat->tampil_aktif_perangkat($id_departemen)->result();
                      foreach ($perangkat as $nama) {
                        echo "<option value='" . $nama->nama_pengguna . "'>(" . $nama->no_prgkt_ti.") - (".$nama->nama_pengguna . ")</option>";
                      }
                      ?>
                    </select>
                  </div>
                <label class="col-sm-1 col-form-label bagian_multiple">Bagian</label>
                <div class="col-md-3">
                  <select class="form-control" name="bagian[]" id="bagian_multiple" multiple="multiple" >
                    <option value='all'>Semua Bagian</option>
                    <?php
                    $kantor = $this->session->userdata('id_master_kantor');
                    $bagian = $this->m_kelola_tiket->tampil_bagian($kantor)->result();
                    foreach ($bagian as $bag) {
                      echo "<option value='" . $bag->id_bagian . "'>" . $bag->bagian . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <label class=" col-sm-1 col-form-label pemel">Jenis Perangkat</label>
                    <div class="col-md-2">
                      <select class="form-control" name="pemel[]" id="pemel">
                        <option id='bagian_null' value=''>Pilih</option>
                        <option value='all'>Semua Perangkat</option>
                        <option value='1'>Laptop</option>
                        <option value='2'>Komputer</option>
                        <option value='3'>Printer</option>
                      </select>
                      </div>
                </div>
              </div>
            </div>
            <div style="padding-left: 20px;">
              <div class="form-group row">
                <label class=" col-sm-1 col-form-label layanan">Jenis Layanan</label>
                <div class="col-md-3">
                  <select class="form-control" name="layanan[]" multiple="multiple"  id="layanan">
                    <option id='bagian_null' value=''>Pilih</option>
                    <option value='all'>Semua Layanan</option>
                    <?php
                    $layanan = $this->m_master_layanan->tampil_master_layanan()->result();
                    foreach ($layanan as $lay) {
                      echo "<option value='" . $lay->jns_layanan . "'>" . $lay->jns_layanan . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <label class="col-form-label tanggal">Tanggal Awal</label>
                <div class="col-sm-2 tanggal">
                <input type="text" name="tgl_awal" class="form-control tanggal" id="datepicker" autocomplete="off" readonly required>
                </div>
                <label class="col-form-label tanggal">Tanggal Akhir</label>
                <div class="col-sm-2">
                <input type="text" name="tgl_akhir" class="form-control tanggal" id="datepicker1" autocomplete="off" readonly required>
                </div>
                <label class="col-form-label tahun">Tahun</label>
                <div class="col-sm-1 tahun">
                  <select class="form-control" name="tahun">
                    <?php 
                      for ($i=DATE("Y"); $i >= 2019; $i--) echo "<option value='".$i."'>".$i."</option>";
                    ?>
                  </select>
                </div>
                <label class="col-form-label cetak">Cetak</label>
                <div class="col-sm-1">
                  <select class="form-control cetak" name="cetak" id="tahun" required>
                    <option value=''>Pilih</option>
                    <option value="excel">Excel</option>
                    <!-- <option value="pdf">PDF</option> -->
                  </select>
                </div>
                <button type="submit" class="btn btn-primary cari">Cari</button>
              </div>
            </div>  
          </form>
          <div class="card">
            <div class="card-body">
              <table id="datatables" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode servis</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Bagian</th>
                    <th>Jenis Layanan</th>
                    <th>Jenis Perangkat</th>
                    <th>Uraian</th>
                    <th>Pelaksana</th>
                    <th>No SP/SPK</th>
                    <th>Biaya</th-->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($tampil as $k) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $k->kode_servis . '</td>';
                    echo "<td>";
                    echo date("d-m-Y H:i:s", strtotime($k->tanggal));
                    echo "</td>";
                    echo '<td>' . $k->nama . '</td>';
                    echo '<td>' . $k->bagian . '</td>';
                    echo '<td>' . $k->jns_kerusakan . '</td>';
                    echo '<td>' . $k->jns_prgkt . '</td>';
                    echo '<td>' . $k->uraian . '</td>';
                    echo '<td>' . $k->solusi . '</td>';
                    echo '<td>' . $k->no_spk . '</td>';
                    echo '<td>' . rupiah($k->biaya) . '</td>';
                    echo '</tr>';
                    $i++;
                  }
                  ?>
                </tbody>
              </table>
              <br>
              <hr>
              <b>Jumlah keluhan yang terselesaikan :
                <?php
                if ($kel_selesai > 0) {
                  echo $kel_selesai;
                  echo " keluhan";
                } else {
                  echo "0 keluhan";
                } ?> </b><br>
              <?php if ($kel_selesai > 0) { ?>
                <?php if ($jml_internal != null) { ?>
                  <b>Internal</b>
                  <table border="2" style="max-width:100%; white-space:nowrap;">
                    <tr>
                      <?php foreach ($jml_internal as $i) {
                        echo '<td>' . $i->jns_kerusakan . '</td>';
                      } ?>
                    </tr>
                    <tr>
                      <?php foreach ($jml_internal as $i) {
                        echo '<td>' . $i->Internal . '</td>';
                      } ?>
                    </tr>
                  </table>
                  <br>
                <?php } ?>
                <?php if ($jml_rekanan != null) { ?>
                  <b>Rekanan</b>
                  <table border="2" style="max-width:100%; white-space:nowrap;">
                    <tr>
                      <?php foreach ($jml_rekanan as $k) {
                        echo '<td>' . $k->jns_kerusakan . '</td>';
                      } ?>
                    </tr>
                    <tr>
                      <?php foreach ($jml_rekanan as $k) {
                        echo '<td>' . $k->Rekanan . '</td>';
                      } ?>
                    </tr>
                  </table><br><?php } ?>
                <table border-bottom: 1px solid #ddd; style="width: 50%;">
                  <?php
                  foreach ($b_layanan as $j) {
                    echo '<tr>';
                    echo "<td>";
                    echo "Total Biaya $j->jns_kerusakan";
                    echo "</td>";
                    echo "<td>";
                    echo ":";
                    echo rupiah($j->biaya);
                    echo "</td>";
                    echo '</tr>';
                  }
                  //
                  ?>
                </table>
                <b>_______________________________________________________________________ +</b>
              <?php } ?>
              <?php
              $bagian = $this->input->post('bagian');
              if ($bagian != null) { ?>
                <p>Total biaya yang dikeluarkan
                  <?php
                  if ($this->input->post()) {
                    $tahun = $this->input->post('tahun');
                  } else {
                    $tahun = (new DateTime)->format("Y");
                  }
                  if ($tahun != null) {
                    echo "tahun";
                    echo $tahun;
                  } ?> :
                  <?php
                  $a = 0;
                  foreach ($b_layanan as $j) {
                    $b = $j->biaya;
                    $a += $b;
                  }
                  echo "<td>";
                  echo rupiah($a);
                  echo "</td>";
                  echo '&nbsp;&nbsp;&nbsp;<b>(';
                  echo ucwords(terbilang($a)) . " Rupiah";
                  echo '<b>)'; ?>
                </p>
              <?php } ?>
                <?php
                if ($this->input->post()) {
                  $tahun = $this->input->post('tahun');
                } else {
                  $tahun = (new DateTime)->format("Y");
                }
                if ($tahun != null) {
                  echo "<p>Keseluruhan biaya yang dikeluarkan tahun ";
                  echo $tahun;
                  echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ";
                  foreach ($biaya_tahun as $obj) {
                    echo rupiah($obj->biaya);
                    echo '&nbsp;&nbsp;&nbsp;<b>(';
                    echo ucwords(terbilang($obj->biaya)) . " Rupiah";
                    echo '<b>)';
                  }
                }
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    $(function() {
      $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
      });
    });
  </script>
  <script>
    $(function() {
      $("#datepicker1").datepicker({
        dateFormat: 'dd-mm-yy',
      });
    });
  </script>
  <script>
    $(".bagian, .bagian_multiple, .layanan, .cetak, .tanggal, .perangkat, .cari, .pemel, #pemel, .tahun" ).hide();
    // if($('select').val()=='default'){
    // alert('Please, choose an option');
    // return false;
    // }
    $(".laporan").change(function()
    {
        var lap=$(".laporan" ).val();
       // console.log(lap);
        if(lap == "layanan")
        {
          $(".layanan" ).show();
          $(".cari" ).show();//button cari
          $(".cetak" ).show();// button cetak
          $(".tanggal" ).show();
          $(".bagian" ).hide();
          $(".bagian_multiple" ).hide();
          $(".tahun").hide();
          $("#bag").val('');
          $('#layanan').next(".select2-container").show();
          $('#perangkat').next(".select2-container").hide();
          $('#bagian_multiple').next(".select2-container").hide();
          $( ".perangkat" ).hide();
          $("#bagian_multiple").prop('required',false);
          $("#layanan").prop('required',true);
          $("#datepicker").prop('required',true); 
          $("#datepicker1").prop('required',true);
        }
        else if(lap == "bagian")
        {
          $( ".layanan" ).show(); // select layanan
          $(".cari" ).show(); // button cari
          $( ".cetak" ).show(); // button cetak
          $( ".tanggal" ).show();
          $( ".bagian" ).show(); //button bagian
          $(".bagian_multiple" ).hide();
          $(".tahun").hide();
          $('#layanan').next(".select2-container").show();
          $('#perangkat').next(".select2-container").hide();
          $('#bagian_multiple').next(".select2-container").hide();
          $( ".perangkat" ).hide();
          $("#bagian_multiple").prop('required',false);
          $("#layanan").prop('required',true);
        $("#datepicker").prop('required',true);
        $("#datepicker1").prop('required',true);
        $("#bag").prop('required',true);
        }
        else if(lap == "perangkat")
        {
          $( ".cetak" ).show();//button cetak 
          $(".cari" ).show(); //button cari
          $( ".tanggal" ).show(); //button tanggal
          $( ".bagian" ).show(); //button bagian
          $(".bagian_multiple" ).hide();
          $(".tahun").hide();
          $("#perangkat").next(".select2-container").show();
          $( ".perangkat" ).show();
          $("#layanan").next(".select2-container").hide();
          $( ".layanan" ).hide();
          $('#bagian_multiple').next(".select2-container").hide();
          $("#layanan, .layanan").val('');
          $("#bagian_multiple").prop('required',false);
          $("#perangkat").prop('required',true);
        $("#layanan").prop('required',false);
        $("#datepicker").prop('required',true);
        $("#datepicker1").prop('required',true);
        $("#bag").prop('required',true);
        }
        else if(lap == "pemel")
        {
          $( ".pemel" ).show();
          $(".cari" ).show();
          $( ".cetak" ).show();
          $( ".bagian" ).hide();
          $(".bagian_multiple" ).show();
          $('#bagian_multiple').next(".select2-container").show();
          $(".tahun").show();
          $('#pemel').show();;
          $("#pemel").prop('required',true);
          $("#bagian_multiple").prop('required',true);
          $("#bag").prop('required',false);
        }
        else
        {
          $(".bagian, .bagian_multiple, .layanan, .cetak, .tanggal, .perangkat, .cari, .pemel, .tahun" ).hide();
          $("#perangkat,#layanan,#bagian_multiple").next(".select2-container").hide();
        }
    });
  </script>
</body>
<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#perangkat,#layanan,#bagian_multiple").select2({
        theme: "classic"
      });
      $("#perangkat,#layanan,#bagian_multiple").next(".select2-container").hide();
    });
    
  </script>
</footer>

</html>