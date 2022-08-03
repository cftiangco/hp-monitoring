<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require('./utils/fpdf/fpdf.php');

$id = $_GET['id'];


/* ====================== START PDF ===================== */
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('./assets/images/main-logo2.png', 137, 6, 18);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(80);
        $this->Cell(198, 5, 'Republica ng Pilipinas', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(80);
        $this->Cell(198, 5, 'Lalawigan ng Laguna', 0, 1, 'C');
        $this->Cell(80);
        $this->Cell(198, 5, 'Pamahalaang Lungsod ng CABUYAO', 0, 1, 'C');

        $this->SetFont('Arial', '', 13);
        $this->Cell(80);
        $this->Cell(198, 10, 'TANGAPANG PANGLUNGSOD NG NUTRISYON', 0, 1, 'C');

        $this->SetFont('Arial', 'B', 15);
        $this->Cell(80);
        $this->Cell(198, 10, 'FAMILY PROFILE Survey Form', 0, 0, 'C');

        $this->Ln(20);
    }

    function Footer()
    {
        $this->SetXY(300,-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,"ccno form01.09.15" . " ( Page No. " . $this->PageNo() . " )",0,0,'C');
    }

    function gridRow() {
        $this->SetFont('Arial','',9);
        $this->setX(11);
        $this->Cell(40,7,'Value','B',0,0,'');
    
        $this->setX(60);
        $this->Cell(23,7,'Value','B',0,0,'');
    
        $this->setX(90);
        $this->Cell(9,7,'Value','B',0,0,'');
    
        $this->setX(102);
        $this->Cell(35,7,'Value','B',0,0,'');
    
        $this->setX(145);
        $this->Cell(25,7,'Value','B',0,0,'');
    
        $this->setX(183);
        $this->Cell(10,7,'Value','B',0,0,'');
    
        $this->setX(213);
        $this->Cell(10,7,'Value','B',0,0,'');
    
        $this->setX(240);
        $this->Cell(10,7,'Value','B',0,0,'');
    
        $this->setX(267);
        $this->Cell(10,7,'Value','B',0,0,'');
    
        $this->setX(291);
        $this->Cell(23,7,'Value','B',0,0,'');
    
        $this->setX(320);
        $this->Cell(10,7,'Value','B',1,0,'');
    }
}

$pdf = new PDF();

$pdf->AddPage('L','Legal');
$pdf->SetFont('Arial','',9);

$pdf->Cell(30,7,'Barangay / Purok:',0,0,'');
$pdf->Cell(30,5,'Value','B',0,'');

$pdf->setX('285');
$pdf->Cell(30,7,'Petsa ng Survey',0,0,'');
$pdf->Cell(25,5,'Value','B',1,'');

$pdf->Ln(5);
$pdf->Cell(15,7,'HH No.:',0,0,'');
$pdf->Cell(30,5,'Value','B',0,'');

$pdf->setX(60);
$pdf->Cell(25,7,'Family A/B/C/D',0,0,'');
$pdf->Cell(30,5,'Value','B',0,'');

$pdf->setX(120);
$pdf->Cell(40,7,'Miyembron ng HH [dami]',0,0,'');
$pdf->Cell(30,5,'Value','B',0,'');

$pdf->setX(200);
$pdf->Cell(35,7,'Kompletong Address',0,0,'');
$pdf->Cell(30,5,'Value','B',0,'');

$pdf->Ln(5);
$pdf->Cell(32,7,'HOUSEHOLD HEAD',0,0,'');
$pdf->Cell(30,5,'Value','B',0,'');

$pdf->setX(75);
$pdf->Cell(10,7,'Bday',0,0,'');
$pdf->Cell(15,5,'Value','B',0,'');

$pdf->setX(103);
$pdf->Cell(10,7,'Edad',0,0,'');
$pdf->Cell(15,5,'Value','B',0,'');

$pdf->setX(130);
$pdf->Cell(51,7,'Nag-aral [Y/N] GRADE/HS/College',0,0,'');
$pdf->Cell(15,5,'Value','B',0,'');

$pdf->setX(198);
$pdf->Cell(15,7,'Trabaho',0,0,'');
$pdf->Cell(30,5,'Value','B',0,'');

$pdf->setX(245);
$pdf->Cell(27,7,'Buwanang Sahod',0,0,'');
$pdf->Cell(15,5,'Value','B',0,'');

$pdf->setX(290);
$pdf->Cell(35,7,'PhilHealth Member[Y/N]',0,0,'');
$pdf->Cell(15,5,'Value','B',1,'');

$pdf->setX(20);
$pdf->Cell(52,7,'May Disability [Y/N] anong disability',0,0,'');
$pdf->Cell(30,5,'Value','B',0,'');

$pdf->setX(105);
$pdf->Cell(10,7,'M/F',0,1,'');

$pdf->Cell(15,7,'ASAWA',0,0,'');
$pdf->Cell(40,5,'Value','B',0,'');

