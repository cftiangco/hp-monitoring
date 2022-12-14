<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once('./utils/fpdf/fpdf.php');
require_once('./models/Survey.php');
require_once('./func/helpers.php');

$survey = new Survey();

$data = new stdClass;

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $data = $survey->getData($_GET['id']);
}

if (isset($_GET['user_id']) && $_GET['user_id']) {

    $id = $survey->getSurveyId($_GET['user_id']);
    $data = $survey->getData($id);
}


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

        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetXY(300, -15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, "ccno form01.09.15" . " ( Page No. " . $this->PageNo() . " )", 0, 0, 'C');
    }

    function gridRow($data)
    {
        $this->SetFont('Arial', '', 9);
        $this->setX(11);
        $this->Cell(40, 7, $data->lastname . ', ' . $data->firstname . ' ' . $data->middlename, 'B', 0, 0, '');

        $this->setX(60);
        $this->Cell(23, 7, dateFormat($data->birthday), 'B', 0, 0, '');

        $this->setX(90);
        $this->Cell(9, 7, getAge($data->birthday), 'B', 0, 0, '');

        $this->setX(102);
        $this->Cell(35, 7, $data->studying . ' / ' . $data->grade, 'B', 0, 0, '');

        $this->setX(145);
        $this->Cell(15, 7, $data->occupation . ' / ' . $data->salary, 'B', 0, 0, '');

        $this->setX(183);
        $this->Cell(10, 7, $data->breast_feeding, 'B', 0, 0, '');

        $this->setX(213);
        $this->Cell(10, 7, $data->bottle_feeding, 'B', 0, 0, '');

        $this->setX(240);
        $this->Cell(10, 7, $data->mix_feeding, 'B', 0, 0, '');

        $this->setX(267);
        $this->Cell(10, 7, $data->philhealth_member, 'B', 0, 0, '');

        $this->setX(291);
        $this->Cell(23, 7, $data->disability . ' / ' . $data->disability_type, 'B', 0, 0, '');

        $this->setX(320);
        $this->Cell(10, 7, $data->sex, 'B', 1, 0, '');
    }
}

$pdf = new PDF();

$pdf->AddPage('L', 'Legal');
$pdf->SetFont('Arial', '', 9);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 7, 'Barangay / Purok:', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 5, $data->purok, 'B', 0, '');

$pdf->setX('285');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 7, 'Petsa ng Survey', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, dateFormat($data->created_at), 'B', 1, '');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'HH No.:', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 5, $data->hh_no, 'B', 0, '');

$pdf->setX(60);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 7, 'Family A/B/C/D', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 5, $data->family_type, 'B', 0, '');

$pdf->setX(120);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 7, 'Miyembron ng HH [dami]', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 5, $data->family_members, 'B', 0, '');

$pdf->setX(200);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(35, 7, 'Kompletong Address', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 5, $data->complete_address, 'B', 0, '');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(32, 7, 'HOUSEHOLD HEAD', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 5, $data->household_head, 'B', 0, '');

$pdf->setX(75);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 7, 'Bday', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 5, dateFormat($data->household_head_birthday), 'B', 0, '');

$pdf->setX(103);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 7, 'Edad', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 5, $data->household_head_age, 'B', 0, '');

$pdf->setX(130);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(51, 7, 'Nag-aral [Y/N] GRADE/HS/College', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 5, $data->household_head_student . ' / ' . $data->household_head_student_grade, 'B', 0, '');

$pdf->setX(198);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'Trabaho', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 5, $data->household_head_occupation, 'B', 0, '');

$pdf->setX(247);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(27, 7, 'Buwanang Sahod', 0, 0, '');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, $data->household_head_salary, 'B', 0, '');

$pdf->setX(290);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(38, 7, 'PhilHealth Member[Y/N]', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(13, 5, $data->household_head_philhealth_member, 'B', 1, '');

$pdf->setX(20);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(57, 7, 'May Disability [Y/N] anong disability', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, $data->household_head_disability . ' / ' . $data->household_head_disability_type, 'B', 0, '');

$pdf->setX(105);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 7, 'M/F:', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 6, $data->household_head_gender, 'B', 1, '');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'ASAWA', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, $data->partner_name, 'B', 0, '');

$pdf->setX(67);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 7, 'Bday', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 5, dateFormat($data->partner_birthday), 'B', 0, '');

$pdf->setX(95);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 7, 'Edad', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 5, $data->partner_age, 'B', 0, '');

$pdf->setX(117);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(52, 7, 'Nag-aral [Y/N] GRADE/HS/College', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(18, 5, $data->partner_student . ' / ' . $data->partner_grade, 'B', 0, '');

$pdf->setX(190);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'Trabaho', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 5, $data->partner_occupation, 'B', 0, '');

$pdf->setX(247);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(27, 7, 'Buwanang Sahod', 0, 0, '');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, $data->partner_salary, 'B', 0, '');

