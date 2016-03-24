<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 24/03/2016
     * Time: 12:20
     *
     * Ce script permet de générer la liste des employés à afficher dans l'aperçu de la forme de saisie des employés
     */
    header("Content-Type: application/json; charset=UTF-8");
    require_once '../bd/connection.php';

    $json_employes = "";
    $sql = "SELECT code_emp, nom_emp, prenoms_emp, departement_emp FROM employes";
    if ($resultat = $connexion->query($sql)) {
        foreach ($resultat as $list) {
            $json_employes[] = $list;
        }
        echo json_encode($json_employes);
    }