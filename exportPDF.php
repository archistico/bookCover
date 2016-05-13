<?php

// Caricamento dati passati dal form
$larghezza = $_GET["larghezza"];
$altezza = $_GET["altezza"];
$dorso = $_GET["dorso"];
$smarginatura = $_GET["smarginatura"];
$cordonatura = $_GET["cordonatura"];
$margineInterno = $_GET["margineInterno"];
$DPI = $_GET["DPI"];

$copertinaLarghezza = $larghezza * 2 + $dorso + $smarginatura * 2 + $cordonatura * 2;
$copertinaAltezza = $altezza + $smarginatura * 2 + $cordonatura * 2;

// Creazione del documento
require('fpdf.php');
if($copertinaLarghezza >= $copertinaAltezza)
{
  $pdf = new FPDF('L', 'mm', array($copertinaLarghezza, $copertinaAltezza));
}
else {
  $pdf = new FPDF('P', 'mm', array($copertinaLarghezza, $copertinaAltezza));
}
$pdf->AddPage();

// Rettangolo copertina con smarginatura
// Rect(float x, float y, float w, float h [, string style])
$pdf->Rect($cordonatura, $cordonatura, $copertinaLarghezza-2*$cordonatura, $copertinaAltezza-2*$cordonatura, 'D');

// Rettangolo taglio
$pdf->Rect($cordonatura+$smarginatura, $cordonatura+$smarginatura, $copertinaLarghezza-2*($cordonatura+$smarginatura), $copertinaAltezza-2*($cordonatura+$smarginatura), 'D');

// Rettangolo dorso
$pdf->Rect($cordonatura+$smarginatura+$larghezza, $cordonatura+$smarginatura, $dorso, $altezza, 'D');

// Linee di taglio


// Setta il font
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,10,'Dimensioni: '. $copertinaLarghezza . 'x' . $copertinaAltezza);

// Chiusura PDF
ob_end_clean();
$pdf->Output();
?>
