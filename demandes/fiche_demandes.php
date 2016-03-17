<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 15/02/2016
     * Time: 12:00
     */

    require_once "../fpdf/fpdf.php";
    require_once "../bd/connection.php";

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('../img/logo3.png', 10, 6, 50);
            $this->SetFont('Arial', 'B', 15);
            // Move to the right
            $this->Cell(80, 20);
//        $this->SetMargins(80, 0);
            $this->Cell(20, 10, 'DEMANDE DE BIENS ET SERVICES', 0, 0, 'C');
            $this->Ln(15);
        }

        // Page footer
        function Footer()
        {
            $this->Image('../img/logo1.png', 95, 280, 10.5, 8);
        }
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM demandes WHERE code_dbs = '" . $id . "'";
    if ($valeur = $connexion->query($sql)) {
        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
        foreach ($ligne as $list) {
            $code_emp = $list['code_emp'];
            $date_dbs = $list['date_dbs'];
            $objets_dbs = $list['objets_dbs'];
        }
    }

    $sql = "SELECT * FROM employes WHERE code_emp = '" . $code_emp . "'";
    if ($valeur = $connexion->query($sql)) {
        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
        foreach ($ligne as $list) {
            $nom_emp = $list['nom_emp'] . " " . $list['prenoms_emp'];
            $departement_emp = $list['departement_emp'];
        }
    }

// Instantiation of inherited class
    $pdf = new PDF();

    $pdf->SetMargins(10, 20);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTitle("Gesterne | " . $id, TRUE);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetFillColor(228, 228, 228);
    $pdf->Rect(10, 35, 70, 8, 'DF');
    $pdf->Cell(70, 8, "NUMERO", 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120, 8, " " . $id, 1); //TODO: générer le numéro de la demande
    $pdf->Ln(8);

    $pdf->SetFont('Arial', 'B', 12);
//    $pdf->Rect(10, 43, 190, 8, 'DF');
    $pdf->Cell(0, 8, "DEMANDEUR", 1, 0, "C");
    $pdf->Ln(8);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Rect(10, 51, 70, 8, 'DF');
    $pdf->Cell(70, 8, "NOM ET PRENOMS", 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120, 8, " " . $nom_emp, 1); //TODO: générer les infos sur le demandeur
    $pdf->Ln(8);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Rect(10, 59, 70, 8, 'DF');
    $pdf->Cell(70, 8, "DIRECTION ET DEPARTEMENT", 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120, 8, " " . $departement_emp, 1); //TODO: générer les infos sur le demandeur
    $pdf->Ln(8);

    $pdf->SetFont('Arial', 'B', 12);
//    $pdf->Rect(10, 67, 190, 8, 'DF');
    $pdf->Cell(0, 8, "DETAILS DE LA DEMANDE", 1, 0, "C");
    $pdf->Ln(8);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Rect(10, 75, 190, 8, 'DF');
    $pdf->Cell(25, 8, "NUMERO", 1);
    $pdf->Cell(90, 8, "LIBELLE", 1);
    $pdf->Cell(25, 8, "QUANTITE", 1);
    $pdf->Cell(50, 8, "OBSERVATION", 1);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 10);
    $sql = "SELECT * FROM details_demande WHERE code_dbs = '" . $id . "'";
    if ($valeur = $connexion->query($sql)) {
        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
        $i = 1;
        foreach ($ligne as $list) {
            $pdf->Cell(25, 8, $i++, 1, 0, "C");
            $pdf->Cell(90, 8, $list['libelle_dd'], 1);
            $pdf->Cell(25, 8, $list['qte_dd'], 1, 0, "C");
            $pdf->Cell(50, 8, $list['observations_dd'], 1);
            $pdf->Ln(8);
        }
    }

//VISAS - SIGNATURES
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Rect(10, 75 + (8 * $i), 190, 8, 'DF');
    $pdf->Cell(90, 8, "OBSERVATIONS", 1);
    $pdf->Cell(40, 8, "DATE", 1);
    $pdf->Cell(60, 8, "SIGNATURE", 1);
    $pdf->Ln(8);

    $pdf->Cell(90, 20, "", 1);
//    $pdf->Cell(90, 20, $objets_dbs, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 20, $date_dbs, 1, 0, 'C');
    $pdf->Cell(60, 20, "", 1);
    $pdf->Ln(20);

    $pdf->SetFont('Arial', 'B', 12);
//    $pdf->Rect(10, 137, 190, 8, 'DF');
    $pdf->Cell(0, 8, "VISA DU SUPERIEUR HIERARCHIQUE", 1, 0, "C");
    $pdf->Ln(8);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Rect(10, 111 + (8 * $i), 190, 8, 'DF');
    $pdf->Cell(90, 8, "OBSERVATIONS", 1);
    $pdf->Cell(40, 8, "DATE", 1);
    $pdf->Cell(60, 8, "SIGNATURE", 1);
    $pdf->Ln(8);

    $pdf->Cell(90, 20, "", 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 20, $date_dbs, 1, 0, 'C');
    $pdf->Cell(60, 20, "", 1);
    $pdf->Ln(20);

    $pdf->SetFont('Arial', 'B', 12);
//    $pdf->Rect(10, 183, 190, 8, 'DF');
    $pdf->Cell(0, 8, "VISA DE LA DIRECTION GENERALE", 1, 0, "C");
    $pdf->Ln(8);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Rect(10, 147 + (8 * $i), 190, 8, 'DF');
    $pdf->Cell(90, 8, "OBSERVATIONS", 1);
    $pdf->Cell(40, 8, "DATE", 1);
    $pdf->Cell(60, 8, "SIGNATURE", 1);
    $pdf->Ln(8);
    
    $pdf->Cell(90, 20, "", 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 20, $date_dbs, 1, 0, 'C');
    $pdf->Cell(60, 20, "", 1);

    $pdf->Output();