<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 17/11/2015
 * Time: 14:39
 */

    require_once '../bd/connection.php';

    if ($_POST['action'] == "ajout") {
        $sql = "SELECT code_emp, nom_emp, prenoms_emp FROM employes WHERE code_emp NOT IN (SELECT code_emp FROM droits) ORDER BY nom_emp ASC ";
    } elseif ($_POST['action'] == "modification") {
        $sql = "SELECT code_emp, nom_emp, prenoms_emp FROM employes WHERE code_emp IN (SELECT code_emp FROM droits) ORDER BY nom_emp ASC ";
    }

    $resultat = $connexion->query($sql);

    $option = "";
    $n = $resultat->num_rows;

    $data = $resultat->fetch_all(MYSQL_NUM); //print_r($data);

    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < 3; $j++)
            $option .= $data[$i][$j] . ";";
    }
    echo $option;