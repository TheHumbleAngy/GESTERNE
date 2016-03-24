<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 26/01/2016
     * Time: 15:07
     *
     * Ce script permet de générer la liste des articles à afficher dans l'aperçu de la forme de saisie des articles
     */
    header("Content-Type: application/json; charset=UTF-8");
    require_once '../bd/connection.php';

    $json_articles = "";
    $sql = "SELECT code_art, designation_art, description_art, stock_art FROM articles";
    if ($resultat = $connexion->query($sql)) {
        foreach ($resultat as $list) {
            $json_articles[] = $list;
        }
        echo json_encode($json_articles);
    }