$pdf->setX(290);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(38, 7, 'PhilHealth Member[Y/N]', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(13, 5, $data->partner_philhealth_member, 'B', 1, '');

$pdf->setX(20);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(45, 7, 'Buntis [Y/N] Age of Gestation', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 5, $data->partner_pregnant . ' / ' . $data->partner_age_of_gestation, 'B', 0, '');

$pdf->setX(75);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(6.9, 7, 'LMP', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 5, dateFormat($data->lmp), 'B', 0, '');

$pdf->setX(103);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(7, 7, 'EDC', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 5, dateFormat($data->edc), 'B', 0, '');

$pdf->setX(130);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(23, 7, 'Nagpapasuso:', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 5, $data->breast_feeding, 'B', 0, '');

$pdf->setX(163);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(93, 7, 'Gumagamit ng Family Planning Method [Y/N] anong method', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(16, 5, $data->family_planning_method . ' / ' . $data->family_planning_methodtype, 'B', 0, '');

$pdf->setX(273);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(56, 7, 'May disability [Y/N] anong disability', 0, 0, '');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(12, 5, $data->disability . ' / ' . $data->disability_type, 'B', 0, '');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'MGA ANAK', 0, 1, '');

$pdf->setX(20);
$pdf->Cell(15, 7, 'Pangalan', 0, 0, '');

$pdf->setX(60);
$pdf->Cell(15, 7, 'Kapanganakan', 0, 0, '');

$pdf->setX(90);
$pdf->Cell(15, 7, 'Edad', 0, 0, '');

$pdf->setX(110);
$pdf->Cell(15, 7, 'Nag-aaral', 0, 0, '');

$pdf->setX(140);
$pdf->Cell(15, 7, 'Trabaho/Buwanang', 0, 0, '');

$pdf->setX(180);
$pdf->Cell(15, 7, 'Sumususo', 0, 0, '');

$pdf->setX(210);
$pdf->Cell(15, 7, 'Dumedede', 0, 0, '');

$pdf->setX(240);
$pdf->Cell(15, 7, 'Mixed', 0, 0, '');

$pdf->setX(260);
$pdf->Cell(15, 7, 'Miyembro ng', 0, 0, '');

$pdf->setX(290);
$pdf->Cell(15, 7, 'May Disability', 0, 0, '');

$pdf->setX(320);
$pdf->Cell(15, 7, 'Sex', 0, 1, '');

$pdf->setX(100);
$pdf->Cell(15, 1, '(Grade/HS/College Level)', 0, 0, '');

$pdf->setX(150);
$pdf->Cell(15, 1, 'Sahod', 0, 0, '');

$pdf->setX(183);
$pdf->Cell(15, 1, 'sa Ina', 0, 0, '');

$pdf->setX(213);
$pdf->Cell(15, 1, 'sa Bote', 0, 0, '');

$pdf->setX(239);
$pdf->Cell(15, 1, 'Feeding', 0, 0, '');

$pdf->setX(262);
$pdf->Cell(15, 1, 'PhilHealth', 0, 1, '');

if (property_exists($data, 'members')) {
    /* MGA ANAK */
    foreach ($data->members as $member) {
        if ($member->type_id == 1) {
            $pdf->gridRow($member);
        }
    }

    /* END MGA ANAK */

    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(15, 7, 'IBA PANG MIYEMBRO', 0, 1, '');

    /* IBA PANG MIYEMBRO */
    foreach ($data->members as $member) {
        if ($member->type_id != 1) {
            $pdf->gridRow($member);
        }
    }
    /* END IBA PANG MIYEMBRO */
}

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'TOILET TYPE:', 0, 0, '');
$pdf->setX(33);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 7, $data->toilet_type, 0, 0, '');

$pdf->setX(130);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'DWELLING UNIT:', 0, 0, '');
$pdf->setX(158);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 7, $data->dwelling_unit, 0, 0, '');

$pdf->setX(230);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'WATER SOURCE:', 0, 0, '');
$pdf->setX(260);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 7, $data->water_source, 0, 1, '');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'Mayroong VEGETABLE GARDEN [Y/N]:', 0, 0, '');
$pdf->setX(72);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 6, $data->vagetable_garden, 'B', 0, '');

$pdf->SetFont('Arial', 'B', 9);
$pdf->setX(230);
$pdf->Cell(15, 7, 'Gumagamit ng IODIZED SALT [Y/N]:', 0, 0, '');
$pdf->setX(287);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 6, $data->using_iodized_salt, 'B', 1, '');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'Nag-aalaga ng HAYOP [Y/N] anu-ano:', 0, 0, '');
$pdf->setX(70);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 6, $data->has_animals . ' / ' . $data->type_of_animals, 'B', 0, '');

$pdf->SetFont('Arial', 'B', 9);
$pdf->setX(230);
$pdf->Cell(15, 7, 'Gumagamit ng FORTIFIED FOODS with SPS [Y/N]:', 0, 0, '');
$pdf->setX(308);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 6, $data->using_fortified_foods, 'B', 1, '');


// OUTPUT
$pdf->Output();
