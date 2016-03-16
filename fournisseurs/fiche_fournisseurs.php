<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 29/02/2016
     * Time: 12:59
     */

    require_once "../fpdf/fpdf.php";
    require_once "../bd/connection.php";

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            $this->Image('../img/logo2.png', 10, 6, 30);
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(120, 20);
            $this->Cell(30, 10, 'LISTE DES FOURNISSEURS', 0, 0, 'C');
//        $this->MultiCell(30, 6, "Liste des employés", 'LRT');
            $this->Ln(15);
            $this->SetFont('Arial', 'B', 11);
            $this->SetFillColor(228, 228, 228);
            $this->Rect(10, 35, 277, 8, 'DF');
            $this->Cell(25, 8, "NUMERO", 1);
            $this->Cell(40, 8, "RAISON SOCIALE", 1);
            $this->Cell(82, 8, "CONTACT", 1);
            $this->Cell(60, 8, "ADRESSE", 1);
            $this->Cell(40, 8, "ACTIVITE", 1);
            $this->Cell(30, 8, "NOTES", 1);
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

    $pdf = new PDF('L');

    $pdf->SetMargins(10, 20);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);

    $pdf->Output();