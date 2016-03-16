<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 15/02/2016
     * Time: 15:22
     */

    require_once "../fpdf/fpdf.php";
    require_once "../bd/connection.php";
    header('Content-Type: text/html; charset=utf-8');

//$id = $_GET['id'];

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            $this->Image('../img/logo2.png', 10, 6, 30);
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(120, 20);
            $this->Cell(30, 10, 'LISTE DES EMPLOYES', 0, 0, 'C');
//        $this->MultiCell(30, 6, "Liste des employés", 'LRT');
            $this->Ln(15);
            $this->SetFont('Arial', 'B', 11);
            $this->SetFillColor(228, 228, 228);
            $this->Rect(10, 35, 277, 8, 'DF');
            $this->Cell(25, 8, "MATRICULE", 1);
            $this->Cell(70, 8, "NOM ET PRENOMS", 1);
            $this->Cell(40, 8, "FONCTION", 1);
            $this->Cell(60, 8, "DEPARTMENT", 1);
            $this->Cell(82, 8, "CONTACT", 1);
            $this->Ln(8);
        }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-30);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            /*
            $this->Image('logo1.png');
            $this->SetLeftMargin(84);
            $this->Cell(22, 0, $this->Image('logo1.png') . '', 0, 0, 'C');
            $this->Ln(1);
            $this->Cell(10, 0, $this->PageNo() . '/{nb}', 0, 0, 'R');*/
        }
    }

// Instantiation of inherited class
    $pdf = new PDF('L');

    $pdf->SetMargins(10, 20);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);

//DETAILS DE LA DEMANDE
    $sql = "SELECT code_emp, titre_emp, nom_emp, prenoms_emp, fonction_emp, departement_emp, email_emp, tel_emp FROM employes";
    if ($valeur = $connexion->query($sql)) {
        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
        $i = 1;
        foreach ($ligne as $list) {
            $pdf->Cell(25, 16, $list['code_emp'], 1);
            $pdf->Cell(70, 16, $list['titre_emp'] . " " . $list['nom_emp'] . " " . $list['prenoms_emp'], 1);
            $pdf->Cell(40, 16, $list['fonction_emp'], 1);
            $pdf->Cell(60, 16, $list['departement_emp'], 1);
//            $pdf->MultiCell(82, 16, "Tel: " . $list['tel_emp'], 1);
//            break;
        $pdf->MultiCell(82, 8, "Tel: " . $list['tel_emp'] . "\nE-mail: " . $list['email_emp'], 1);
//        $pdf->Ln();
        }
    }

    $pdf->Output();