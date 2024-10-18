<!DOCTYPE html>
<html>
<footer class="main-footer">
  <strong>Hak Cipta &copy; 2023.</strong>
  PT Perkebunan Nusantara I.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<div id="base-url" data-url="<?= base_url(); ?>"></div>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!--script src="<//?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script-->
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!--script src="<?= base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script-->
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<!--Data Tables
<script src="https://cdn.datatables.net/v/bs4/dt-1.11.2/datatables.min.js"></script>-->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!--Validation-->
<script src="<?= base_url() ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!--Chart Js-->
<!--script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script-->

<script src="https://js.pusher.com/6.0/pusher.min.js"></script>

<!-- DateTimePicker-->
<script src="<?= base_url() ?>assets/datetimepicker/bootstrap-datetimepicker.min.js"></script>

<script>
  // Enable pusher logging - don't include this in production
  //Pusher.logToConsole = true;

  var pusher = new Pusher('ad8644ee3904a2aa602c', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    //alert(JSON.stringify(data));
    $.ajax({
      method: "POST",
      url: "<?= base_url('notifikasi/list_notifikasi') ?>",
      success: function(response) {
        $("#list-notifikasi").html(response);
      }
    })
  });
</script>


<script type="text/javascript">
  $(function() {
    $("#datatables").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

  $(document).ready(function(){
  	var baseUrl = $('#base-url').data('url'); //Mengambil data value base_url dri elemen html
	var table = $('#datatables-tiket');
	table.DataTable({
		'processing': true,
		'serverSide': true,
    "responsive": true,
      "autoWidth": false,
		'ordering': true,
		'order': [[0, 'desc']],
		'ajax': {
			'url': table.data('url'),
			'type': 'post'
		},
		'deferRender': true,
		'aLengthMenu': [[10, 15, 50], [10, 15, 50]],
		'columns': [
      {
            "render": function(data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
      },
			{'data': 'kode_servis'},
			{'data': 'tanggal'},
			{'data': 'nama'},
			{'data': 'nama_master_kantor_baru'},
			{'data': 'bagian'},
			{'data': 'jns_kerusakan'},
			{'data': 'uraian'},
			{'data': 'no_spk'},
			{'data': 'prioritas'},
			{
				'data': 'status',
				'render': function(data, type, row) {
					
					if (row.status == "") 
					{
						return '<td><span class="badge bg-danger">Menunggu</span></td>';
					} 
					else 
					{
						if(row.status === "Selesai")
						{
							return '<td><span class="badge bg-success">Selesai</span></td>';
						}
						else if(row.status == "Sedang ditangani")
						{
							return '<td><span class="badge bg-warning">Sedang Ditangani</span></td>';
						}
						else
						{
							return '<td><span class="badge bg-info">Antrian</span></td>';
						}
					}
				}
            },
			{
				'data': 'waktu_antrian',
				'render': function(data, type, row) {
					if (row.waktu_antrian!= null) 
					{
					    
					    return 'Tunggu <br>' + row.waktu_antrian + '</br>';
					
					//console.log(jarak_waktu("2023-12-06 14:30:02", "2023-12-06 16:30:02"));
					//Menampilkan isi tabel
					//tabelAntrian(row.tanggal, row.waktu_antrian);
					//console.log(row.tanggal);
					//console.log(row.waktu_antrian);

					}	
					else{
					    return 'Tunggu <br> 00:00:00 </br>';
					}
					
				}
            },
			{
				'data': 'waktu_ditangani',
				'render': function(data, type, row) {
					
					if (row.waktu_ditangani != null) 
					{
					    return 'Antrian <br>' + row.waktu_ditangani + '</br>';
						//return 'Antrian <br> (jarak_waktu(' + row.waktu_antrian + ', ' + row.waktu_ditangani + '))</br>';
						//return '<td> Antrian <br> (<?php //echo jarak_waktu(' . row.waktu_antrian . ', ' . row.waktu_ditangani . '); ?>)</br>';
					}	
					else{
					    return 'Antrian <br> 00:00:00 </br>';
					}
				}
            },
			{
				'data': 'waktu_selesai',
				'render': function(data, type, row) {
					
					if (row.waktu_selesai != null) 
					{
					    return 'Penanganan <br>' + row.waktu_selesai + '</br>';
						//return 'Penanganan <br> (jarak_waktu(' + row.waktu_ditangani + ', ' + row.waktu_selesai + '))</br>';
						//return '<td> Penanganan <br> (<?php //echo jarak_waktu(' . row.waktu_ditangani . ', ' . row.waktu_selesai . '); ?>)</br>';
					}	
					else{
					    return 'Penanganan <br> 00:00:00 </br>';
					}
				}
            },
            {
				'data': 'waktu_total',
				'render': function(data, type, row) {
					
					if (row.waktu_selesai != null) 
					{
					    return 'Total <br>' + row.waktu_total + '</br>';
						//return 'Penanganan <br> (jarak_waktu(' + row.waktu_ditangani + ', ' + row.waktu_selesai + '))</br>';
						//return '<td> Penanganan <br> (<?php //echo jarak_waktu(' . row.waktu_ditangani . ', ' . row.waktu_selesai . '); ?>)</br>';
					}				
					else{
					    return 'Total <br> 00:00:00 </br>';
					}
				}
            },
      		{'render': function(data, type, row){ //Tampilkan kolom Action
                if (row.status === "Sedang ditangani" || row.status === "Selesai") {
                    var html ='<a href="#" type="button" class="pilih-modal" data-toggle="modal" data-target="#PdfModal" role="button" data-id_ajukan="' + row.id_ajukan + '"><img src="' + baseUrl + 'assets/images/icon-print.png" alt="print" width="50" height="50"></a>';
                    html+= '<a id="detail" class="btn btn-info" data-toggle="modal" data-id_ajukan="'+row.id_ajukan+'" data-target="#modal-lg"><i class="fa fa-eye"></i></a>';
                    html+= '<a class="btn btn-warning" href="' + baseUrl + 'Panel/ubah_tiket/' + row.id_ajukan + '"><i class="fa fa-edit"></i></a>';
				    html+= '<a class="btn btn-danger" onclick="return confirm_delete()" href="' + baseUrl + 'Panel/hapus_tiket/' + row.id_ajukan + '"><i class="fa fa-trash"></i></a>';
                    return html;
                }

				var html = '<a id="detail" class="btn btn-info" data-toggle="modal" data-id_ajukan="'+row.id_ajukan+'" data-target="#modal-lg"><i class="fa fa-eye"></i></a>';
				html+= '<a class="btn btn-warning" href="' + baseUrl + 'Panel/ubah_tiket/' + row.id_ajukan + '"><i class="fa fa-edit"></i></a>';
				html+= '<a class="btn btn-danger" onclick="return confirm_delete()" href="' + baseUrl + 'Panel/hapus_tiket/' + row.id_ajukan + '"><i class="fa fa-trash"></i></a>';
				return html;
				}
			}

		],
		'initComplete': function(settings, json) {
            updateDataTable(settings);
        }
	});
});
	
function updateDataTable(settings) {
    const api = new $.fn.dataTable.Api(settings);

    const promiseAntrian = [];
    const promiseDitangani = [];
    const promiseSelesai = [];
    const promiseTotal = []
    api.rows().every(function () {
        const data = this.data();
        if (data.waktu_antrian != null) {
            const promise = new Promise((resolve, reject) => {
                jarak_waktu(data.tanggal, data.waktu_antrian)
                    .then(result => {
                        console.log('waktu',result);
                        resolve(result);
                    })
                    .catch(error => {
                        console.error('An error occurred:', error);
                        reject(''); // or handle the error as needed
                    });
            });

            promiseAntrian.push(promise);
        }
        if (data.waktu_ditangani != null) {
            const promise = new Promise((resolve, reject) => {
                jarak_waktu(data.waktu_antrian, data.waktu_ditangani)
                    .then(result => {
                        console.log('waktu',result);
                        resolve(result);
                    })
                    .catch(error => {
                        console.error('An error occurred:', error);
                        reject(''); // or handle the error as needed
                    });
            });

            promiseDitangani.push(promise);
        }
        if (data.waktu_selesai != null) {
            const promise = new Promise((resolve, reject) => {
                jarak_waktu(data.waktu_ditangani, data.waktu_selesai)
                    .then(result => {
                        console.log('waktu selesai',result);
                        resolve(result);
                    })
                    .catch(error => {
                        console.error('An error occurred:', error);
                        reject(''); // or handle the error as needed
                    });
            });

            promiseSelesai.push(promise);
            const promise2 = new Promise((resolve, reject) => {
                jarak_waktu(data.tanggal, data.waktu_selesai)
                    .then(result => {
                        console.log('waktu total',result);
                        resolve(result);
                    })
                    .catch(error => {
                        console.error('An error occurred:', error);
                        reject(''); // or handle the error as needed
                    });
            });

            promiseTotal.push(promise2);
        }
        
    });

    // Wait for all promises to resolve
    Promise.all(promiseAntrian)
        .then(results => {
            console.log(results)
            // Update the DataTable cells with the results
            api.rows().every(function (index) {
                const cell = api.cell(this,12)
                console.log(results[index],cell,cell.data());
                cell.data(results[index]);
            });
            console.log(results)
            // Redraw the DataTable after all promises have resolved
            //api.draw();
        })
        .catch(error => {
            console.error('An error occurred:', error);
        });
    Promise.all(promiseDitangani)
        .then(results => {
            console.log(results)
            // Update the DataTable cells with the results
            api.rows().every(function (index) {
                const cell = api.cell(this,13)
                console.log(results[index],cell,cell.data());
                cell.data(results[index]);
            });
            console.log(results)
            // Redraw the DataTable after all promises have resolved
            //api.draw();
        })
        .catch(error => {
            console.error('An error occurred:', error);
        });
    Promise.all(promiseSelesai)
        .then(results => {
            console.log(results)
            // Update the DataTable cells with the results
            api.rows().every(function (index) {
                const cell = api.cell(this,14)
                console.log(results[index],cell,cell.data());
                cell.data(results[index]);
            });
            console.log(results)
            // Redraw the DataTable after all promises have resolved
            //api.draw();
        })
        .catch(error => {
            console.error('An error occurred:', error);
        });
    Promise.all(promiseTotal)
        .then(results => {
            console.log(results)
            // Update the DataTable cells with the results
            api.rows().every(function (index) {
                const cell = api.cell(this,14)
                console.log(results[index],cell,cell.data());
                cell.data(results[index]);
            });
            console.log(results)
            // Redraw the DataTable after all promises have resolved
            //api.draw();
        })
        .catch(error => {
            console.error('An error occurred:', error);
        });
}


  $(document).ready(function(){
  var baseUrl = $('#base-url').data('url'); //Mengambil data value base_url dri elemen html
	var table = $('#datatables-kantor');
	table.DataTable({
		'processing': true,
		'serverSide': true,
		'ordering': true,
		'order': [[0, 'desc']],
		'ajax': {
			'url': table.data('url'),
			'type': 'post'
		},
		'deferRender': true,
		'aLengthMenu': [[10, 15, 50], [10, 15, 50]],
		'columns': [
      {
            "render": function(data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
      },
			{'data': 'nama_master_kantor'},
			{'data': 'kode_master_kantor'},
      {'render': function(data, type, row){ //Tampilkan kolom Action
				var html = '<a class="btn btn-sm badge-success float-left mr-2" href="' + baseUrl + 'Panel/ubah_kantor/' + row.id_master_kantor + '">Edit</a>';
				html += '<a class="btn btn-sm badge-danger float-left" href="' + baseUrl + 'Panel/hapus_kantor/' + row.id_master_kantor + '">Delete</a>';
				return html;
				}
			}

		]
	});
});

$(document).ready(function(){
  var baseUrl = $('#base-url').data('url'); //Mengambil data value base_url dri elemen html
	var table = $('#datatables-bagian');
	table.DataTable({
		'processing': true,
		'serverSide': true,
		'ordering': true,
		'order': [[0, 'desc']],
		'ajax': {
			'url': table.data('url'),
			'type': 'post'
		},
		'deferRender': true,
		'aLengthMenu': [[10, 15, 50], [10, 15, 50]],
		'columns': [
      {
            "render": function(data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
      },
			{'data': 'bagian'},
			{'data': 'kode_bag_baru'},
      {'data': 'nama_master_kantor_baru'},
      {'render': function(data, type, row){ //Tampilkan kolom Action
				var html = '<a class="btn btn-sm badge-success float-left mr-2" href="' + baseUrl + 'Panel/ubah_bagian/' + row.id_bagian + '">Edit</a>';
				html += '<a class="btn btn-sm badge-danger float-left" href="' + baseUrl + 'Panel/hapus_bagian/' + row.id_bagian + '">Delete</a>';
				return html;
				}
			}

		]
	});
}); 


  $(document).ready(function() {
    $('#datatables0').DataTable({
      "scrollX": true
    });
  });
  
  async function jarak_waktu(waktu1, waktu2) {
    //Convert date time ke date string JS
    //waktu1
    let [datePart1, timePart1] = waktu1.split(' ');
    let [year1, month1, day1] = datePart1.split('-').map(Number);
    let [hours1, minutes1] = timePart1.split(':').map(Number);
    month1--;

    //waktu2
    let [datePart2, timePart2] = waktu2.split(' ');
    let [year2, month2, day2] = datePart2.split('-').map(Number);
    let [hours2, minutes2] = timePart2.split(':').map(Number);
    month2--;

    //Contoh waktu INPUT
    let input_1 = new Date(year1, month1, day1, hours1, minutes1)
    let input_2 = new Date(year2, month2, day2, hours2, minutes2)

    // let input_1_hari = input_1.toLocaleDateString('id-ID', { weekday: 'long' });
    // let input_2_hari = input_2.toLocaleDateString('id-ID', { weekday: 'long' });

    //Menghitung jarak hari
    let jml_hari = Math.floor((input_2 - input_1) / (24 * 60 * 60 * 1000));

    //Set detik ke 0
    let detik = 0
    for(let i = 0; i <= jml_hari; i++) {
        //Skip untuk sabtu & minggu
        let input_1_hari = input_1.getDay();
        if (input_1_hari == 6 || input_1_hari == 0) {
            //Hari bergerak + 1
            input_1.setDate(input_1.getDate() + 1);
        } else {
            //Ambil jam kerja
            
            try {
                let harian_mulai = await getJamMasuk(input_1_hari);
                let harian_selesai = await getJamSelesai(input_1_hari);
    
                let temp_mulai = new Date(input_1.toDateString() + ' ' + harian_mulai);
                let temp_selesai = new Date(input_1.toDateString() + ' ' + harian_selesai);
                
                //Jika input(1) sebelum jam kerja
                if(input_1 < temp_mulai) {
                    //Skip
                } else {
                    //Jika hari pertama
                    if(i == 0 && i < jml_hari) {
                        detik += (temp_selesai - input_1) / 1000;
                    }
                    //Jika hari pertengahan
                    else if(i > 0 && i < jml_hari) {
                        detik += (temp_selesai - temp_mulai) / 1000;
                    }
                    //Jika hari terakhir
                    else if(i == jml_hari) {
                        let temp_jam_1 = (input_1 > temp_mulai) ? input_1 : temp_mulai;
                        let temp_jam_2 = (input_2 < temp_selesai) ? input_2 : temp_selesai;
    
                        detik += (temp_jam_2 - temp_jam_1) / 1000;
                    }
                }
            } catch(error) {
                console.error(error)
            }
            
            //Hari bergerak + 1
            input_1.setDate(input_1.getDate() + 1);
        }
    }

    if(detik >= 0) {
        return detik_to_teks(detik);
    } else {
        return detik_to_teks(0);
    }
}

function detik_to_teks(detik) {
    //24 jam = 86400 detik
    let days = Math.floor(detik / 86400);
    let remain = (days > 0) ? detik - (days * 86400) : detik;
    let hours = ('0' + Math.floor(remain / 3600)).slice(-2);
    let minutes = ('0' + Math.floor((remain / 60) % 60)).slice(-2);
    let seconds = ('0' + (remain % 60)).slice(-2);

    if (days === 0) {
        return `${hours}:${minutes}:${seconds}`;
    } else {
        return `${days} hr ${hours}:${minutes}:${seconds}`;
    }
}
  
  async function tabelAntrian(tanggal, waktuAntrian) {
        try {
            const result = await jarak_waktu(tanggal, waktuAntrian);
            console.log(`hasil: ${result}`);
            displayResult(result);
        } catch (error) {
            console.error('Terjadi kesalahan:', error);
        }
  }
  
  function displayResult(result) {
      const resultCell = $('<td>', { class: 'resultCell' });
	    return '<td> Tunggu <br>' + result + '</br></td>';
  }


async function getJamMasuk(hari) {
    try {
        let response = await fetch(`getJamMasuk/${hari}`);
        if (!response.ok) {
            throw new Error(`Terjadi kesalahan! status: ${response.status}`);
        }
        let data = await response.json();
        return data.harian_masuk;
    } catch (error) {
        console.error(error);
        throw error;
    }
}

async function getJamSelesai(hari) {
    try {
        let response = await fetch(`getJamSelesai/${hari}`);
        if (!response.ok) {
            throw new Error(`Terjadi kesalahan! status: ${response.status}`);
        }
        let data = await response.json();
        return data.harian_selesai;
    } catch (error) {
        console.error(error);
        throw error;
    }
}
</script>