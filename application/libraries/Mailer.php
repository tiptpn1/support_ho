<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    protected $_ci;
    protected $email_pengirim = 'it.support@ptpn1.co.id'; // Isikan dengan email pengirim
    protected $nama_pengirim = 'TI PTPN I'; // Isikan dengan nama pengirim
    protected $password = 'Akhlak123'; // Isikan dengan password email pengirim

    public function __construct(){
        $this->_ci = &get_instance(); // Set variabel _ci dengan Fungsi2-fungsi dari Codeigniter

        require_once(APPPATH.'third_party/phpmailer/Exception.php');
        require_once(APPPATH.'third_party/phpmailer/PHPMailer.php');
        require_once(APPPATH.'third_party/phpmailer/SMTP.php');
    }

    public function send($data){
        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->Host = 'ssl://127.0.0.1'; 
        $mail->Username = $this->email_pengirim; // Email Pengirim
        $mail->Password = $this->password; // Isikan dengan Password email pengirim
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'smtp';
        // $mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

        $mail->setFrom($this->email_pengirim, $this->nama_pengirim);
        $mail->addAddress($data['email'], '');
        $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

        //$mail->Subject = $data['subjek'];
        $mail->Body = $data['content'];
        $mail->AddEmbeddedImage('assets/images/ptpn12.png', 'logo_ptpn12', 'ptpn12.png'); // Aktifkan jika ingin menampilkan gambar dalam email
		

        $send = $mail->send();

        if($send){ // Jika Email berhasil dikirim
            $response = array('status'=>'Sukses', 'message'=>'Permintaan Anda berhasil dikirim. Cek email untuk menerima notifikasi');
        }else{ // Jika Email Gagal dikirim
            $response = array('status'=>'Gagal', 'message'=>'Permintaan gagal dikirim');
        }

        return $response;
    }
}
