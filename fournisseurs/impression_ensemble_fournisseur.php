<?php

//require_once('../bd/connection.php');

// require_once the main TCPDF library (search for installation path).
require_once('../tcpdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $image_file = K_PATH_IMAGES . 'logowebsitencare.png';
        $this->Image($image_file, 15, 10, 50, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        //$this->SetFont('helvetica', 'B', 20);
        // Title
        //$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

    }
}


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('JOCO');
$pdf->SetTitle('Application web');
$pdf->SetSubject('NCA Re Gestion Interne');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);


// Add a page
// This method has several options, check the source code documentation for more information.
// A4 LANDSCAPE (portrait)

$pdf->AddPage('L', 'A4');

// Set font
// déjàvusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('Times', '', 20, '', true);

// set text shadow effect
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Set some content to print
$pdf->write(0, 'LISTE DES FOURNISSEURS', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(2);
/* ----------------------------------------------------------
            Traitement des données
   ----------------------------------------------------------*/
$pdf->SetFont('helvetica', '', 10);
$sql = "SELECT * FROM fournisseur order by code_four ASC ";

if ($valeur = $connexion->query($sql)) {

    $html = '<table cellspacing="0" cellpadding="1" border="1">';
    $html .= <<<EDO
<thead>
    <tr style="background-color:#eee;" >
        <th width="10%">Matricule</th>
        <th>Nom et Prénoms</th>
        <th>Contact</th>
        <th>Fax</th>
        <th>Email</th>
    </tr>
</thead>
EDO;
    $ligne = $valeur->fetch_all(MYSQL_ASSOC);
    foreach ($ligne as $list) {
        $code_four = utf8_encode($list['code_four']);

        $nom_four = utf8_encode($list['nom_four']);

        $tel_four = utf8_encode($list['telephonepro_four']);
        $fax_four=utf8_encode($list['fax_four']);
        $email_four = utf8_encode($list['email_four']);

        $html .= <<<EDO
<tr>
    <td width="10%">$code_four</td>

    <td>$nom_four</td>
    <td>$tel_four</td>
    <td>$fax_four</td>
    <td>$email_four</td>
</tr>
EDO;
    }
    $html .= "</table>";
} else {
    $html = "<span>Aucune information</span>";
}
$pdf->writeHTML($html, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('liste_des_fournisseurs.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
