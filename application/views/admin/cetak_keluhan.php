<html>

<head>

</head>

<body>

    <table align="center" width="100%" bordercolor="#000000">
        <tr>
            <td>
                <table width="100%" border="1" bordercolor="#000000">
                    <tr>
                        <td width="31%" align="center">PT Perkebunan Nusantara I<br />
                            <?php echo $this->m_kelola_tiket->ambil_nama_kantor($data->id_ajukan)->row()->alamat_kantor ?>
                        </td>
                        <td width="25%" align="center"><strong class="style17">FORM<br />IT Support Request
                            </strong></td>
                        <td width="30%" class="style17">
                            <table>
                                <tr>
                                    <td>No</td>
                                    <?php
                                    //$kelola_tiket = $this->M_kelola_tiket->tampil_kelola_tiket()->result();
                                    //print_r($data->format_nomor);
                                    //die();
                                    ?>
                                    <td>:
                                        <?php
                                        if ($data->format_nomor == null) { ?>
                                            <?php echo "32"; ?>/<?= $data->kode_servis; ?>/<?= date("Y", strtotime($data->tanggal)); ?>
                                        <?php
                                        } else {
                                            echo $data->format_nomor;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Dokumen</td>
                                    <td>: <?= date("d-m-Y", strtotime($data->tanggal)) ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Cetak</td>
                                    <td>: <?= date("d-m-Y") ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="style17">
                <p>
                    <font color="#000000">
                        <table width="100%">
                            <tr>
                                <td>Kepada Yth. Sub Bagian Teknologi Informasi</td>
                            </tr>
                            <tr>
                                <td>Dengan ini dilaporkan bahwa terjadi kerusakan di :</td>
                            </tr>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td>Bagian</td>
                                            <td>: <?php echo $this->m_kelola_tiket->ambil_nama_bagian($data->id_ajukan)->row()->bagian ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Pemohon</td>
                                            <td>: <?= $data->nama ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kerusakan</td>
                                            <td>: <?= $data->jns_kerusakan ?></td>
                                        </tr>
                                        <?php if ($data->id_master_jns  != 0) {
                                            echo "<tr>
                                            <td>Jenis Perangkat</td>
                                            <td>:"; ?> <?php echo $this->m_kelola_tiket->ambil_nama_jnsprgkt($data->id_ajukan)->row()->jns_prgkt ?> <?php echo "</td>
                                        </tr>";
                                                                                                                                                } ?>
                                        <?php if ($data->id_perangkat  != 0) {
                                            echo "<tr>
                                            <td>No.Perangkat TI</td>
                                            <td>:"; ?> <?php echo $perangkat->no_prgkt_ti ?> <?php echo "</td>
                                        </tr>";
                                                                                            } ?>
                                        <?php if ($data->id_perangkat  != 0) {
                                            echo "<tr>
                                            <td>No.Perangkat Vendor</td>
                                            <td>:"; ?> <?php echo $perangkat->no_prgkt_vendor ?> <?php echo "</td>
                                        </tr>";
                                                                                                } ?>
                                        <tr>
                                            <td>Uraian Kerusakan</td>
                                            <td>: <?= $data->uraian ?></td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr>
                                            <td>Sehubungan dengan hal tersebut di atas, kami mohon bantuan Sub Bagian T.I untuk membantu menangani keluhan komputer di bagian kami.<br>
                                                Atas bantuan dan kerjasamanya, kami sampaikan terima kasih.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                    </font>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1" width="100%">
                    <tr>
                        <td width="21%" class="style17">
                            <div align="center">
                                <p>Pemohon</p>
                                <p>&nbsp;</p>
                                <p><?= $data->nama ?></p>
                            </div>
                        </td>

                        <td width="26%" class="style17">
                            <div align="center">
                                <p>Mengetahui,</p>
                                <p>Kabag</p>
                                <p>&nbsp;</p>
                                <p>___________________________</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">
                <hr />
                <h4>SOLUSI/PERBAIKAN/REKOMENDASI&nbsp;:&nbsp;<I>(diisi petugas T.I)</I></h4>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Dikerjakan oleh </td>
                        <td>: <?= $data->solusi ?></td>
                    </tr>
                    <?php if ($data->solusi  == "Rekanan") { ?>
                        <tr>
                            <td>Nama Rekanan </td>
                            <td>: <?= $data->vendor ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>Uraian solusi </td>
                        <td>: <?= $data->uraian_solusi ?></td>
                    </tr>
                    <?php if ($data->solusi  == "Rekanan") { ?>
                        <tr>
                            <td>Nomor SP/SPK </td>
                            <td>: <?= $data->no_spk ?></td>
                        </tr>
                        <tr>
                            <td>Biaya </td>
                            <td>: <?= rupiah($data->biaya) ?></td>
                        </tr>
                        <tr>
                            <td>Terbilang </td>
                            <td>: <?= ucwords(terbilang($data->biaya)) . " Rupiah"; ?> </td>
                        </tr>
                    <?php } else if ($data->solusi  == "Internal") { ?>
                        <tr>
                            <td>Nama petugas TI </td>
                            <td>: <?= $data->nama_ti ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>Disposisi Kepala Bagian </td>
                        <td>: <?= $data->disposisi ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <table width="100%" border="1" bordercolor="#000000">
                <tr>
                    <td width="35%" class="style17">
                        <div align="center">
                            <p>Petugas T.I</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p><?= $data->nama_ti ?></p>
                        </div>
                    </td>
                    <td width="22%" class="style17">
                        <div align="center">
                            <p>Kasubag. TI</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>___________________________</p>
                        </div>
                    </td>
                    <td width="43%" class="style17">
                        <div align="center" style="margin-top: 0%;">
                            <p>Mengetahui, </p><br>
                            <p style="margin-top: -3%;">Kepala Bagian</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p></p>
                        </div>
                    </td>
                </tr>
            </table>
        </tr>
    </table>
</body>

</html>