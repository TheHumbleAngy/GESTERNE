<?php
/**
 * Created by PhpStorm.
 * User: stagiaireinfo
 * Date: 11/04/14
 * Time: 16:18
 */

//    require_once('../bd/connection.php');

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $sql = ("DELETE FROM bons_livraison WHERE code_bl='" . $id . "'");
        mysqli_query($connexion, $sql);

        header('LOCATION: form_principale.php?page=bons_livraison/liste_bons_livraison');
    }