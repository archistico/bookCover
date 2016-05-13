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
$pdf->Rect($cordonatura, $cordonatura, $copertinaLarghezza-2*$cordonatura, $copertinaAltezza-2*$cordonatura, 'D');

// Rettagolo pagina Quarta
$pdf->Rect($cordonatura+$smarginatura, $cordonatura+$smarginatura, $larghezza, $altezza, 'D');

// Rettagolo pagina Prima
$pdf->Rect($cordonatura+$smarginatura+$larghezza+$dorso, $cordonatura+$smarginatura, $larghezza, $altezza, 'D');

// Rettangolo dorso
$pdf->Rect($cordonatura+$smarginatura+$larghezza, $cordonatura+$smarginatura, $dorso, $altezza, 'D');

// Margini di sicurezza quarta
$pdf->Rect($cordonatura+$smarginatura+$margineInterno, $cordonatura+$smarginatura+$margineInterno, $larghezza-2*$margineInterno, $altezza-2*$margineInterno, 'D');

// Margini di sicurezza prima
$pdf->Rect($cordonatura+$smarginatura+$larghezza+$dorso+$margineInterno, $cordonatura+$smarginatura+$margineInterno, $larghezza-2*$margineInterno, $altezza-2*$margineInterno, 'D');

// Linee lato sopra
$pdf->Line($cordonatura+$smarginatura, 0, $cordonatura+$smarginatura,$cordonatura);
$pdf->Line($cordonatura+$smarginatura+$larghezza, 0, $cordonatura+$smarginatura+$larghezza,$cordonatura);
$pdf->Line($cordonatura+$smarginatura+$larghezza+$dorso, 0, $cordonatura+$smarginatura+$larghezza+$dorso,$cordonatura);
$pdf->Line($cordonatura+$smarginatura+2*$larghezza+$dorso, 0, $cordonatura+$smarginatura+2*$larghezza+$dorso,$cordonatura);

// Linee lato sotto
$pdf->Line($cordonatura+$smarginatura, $copertinaAltezza-$cordonatura, $cordonatura+$smarginatura,$copertinaAltezza);
$pdf->Line($cordonatura+$smarginatura+$larghezza, $copertinaAltezza-$cordonatura, $cordonatura+$smarginatura+$larghezza,$copertinaAltezza);
$pdf->Line($cordonatura+$smarginatura+$larghezza+$dorso, $copertinaAltezza-$cordonatura, $cordonatura+$smarginatura+$larghezza+$dorso,$copertinaAltezza);
$pdf->Line($cordonatura+$smarginatura+2*$larghezza+$dorso, $copertinaAltezza-$cordonatura, $cordonatura+$smarginatura+2*$larghezza+$dorso,$copertinaAltezza);

// Linee sinistra
$pdf->Line( 0, $cordonatura+$smarginatura, $cordonatura, $cordonatura+$smarginatura);
$pdf->Line( 0, $copertinaAltezza-$cordonatura-$smarginatura, $cordonatura, $copertinaAltezza-$cordonatura-$smarginatura);

// Linee destra
$pdf->Line( $copertinaLarghezza-$cordonatura, $cordonatura+$smarginatura, $copertinaLarghezza, $cordonatura+$smarginatura);
$pdf->Line( $copertinaLarghezza-$cordonatura, $copertinaAltezza-$cordonatura-$smarginatura, $copertinaLarghezza, $copertinaAltezza-$cordonatura-$smarginatura);

// Setta il font
$pdf->SetFont('Arial','B',10);
// Muoviti internamente nella zona margini
$pdf->Text($cordonatura+$smarginatura+$margineInterno+5,$cordonatura+$smarginatura+$margineInterno+10,'Dimensioni totali: '. $copertinaLarghezza . 'x' . $copertinaAltezza . ' mm');
$pdf->Text($cordonatura+$smarginatura+$margineInterno+5,$cordonatura+$smarginatura+$margineInterno+15,'Dimensione pagina: '. $larghezza . 'x' . $altezza . ' mm');
$pdf->Text($cordonatura+$smarginatura+$margineInterno+5,$cordonatura+$smarginatura+$margineInterno+20,'Larghezza dorso: '. $dorso . ' mm');
$pdf->Text($cordonatura+$smarginatura+$margineInterno+5,$cordonatura+$smarginatura+$margineInterno+25,'Larghezza smarginatura: '. $smarginatura . ' mm');
$pdf->Text($cordonatura+$smarginatura+$margineInterno+5,$cordonatura+$smarginatura+$margineInterno+30,'Larghezza cordonatura: '. $cordonatura . ' mm');
$pdf->SetFont('Arial','B',20);
$pdf->Text($cordonatura+$smarginatura+$larghezza/2-5,$cordonatura+$smarginatura+$altezza/2+5,'IV');
$pdf->Text($cordonatura+$smarginatura+$dorso+$larghezza+$larghezza/2-15,$cordonatura+$smarginatura+$altezza/2+5,'TITOLO');

// Chiusura PDF
ob_end_clean();
$pdf->Output();
?>
