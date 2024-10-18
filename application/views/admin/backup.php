<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
        theme: "classic"
      });
    });
  </script>
  <script type="text/javascript">
    function f_sts_prngkt(a) {
      var x = a.value;
      if (x == 'mutasi') {

        /*$.ajax({
          url: "<!--?php echo base_url('ajax/bagian_baru_selected_perangkat') ?>",
          type: 'POST',
          data: {
            'id_bagian': '<!--?php echo $perangkat->id_bagian_baru ?>'
          },
          success: function(result) {
            document.getElementById("id_bagian_baru_2").innerHTML = result;
            //$("#id_bagian_baru").html(result);
          }
          //Select2

        });*/

        document.getElementById("id_bagian_baru").innerHTML = "<label class='col-sm-2 col-form-label'>Bagian Baru</label> <div class='col-sm-10'><select class='form-control col-md-10 js-example-basic-multiple-2' name='id_bagian_baru[]' multiple='multiple' required> <?php foreach ($bagian as $b) {
                                                                                                                                                                                                                                                                            echo "<option value='" . $b->id_bagian . "'>" . $b->bagian . "</option>";
                                                                                                                                                                                                                                                                          } ?> </select> </div>";
        $('.js-example-basic-multiple-2').select2({
          theme: "classic"
        });
        /*document.getElementById("id_bagian_baru").innerHTML = "<label class='col-sm-2 col-form-label'>Bagian Baru</label><div class='col-sm-10'><select class='form-control col-md-10' name='id_bagian_baru' id='id_bagian_baru'> <!--?php foreach($bagian as $f){ echo "<option value='".$f->id_bagian."'>".$f->bagian."</option>"; } ?> </select></div>";*/

        document.getElementById("id_no_inv_baru").innerHTML = "<label class='col-sm-2 col-form-label'>Nomor Inventaris Baru</label><div class='col-sm-10'><input type='text' class='form-control col-md-10' name='noprgkt_baru' id='id_noprgkt_baru' value='<?= $perangkat->no_prgkt_baru ?>'></div>";
      } else {
        document.getElementById("id_bagian_baru").innerHTML = ""
        document.getElementById("id_no_inv_baru").innerHTML = "";
      }
    }
  </script>