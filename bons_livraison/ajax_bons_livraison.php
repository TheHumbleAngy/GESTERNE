<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 22-Jul-15
 * Time: 11:10 AM
 */

require_once '../bd/connection.php';

//On appelle ici tous les bons de commande qui ne figurent pas encore sur un bon de livraison
$sql = "SELECT bons_commande.num_bc FROM bons_commande
          INNER JOIN fournisseurs
            ON fournisseurs.code_four = bons_commande.code_four
        WHERE fournisseurs.code_four = '" . $_POST['fournisseur'] . "'
        AND bons_commande.statut <> 'livre'
        ORDER BY bons_commande.num_bc DESC";

$resultat = $connexion->query($sql);

$option = "";
$data = $resultat->fetch_all(MYSQL_NUM);
$n = $resultat->num_rows;

for ($i = 0; $i < $n; $i++) {
    $option .= $data[$i][0] . ";";
}
echo $option;