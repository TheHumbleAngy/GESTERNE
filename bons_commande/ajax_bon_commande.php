<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 12-Jul-15
 * Time: 7:22 PM
 */

require_once '../bd/connection.php';
//echo "Hello";

if (isset($_POST["proforma"])) {
    $pro = htmlspecialchars($_POST['proforma'], ENT_QUOTES);

    /* on r�ccup�re le d�partement de l'employ� demandeur � partir des tables proformas, demandes_proformas, demandes, employés
    en fonction de la proforma s�lectionn�e*/

    $sql1 = "SELECT four.code_four, four.nom_four
            FROM fournisseurs AS four INNER JOIN proformas AS pro
            ON four.code_four = pro.code_four
            WHERE pro.ref_fp = '" . $pro . "'";

    /*$sql2 = "SELECT departement_emp
            FROM employés AS emp INNER JOIN demandes AS dmd
            ON emp.code_emp = dmd.code_emp
            INNER JOIN demandes_proformas AS dp
            ON dmd.code_dbs = dp.code_dbs
            INNER JOIN proformas AS pro
            ON pro.ref_fp = dp.ref_fp
            WHERE pro.ref_fp = '" . $pro . "'";*/

    $sql3 = "SELECT libelle, qte_dfp, pu_dfp, remise_dfp
            FROM details_proforma INNER JOIN proformas
            ON details_proforma.ref_fp = proformas.ref_fp
            WHERE proformas.ref_fp = '" . $pro . "'";

    $fournisseur = "";
    if ($result = $connexion->query($sql1)) {
        $lignes = $result->fetch_all(MYSQL_ASSOC);
        foreach ($lignes as $list) {
            $nom_four = $list['nom_four'];
            $code_four = $list['code_four'];
        }
    }

    echo '
<div style="text-align: center; margin-bottom: 1%">
        <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
            Valider
        </button>
    </div>
<table class="formulaire">
    <tr>
        <td class="champlabel" style="padding-left: 10px">Fournisseur :</td>
        <td>
            <label>
                <input type="text" name="nom_four" class="form-control" id="four" readonly value="' . $nom_four . '">
                <input type="hidden" name="cod_four" value="' . $code_four . '">
            </label>
        </td>
    </tr>
    <tr></tr>
</table>
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <table border="0" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="entete" style="text-align: center">Libelle</th>
                <th class="entete" style="text-align: center">Quantité</th>
                <th class="entete" style="text-align: center">Prix Unitaire</th>
                <th class="entete" style="text-align: center">Remise</th>
                <th class="entete" style="text-align: center">Prix TTC</th>
            </tr>
        </thead>
            ';

    $i = 0;
    if ($result = $connexion->query($sql3)) {
        $lignes = $result->fetch_all(MYSQL_ASSOC);
        $total = 0;
        foreach ($lignes as $list) {
            $i++;
            echo '<tr>';
            echo '<td style="text-align: center">' . stripslashes($list['libelle']) . '<input type="hidden" name="libelle_dbc[]" value="' . stripslashes($list['libelle']) . '"></td>';
            echo '<td style="text-align: center">' . stripslashes($list['qte_dfp']) . '<input type="hidden" name="qte_dbc[]" value="' . stripslashes($list['qte_dfp']) . '"></td>';
            echo '<td style="text-align: center">' . number_format(stripslashes($list['pu_dfp']), 0, ',', ' ') . '<input type="hidden" name="pu_dbc[]" value="' . stripslashes($list['pu_dfp']) . '"></td>';
            echo '<td style="text-align: center">' . stripslashes($list['remise_dfp']) . '%' . '<input type="hidden" name="remise_dbc[]" value="' . stripslashes($list['remise_dfp']) . '"></td>';

            $qte = stripslashes($list['qte_dfp']);
            $pu = stripslashes($list['pu_dfp']);
            $rem = stripslashes($list['remise_dfp']);

            if ($rem > 0) {
                $rem = $rem / 100;
                $ttc = $qte * $pu * (1 - $rem);
            }
            else
                $ttc = $qte * $pu;

            $total = $total + $ttc;
            echo '<td style="text-align: right">';
            echo number_format($ttc, 0, ',', ' ');
            echo '</td>';
            echo '</tr>';
        }
    }

    echo '<thead>
            <tr style="font-weight: bolder">
                <th class="entete" style="text-align: center" colspan="4">TOTAL</th>
                <th class="entete" style="text-align: right">' . number_format($total, 0, ',', ' ') . '</th>
            </tr>
          </thead>

        </table>
    </div>
</div>';
    echo '<input type="hidden" name="nbr" value="' . $i . '">';
}