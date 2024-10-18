//JANGAN DIHAPUUUSSSSSSSSSSSSSS!
<?php
                      $i=1;
                      foreach($kelola_tiket as $k){
                        //Hitung waktu
                        /*$tmp_tunggu     = hitung_waktu($k->waktu_ditangani, $k->tanggal);
                        $tmp_penanganan = hitung_waktu($k->waktu_selesai, $k->waktu_ditangani);
                        $tmp_total      = hitung_waktu($k->waktu_selesai, $k->tanggal);
                        $tmp_waktu      = "Waktu tunggu : ".$tmp_tunggu. "<br>".
                                        "Waktu penanganan : ".$tmp_penanganan. "<br>".
                                        "Waktu total : ".$tmp_total;*/
                        //
                        if($k->status==NULL){ 
                          $tmp_waktu      = "";
                        }else if($k->status=="Belom ditangani"){
                          $tmp_waktu      = "";
                        }else if($k->status=="Sedang ditangani"){
                          $tmp_tunggu     = hitung_waktu($k->waktu_ditangani, $k->tanggal);
                          $tmp_waktu      = "Waktu tunggu : ".$tmp_tunggu. "<br>";
                        }else{
                          $tmp_tunggu     = hitung_waktu($k->waktu_ditangani, $k->tanggal);
                          $tmp_penanganan = hitung_waktu($k->waktu_selesai, $k->waktu_ditangani);
                          $tmp_total      = hitung_waktu($k->waktu_selesai, $k->tanggal);
                          $tmp_waktu      = "Waktu tunggu : ".$tmp_tunggu. "<br>".
                                            "Waktu penanganan : ".$tmp_penanganan. "<br>".
                                            "Waktu total : ".$tmp_total;
                        }
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        
                        echo '<td>'.$k->tanggal.'</td>';
                        echo '<td>'.$k->nama.'</td>';
                        echo '<td>'.$k->bagian.'</td>';
                        echo '<td>'.$k->email.'</td>';
                        echo '<td>'.$k->jns_kerusakan.'</td>';
                        echo '<td>'.$k->jns_prgkt.'</td>';
                        echo '<td>'.$k->uraian.'</td>';
                        echo '<td>'.$k->jns_prgkt.'</td>';
                        echo '<td>'.$k->kode_servis.'</td>';
                        echo '<td>'.$k->prioritas.'</td>';
                        echo '<td>'.$k->pengguna_layanan.'</td>';
                        echo '<td>'.$k->solusi.'</td>';
                        echo '<td>'.$k->biaya.'</td>';
                        echo '<td>'.$k->no_spk.'</td>';
                        echo '<td>'.$k->status.'</td>';
                        echo '<td>'.$tmp_waktu.'</td>';
                        echo "
                          <td>
                            <a class='btn btn-warning' href='".base_url('Admin/ubah_tiket/').$k->id_ajukan."'>Ubah</a>
                            <a class='btn btn-danger' onclick='return confirm_delete()' href='".base_url('Admin/hapus_tiket/').$k->id_ajukan."'>Hapus</a>
                          </td>";
                        echo '</tr>';
                        $i++;
                  }
                  ?>
                  <!--tr>
                    <td>001</td>
                    <td>12 maret 2020</td>
                    <td>Angga</td>
                    <td>Sekper</td>
                    <td>angga@gmail.com</td>
                    <td>software</td>
                    <td>Utama</td>
                    <td>Belom ditangani</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">Detail</button><br><br>
                          <a class="btn btn-warning" href="<?php //echo base_url(); ?>Admin/ubah_tiket">Ubah</a><br><br>
                          <a class="btn btn-danger" onclick="confirm_delete()">Hapus</a>
                    </td>
                  </tr-->