<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 12-Aug-15
 * Time: 11:58 AM
 */

require_once '../bd/connection.php';

if (isset($_POST["proforma"])) {
    $pro = htmlspecialchars($_POST['proforma'], ENT_QUOTES);

    /* on r�ccup�re le d�partement de l'employ� demandeur � partir des tables proformas, demandes_proformas, demandes, employés
    en fonction de la proforma s�lectionn�e*/

        $sql = "SELECT libelle, qte_dfp, pu_dfp, remise_dfp, fournisseurs.code_four, fournisseurs.nom_four
                FROM details_proforma INNER JOIN proformas
                ON details_proforma.ref_fp = proformas.ref_fp
                INNER JOIN fournisseurs
                ON fournisseurs.code_four = proformas.code_four
                WHERE proformas.ref_fp = '" . $pro . "'";

    $i = 0;

    if ($result = $connexion->query($sql)) {
        if ($result->num_rows > 0) {
            $lignes = $result->fetch_all(MYSQL_ASSOC);
//        print_r($lignes);
            echo '
    <div style="text-align: center; margin-bottom: 2%">
            <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                Valider
            </button>
        </div>
    <div class="col-md-12">
        <table style="border-collapse: separate; border-spacing: 8px" border="0">
            <tr>
                <td class="champlabel">Fournisseur :</td>
                <td>
                    <label class="nomargin_tb">
                        <input type="text" class="form-control fournisseur" name="nom_four" readonly value="' . stripslashes($lignes[0]['nom_four']) . '" style="font-weight: normal">
                        <input type="hidden" name="code_four" value="'. stripslashes($lignes[0]['code_four']) .'">
                    </label>
                </td>
            </tr>
        </table>
        <div class="panel panel-default">
            <table border="0" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="entete" style="text-align: center; width: 50%">Désignation</th>
                        <th class="entete" style="text-align: center; width: 5%">Quantité</th>
                        <th class="entete" style="text-align: center; width: 15%">Prix Unitaire</th>
                        <th class="entete" style="text-align: center; width: 5%">Remise</th>
                        <th class="entete" style="text-align: center; width: 20%">Prix TTC</th>
                    </tr>
                </thead>';

            $total = 0;

            $i = 0;
            foreach ($lignes as $list) {
                echo '<tr>';
                echo '<td style="text-align: left">' . stripslashes($list['libelle']) . '</td><input type="hidden" name="libelle[]" value="' . stripslashes($list['libelle']) . '"/>';
                echo '<td style="text-align: center">' . stripslashes($list['qte_dfp']) . '</td><input type="hidden" name="qte[]" value="' . stripslashes($list['qte_dfp']) . '"/>';
                echo '<td style="text-align: center">' . number_format(stripslashes($list['pu_dfp']), 0, ',', ' ')  . '</td><input type="hidden" name="pu[]" value="' . stripslashes($list['pu_dfp']) . '"/>';
                echo '<td style="text-align: center">' . stripslashes($list['remise_dfp']) . '%</td><input type="hidden" name="rem[]" value="' . stripslashes($list['remise_dfp']) . '"/>';

                $qte = stripslashes($list['qte_dfp']);
                $pu = stripslashes($list['pu_dfp']);
                $rem = stripslashes($list['remise_dfp']);

                if ($rem > 0) {
                    $rem = $rem / 100;
                    $ttc = $qte * $pu * (1 - $rem);
                }
                else
                    $ttc = $qte * $pu;

                $total += $ttc;
                echo '<td style="text-align: right">';
                echo number_format($ttc, 0, ',', ' ');
                echo '</td>';
                echo '</tr>';
                $i++;
            }

            echo '<thead>
                    <tr style="font-weight: bolder">
                        <th class="entete" style="text-align: center" colspan="4">TOTAL</th>
                        <th class="entete" style="text-align: right">' . number_format($total, 0, ',', ' ') . '</th>
                    </tr>
                  </thead>

            </table>
        </div>
    </div>
    <input type="hidden" name="nbr" value="' . $i . '">';
        }
        else {
            echo "<p>Cette proforma ne contient aucun article</p>";
        }
    }
}