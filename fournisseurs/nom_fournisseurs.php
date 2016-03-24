<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 24/03/2016
     * Time: 14:45
     *
     * Ce script génère la liste des propositions de libellés dans les champs de saisie de fournisseurs sous forme JSON
     */
    header("Content-Type: application/json; charset=UTF-8");
    require_once '../bd/connection.php';

    $json_fournisseurs = array();

    $sql = "SELECT nom_four FROM fournisseurs ORDER BY nom_four ASC ";

    if ($resultat = $connexion->query($sql)) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
        foreach ($ligne as $list) {
            $json_fournisseurs[] = $list;
        }

//    print json_encode($json_fournisseurs);
        echo json_encode($json_fournisseurs);
    }