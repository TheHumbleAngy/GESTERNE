<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 17-Sep-15
     * Time: 10:10 AM
     */

    require_once '../bd/connection.php';

    $req = "SELECT ref_fp FROM proformas ORDER BY ref_fp DESC LIMIT 1";
    $resultat = $connexion->query($req);

    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);

        $ref_fp = "";
        foreach ($ligne as $data) {
            $ref_fp = stripslashes($data['ref_fp']);
        }

        //extraction des 4 derniers chiffres
        $ref_fp = substr($ref_fp, -4);

        //incrementation du nombre
        $ref_fp += 1;
    } else {
        //s'il n'existe pas d'enregistrements dans la base de données
        $ref_fp = 1;
    }

    $b = "FPRO";
    $dat = date("Y");
    $dat = substr($dat, -2);
    $format = '%04d';
    $resultat = $dat . "" . $b . "" . sprintf($format, $ref_fp);

    //on affecte au code le resultat
    echo $ref_fp = $resultat;