$pdf->setX(67);
$pdf->Cell(10,7,'Bday',0,0,'');
$pdf->Cell(15,5,'Value','B',0,'');

$pdf->setX(95);
$pdf->Cell(10,7,'Edad',0,0,'');
$pdf->Cell(10,5,'Value','B',0,'');

$pdf->setX(117);
$pdf->Cell(52,7,'Nag-aral [Y/N] GRADE/HS/College',0,0,'');
$pdf->Cell(18,5,'Value','B',0,'');

$pdf->setX(190);
$pdf->Cell(15,7,'Trabaho',0,0,'');
$pdf->Cell(30,5,'Value','B',0,'');

$pdf->setX(245);
$pdf->Cell(27,7,'Buwanang Sahod',0,0,'');
$pdf->Cell(15,5,'Value','B',0,'');

$pdf->setX(290);
$pdf->Cell(35,7,'PhilHealth Member[Y/N]',0,0,'');
$pdf->Cell(15,5,'Value','B',1,'');

$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,'MGA ANAK',0,1,'');

$pdf->setX(20);
$pdf->Cell(15,7,'Pangalan',0,0,'');

$pdf->setX(60);
$pdf->Cell(15,7,'Kapanganakan',0,0,'');

$pdf->setX(90);
$pdf->Cell(15,7,'Edad',0,0,'');

$pdf->setX(110);
$pdf->Cell(15,7,'Nag-aaral',0,0,'');

$pdf->setX(140);
$pdf->Cell(15,7,'Trabaho/Buwanang',0,0,'');

$pdf->setX(180);
$pdf->Cell(15,7,'Sumususo',0,0,'');

$pdf->setX(210);
$pdf->Cell(15,7,'Dumedede',0,0,'');

$pdf->setX(240);
$pdf->Cell(15,7,'Mixed',0,0,'');

$pdf->setX(260);
$pdf->Cell(15,7,'Miyembro ng',0,0,'');

$pdf->setX(290);
$pdf->Cell(15,7,'May Disability',0,0,'');

$pdf->setX(320);
$pdf->Cell(15,7,'Sex',0,1,'');

$pdf->setX(100);
$pdf->Cell(15,1,'(Grade/HS/College Level)',0,0,'');

$pdf->setX(150);
$pdf->Cell(15,1,'Sahod',0,0,'');

$pdf->setX(183);
$pdf->Cell(15,1,'sa Ina',0,0,'');

$pdf->setX(213);
$pdf->Cell(15,1,'sa Bote',0,0,'');

$pdf->setX(239);
$pdf->Cell(15,1,'Feeding',0,0,'');

$pdf->setX(262);
$pdf->Cell(15,1,'PhilHealth',0,1,'');

/* MGA ANAK */

$pdf->gridRow($pdf);
$pdf->gridRow($pdf);
$pdf->gridRow($pdf);
$pdf->gridRow($pdf);
/* END MGA ANAK */

$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,'IBA PANG MIYEMBRO',0,1,'');

/* IBA PANG MIYEMBRO */
$pdf->gridRow($pdf);
$pdf->gridRow($pdf);
$pdf->gridRow($pdf);
/* END IBA PANG MIYEMBRO */

$pdf->Ln(5);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,'TOILET TYPE:',0,0,'');
$pdf->setX(33);
$pdf->SetFont('Arial','',9);
$pdf->Cell(15,7,'Open pit/Antipolo',0,0,'');

$pdf->setX(130);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,'DWELLING UNIT:',0,0,'');
$pdf->setX(158);
$pdf->SetFont('Arial','',9);
$pdf->Cell(15,7,'Barong-barong',0,0,'');

$pdf->setX(230);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,'WATER SOURCE:',0,0,'');
$pdf->setX(260);
$pdf->SetFont('Arial','',9);
$pdf->Cell(15,7,'Artesian Well (Bomba/jetmatic) / Deep well',0,1,'');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,'Mayroong VEGETABLE GARDEN [Y/N]:',0,0,'');
$pdf->setX(72);
$pdf->SetFont('Arial','',9);
$pdf->Cell(15,6,'value','B',0,'');

$pdf->SetFont('Arial','B',9);
$pdf->setX(230);
$pdf->Cell(15,7,'Gumagamit ng IODIZED SALT [Y/N]:',0,0,'');
$pdf->setX(287);
$pdf->SetFont('Arial','',9);
$pdf->Cell(15,6,'value','B',1,'');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,7,'Nag-aalaga ng HAYOP [Y/N] anu-ano:',0,0,'');
$pdf->setX(70);
$pdf->SetFont('Arial','',9);
$pdf->Cell(50,6,'value','B',0,'');

$pdf->SetFont('Arial','B',9);
$pdf->setX(230);
$pdf->Cell(15,7,'Gumagamit ng FORTIFIED FOODS with SPS [Y/N]:',0,0,'');
$pdf->setX(308);
$pdf->SetFont('Arial','',9);
$pdf->Cell(15,6,'value','B',1,'');


// OUTPUT
$pdf->Output();
