<?php
    /**
     * Created by PhpStorm.
     * User: Ange Kouakou
     * Date: 3/6/14
     * Time: 12:22 PM
     */
    header('Content-Type: text/html; charset=utf-8');
//Ces informations sont modifiées en fonction du serveur utilisé

    $bd_hote = 'localhost';
    $bd_basededonnees = 'gestion';
    $bd_utilisateur = 'angy';
    $bd_mdp = 'ncare';

    $connexion = new mysqli($bd_hote, $bd_utilisateur, $bd_mdp, $bd_basededonnees);

    if ($connexion->connect_error)
        die($connexion->connect_error);

//Permet de tenir compte des caractères spéciaux pendant les eneregistrements
    mysqli_set_charset($connexion, "utf8");