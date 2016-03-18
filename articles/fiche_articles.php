<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 17/03/2016
     * Time: 17:39
     */

    require_once "../fpdf/fpdf.php";
    require_once "../bd/connection.php";
    header('Content-Type: text/html; charset=utf-8');

    class PDF_MC_Table extends FPDF
    {
        var $widths;
        var $aligns;

        // Page header
        function Header()
        {
            $this->Image('../img/logo2.png', 10, 6, 30);
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(120, 20);
            $this->Cell(30, 10, 'LISTE DES ARTICLES', 0, 0, 'C');
            $this->Ln(15);
            $this->SetFont('Arial', 'B', 11);
            $this->SetFillColor(228, 228, 228);
            $this->Rect(10, 25, 277, 8, 'DF');
            $this->Cell(85, 8, "DESIGNATION", 1);
            $this->Cell(62, 8, "GROUPE", 1);
            $this->Cell(70, 8, "DETAILS", 1);
            $this->Cell(60, 8, "DESCRIPTION", 1);
//            $this->Cell(32, 8, "CONTACT", 1);
            $this->Ln(8);
        }

        // Page footer
        function Footer()
        {
            // Position at 10px from bottom
            $this->SetY(-10);
            // Position at 138px from left, that is approximately the center bottom of the page
            $this->SetX(138);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number

            /*$this->Image('logo1.png');
            $this->SetLeftMargin(84);
            $this->Cell(22, 0, $this->Image('logo1.png') . '', 0, 0, 'C');
            $this->Ln(1);*/
            $this->Cell(10, 0, $this->PageNo(), 0, 0, 'R');
        }

        function SetWidths($w)
        {
            //Set the array of column widths
            $this->widths = $w;
        }

        function SetAligns($a)
        {
            //Set the array of column alignments
            $this->aligns = $a;
        }

        function CheckPageBreak($h)
        {
            //If the height h would cause an overflow, add a new page immediately
            if ($this->GetY() + $h > $this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
        }

        function NbLines($w, $txt)
        {
            //Computes the number of lines a MultiCell of width w will take
            $cw =& $this->CurrentFont['cw'];

            if ($w == 0) //si l'épaisseur de la cellule est = 0
                $w = $this->w - $this->rMargin - $this->x;

            $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
            $s = str_replace("\r", '', $txt); //on remplace le saut de ligne par rien dans le text
            $nb = strlen($s); //on récupère le nombre de caractère contenu dans le text

            if ($nb > 0 and $s[$nb - 1] == "\n")
                $nb--; //on diminue ce nombre d'une unité s'il y a un retour à la ligne à la fin du text

            $sep = -1;
            $i = 0;
            $j = 0;
            $l = 0;
            $nl = 1;

            while ($i < $nb) { //on parcourt chaque caractère du text
                $c = $s[$i];    //on recupere le caratère
                if ($c == "\n") { //si le caractère est un retour à la ligne
                    $i++;
                    $sep = -1;
                    $j = $i;
                    $l = 0;
                    $nl++;
                    continue;
                }
                if ($c == ' ') //si le caractère est un espace
                    $sep = $i;
                $l += $cw[$c];
                if ($l > $wmax) {
                    if ($sep == -1) {
                        if ($i == $j)
                            $i++;
                    } else
                        $i = $sep + 1;
                    $sep = -1;
                    $j = $i;
                    $l = 0;
                    $nl++;
                } else
                    $i++;
            }

            return $nl;
        }

        function Row($data) //$value est la valeur limite pour la lageur de la cellule
        {
            //Calculate the height of the row
            $nb = 0;
            for ($i = 0; $i < count($data); $i++)
                $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
            $h = 5 * $nb;
            /*for ($i = 0; $i < count($data); $i++) {
                if ($data[$i] < $value) {
                    $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
                    $h = 5 * $nb;
                } else {
                    $h = $nb;
                }
            }*/


            //Issue a page break first if needed
            $this->CheckPageBreak($h);
            //Draw the cells of the row
            for ($i = 0; $i < count($data); $i++) {
                $w = $this->widths[$i];
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                //Save the current position
                $x = $this->GetX();
                $y = $this->GetY();
                //Draw the border
                $this->Rect($x, $y, $w, $h);
                //Print the text
                $this->MultiCell($w, 5, $data[$i], 0, $a);
                //Put the position to the right of the cell
                $this->SetXY($x + $w, $y);
            }
            //Go to the next line
            $this->Ln($h);
        }
    }

    $pdf = new PDF_MC_Table('L');
    $pdf->AddPage();
    $pdf->SetTitle("Gesterne | Liste des Articles", TRUE);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(85, 62, 70, 60));

    /*for ($i = 0; $i < 5; $i++)
        $pdf->Row(array("A", "B", "C", "D", "E"));*/

    //DETAILS DE LA DEMANDE
    $sql = "SELECT code_grp, designation_art, description_art, niveau_reappro_art, niveau_cible_art, stock_art FROM articles ORDER BY designation_art";
    if ($valeur = $connexion->query($sql)) {
        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
        $i = 1;
        foreach ($ligne as $list) {
            $req = "SELECT designation_grp FROM groupe_articles WHERE code_grp = '" . $list['code_grp'] . "'";
            if ($val = $connexion->query($req)) {
                $row = $val->fetch_all(MYSQL_ASSOC);
                foreach ($row as $data) {
                    $pdf->Row(array($list['designation_art'], $data['designation_grp'], "Stock Actuel : " . $list['stock_art']  . "\nNiveau Reappro : " . $list['niveau_reappro_art'] . "\nNiveau Cible : " . $list['niveau_cible_art'], $list['description_art']));
                }
            }
        }
    }

    $pdf->Output();