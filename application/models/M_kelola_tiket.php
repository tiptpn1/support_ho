<?php

class M_kelola_tiket extends CI_Model
{
    /*public function tampil_kelola_tiket(){
		return $this->db->get('ajukan_keluhan');
	}*/
    /*punyaku yg baru jgn dihapus
    function tampil_kelola_tiket(){
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        //$this->db->join('perangkat', 'ajukan_keluhan.id_perangkat = perangkat.id_perangkat');
        $this->db->join('master_jns', 'ajukan_keluhan.id_master_jns = master_jns.id_master_jns', 'left');
        return $this->db->get();
    }
	/*public function edit_kelola_tiket($id_ajukan){
    	$this->db->select('*');
        $this->db->from('ajukan_keluhan');
        //$this->db->join('perangkat', 'ajukan_keluhan.id_perangkat = perangkat.id_perangkat');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }*/
    /*public function edit_kelola_tiket(){
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('perangkat', 'ajukan_keluhan.id_perangkat = perangkat.id_perangkat');
        return $this->db->get();
    }
    public function edit_kelola_tiket($id_ajukan){
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        //$this->db->join('perangkat', 'ajukan_keluhan.id_perangkat = perangkat.id_perangkat');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }
    public function tampil_bagian(){
        return $this->db->get('bagian');
    }
    public  function edit_aksi_tiket($data, $where){
        return $this->db->update('ajukan_keluhan', $data, $where);
    }
	public function hapus_data_tiket($where){
    	return $this->db->delete('ajukan_keluhan', $where);
    }*/


