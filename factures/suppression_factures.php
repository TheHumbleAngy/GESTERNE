<?php
/**
 * Created by PhpStorm.
 * User: ange-marius.kouakou
 * Date: 04/04/14
 * Time: 15:59
 */

//    require_once('../bd/connection.php');

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $sql = ("DELETE FROM facture WHERE num_fact='" . $id . "'");
        mysqli_query($connexion, $sql);
        header('location: form_principale.php?page=factures/liste_factures');
    }