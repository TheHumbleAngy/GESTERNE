<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 24/03/2016
     * Time: 14:29
     *
     * Ce script permet de générer la liste des fournisseurs à afficher dans l'aperçu de la forme de saisie des fournisseurs
     */
    header("Content-Type: application/json; charset=UTF-8");
    require_once '../bd/connection.php';

    $json_fournisseurs = "";
    $sql = "SELECT code_four, nom_four, telephonepro_four, activite_four FROM fournisseurs";
    if ($resultat = $connexion->query($sql)) {
        foreach ($resultat as $list) {
            $json_fournisseurs[] = $list;
        }
        echo json_encode($json_fournisseurs);
    }