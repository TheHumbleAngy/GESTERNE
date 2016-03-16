<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 04-Sep-15
     * Time: 10:34 AM
     */

    require_once '../bd/connection.php';

    $req = "SELECT num_bc FROM bons_commande ORDER BY num_bc DESC LIMIT 1";
    $resultat = $connexion->query($req);

    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);

        //reccuperation du code
        $num_bc = "";
        foreach ($ligne as $data) {
            $num_bc = stripslashes($data['num_bc']);
        }

        //extraction des 4 derniers chiffres
        $num_bc = substr($num_bc, -4);

        //incrementation du nombre
        $num_bc += 1;

        $b = "BC";
        $dat = date("Y");
        $dat = substr($dat, -2);
        $format = '%04d';
        $code = $dat . "" . $b . "" . sprintf($format, $num_bc);

    } else {

        //s'il n'existe pas d'enregistrements dans la base de données
        $num_bc = 1;
        $b = "BC";
        $dat = date("Y");
        $dat = substr($dat, -2);
        $format = '%04d';
        $code = $dat . "" . $b . "" . sprintf($format, $num_bc);
    }

    echo $num_bc = $code;