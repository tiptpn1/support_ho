<?php
 
class Fungsi{
  public function PdfGenerator($html,$filename,$paper,$orientation)
  {
    require FCPATH . 'vendor/autoload.php';
    $dompdf = new Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }
}