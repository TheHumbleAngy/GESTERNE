<?php
/**
 * Created by PhpStorm.
 * User: ange-marius.kouakou
 * Date: 04/04/14
 * Time: 15:53
 */

//require_once('../bd/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = ("DELETE FROM facture_proforma WHERE ref_fp='" . $id . "'");
    mysqli_query($connexion, $sql);
    header('location: form_principale.php?page=proformas/liste_factures_proforma');
}