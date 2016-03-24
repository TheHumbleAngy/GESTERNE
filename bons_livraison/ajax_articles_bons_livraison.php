<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 22-Jul-15
 * Time: 11:10 AM
 */

require_once '../bd/connection.php';

$i = 0;
if (isset($_POST['bon_cmd'])) {
    $bon_cmd = htmlspecialchars($_POST['bon_cmd'], ENT_QUOTES);

    $n = 0;

    //On verifie si le bon de commande selectionne n'est pas déjà lie � un bon de livraison
    $sql = "SELECT num_bc FROM bons_livraison WHERE num_bc = '" . $bon_cmd . "'";
    if ($resultat = $connexion->query($sql)) {
        $n = $resultat->num_rows;
        //Si la requete retourne au moins une ligne, on a déjà un bon de commande lie � un bon de livraison
        if ($n > 0) {
            //On reccupere le dernier bon de livraison enregistre relatif au bon de commande
            /*$sql = "SELECT details_bon_livraison.code_bl, qte_restante
                    FROM details_bon_livraison INNER JOIN bons_livraison
                    ON bons_livraison.code_bl = details_bon_livraison.code_bl
                    WHERE bons_livraison.num_bc = '" . $bon_cmd . "'
                    AND details_bon_livraison.code_bl = (SELECT MAX(code_bl) FROM details_bon_livraison)";*/
            $sql = "SELECT details_bon_livraison.code_bl, qte_restante
                    FROM details_bon_livraison INNER JOIN bons_livraison
                    ON bons_livraison.code_bl = details_bon_livraison.code_bl
                    WHERE bons_livraison.num_bc = '" . $bon_cmd . "'
                    AND details_bon_livraison.code_bl =
                            (SELECT MAX(BL.code_bl) FROM details_bon_livraison AS DBL
                            INNER JOIN bons_livraison AS BL
                            ON DBL.code_bl = BL.code_bl
                            INNER JOIN bons_commande AS BC
                            ON BL.num_bc = BC.num_bc
                            WHERE BC.num_bc = '" . $bon_cmd . "')";

            $code_bl = "";
            $qte_restante = 0;
            if ($resultat = $connexion->query($sql)) {
                $lignes = $resultat->fetch_all(MYSQL_ASSOC);
                foreach ($lignes as $data) {
                    $code_bl = stripslashes($data['code_bl']);
                    $qte_restante += stripslashes($data['qte_restante']);
                }

//                echo $qte_restante;

                if ($qte_restante > 0) {
                    $sql = "SELECT libelle_dbl, qte_restante
                        FROM details_bon_livraison INNER JOIN bons_livraison
                        ON bons_livraison.code_bl = details_bon_livraison.code_bl
                        WHERE bons_livraison.code_bl = '" . $code_bl . "'";

                    $result = $connexion->query($sql);
                    $lignes = $result->fetch_all(MYSQL_ASSOC);
//                $n = $result->num_rows;
                    echo '
<div class="col-md-10 col-md-offset-1">
    <div style="text-align: center; margin-bottom: 1%">
        <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
            Valider
        </button>
    </div>
    <div class="panel panel-default">
        <table border="0" class="table table-hover table-bordered">
            <tr>
                <td class="entete" style="text-align: center">Désignation</td>
                <td class="entete" style="text-align: center; width: 80px">Quantité Restante</td>
                <td class="entete" style="text-align: center; width: 80px">Quantité Livree</td>
            </tr>';

                    foreach ($lignes as $list) {
                        //Si la quantit� restante de l'article � afficher est > 0, alors on affiche la ligne de l'article
                        if (stripslashes($list['qte_restante']) > 0) {
                            echo '<tr>';
                            echo '<td style="text-align: center">' . stripslashes($list['libelle_dbl']) . '</td>';
                            echo '<input type="hidden" name="libelle_dbl[]" value="' . stripslashes($list['libelle_dbl']) . '">';
                            echo '<td style="text-align: center">' . stripslashes($list['qte_restante']) . '</td>';
                            echo '<input type="hidden" name="qte_cmd[]" value="' . stripslashes($list["qte_restante"]) . '">';
                            echo '<td style="text-align: center">
                                <label style="margin: 0">
                                    <input type="number" class="form-control" min="1" name="qte_livree[]" required max="' . stripslashes($list['qte_restante']) . '">
                                </label>
                                </td>';
                            echo '</tr>';
                            $i++;
                        } //else continue;
                    }

                    echo '
        </table><input type="hidden" name="n" value="' . $i . '">
    </div>
</div>';
                }
                /*else {
                    echo "<h4 style='color: #01ADDD'>Cette commande a déjà ete satisfaite. Veuillez en selectionner une autre.</h4>";
                }*/
            }

        } else {
            $sql = "SELECT libelle, qte_dfp
            FROM details_proforma INNER JOIN proformas
            ON details_proforma.ref_fp = proformas.ref_fp
            INNER JOIN bons_commande
            ON proformas.ref_fp = bons_commande.ref_fp
            WHERE bons_commande.num_bc = '" . $bon_cmd . "'";

            if ($result = $connexion->query($sql)) {
                $lignes = $result->fetch_all(MYSQL_ASSOC);
//                $n = $result->num_rows;
                echo '
<div class="col-md-10 col-md-offset-1">
    <div style="text-align: center; margin-bottom: 1%">
        <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
            Valider
        </button>
    </div>
    <div class="panel panel-default">
        <table border="0" class="table table-hover table-bordered">
            <tr>
                <td class="entete" style="text-align: center">Désignation</td>
                <td class="entete" style="text-align: center; width: 80px">Quantité Commandee</td>
                <td class="entete" style="text-align: center; width: 80px">Quantité Livree</td>
            </tr>';

                foreach ($lignes as $list) {
                    echo '<tr>';
                    echo '<td style="text-align: center">' . stripslashes($list['libelle']) . '</td>';
                    echo '<input type="hidden" name="libelle_dbl[]" value="' . stripslashes($list["libelle"]) . '">';
                    echo '<td style="text-align: center">' . stripslashes($list['qte_dfp']) . '</td>';
                    echo '<input type="hidden" name="qte_cmd[]" value="' . stripslashes($list["qte_dfp"]) . '">';
                    echo '<td style="text-align: center">
                    <label style="margin: 0">
                        <input type="number" class="form-control" min="1" name="qte_livree[]" required max="' . stripslashes($list['qte_dfp']) . '">
                    </label>
                  </td>';
                    echo '</tr>';
                    $i++;
                }
            }
            echo '<tr>';

            echo '</tr>';
            echo '
        </table><input type="hidden" name="n" value="' . $i . '">
    </div>
</div>';
//        }
//    }
        }
    }
    //On verifie s'il y a une quantite restante par rapport au bon de commande selectionne
//    $sql2 = "SELECT qte_restante
//            FROM details_bon_livraison INNER JOIN bons_livraison
//            ON bons_livraison.code_bl = details_bon_livraison.code_bl
//            WHERE bons_livraison.num_bc = '" . $bon_cmd . "'";
//
//    if ($resultat = $connexion->query($sql2)) {
//        $lignes = $resultat->fetch_all(MYSQL_ASSOC);
//        $n = $resultat->num_rows;
//        foreach ($lignes as $list) {
//            $qte_rest = stripslashes($list['qte_restante']);
//        }
//
//        //S'il existe une quantite restante, on affiche les articles manquants
//        if ($n > 0) {
//            /*$sql1 = "SELECT DBL.libelle_dbl, DBL.qte_restante, DP.qte_dfp
//            FROM details_bon_livraison AS DBL
//            INNER JOIN bons_livraison AS BL
//            ON DBL.code_bl = BL.code_bl�
//            INNER JOIN bons_commande AS BC
//            ON BC.num_bc = BL.num_bc
//            INNER JOIN details_proforma AS DP
//            ON BC.ref_fp = DP.ref_fp
//            WHERE BL.num_bc = '" . $bon_cmd . "'";*/
//
//            $sql1 = "SELECT libelle_dbl, qte_restante
//            FROM details_bon_livraison INNER JOIN bons_livraison
//            ON bons_livraison.code_bl = details_bon_livraison.code_bl
//            WHERE bons_livraison.num_bc = '" . $bon_cmd . "'";

}