    //punyaku
    function generate_id()
    {
        $last_id    = $this->db->order_by('kode_servis', 'desc')->get('ajukan_keluhan')->row();
        if ($last_id == NULL) {
            return 'S-00000000001';
        } else {
            $new_id = intval(substr($last_id->kode_servis, 2)) + 1;
            return 'S-' . str_pad($new_id, 11, '0', STR_PAD_LEFT);
        }
    }
    function tampil_kelola_tiket($kantor)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        $this->db->join('master_jns', 'ajukan_keluhan.id_master_jns = master_jns.id_master_jns', 'left');
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);

        $this->db->order_by("Field(prioritas, 'utama', 'sedang', 'rendah')");
        $this->db->order_by("Field(status, 'Belum ditangani', 'Antrian', 'Sedang ditangani', 'Selesai')");
        $this->db->order_by('tanggal', 'DESC');
        //print_r($this->db->last_query());
        //die();
        return $this->db->get();
    }
    public function edit_kelola_tiket($id_ajukan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        //$this->db->join('perangkat', 'ajukan_keluhan.id_perangkat = perangkat.id_perangkat');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }
    function ambil_nama_kantor($id_ajukan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('master_kantor', 'ajukan_keluhan.id_master_kantor = master_kantor.id_master_kantor');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }
    function ambil_nama_bagian($id_ajukan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }
    function ambil_nama_jnsprgkt($id_ajukan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('master_jns', 'ajukan_keluhan.id_master_jns = master_jns.id_master_jns');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }
    function ambil_email_admin_reg($id_ajukan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('users', 'ajukan_keluhan.id_master_kantor = users.id_master_kantor');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }
    function tampil_pilprgkt($id_ajukan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('perangkat', 'ajukan_keluhan.id_perangkat = perangkat.id_perangkat');
        $this->db->join('master_prgkt', 'perangkat.id_master_prgkt = master_prgkt.id_master_prgkt');
        $this->db->join('master_jns', 'master_prgkt.id_master_jns = master_jns.id_master_jns', 'LEFT');
        $this->db->where('id_ajukan', $id_ajukan);
        return $this->db->get();
    }
    function tampil_bagian($kantor)
    {
        //return $this->db->get('bagian');
        $this->db->select('*');
        $this->db->from('bagian');
        $this->db->where('id_master_kantor', $kantor);
        return $this->db->get();
    }
    public function get_id_ajukan()
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->order_by('id_ajukan', 'desc');
        return $this->db->get();
    }
    public  function edit_aksi_tiket($data, $where)
    {
        return $this->db->update('ajukan_keluhan', $data, $where);
    }
    public function hapus_data_tiket($where)
    {
        $id = $this->edit_kelola_tiket($where['id_ajukan'])->row()->id_ajukan;
        $query  = $this->db->query("SELECT upload_spk FROM ajukan_keluhan WHERE id_ajukan='$id'");
        $ambil = $query->row_array();
        if ($ambil['upload_spk'] != NULL) {
            unlink('./assets/upload/' . $ambil['upload_spk']);
        }
        //print_r($ambil); die();
        $this->db->delete('ajukan_keluhan', $where);
        return 1;
    }
    public function biaya_layanan($jns_layanan)
    {
        // $q     = $this->db->query("SELECT SUM(biaya) as biaya_total FROM ajukan_keluhan WHERE jns_kerusakan='$jns_layanan'")->result();      
        // if($q[0]->biaya_total) return $q[0]->biaya_total;
        // else return 0;
        $this->db->select('SUM(biaya) as biaya_total');
        $this->db->from('ajukan_keluhan');
        $this->db->where('jns_kerusakan', $jns_layanan);
        $dt = $this->db->get()->row()->biaya_total;
        return $dt;
    }
    public function cari($tahun)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->like('YEAR(tanggal)', $tahun);
        return $this->db->get()->result();
    }
    public function jml_jns_layanan_rekanan($tahun)
    {
        //$q  = $this->db->query("SELECT jns_kerusakan, COUNT( solusi ) AS Rekanan FROM ajukan_keluhan WHERE solusi="Rekanan" GROUP BY jns_kerusakan");
        //if(!empty($_POST['tahun'])){
        // $word=$_POST['tahun'];
        // } else {
        // $word=$_GET['tahun'];
        // }
        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("count(solusi) as Rekanan");
        $this->db->where('solusi', 'Rekanan');
        $this->db->where('YEAR(tanggal)', $tahun);
        //->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
        //
        //$this->db->where('tanggal LIKE '%$tahun%'');
        // $this->db->where('YEAR(tanggal)',$tahun);
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }
    public function jml_jns_layanan_inex($tahun, $kantor)
    {
        //$q  = $this->db->query("SELECT jns_kerusakan, COUNT( solusi ) AS Internal FROM ajukan_keluhan WHERE solusi="Internal" GROUP BY jns_kerusakan");

        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("SUM(IF(solusi='Internal',1,0)) as Internal");
        $this->db->select("SUM(IF(solusi='Rekanan',1,0)) as Rekanan");
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        //$this->db->where('solusi', '(Internal');
        //$this->db->or_where('solusi', 'Rekanan)');
        $this->db->where('YEAR(tanggal)', $tahun);
        // $this->db->where('solusi', 'Internal');
        // $this->db->or_where('solusi', 'Rekanan');


        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
        // print_r($this->db->last_query());
        // die();

        //cb
    }
    public function biaya_bagian($tahun, $kantor)
    {
        //$thn=$_POST["tahun"];
        //$query= $this->db->query("SELECT bagian.bagian AS nama, SUM(ajukan_keluhan.biaya) AS biaya FROM ajukan_keluhan JOIN bagian ON ajukan_keluhan.id_bagian = bagian.id_bagian GROUP BY ajukan_keluhan.id_bagian")->result;
        //return $query;
        //$query1= $this->db->query("SELECT bagian FROM bagian INNER JOIN ajukan_keluhan ON bagian.id_bagian= ajukan_keluhan.id_bagian");
        //SELECT bagian.bagian AS nama, SUM(ajukan_keluhan.biaya) AS biaya FROM ajukan_keluhan JOIN bagian ON ajukan_keluhan.id_bagian = bagian.id_bagian GROUP BY ajukan_keluhan.id_bagian

        $this->db->select('bagian');
        $this->db->select("SUM(biaya) as biaya");
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        return $this->db->group_by('bagian')
            ->get()
            ->result();
        //print_r($this->db->last_query());
        //die();
    }
    public function pie_biaya($tahun)
    {
        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("count(*) as total");
        $this->db->where('YEAR(tanggal)', $tahun);
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }
    public function pie_bagian_keluhan($tahun, $kantor)
    {
        $this->db->select('bagian');
        $this->db->select("count(*) as total_bagian");
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        return $this->db->group_by('bagian')
            ->get()
            ->result();
        // print_r($this->db->last_query());
        //die();
    }
    function get_data()
    {
        /*$query = $this->db->query("SELECT id_bagian,COUNT(id_ajukan) AS id_ajukan FROM ajukan_keluhan GROUP BY id_bagian");
         
        if($query->num_rows() > 0){
        foreach($query->result() as $data){
        $hasil[] = $data;
        }
        return $hasil;
        }*/
    }
    function get_data_biaya($tahun, $kantor)
    {
        //$query = $this->db->query("SELECT jns_kerusakan,SUM(biaya) AS biaya FROM ajukan_keluhan GROUP BY jns_kerusakan");

        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("SUM(biaya) as biaya");
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
        //      print_r($this->db->last_query());
        //die();
    }
    //laporan tabel bagian,jenis layanan
    function tampil_selesai($tgl_awal, $tgl_akhir, $bagian, $layanan, $kantor)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        $this->db->join('master_jns', 'ajukan_keluhan.id_master_jns = master_jns.id_master_jns', 'left');
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        $this->db->order_by('date(tanggal)', 'DESC');
        //$this->db->where("id",1)->where("(status='live' OR status='dead')");

        $layanan_all = 0;
        $layanan_where = "";
        foreach ($layanan as $key => $value) {
            if ($value == 'all') {
                $layanan_all = 1;
            }

            if ($key == 0) {
                $layanan_where .= 'AND (';
            } else {
                $layanan_where .= 'OR';
            }
            $layanan_where .= ' ajukan_keluhan.jns_kerusakan="' . $value . '" ';
        }
        if ($layanan_where != "") {
            $layanan_where .= ")";
        }

        //report biaya semua bagian dan semua layanan
        if ($tgl_awal != null && $tgl_akhir != null && ($bagian == NULL || $bagian == "all") && $layanan_all == 1) {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND status="Selesai"');
            //report biaya semua layanan dan bagian tertentu
        } elseif ($tgl_awal != null && $tgl_akhir != null && $layanan_all == 1 && $bagian != "all" && $bagian != NULL) {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND ajukan_keluhan.id_bagian="' . $bagian . '" AND status="Selesai"');
        }
        //report biaya layanan tertentu dan semua bagian
        elseif ($tgl_awal != null && $tgl_akhir != null && $layanan_all != 1 && ($bagian == NULL || $bagian == "all")) {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" ' . $layanan_where . ' AND status="Selesai"');
        }
        //report biaya bagian tertentu dan layanan tertentu
        else {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND ajukan_keluhan.id_bagian="' . $bagian . '" ' . $layanan_where . ' AND status="Selesai"');
        }
        //$this->db->where('YEAR(ajukan_keluhan.tanggal)', $tahun);
        //$this->db->or_where('ajukan_keluhan.id_bagian', $bagian);
        return $this->db->get()->result();
    }

    function tampil_selesai_semua($tahun, $kantor)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        $this->db->join('master_jns', 'ajukan_keluhan.id_master_jns = master_jns.id_master_jns', 'left');
        $this->db->join('master_kantor', 'master_kantor.id_master_kantor = ajukan_keluhan.id_master_kantor', 'left');
        $this->db->order_by('date(tanggal)', 'DESC');
        $this->db->where('status', 'Selesai');
        $this->db->where('YEAR(ajukan_keluhan.tanggal)', $tahun);
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        return $this->db->get()->result();
    }


    //cari tanggal dengan layanan
    function cari_tanggal_layanan($tgl_awal, $tgl_akhir, $layanan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        $this->db->join('master_jns', 'ajukan_keluhan.id_master_jns = master_jns.id_master_jns', 'left');
        $this->db->order_by('date(tanggal)', 'DESC');
        //$this->db->where("id",1)->where("(status='live' OR status='dead')");
        if ($tgl_awal != null && $tgl_akhir != null && $layanan == "all") {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND status="Selesai"');
        } else {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND ajukan_keluhan.jns_kerusakan="' . $layanan . '" AND status="Selesai"');
        }
        //$this->db->where('YEAR(ajukan_keluhan.tanggal)', $tahun);
        //$this->db->or_where('ajukan_keluhan.id_bagian', $bagian);
        return $this->db->get()->result();
    }

    public function keluhan_selesai($tgl_awal, $tgl_akhir, $bagian, $layanan)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        if ($tgl_awal != null && $tgl_akhir != null && $bagian == "all" && $layanan == "all") {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND status="Selesai"');
        } else {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND ajukan_keluhan.id_bagian="' . $bagian . '" AND ajukan_keluhan.jns_kerusakan="' . $layanan . '" AND status="Selesai"');
        }
        $query = $this->db->get();
        $jumlah = $query->num_rows();
        return $jumlah;

        /*$query = $this->db->query('SELECT * FROM ajukan_keluhan INNER JOIN bagian ON ajukan_keluhan.id_bagian= bagian.id_bagian WHERE bagian LIKE "%$bagian%" AND status= "Selesai" AND YEAR(ajukan_keluhan.tanggal ) ="$tahun"');
        $jumlah = $query->num_rows();
        return $jumlah;*/
    }
    public function keluhan_selesai_semua($tahun, $kantor)
    {
        $query = $this->db->query('SELECT * FROM ajukan_keluhan LEFT JOIN master_kantor ON ajukan_keluhan.id_master_kantor=ajukan_keluhan.id_master_kantor WHERE status= "Selesai" AND YEAR(tanggal) =' . $tahun . ' AND  ajukan_keluhan.id_master_kantor =' . $kantor . '');
        //print_r($this->db->last_query());
        //die();
        $jumlah = $query->num_rows();
        return $jumlah;
    }


    public function internal($tgl_awal, $tgl_akhir, $bagian, $layanan)
    {
        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("count(solusi) as Internal");
        $this->db->where('solusi', 'Internal');
        if ($tgl_awal != null && $tgl_akhir != null && $bagian == "all" && $layanan == "all") {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND status="Selesai"');
        } else {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND ajukan_keluhan.id_bagian="' . $bagian . '" AND ajukan_keluhan.jns_kerusakan="' . $layanan . '" AND status="Selesai"');
        }
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }
    public function internal_semua($tahun, $kantor)
    {
        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("count(solusi) as Internal");
        $this->db->join('master_kantor', 'master_kantor.id_master_kantor = ajukan_keluhan.id_master_kantor', 'left');
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        $this->db->where('solusi', 'Internal');
        $this->db->where('status', 'Selesai');
        $this->db->where('YEAR(tanggal)', $tahun);
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }

    public function rekanan($tgl_awal, $tgl_akhir, $bagian, $layanan)
    {
        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("count(solusi) as Rekanan");
        $this->db->where('solusi', 'Rekanan');
        if ($tgl_awal != null && $tgl_akhir != null && $bagian == "all" && $layanan == "all") {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND status="Selesai"');
        } else {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND ajukan_keluhan.id_bagian="' . $bagian . '" AND ajukan_keluhan.jns_kerusakan="' . $layanan . '" AND status="Selesai"');
        }
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }
    public function rekanan_semua($tahun, $kantor)
    {
        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("count(solusi) as Rekanan");
        $this->db->join('master_kantor', 'master_kantor.id_master_kantor = ajukan_keluhan.id_master_kantor', 'left');
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        $this->db->where('solusi', 'Rekanan');
        $this->db->where('status', 'Selesai');
        $this->db->where('YEAR(tanggal)', $tahun);
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }

    function biaya_perlayanan($tgl_awal, $tgl_akhir, $bagian, $layanan)
    {
        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("SUM(biaya) as biaya");
        if ($tgl_awal != null && $tgl_akhir != null && $bagian == "all" && $layanan == "all") {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND status="Selesai"');
        } else {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND ajukan_keluhan.id_bagian="' . $bagian . '" AND ajukan_keluhan.jns_kerusakan="' . $layanan . '" AND status="Selesai"');
        }
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }
    function biaya_perlayanan_semua($tahun, $kantor)
    {
        $this->db->group_by('jns_kerusakan');
        $this->db->select('jns_kerusakan');
        $this->db->select("SUM(biaya) as biaya");
        $this->db->join('master_kantor', 'master_kantor.id_master_kantor = ajukan_keluhan.id_master_kantor', 'left');
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        $this->db->where('status', 'Selesai');
        $this->db->where('YEAR(tanggal)', $tahun);
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }

    public function biaya_tahunan_semua($tahun, $kantor)
    {
        /*$this->db->select("SUM(biaya) as biaya");
        $this->db->where('status', 'Selesai');
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->from('ajukan_keluhan')
            ->get()
            ->result();*/

        //$this->db->group_by('biaya');
        //$this->db->select('biaya');
        $this->db->select("sum(biaya) as biaya");
        $this->db->join('master_kantor', 'master_kantor.id_master_kantor = ajukan_keluhan.id_master_kantor', 'left');
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        $this->db->where('status', 'Selesai');
        $this->db->where('YEAR(tanggal)', $tahun);
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }
    public function biaya_tahunan($tahun, $bagian)
    {
        $this->db->select('biaya');
        $this->db->select("sum(biaya) as biaya");
        $this->db->where('status', 'Selesai');
        if ($tahun != null && $bagian != null) {
            $this->db->where("(YEAR(ajukan_keluhan.tanggal)='$tahun' AND ajukan_keluhan.id_bagian='$bagian')");
        } else {
            $this->db->where("(YEAR(ajukan_keluhan.tanggal)='$tahun' OR ajukan_keluhan.id_bagian='$bagian')");
        }
        return $this->db->from('ajukan_keluhan')
            ->get()
            ->result();
    }
    /*public function jml_layanan(){
        $q  = $this->db->query("SELECT `jns_kerusakan`, count(solusi) as Internal FROM `ajukan_keluhan` WHERE `solusi` = 'Internal' GROUP BY `jns_kerusakan`");
        
        $a = $q->num_rows();
        return $a;
    }*/

    function max_number()
    {
        $date = date("Y-m-d");
        $tahun_terima = explode("-", $date);
        //print_r ($tahun_terima[0]);
        $query  = $this->db->query("select max(kode_servis) as nomor_servis from ajukan_keluhan where kode_servis and tahun='$tahun_terima[0]'");
        return $query;
    }

    //laporan tabel bagian,jenis layanan
    function tampil_pengguna_perangkat($tgl_awal, $tgl_akhir, $perangkat, $bagian,$kantor)
    {
        $this->db->select('*');
        $this->db->from('ajukan_keluhan');
        $this->db->join('bagian', 'ajukan_keluhan.id_bagian = bagian.id_bagian');
        $this->db->join('master_jns', 'ajukan_keluhan.id_master_jns = master_jns.id_master_jns', 'left');
        $this->db->join('perangkat', 'ajukan_keluhan.id_perangkat = perangkat.id_perangkat');
        $this->db->where('ajukan_keluhan.id_master_kantor', $kantor);
        $this->db->order_by('date(tanggal)', 'DESC');
        //$this->db->where("id",1)->where("(status='live' OR status='dead')");
        $perangkat_all = 0;
        $perangkat_where = "";
        foreach ($perangkat as $key => $value) {
            if ($value == 'all') {
                $perangkat_all = 1;
            }

            if ($key == 0) {
                $perangkat_where .= 'and (';
            } else {
                $perangkat_where .= 'or';
            }
            $perangkat_where .= ' perangkat.no_prgkt_ti="' . $value . '" ';
        }
        if ($perangkat_where != "") {
            $perangkat_where .= ")";
        }
        if ($tgl_awal != null && $tgl_akhir != null && $bagian == "all" && $perangkat_all == 1) {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND (ajukan_keluhan.jns_kerusakan="software" or ajukan_keluhan.jns_kerusakan="hardware") AND ajukan_keluhan.status="Selesai"');
        } elseif ($tgl_awal != null && $tgl_akhir != null && $bagian == "all") {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" ' . $perangkat_where . ' AND (ajukan_keluhan.jns_kerusakan="software" or ajukan_keluhan.jns_kerusakan="hardware") AND ajukan_keluhan.status="Selesai"');
        } elseif ($tgl_awal != null && $tgl_akhir != null && $perangkat_all == 1) {

            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" AND ajukan_keluhan.id_bagian="' . $bagian . '" AND (ajukan_keluhan.jns_kerusakan="software" or ajukan_keluhan.jns_kerusakan="hardware") AND ajukan_keluhan.status="Selesai"');
        } else {
            $this->db->where('ajukan_keluhan.tanggal >="' . $tgl_awal . '" AND ajukan_keluhan.tanggal<="' . $tgl_akhir . '" ' . $perangkat_where . ' AND ajukan_keluhan.id_bagian="' . $bagian . '" AND (ajukan_keluhan.jns_kerusakan="software" or ajukan_keluhan.jns_kerusakan="hardware") AND ajukan_keluhan.status="Selesai"');
        }

        //$this->db->where('YEAR(ajukan_keluhan.tanggal)', $tahun);
        //$this->db->or_where('ajukan_keluhan.id_bagian', $bagian);
        return $this->db->get()->result();
    }

    public function get_bagian_nama($id)
    {
        $this->db->select('bagian');
        $this->db->from('bagian');
        $this->db->where(array('id_bagian' => $id));
        return $this->db->get()->row()->bagian;
    }

    function excel_pemel($bagian, $pemel, $tahun, $kantor)
    {
        // $date=date("Y-m-d");
        // $tahun_keluhan =explode("-",$date);
        //print_r ($tahun_terima[0]);
        $bagian_where = 1;
        if (is_array($bagian)) {
            $countBagian = count($bagian);
            foreach ($bagian as $key => $value) {
                if ($value == "all") {
                    $bagian_where = 1;
                    $departemen= "id_master_kantor=".$kantor;
                    break;
                } elseif ($key == 0) {
                    $bagian_where = "(bagian.id_bagian = $value";
                } else {
                    $bagian_where = $bagian_where . " OR bagian.id_bagian = $value";
                }

                if ($key == ($countBagian - 1)) {
                    $bagian_where = $bagian_where . ")";
                }
            }
        } else {
            if ($bagian != 'all') {
                $bagian_where = "bagian.id_bagian = $bagian";
            }
        }

        $pemel_where = "";
        foreach ($pemel as $key => $value) {
            if ($value == "all") {
                $pemel_where = $pemel_where . "AND ( master_group_perangkat.id_group = 1 OR master_group_perangkat.id_group = 2 OR  master_group_perangkat.id_group = 3) ";
                break;
            } else {
                $pemel_where = $pemel_where . "AND  master_group_perangkat.id_group = $value";
            }
        }
        $query  = $this->db->query("SELECT perangkat.id_perangkat,group_perangkat,no_prgkt_ti,master_jns.jns_prgkt,nama_pengguna,bagian.id_bagian,bagian,
        GROUP_CONCAT(ajukan_keluhan.biaya SEPARATOR ', ') AS biaya,
        GROUP_CONCAT(ajukan_keluhan.solusi  SEPARATOR ', ') AS solusi,
        GROUP_CONCAT(ajukan_keluhan.waktu_selesai SEPARATOR ', ') AS waktu_selesai
        FROM perangkat
        LEFT JOIN master_prgkt ON perangkat.id_master_prgkt = master_prgkt.id_master_prgkt
        LEFT JOIN master_jns ON master_prgkt.id_master_jns = master_jns.id_master_jns
        LEFT JOIN master_group_perangkat ON master_group_perangkat.id_group = master_jns.id_group 
        LEFT JOIN ajukan_keluhan ON ajukan_keluhan.id_perangkat=perangkat.id_perangkat AND ajukan_keluhan.status='Selesai' AND ajukan_keluhan.tahun='$tahun' AND ajukan_keluhan.jns_kerusakan='Hardware' AND ajukan_keluhan.solusi='Rekanan'
        LEFT JOIN ajukan_keluhan_histori ON ajukan_keluhan_histori.id_ajukan=ajukan_keluhan.id_ajukan 
        LEFT JOIN bagian ON bagian.id_bagian=perangkat.id_bagian 
        WHERE $bagian_where $pemel_where $departemen
        GROUP BY perangkat.id_perangkat,group_perangkat,no_prgkt_ti,tipe_prgkt,nama_pengguna,bagian.id_bagian,bagian
        ORDER BY biaya DESC, no_prgkt_ti ASC, ajukan_keluhan.waktu_selesai ASC")->result();
        // print_r($this->db->last_query());
        // die();
        return $query;
    }
}
