<?php

function ctk($data)
{
    if ($data == NULL) {
        return "-";
    } else {
        return $data;
    }
}
function hitung_waktu($date1, $date2)
{
    $diff = abs(strtotime($date2) - strtotime($date1));

    $years   = floor($diff / (365 * 60 * 60 * 24));
    $months  = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days    = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours   = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    $minuts  = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
    //
    $tmp = '';
    if ($years != 0)
        $tmp .= $years . ' tahun ';
    if ($months  != 0)
        $tmp .= $months . ' bulan ';
    // if ($days  != 0)
    //$tmp .= $days . ' hari ';

    if ($days  == 0) {
        $tmp .= '';
    } else if ($days  != 0) {
        $tmp .= $days . ' hari ';
    }

    if ($hours  == 0) {
        $tmp .= str_pad(intval($hours), 2, '0', STR_PAD_LEFT) . ':';
    } else if ($hours  != 0) {
        if ($hours < 10) {
            $tmp .= '0';
        }
        $tmp .= $hours . ':';
    }

    if ($minuts  == 0) {
        $tmp .= str_pad(intval($minuts), 2, '0', STR_PAD_LEFT) . ':';
    } else if ($minuts  != 0) {
        if ($minuts < 10) {
            $tmp .= '0';
        }
        $tmp .= $minuts . ':';
    }

    if ($seconds  == 0) {
        $tmp .= str_pad(intval($seconds), 2, '0', STR_PAD_LEFT) . ':';
    } else if ($seconds  != 0) {
        if ($seconds < 10) {
            $tmp .= '0';
        }
        $tmp .= $seconds;
    }


    return $tmp;
}
function hari_ini($hari)
{
    //$hari = date ("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return $hari_ini;
}

function rupiah($value)
{
    return 'Rp ' . number_format($value, 2, ',', '.');
}
function uang($value)
{
    return number_format($value, 0, '.', '.');
}
function ctk_bagian_multiple($data)
{
    if (!$data) {
        echo '-';
    } else {
        $text = '';
        foreach ($data as $b) {
            $text .= $b->bagian . '<br>';
        };
        echo $text;
    }
}

if (!function_exists('list_notifikasi')) {
    function list_notifikasi()
    {
        $ci = get_instance();
        return $ci->db->select('n.*, ak.nama')->from('notif n')
            ->join('ajukan_keluhan ak', 'ak.id_ajukan = n.id_ajukan', 'left')
            ->where(['n.id_ajukan' => $ci->session->id_ajukan, 'read' => 'N'])->get()->result_array();
    }
}

/*if (!function_exists('list_notifikasi')){
    function list_notifikasi($id_ajukan){
        $ci = get_instance();
        return $ci->db->select('*');
        return $ci->db->from('notif');
        return $ci->db->join('ajukan_keluhan', 'notif.id_ajukan = ajukan_keluhan.id_ajukan');
        return $ci->db->where('id_ajukan', $id_ajukan)->get()->result_array();
    }
}*/

