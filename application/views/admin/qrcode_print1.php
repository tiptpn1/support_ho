<!DOCTYPE html>
<html lang="en">
<head>
    <title>QR Code Print</title>
</head>

<body>
    <!--?=base_url(); ?>assets/images/<//?php echo $QRprint->qr_code; ?-->
    <img src="<?=base_url(); ?> Panel/qrcode_print">
    <!--img src="{{'data:image/png;base64,' . base64_encode($QRprint->qr_code)}}" alt="image" -->
</body>
</html>