<!DOCTYPE html>
<html lang="en">
<head>
    <title>QR Code Print</title>
</head>

<body>
    <!--?=base_url(); ?>assets/images/<//?php echo $QRprint->qr_code; ?-->
    <img src="assets/images/qrcode_new<?= $QRprint->id_perangkat ?>.png">
    <!--img src="{{'data:image/png;base64,' . base64_encode($QRprint->qr_code)}}" alt="image" -->
</body>
</html>