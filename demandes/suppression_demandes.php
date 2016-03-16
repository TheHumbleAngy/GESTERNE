<?php
/**
 * Created by PhpStorm.
 * User: ange-marius.kouakou
 * Date: 04/04/14
 * Time: 15:56
 */

//    require_once('../../bd/connection.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = ("DELETE FROM demande_bien_service WHERE code_dbs='" . $id . "'");
        mysqli_query($connexion, $sql);
        header('location: form_principale.php?page=articles/demandes/liste_demandes');
    }