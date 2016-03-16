<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 27/11/2015
     * Time: 16:30
     *
     * Ce script g�n�re le num�ro de l'article en cours de saisie
     */

    require_once '../bd/connection.php';

    $req = "SELECT code_art FROM articles ORDER BY code_art DESC LIMIT 1";
    $resultat = $connexion->query($req);

//echo $resultat->num_rows;
    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);

        //reccuperation du code
        $code_art = "";
        foreach ($ligne as $data) {
            $code_art = stripslashes($data['code_art']);
        }

        //extraction des 4 derniers chiffres
        $code_art = substr($code_art, -4);

        //incrementation du nombre
        $code_art += 1;
    } else {
        //s'il n'existe pas d'enregistrements dans la base de donn�es
        $code_art = 1;
    }

    $b = "ART";
    $dat = date("Y");
    $dat = substr($dat, -2);
    $format = '%04d';
    $code = $dat . "" . $b . "" . sprintf($format, $code_art);

//on affecte au code le resultat
    echo $code_art = $code;