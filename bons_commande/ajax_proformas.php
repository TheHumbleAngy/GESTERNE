<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 17-Jul-15
 * Time: 3:11 PM
 */

require_once '../bd/connection.php';

//On appelle ici toutes les proformas qui ne figurent pas encore sur un bon de commande
$sql = "SELECT ref_fp FROM proformas";

$resultat = $connexion->query($sql);
$option = "";
$data = $resultat->fetch_all(MYSQL_NUM);
$n = $resultat->num_rows;
for ($i = 0; $i < $n; $i++) {
    $option .= $data[$i][0] . ";";
}
echo $option;