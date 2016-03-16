<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 18/01/2016
     * Time: 13:18
     *
     * Ce script génère la liste des propositions de libellés dans les champs de saisie d'articles sous forme JSON
     */
    header("Content-Type: application/json; charset=UTF-8");
    require_once '../bd/connection.php';

    $json_articles = array();

    $sql = "SELECT designation_art FROM articles ORDER BY designation_art ASC ";

    if ($resultat = $connexion->query($sql)) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
        foreach ($ligne as $list) {
            $json_articles[] = $list;
        }

//    print json_encode($json_articles);
        echo json_encode($json_articles);
    }