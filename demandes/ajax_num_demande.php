<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 04-Sep-15
     * Time: 9:58 AM
     */

    require_once '../bd/connection.php';

    $req = "SELECT code_dbs FROM demandes ORDER BY code_dbs DESC LIMIT 1";
    $resultat = $connexion->query($req);

    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);

        $code_dbs = "";
        foreach ($ligne as $data) {
            $code_dbs = stripslashes($data['code_dbs']);
        }

        //extraction des 4 derniers chiffres
        $code_dbs = substr($code_dbs, -4);

        //incrementation du nombre
        $code_dbs += 1;
    } else {
        //s'il n'existe pas d'enregistrements dans la base de données
        $code_dbs = 1;
    }
    $b = "DBS";
    $dat = date("Y");
    $dat = substr($dat, -2);
    $format = '%04d';
    $resultat = $dat . "" . $b . "" . sprintf($format, $code_dbs);
    //on affecte au code le resultat
    echo $code_dbs = $resultat;