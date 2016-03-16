<?php
//require_once('../../bd/connection.php');
//require_once('../../tcpdf/tcpdf.php');
//require_once('../../fonctions.php');
//sec_session_start();
    $id = $_GET['id'];

// Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF
    {

        //Page header
        public function Header()
        {
            // Logo
            $image_file = K_PATH_IMAGES . 'logowebsitencare.png';
            $this->Image($image_file, 15, 10, 50, '', 'png', '', 'T', FALSE, 300, '', FALSE, FALSE, 0, FALSE, FALSE, FALSE);
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
            $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, FALSE, 'C', 0, '', 0, FALSE, 'T', 'M');

        }
    }


// create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', FALSE);

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
    $pdf->setFontSubsetting(TRUE);


// Add a page
// This method has several options, check the source code documentation for more information.
// A4 LANDSCAPE (paysage)

    $pdf->AddPage();

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
    $pdf->SetFont('Times', '', 20, '', TRUE);

// set text shadow effect
    $pdf->setTextShadow(array('enabled' => TRUE, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Set some content to print
    $pdf->write(0, 'Bon de Commande', '', 0, 'C', TRUE, 0, FALSE, FALSE, 0);
    $pdf->Ln(2);
    /* ----------------------------------------------------------
                Traitement des données
       ----------------------------------------------------------*/
    $pdf->SetFont('helvetica', '', 12);


    $sql = "SELECT detail_factpro.libelle, detail_factpro.qte_dfp, detail_factpro.pu_dfp, detail_factpro.remise_dfp,bon_commande.num_val,bon_commande.date_bc,bon_commande.num_bc
FROM facture_proforma, detail_factpro,validation,bon_commande
WHERE facture_proforma.ref_fp = detail_factpro.ref_fp
AND validation.num_val=bon_commande.num_val
AND validation.ref_fp=detail_factpro.ref_fp
AND detail_factpro.etat = 'OK'
AND bon_commande.num_val ='" . $id . "'";


    if ($valeur = $connexion->query($sql)) {
        $html = '<table cellspacing="0" cellpadding="1" border="1">';
        $html .= <<<EDO
    <thead>

    <tr style="background-color:#eee;" >
        <th>N° BC</th>
        <th>N° Val</th>
        <th>Date</th>
        <th>Libelle</th>
        <th style="text-align:center;">Quantité</th>
        <th style="text-align:center;">Prix Unitaire</th>
        <th style="text-align:center;">Remise %</th>

    </tr>
</thead>
EDO;
        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
        foreach ($ligne as $list) {
            $num_bc = utf8_encode($list['num_bc']);
            $num_val = utf8_encode($list['num_val']);
            $date_bc = utf8_encode($list['date_bc']);
            $libelle = utf8_encode($list['libelle']);
            $qte_dfp = utf8_encode($list['qte_dfp']);
            $pu_dfp = utf8_encode($list['pu_dfp']);
            $remise_dfp = utf8_encode($list['remise_dfp']);


            $html .= <<<EDO
<tr>
    <td>$num_bc</td>
    <td>$num_val</td>
    <td>$date_bc</td>
    <td>$libelle</td>
    <td style="text-align:center;">$qte_dfp</td>
    <td style="text-align:center;">$pu_dfp</td>
    <td style="text-align:center;">$remise_dfp</td>
 </tr>


EDO;
        }
        $html .= "</table>";
    } else {
        $html = "<span>Aucune information</span>";
    }
    $pdf->writeHTML($html, TRUE, FALSE, FALSE, FALSE, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
    $pdf->Output('bon_de_commande.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
