<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 20-Jul-15
 * Time: 11:08 AM
 */

if (isset($_POST["pu"]) && isset($_POST["qte"])) {
    $pu = htmlspecialchars($_POST['pu'], ENT_QUOTES);
    $qte = htmlspecialchars($_POST['qte'], ENT_QUOTES);

    $tot_ht = $pu * $qte;
    $tot_ttc = $pu * $qte * 0.18;

    $resultat = $tot_ht . ";" . $tot_ttc;
    echo $resultat;
}