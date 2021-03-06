<?php

// Caricamento dati passati dal form
$tipologia = $_GET["tipologia"];
$larghezza = $_GET["larghezza"];
$altezza = $_GET["altezza"];
$dorso = $_GET["dorso"];
$abbondanza = $_GET["abbondanza"];
$taglio = $_GET["taglio"];
$margineInterno = $_GET["margineInterno"];
if (isset($_GET['stampaInfo'])) {
    $stampaInfo = true;
} else {
    $stampaInfo = false;
}
if (isset($_GET['aletta'])) {
    $aletta = $_GET['aletta'];
} else {
    $aletta = 0;
}
$ISBN = $_GET["ISBN"];


if ($tipologia == "0") {
    // *********************************************************************************************************************************************************************************
    // SE COPERTINA SENZA ALETTE
    // *********************************************************************************************************************************************************************************
    $copertinaLarghezza = $larghezza * 2 + $dorso + $abbondanza * 2 + $taglio * 2;
    $copertinaAltezza = $altezza + $abbondanza * 2 + $taglio * 2;

    // Creazione del documento
    require('fpdf.php');
    if ($copertinaLarghezza >= $copertinaAltezza) {
        $pdf = new FPDF('L', 'mm', array($copertinaLarghezza, $copertinaAltezza));
    } else {
        $pdf = new FPDF('P', 'mm', array($copertinaLarghezza, $copertinaAltezza));
    }
    $pdf->AddPage();

    //setta il nero
    $pdf->SetDrawColor(0, 0, 0);

    // Rettangolo copertina con smarginatura
    $pdf->Rect($taglio, $taglio, $copertinaLarghezza - 2 * $taglio, $copertinaAltezza - 2 * $taglio, 'D');

    // Rettagolo pagina Quarta
    $pdf->Rect($taglio + $abbondanza, $taglio + $abbondanza, $larghezza, $altezza, 'D');

    // Rettagolo pagina Prima
    $pdf->Rect($taglio + $abbondanza + $larghezza + $dorso, $taglio + $abbondanza, $larghezza, $altezza, 'D');

    // Rettangolo dorso
    $pdf->Rect($taglio + $abbondanza + $larghezza, $taglio + $abbondanza, $dorso, $altezza, 'D');

    //setta il rosso
    $pdf->SetDrawColor(255, 0, 0);

    // Rettangolo di taglio
    // Rettagolo pagina Quarta
    $pdf->Rect($taglio + $abbondanza, $taglio + $abbondanza, $copertinaLarghezza - 2 * ($taglio + $abbondanza), $copertinaAltezza - 2 * ($taglio + $abbondanza), 'D');

    //setta il verde
    $pdf->SetDrawColor(0, 255, 0);

    // Margini di sicurezza quarta
    $pdf->Rect($taglio + $abbondanza + $margineInterno, $taglio + $abbondanza + $margineInterno, $larghezza - 2 * $margineInterno, $altezza - 2 * $margineInterno, 'D');

    // Margini di sicurezza prima
    $pdf->Rect($taglio + $abbondanza + $larghezza + $dorso + $margineInterno, $taglio + $abbondanza + $margineInterno, $larghezza - 2 * $margineInterno, $altezza - 2 * $margineInterno, 'D');

    //setta il nero
    $pdf->SetDrawColor(0, 0, 0);

    // Linee lato sopra
    $pdf->Line($taglio + $abbondanza, 0, $taglio + $abbondanza, $taglio);
    $pdf->Line($taglio + $abbondanza + $larghezza, 0, $taglio + $abbondanza + $larghezza, $taglio);
    $pdf->Line($taglio + $abbondanza + $larghezza + $dorso, 0, $taglio + $abbondanza + $larghezza + $dorso, $taglio);
    $pdf->Line($taglio + $abbondanza + 2 * $larghezza + $dorso, 0, $taglio + $abbondanza + 2 * $larghezza + $dorso, $taglio);

    // Linee lato sotto
    $pdf->Line($taglio + $abbondanza, $copertinaAltezza - $taglio, $taglio + $abbondanza, $copertinaAltezza);
    $pdf->Line($taglio + $abbondanza + $larghezza, $copertinaAltezza - $taglio, $taglio + $abbondanza + $larghezza, $copertinaAltezza);
    $pdf->Line($taglio + $abbondanza + $larghezza + $dorso, $copertinaAltezza - $taglio, $taglio + $abbondanza + $larghezza + $dorso, $copertinaAltezza);
    $pdf->Line($taglio + $abbondanza + 2 * $larghezza + $dorso, $copertinaAltezza - $taglio, $taglio + $abbondanza + 2 * $larghezza + $dorso, $copertinaAltezza);

    // Linee sinistra
    $pdf->Line(0, $taglio + $abbondanza, $taglio, $taglio + $abbondanza);
    $pdf->Line(0, $copertinaAltezza - $taglio - $abbondanza, $taglio, $copertinaAltezza - $taglio - $abbondanza);

    // Linee destra
    $pdf->Line($copertinaLarghezza - $taglio, $taglio + $abbondanza, $copertinaLarghezza, $taglio + $abbondanza);
    $pdf->Line($copertinaLarghezza - $taglio, $copertinaAltezza - $taglio - $abbondanza, $copertinaLarghezza, $copertinaAltezza - $taglio - $abbondanza);

    // Setta il font
    $pdf->SetFont('Arial', 'B', 10);
    if ($stampaInfo == true) {
        // Muoviti internamente nella zona margini
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5, $taglio + $abbondanza + $margineInterno + 10, 'Dimensioni totali: ' . $copertinaLarghezza . 'x' . $copertinaAltezza . ' mm');
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5, $taglio + $abbondanza + $margineInterno + 15, 'Dimensione pagina: ' . $larghezza . 'x' . $altezza . ' mm');
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5, $taglio + $abbondanza + $margineInterno + 20, 'Larghezza dorso: ' . $dorso . ' mm');
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5, $taglio + $abbondanza + $margineInterno + 25, 'Larghezza abbondanza: ' . $abbondanza . ' mm');
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5, $taglio + $abbondanza + $margineInterno + 30, 'Segni di taglio: ' . $taglio . ' mm');
        //$pdf->Text($taglio + $abbondanza + $margineInterno + 5, $taglio + $abbondanza + $margineInterno + 35, 'ISBN: '.count($ISBN));
    }
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Text($taglio + $abbondanza + $larghezza / 2 - 5, $taglio + $abbondanza + $altezza / 2 + 5, 'IV');
    $pdf->Text($taglio + $abbondanza + $dorso + $larghezza + $larghezza / 2 - 15, $taglio + $abbondanza + $altezza / 2 + 5, 'TITOLO');
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Text($taglio + $abbondanza + $dorso + $larghezza + $larghezza / 2 - 18, $taglio + $abbondanza + $altezza / 2 + 10, 'www.archistico.com');

    require('ISBN.php');
    $nISBN = new ISBN();
    $nISBN->Codifica($ISBN);
    $aISBN = str_split($nISBN->getISBN());
    
    // Disegna ISBN
    $Lmodulo = 0.35;
    $Hmodulo = 20;
    $bordo = 5;
    
    $posX = $taglio + $abbondanza + $larghezza - $margineInterno - $Lmodulo*95 - $bordo;
    $posY = $copertinaAltezza - $taglio - $abbondanza - $margineInterno - $Hmodulo - $bordo+2;
    
    $pdf->SetFillColor(255,255,255);
    $pdf->Rect($posX-$bordo, $posY-$bordo, $Lmodulo*95+2*$bordo, $Hmodulo+2*$bordo-2, 'F');
    
    $pdf->SetLineWidth(0);
    $pdf->SetFillColor(0,0,0);
    
    for($c=0;$c<count($aISBN);$c++){
        if($aISBN[$c]==1) {
            if($c<=3 || $c>=92 || ($c>=46 && $c<=49)) {
                $pdf->Rect($posX+$c*$Lmodulo, $posY, $Lmodulo, $Hmodulo, 'F');
            } else {
                $pdf->Rect($posX+$c*$Lmodulo, $posY, $Lmodulo, $Hmodulo-2, 'F');
            }
        }
    }
    
    $pdf->SetFont('Arial', '', 8);
    $pdf->Text($posX-2.75, $posY+$Hmodulo+0.75, $ISBN[0]);
    for($c=1;$c<=6;$c++) { $pdf->Text($posX+1.75+($c-1)*2.40, $posY+$Hmodulo+0.75, $ISBN[$c]); }
    for($c=1;$c<=6;$c++) { $pdf->Text($posX+17.75+($c-1)*2.40, $posY+$Hmodulo+0.75, $ISBN[$c+6]); }
    $pdf->SetFont('Arial', '', 8.25);
    $pdf->Text($posX-0.25, $posY-0.5, "ISBN:  ".substr($ISBN,0,3)."-".substr($ISBN,3,2)."-".substr($ISBN,5,7)."-".substr($ISBN,12,1));
    
    // Chiusura PDF
    ob_end_clean();
    $pdf->Output('I', 'Cover senza alette '.$larghezza.'x'.$altezza.' mm - dorso '.$dorso.' mm.pdf');
} else {
    // *********************************************************************************************************************************************************************************
    // SE COPERTINA CON ALETTE
    // *********************************************************************************************************************************************************************************
    $copertinaLarghezza = $larghezza * 2 + $dorso + $abbondanza * 2 + $taglio * 2 + 2 * $aletta;
    $copertinaAltezza = $altezza + $abbondanza * 2 + $taglio * 2;

    // Creazione del documento
    require('fpdf.php');
    if ($copertinaLarghezza >= $copertinaAltezza) {
        $pdf = new FPDF('L', 'mm', array($copertinaLarghezza, $copertinaAltezza));
    } else {
        $pdf = new FPDF('P', 'mm', array($copertinaLarghezza, $copertinaAltezza));
    }
    $pdf->AddPage();

    //setta il nero
    $pdf->SetDrawColor(0, 0, 0);

    // Rettangolo copertina con smarginatura
    $pdf->Rect($taglio, $taglio, $copertinaLarghezza - 2 * $taglio, $copertinaAltezza - 2 * $taglio, 'D');

    // Rettagolo pagina Quarta
    $pdf->Rect($taglio + $abbondanza +$aletta, $taglio + $abbondanza, $larghezza, $altezza, 'D');

    // Rettagolo pagina Prima
    $pdf->Rect($taglio + $abbondanza + $larghezza + $dorso + $aletta, $taglio + $abbondanza, $larghezza, $altezza, 'D');

    // Rettangolo dorso
    $pdf->Rect($taglio + $abbondanza + $larghezza + $aletta, $taglio + $abbondanza, $dorso, $altezza, 'D');
    
    // Rettangolo aletta DX
    $pdf->Rect($taglio + $abbondanza, $taglio + $abbondanza, $aletta, $altezza, 'D');

    // Rettangolo aletta SX
    $pdf->Rect($copertinaLarghezza - $taglio - $abbondanza - $aletta, $taglio + $abbondanza, $aletta, $altezza, 'D');
    
    //setta il rosso
    $pdf->SetDrawColor(255, 0, 0);

    // Rettangolo di taglio
    // Rettagolo pagina Quarta
    $pdf->Rect($taglio + $abbondanza, $taglio + $abbondanza, $copertinaLarghezza - 2 * ($taglio + $abbondanza), $copertinaAltezza - 2 * ($taglio + $abbondanza), 'D');

    //setta il verde
    $pdf->SetDrawColor(0, 255, 0);

    // Margini di sicurezza quarta
    $pdf->Rect($taglio + $abbondanza + $margineInterno + $aletta, $taglio + $abbondanza + $margineInterno, $larghezza - 2 * $margineInterno, $altezza - 2 * $margineInterno, 'D');

    // Margini di sicurezza prima
    $pdf->Rect($taglio + $abbondanza + $larghezza + $dorso + $margineInterno + $aletta, $taglio + $abbondanza + $margineInterno, $larghezza - 2 * $margineInterno, $altezza - 2 * $margineInterno, 'D');
    
    // Margini di sicurezza aletta DX
    $pdf->Rect($taglio + $abbondanza + $margineInterno, $taglio + $abbondanza + $margineInterno, $aletta - 2 * $margineInterno, $altezza - 2 * $margineInterno, 'D');
    
    // Margini di sicurezza aletta SX
    $pdf->Rect($copertinaLarghezza - $taglio - $abbondanza - $aletta + $margineInterno, $taglio + $abbondanza + $margineInterno, $aletta - 2 * $margineInterno, $altezza - 2 * $margineInterno, 'D');
    
    //setta il nero
    $pdf->SetDrawColor(0, 0, 0);

    // Linee lato sopra
    $pdf->Line($taglio + $abbondanza, 0, $taglio + $abbondanza, $taglio);
    $pdf->Line($taglio + $abbondanza + $aletta, 0, $taglio + $abbondanza + $aletta, $taglio);
    $pdf->Line($taglio + $abbondanza + $larghezza + $aletta, 0, $taglio + $abbondanza + $larghezza + $aletta, $taglio);
    $pdf->Line($taglio + $abbondanza + $larghezza + $dorso + $aletta, 0, $taglio + $abbondanza + $larghezza + $dorso + $aletta, $taglio);
    $pdf->Line($taglio + $abbondanza + 2 * $larghezza + $dorso + $aletta, 0, $taglio + $abbondanza + 2 * $larghezza + $dorso + $aletta, $taglio);
    $pdf->Line($copertinaLarghezza - $taglio - $abbondanza, 0, $copertinaLarghezza - $taglio - $abbondanza, $taglio);

    // Linee lato sotto
    $pdf->Line($taglio + $abbondanza, $copertinaAltezza - $taglio, $taglio + $abbondanza, $copertinaAltezza);
    
    $pdf->Line($taglio + $abbondanza + $aletta, $copertinaAltezza - $taglio, $taglio + $abbondanza + $aletta, $copertinaAltezza);
    
    $pdf->Line($taglio + $abbondanza + $larghezza + $aletta, $copertinaAltezza - $taglio, $taglio + $abbondanza + $larghezza + $aletta, $copertinaAltezza);
    $pdf->Line($taglio + $abbondanza + $larghezza + $dorso + $aletta, $copertinaAltezza - $taglio, $taglio + $abbondanza + $larghezza + $dorso + $aletta, $copertinaAltezza);
    $pdf->Line($taglio + $abbondanza + 2 * $larghezza + $dorso + $aletta, $copertinaAltezza - $taglio, $taglio + $abbondanza + 2 * $larghezza + $dorso + $aletta, $copertinaAltezza);
    
    $pdf->Line($copertinaLarghezza - $taglio - $abbondanza, $copertinaAltezza - $taglio, $copertinaLarghezza - $taglio - $abbondanza, $copertinaAltezza);
    
    // Linee sinistra
    $pdf->Line(0, $taglio + $abbondanza, $taglio, $taglio + $abbondanza);
    $pdf->Line(0, $copertinaAltezza - $taglio - $abbondanza, $taglio, $copertinaAltezza - $taglio - $abbondanza);

    // Linee destra
    $pdf->Line($copertinaLarghezza - $taglio, $taglio + $abbondanza, $copertinaLarghezza, $taglio + $abbondanza);
    $pdf->Line($copertinaLarghezza - $taglio, $copertinaAltezza - $taglio - $abbondanza, $copertinaLarghezza, $copertinaAltezza - $taglio - $abbondanza);

    // Setta il font
    $pdf->SetFont('Arial', 'B', 10);
    if ($stampaInfo == true) {
        // Muoviti internamente nella zona margini
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5 + $aletta, $taglio + $abbondanza + $margineInterno + 10, 'Dimensioni totali: ' . $copertinaLarghezza . 'x' . $copertinaAltezza . ' mm');
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5 + $aletta, $taglio + $abbondanza + $margineInterno + 15, 'Dimensione pagina: ' . $larghezza . 'x' . $altezza . ' mm');
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5 + $aletta, $taglio + $abbondanza + $margineInterno + 20, 'Larghezza dorso: ' . $dorso . ' mm');
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5 + $aletta, $taglio + $abbondanza + $margineInterno + 25, 'Larghezza abbondanza: ' . $abbondanza . ' mm');
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5 + $aletta, $taglio + $abbondanza + $margineInterno + 30, 'Segni di taglio: ' . $taglio . ' mm');
        $pdf->Text($taglio + $abbondanza + $margineInterno + 5 + $aletta, $taglio + $abbondanza + $margineInterno + 35, 'Aletta: ' . $aletta . ' mm');
    }
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Text($taglio + $abbondanza + $larghezza / 2 - 5 + $aletta, $taglio + $abbondanza + $altezza / 2 + 5, 'IV');
    $pdf->Text($taglio + $abbondanza + $dorso + $larghezza + $larghezza / 2 - 15 + $aletta, $taglio + $abbondanza + $altezza / 2 + 5, 'TITOLO');
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Text($taglio + $abbondanza + $dorso + $larghezza + $larghezza / 2 - 18 + $aletta, $taglio + $abbondanza + $altezza / 2 + 10, 'www.archistico.com');
    
    require('ISBN.php');
    $nISBN = new ISBN();
    $nISBN->Codifica($ISBN);
    $aISBN = str_split($nISBN->getISBN());
    
    // Disegna ISBN
    $Lmodulo = 0.35;
    $Hmodulo = 20;
    $bordo = 5;
    
    $posX = $taglio + $abbondanza + $larghezza - $margineInterno - $Lmodulo*95 - $bordo + $aletta;
    $posY = $copertinaAltezza - $taglio - $abbondanza - $margineInterno - $Hmodulo - $bordo+2;
    
    $pdf->SetFillColor(255,255,255);
    $pdf->Rect($posX-$bordo, $posY-$bordo, $Lmodulo*95+2*$bordo, $Hmodulo+2*$bordo-2, 'F');
    
    $pdf->SetLineWidth(0);
    $pdf->SetFillColor(0,0,0);
    
    for($c=0;$c<count($aISBN);$c++){
        if($aISBN[$c]==1) {
            if($c<=3 || $c>=92 || ($c>=46 && $c<=49)) {
                $pdf->Rect($posX+$c*$Lmodulo, $posY, $Lmodulo, $Hmodulo, 'F');
            } else {
                $pdf->Rect($posX+$c*$Lmodulo, $posY, $Lmodulo, $Hmodulo-2, 'F');
            }
        }
    }
    
    $pdf->SetFont('Arial', '', 8);
    $pdf->Text($posX-2.75, $posY+$Hmodulo+0.75, $ISBN[0]);
    for($c=1;$c<=6;$c++) { $pdf->Text($posX+1.75+($c-1)*2.40, $posY+$Hmodulo+0.75, $ISBN[$c]); }
    for($c=1;$c<=6;$c++) { $pdf->Text($posX+17.75+($c-1)*2.40, $posY+$Hmodulo+0.75, $ISBN[$c+6]); }
    $pdf->SetFont('Arial', '', 8.25);
    $pdf->Text($posX-0.25, $posY-0.5, "ISBN:  ".substr($ISBN,0,3)."-".substr($ISBN,3,2)."-".substr($ISBN,5,7)."-".substr($ISBN,12,1));
    
    // Chiusura PDF
    ob_end_clean();
    $pdf->Output('I', 'Cover con alette '.$larghezza.'x'.$altezza.' mm - dorso '.$dorso.' mm.pdf');
}   

// Aggiunge riga nel DB
require('SQLaggiungi.php');
SQLaggiungi($tipologia, $larghezza, $altezza, $dorso, $abbondanza, $taglio, $margineInterno, $aletta, $ISBN);

?>
