<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/navigation_admin.php", array('page' => 'laporan_grafik')) ?>
  <script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-piechart-outlabels"></script>
</head>

<body>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Grafik</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <form role="form" id="quickForm" method="post" action="">
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">Tahun</label>
                <div class="col-md-3">
                  <select class="form-control" name="tahun" id="tahun" required>
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
          </form>
          <!--mulai grafik-->
          <div class="accordion" id="accordionExample">
            <!--<div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Grafik Batang Jenis Layanan Yang Sering Bermasalah di PT APN ditangani oleh rekanan
                  </button>
                </h2>
              </div>

               <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                   BAR CHART rekanan
                  <button type="submit" class="btn btn-primary" onclick="cetak_batang()">Export to PDF</button>
                  <canvas id="barChart" style="position: relative; height:50vh; width:70vw"></canvas>
                  <?php
                  // $layanan = "";
                  // $jumlah = null;
                  // foreach ($hasil_rekanan as $k) {
                  //   $jns = $k->jns_kerusakan;
                  //   $layanan .= "'$jns'" . ", ";
                  //   $jum = $k->Rekanan;
                  //   $jumlah .= "$jum" . ", ";
                  // }
                  //
                  ?>
                </div>
              </div> 
            </div>-->
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    Grafik Batang Jenis Layanan Yang Sering Bermasalah di PT Perkebunan Nusantara I ditangani oleh Internal & Rekanan
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <!-- BAR CHART internal-->
                  <button type="submit" class="btn btn-primary" onclick="cetak_batang1()">Export to PDF</button>
                  <canvas id="barChart3" style="position: relative; height:50vh; width:70vw"></canvas>
                  <?php
                  $layanan1 = null;
                  $jumlah1 = null;
                  $jumlah2 = null;
                  foreach ($hasil_inex as $i) {
                    $jns1 = $i->jns_kerusakan;
                    $layanan1 .= "'$jns1'" . ", ";
                    $jum1 = $i->Internal;
                    $jum2 = $i->Rekanan;
                    $jumlah1 .= "$jum1" . ", ";
                    $jumlah2 .= "$jum2" . ", ";
                    //cb
                  }
                  ?>
                  <hr>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Grafik Batang Total Biaya di PT Perkebunan Nusantara I
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  <!-- BAR CHART JNS LAYANAN-->
                  <button type="submit" class="btn btn-primary" onclick="cetak_batang2()">Export to PDF</button>
                  <canvas id="barChart4" style="position: relative; height:50vh; width:70vw"></canvas>
                  <?php
                  $g = "";
                  $jml2 = null;
                  foreach ($bar_biaya as $i) {
                    $bagian1  = $i->bagian;
                    $g       .= "'$bagian1'" . ", ";
                    $jum2     = $i->biaya;
                    $jml2    .= "$jum2" . ", ";
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Grafik Pie Permintaan Support TI dari Bagian, dan Unit Kerja PT Perkebunan Nusantara I
                  </button>
                </h2>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                  <!-- PIE CHART LAYANAN-->
                  <button type="submit" class="btn btn-primary" onclick="cetak_pie()">Export to PDF</button>
                  <canvas id="outlabeledChart" style="position: relative; height:200vh; width:220vw"></canvas>
                  <?php
                  $bg = "";
                  $kel = null;
                  foreach ($pie_keluhan as $x) {
                    $bagian2  = $x->bagian;
                    $bg      .= "'$bagian2'" . ", ";
                    $tot1    = $x->total_bagian;
                    $kel    .= "$tot1" . ", ";
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Grafik Pie Layanan Yang Paling Mengeluarkan Biaya di PT Perkebunan Nusantara I
                  </button>
                </h2>
              </div>
              <!--baru-->

              <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body">
                  <button type="submit" class="btn btn-primary" onclick="cetak_pie1()">Export to PDF</button>
                  <canvas id="outlabeledChart1" class="chartjs-render-monitor" style="position: relative; height:200vh; width:220vw"></canvas>

                  <?php
                  $a = "";
                  $total = null;
                  foreach ($pie_biaya as $j) {
                    $jenis = $j->jns_kerusakan;
                    $a .= "'$jenis'" . ", ";
                    $jml = $j->biaya;
                    $total .= "$jml" . ", ";
                    $hasil_label = "a";
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>

<footer>
  <?php $this->load->view("admin/footer_admin.php") ?>
  <script>
    function cetak_batang() {
      var canvas = document.getElementById('barChart');
      var imgData = canvas.toDataURL("image/jpeg", 1.0);
      var pdf = new jsPDF('landscape');

      pdf.addImage(imgData, 'JPEG', 20, 20, 220, 130);
      pdf.save("Grafik layanan yang sering bermasalah rekanan.pdf");
    }
    //jns layanan yg srg bermasalah
    var ctx = document.getElementById("barChart").getContext('2d');
    var barChart1 = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php echo $layanan; ?>],
        datasets: [{
          label: 'Rekanan',
          data: [<?php echo $jumlah; ?>],
          backgroundColor: "#e83112",
          borderColor: "#a7c584",
          borderWidth: 1,
        }, ],
      },
      options: {
        title: {
          display: true,
          fontSize: 20,
          text: 'Grafik Batang Jenis Layanan Yang Sering Bermasalah di PT Perkebunan Nusantara I yang ditangani oleh Vendor'
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              chartArea: {
                backgroundColor: 'white'
              }
            }
          }]
        }
      }
    });
    var backgroundColor = 'white';
    Chart.plugins.register({
      beforeDraw: function(c) {
        var ctx = c.chart.ctx;
        ctx.fillStyle = backgroundColor;
        ctx.fillRect(0, 0, c.chart.width, c.chart.height);
      }
    });
  </script>

  <script>
    function cetak_batang1() {
      var canvas = document.getElementById('barChart3');
      var imgData = canvas.toDataURL("image/jpeg", 1.0);
      var pdf = new jsPDF('landscape');

      pdf.addImage(imgData, 'JPEG', 20, 20, 220, 130);
      pdf.save("Grafik layanan yang sering bermasalah Internal & Rekanan.pdf");
    }

    //jns layanan yg srg bermasalah
    var ctx = document.getElementById("barChart3").getContext('2d');
    var barChart3 = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php echo $layanan1; ?>],
        datasets: [{
            label: 'Internal',
            data: [<?php echo $jumlah1; ?>],
            backgroundColor: "#334fab",
            borderColor: "#f7f8fc",
            borderWidth: 1
          },
          {
            label: 'Rekanan',
            data: [<?php echo $jumlah2; ?>],
            backgroundColor: "#14e810",
            borderColor: "#f7f8fc",
            borderWidth: 1
          }
        ],
      },
      options: {
        title: {
          display: true,
          fontSize: 14,
          text: 'Grafik Batang Jenis Layanan Yang Sering Bermasalah di PT Perkebunan Nusantara I ditangani oleh Internal & Rekanan'
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
    var backgroundColor = 'white';
    Chart.plugins.register({
      beforeDraw: function(c) {
        var ctx = c.chart.ctx;
        ctx.fillStyle = backgroundColor;
        ctx.fillRect(0, 0, c.chart.width, c.chart.height);
      }
    });
  </script>

  <script>
    function cetak_batang2() {
      var canvas = document.getElementById('barChart4');
      var imgData = canvas.toDataURL("image/jpeg", 1.0);
      var pdf = new jsPDF('landscape');

      pdf.addImage(imgData, 'JPEG', 20, 20, 220, 130);
      pdf.save("Grafik Batang Total Biaya.pdf");
    }
    //jns layanan yg srg bermasalah
    var ctx = document.getElementById("barChart4").getContext('2d');
    var barChart1 = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php echo $g; ?>],
        datasets: [{
          label: 'Data biaya',
          data: [<?php echo $jml2; ?>],
          backgroundColor: "#82ca20",
          borderColor: "#c39797",
          borderWidth: 1
        }]
      },
      options: {
        title: {
          display: true,
          fontSize: 20,
          text: 'Grafik Batang Total Biaya di PT Perkebunan Nusantara I'
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
    var backgroundColor = 'white';
    Chart.plugins.register({
      beforeDraw: function(c) {
        var ctx = c.chart.ctx;
        ctx.fillStyle = backgroundColor;
        ctx.fillRect(0, 0, c.chart.width, c.chart.height);
      }
    });
  </script>

  <script>
    //contoh
    var ctx = document.getElementById("barChart1").getContext('2d');
    var barChart1 = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 23, 2, 3],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        title: {
          display: true,
          fontSize: 20,
          text: 'Grafik Batang Total Biaya di PT Perkebunan Nusantara I'
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  </script>

  <script id="script-construct">
    function cetak_pie() {
      var canvas = document.getElementById('outlabeledChart');
      var imgData = canvas.toDataURL("image/jpeg", 1.0);
      var pdf = new jsPDF('landscape');

      pdf.addImage(imgData, 'JPEG', 20, 20, 220, 130);
      pdf.save("Grafik Pie Bagian Yang Paling Banyak Keluhan.pdf");
    }
    var chart = new Chart('outlabeledChart', {
      type: 'outlabeledPie',
      data: {
        labels: [<?php echo $bg ?>],
        datasets: [{
          backgroundColor: [
            '#FF3784',
            '#36A2EB',
            '#4BC0C0',
            '#F77825',
            '#9966FF',
            '#00A8C6',
            '#379F7A',
            '#CC2738',
            '#8B628A',
            '#8FBE00'
          ],
          data: [<?php echo $kel; ?>]
        }]
      },
      options: {
        title: {
          display: true,
          fontSize: 20,
          text: 'Grafik Pie Permintaan Support TI dari Bagian, dan Unit Kerja PT Perkebunan Nusantara I'
        },
        zoomOutPercentage: 55, // makes chart 55% smaller (50% by default, if the preoprty is undefined)
        plugins: {
          legend: false,
          outlabels: {
            text: '%l %p => %v',
            color: 'white',
            stretch: 45,
            font: {
              resizable: true,
              minSize: 12,
              maxSize: 18
            }
          }
        }
      }
    });
  </script>
  <script id="script-construct">
    function cetak_pie1() {
      var canvas = document.getElementById('outlabeledChart1');
      var imgData = canvas.toDataURL("image/jpeg", 1.0);
      var pdf = new jsPDF('landscape');

      pdf.addImage(imgData, 'JPEG', 20, 20, 220, 130);
      pdf.save("Grafik Pie Layanan Yang Paling Mengeluarkan Biaya.pdf");
    }
    var chart = new Chart('outlabeledChart1', {
      type: 'outlabeledPie',
      data: {
        labels: [<?php echo $a ?>],
        datasets: [{
          backgroundColor: [
            '#FF3784',
            '#36A2EB',
            '#4BC0C0',
            '#F77825',
            '#9966FF',
            '#00A8C6',
            '#379F7A',
            '#CC2738',
            '#8B628A',
            '#8FBE00'
          ],
          data: [<?php echo $total; ?>]
        }]
      },
      options: {
        title: {
          display: true,
          fontSize: 20,
          text: 'Grafik Pie Layanan Yang Paling Mengeluarkan Biaya di PT Perkebunan Nusantara I'
        },
        zoomOutPercentage: 55, // makes chart 55% smaller (50% by default, if the preoprty is undefined)
        plugins: {
          legend: false,
          outlabels: {
            text: '%l %p => %v',
            color: 'white',
            stretch: 45,
            font: {
              resizable: true,
              minSize: 12,
              maxSize: 18
            }
          }
        }
      }
    });
  </script>