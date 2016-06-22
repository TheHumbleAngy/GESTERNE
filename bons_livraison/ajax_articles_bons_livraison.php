<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 22-Jul-15
 * Time: 11:10 AM
 */

require_once '../bd/connection.php';

if (isset($_POST['bon_cmd'])) {
    $bon_cmd = htmlspecialchars($_POST['bon_cmd'], ENT_QUOTES);

    $sql1 = "SELECT * FROM bons_commande WHERE num_bc = '" . $bon_cmd . "'";
    $sql2 = "SELECT * FROM details_bon_commande WHERE num_bc = '" . $bon_cmd . "'";

    if ($resultat = $connexion->query($sql1)) {
        if ($resultat->num_rows > 0) {
            echo "
<div class='col-md-12'>
    <div style='text-align: center; margin-bottom: 2%'>
        <button class='btn btn-info' type='submit' name='valider' style='width: 150px'>
            Valider
        </button>
    </div>
    <div class='col-md-12'>
        <div class='panel panel-default'>
            <table border='0' class='table table-hover table-bordered'>
                <thead>
                <tr>
                    <th class='entete' style='text-align: center'>Libelle</th>
                    <th class='entete' style='text-align: center'>Quantité</th>
                    <th class='entete' style='text-align: center'>Prix Unitaire</th>
                    <th class='entete' style='text-align: center'>Remise</th>
                    <th class='entete' style='text-align: center'>Prix TTC</th>
                </tr>
                </thead>
        ";

            $total = 0;
            $i = 0;
            if ($result = $connexion->query($sql2)) {
                $lignes = $result->fetch_all(MYSQL_ASSOC);
                $total = 0;
                foreach ($lignes as $list) {
                    $i++;
                    echo '<tr>';
                    echo '<td style="text-align: center">' . stripslashes($list['libelle_dbc']) . '<input type="hidden" name="libelle_dbc[]" value="' . stripslashes($list['libelle_dbc']) . '"></td>';
                    echo '<td style="text-align: center">' . stripslashes($list['qte_dbc']) . '<input type="hidden" name="qte_dbc[]" value="' . stripslashes($list['qte_dbc']) . '"></td>';
                    echo '<td style="text-align: center">' . number_format(stripslashes($list['pu_dbc']), 0, ',', ' ') . '<input type="hidden" name="pu_dbc[]" value="' . stripslashes($list['pu_dbc']) . '"></td>';
                    echo '<td style="text-align: center">' . stripslashes($list['remise_dbc']) . '%' . '<input type="hidden" name="remise_dbc[]" value="' . stripslashes($list['remise_dbc']) . '"></td>';

                    $qte = stripslashes($list['qte_dbc']);
                    $pu = stripslashes($list['pu_dbc']);
                    $rem = stripslashes($list['remise_dbc']);

                    if ($rem > 0) {
                        $rem = $rem / 100;
                        $ttc = $qte * $pu * (1 - $rem);
                    } else
                        $ttc = $qte * $pu;

                    $total = $total + $ttc;
                    echo '<td style="text-align: right">';
                    echo number_format($ttc, 0, ',', ' ');
                    echo '</td>';
                    echo '</tr>';
                }
            }

            echo "
                <thead>
                    <tr style='font-weight: bolder'>
                        <th class='entete' style='text-align: center' colspan='4'>TOTAL</th>
                        <th class='entete' style='text-align: right'>" . number_format($total, 0, ',', ' '). "</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
        ";
        }
    }
}