//fungsi rupiah terbilang
function penyebut($nilai)
{
    $nilai = abs($nilai); //abs untuk mengembalikan nilai positif
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

/*function selisihHari($tglAwal, $tglAkhir){
    // list tanggal merah selain hari minggu
    $tglLibur = Array("2013-01-04", "2013-01-05", "2013-01-17");
 
    // memecah string tanggal awal untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah1 = explode("-", $tglAwal);
    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];
 
    // memecah string tanggal akhir untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah2 = explode("-", $tglAkhir);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 =  $pecah2[0];
 
    // mencari selisih hari dari tanggal awal dan akhir
    $jd1 = GregorianToJD($month1, $date1, $year1);
    $jd2 = GregorianToJD($month2, $date2, $year2);
 
    $selisih = $jd2 - $jd1;
 
    // proses menghitung tanggal merah dan hari minggu
    // di antara tanggal awal dan akhir
    for($i=1; $i<=$selisih; $i++){
        // menentukan tanggal pada hari ke-i dari tanggal awal
        $tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
        $tglstr = date("Y-m-d", $tanggal);
 
        // menghitung jumlah tanggal pada hari ke-i
        // yang masuk dalam daftar tanggal merah selain minggu
        if (in_array($tglstr, $tglLibur)){
           $libur1++;
        }
 
        // menghitung jumlah tanggal pada hari ke-i
        // yang merupakan hari minggu
        if ((date("N", $tanggal) == 7)){
           $libur2++;
        }
    }
 
    // menghitung selisih hari yang bukan tanggal merah dan hari minggu
    return $selisih-$libur1-$libur2;
}
 
$tgl1 = "2013-01-01";
$tgl2 = "2013-01-31";
 
// output -> "Selisih hari dari tanggal 2013-01-01 dan 2013-01-31 adalah: 23 hari"
echo "Selisih hari dari tanggal ".$tgl1." dan ".$tgl2." adalah: ".selisihHari($tgl1, $tgl2)." hari";*/
function jarak_waktu($waktu1, $waktu2)
{
    $ci = get_instance();
    $ci->load->model('m_jamkerja');
    $ci->load->model('m_hari_libur');
    //Contoh waktu INPUT
    $input_1        = $waktu1;
    $input_2        = $waktu2;
    //echo "Input 1 : $input_1 <br>";
    //echo "Input 2 : $input_2 <br>";
    // N= 1 = Senin s.d. 7 = Minggu
    $input_1_hari            = date("N", strtotime($input_1));
    $input_2_hari            = date("N", strtotime($input_2));
     //echo "Hari 1 : $input_1_hari <br>";
    // echo "Hari 2 : $input_2_hari <br>";
    // Menghitung jarak hari
    $h1         = date_create(date("Y-m-d 00:00:00", strtotime($input_1)));
    $h2         = date_create(date("Y-m-d 00:00:00", strtotime($input_2)));
    $jml_hari   = date_diff($h1, $h2)->d;
    // echo "Jarak hari : $jml_hari <br>";
    //Looping per hari
    // echo "<br>";
    //Set detik ke 0
    $detik = 0;
    for ($i = 0; $i <= $jml_hari; $i++) {
        //echo "<b>$i ========================> Sekarang : " . detik_to_teks($detik) . "</b><br>";
        //Skip untuk sabtu & minggu
        $input_1_hari = date("N", strtotime($input_1));
        //echo "-- Cek hari $input_1_hari<br>";
        if ($input_1_hari == 6 || $input_1_hari == 7 || $ci->m_hari_libur->is_exist(date("Y-m-d", strtotime($input_1))) > 0) {
            // echo "-- SKIP, NEXT DAY<br>";
            //Hari bergerak + 1
            $input_1         = date('Y-m-d H:i:s', strtotime('+1 days', strtotime($input_1)));
        }
        //Hari Kerja
        else {
            //Ambil jam kerja
            $harian_mulai       = $ci->m_jamkerja->r_masuk($input_1_hari);
            $harian_selesai     = $ci->m_jamkerja->r_keluar($input_1_hari);
            $temp_mulai         = strtotime($harian_mulai);
            $temp_selesai       = strtotime($harian_selesai);
            //echo "-- Jam mulai kerja : $harian_mulai <br>";
            //echo "-- Jam selesai kerja : $harian_selesai <br>";
            // Jika input(1) sebelum jam  kerja
            if (strtotime(date("H:i:s", strtotime($input_1))) < $temp_mulai) {
                //echo "-- SKIP";
            }
            // Jika input(1) dalam waktu jam kerja
            else {
                //Jika hari pertama
                if ($i == 0 && $i < $jml_hari) {
                    // [Harian jam selesai kerja] - [Input 1] 
                    $detik            += $temp_selesai - strtotime(date("H:i:s", strtotime($input_1)));
                    //echo "-- Cek " . date("H:i:s", strtotime(date("H:i:s", strtotime($input_1)))) . "<br>";
                    //echo "-- Cek " . date("H:i:s", $temp_selesai) . "<br>";
                    //echo "Hari pertama <br>";
                }
                //Jika hari pertengahan
                else if ($i > 0 && $i < $jml_hari) {
                    // [Harian jam selesai kerja] - [Harian jam mulai kerja]
                    $detik            += $temp_selesai - $temp_mulai;
                    //echo "-- Cek " . date("H:i:s", $temp_mulai) . "<br>";
                    //echo "-- Cek " . date("H:i:s", $temp_selesai) . "<br>";
                    //echo "Hari pertengahan<br>";
                }
                //Jika hari terakhir
                else if ($i == $jml_hari) {
                    //Jika hanya 1 hari
                    if ($jml_hari == 0) {
                       // echo "SATU !!!";
                        $temp_jam_1        = strtotime(date("H:i:s", strtotime($input_1)));
                    }
                    //Jika banyak hari
                    else {
                        $temp_jam_1        = $temp_mulai;
                    }
                    $temp_jam_2        = strtotime(date("H:i:s", strtotime($input_2)));
                    //echo "-- Cek 1 : " . date("H:i:s", $temp_mulai) . "<br>";
                    //echo "-- Cek 2 : " . date("H:i:s", $temp_jam_2) . "<br>";
                    //Jika jam input(1) lebih dari jam mulai kerja
                    if ($temp_jam_1 > $temp_mulai) {
                        $temp_mulai = $temp_jam_1;
                    }
                    //Jika jam input(2) kurang dari jam selesai kerja
                    if ($temp_jam_2 < $temp_selesai) {
                        $temp_selesai = $temp_jam_2;
                    }
                    //Proses
                    $detik            += $temp_selesai - $temp_mulai;
                    // echo "Hari terakhir<br>";
                }
            }
            //Hari bergerak + 1
            // $input_1         = date('Y-m-d H:i:s', strtotime('+1 days', strtotime($input_1)));
        }
        //echo "<br>";
    }
    //echo "X ========================> Sekarang : $detik detik alias <b>" . detik_to_teks($detik) . "</b><br>";
    // echo json_encode(date("Y-m-d H:i:s",$detik)." ".date("Y-m-d H:i:s",$temp_mulai))." ".$detik;
    if($detik >= 0){
        return detik_to_teks($detik);
    }else{
        return detik_to_teks(0);
    }
    
}
function detik_to_teks($detik)
{
    //24 jam = 86400 detik
    $days       = floor($detik / 86400);
    if ($days > 0) {
        $remain = $detik - ($days * 86400);
    } else {
        $remain = $detik;
    }
    $hours      = sprintf("%02d", floor($remain / 3600));
    $minutes    = sprintf("%02d", floor(($remain / 60) % 60));
    $seconds    = sprintf("%02d", $remain % 60);
    
    if($days == 0){
        return "$hours:$minutes:$seconds";
    }else{
        return "$days hr $hours:$minutes:$seconds";
    }
}
