<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 04-Sep-15
     * Time: 10:41 AM
     */

    require_once '../bd/connection.php';

    $req = "SELECT num_fact FROM factures ORDER BY num_fact DESC LIMIT 1";
    $resultat = $connexion->query($req);

//echo $resultat->num_rows;
    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);

        //reccuperation du code
        $num_fact = "";
        foreach ($ligne as $data) {
            $num_fact = stripslashes($data['num_fact']);
        }

        //extraction des 4 derniers chiffres
        $num_fact = substr($num_fact, -4);

        //incrementation du nombre
        $num_fact += 1;
        $b = "FCT";
        $dat = date("Y");
        $dat = substr($dat, -2);
        $format = '%04d';
        $code = $dat . "" . $b . "" . sprintf($format, $num_fact);

//    echo $code;
    } else {
        //s'il n'existe pas d'enregistrements dans la base de données
        $num_fact = 1;
        $b = "FCT";
        $dat = date("Y");
        $dat = substr($dat, -2);
        $format = '%04d';
        $code = $dat . "" . $b . "" . sprintf($format, $num_fact);
    }
//on affecte au code le resultat
    echo $num_fact = $code;