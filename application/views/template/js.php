  <!--script src="<?=base_url()?>assets/js/jquery.min.js"></script-->
  <script src="<?=base_url()?>assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?=base_url()?>assets/js/popper.min.js"></script>
  <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.easing.1.3.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.waypoints.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.stellar.min.js"></script>
  <script src="<?=base_url()?>assets/js/owl.carousel.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.magnific-popup.min.js"></script>
  <script src="<?=base_url()?>assets/js/aos.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.animateNumber.min.js"></script>
  <script src="<?=base_url()?>assets/js/scrollax.min.js"></script>
  <script src="<?=base_url()?>assets/js/main.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <script type="text/javascript">
   $( function() {
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordion" ).accordion({
      icons: icons
    });
    $( "#toggle" ).button().on( "click", function() {
      if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
        $( "#accordion" ).accordion( "option", "icons", null );
      } else {
        $( "#accordion" ).accordion( "option", "icons", icons );
      }
    });
  } );

    $(function() {
    $("#datatables").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

  $(document).ready(function(){
	var table = $('#datatables_antrian');
    var no=1;
	table.DataTable({
		'processing': true,
		'serverSide': true,
		'ordering': true,
		"bDestroy": true,
		'order': [[2, 'desc']],
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
            //{'data': 'email'},
            {'data': 'jns_kerusakan'},
            {'data': 'uraian'},
            {'data': 'status'}
		]
	});
});

</script>