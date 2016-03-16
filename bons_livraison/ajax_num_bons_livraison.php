<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 04-Sep-15
     * Time: 10:48 AM
     */

require_once '../bd/connection.php';
    //On vérifie s'il y a un en registrement dans la base de données
    $req = "SELECT code_bl FROM bons_livraison ORDER BY code_bl DESC LIMIT 1";
    $resultat = $connexion->query($req);

    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);

        //reccuperation du code
        $code_bl = "";
        foreach ($ligne as $data) {
            $code_bl = stripslashes($data['code_bl']);
        }

        //extraction des 4 derniers chiffres
        $code_bl = substr($code_bl, -4);

        //incrementation du nombre
        $code_bl += 1;

        $b = "BL";
        $dat = date("Y");
        $dat = substr($dat, -2);
        $format = '%04d';
        $resultat = $dat . "" . $b . "" . sprintf($format, $code_bl);

        //echo $resultat;
    } else {
        //s'il n'existe pas d'enregistrements dans la base de données
        $code_bl = 1;
        $b = "BL";
        $dat = date("Y");
        $dat = substr($dat, -2);
        $format = '%04d';
        $resultat = $dat . "" . $b . "" . sprintf($format, $code_bl);
    }
    //on affecte au code le resultat
    echo $code_bl = $resultat;