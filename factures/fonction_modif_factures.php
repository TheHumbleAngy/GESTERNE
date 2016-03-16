<?php
/**
 * Created by PhpStorm.
 * User: JOCO
 * Date: 20/03/14
 * Time: 09:11
 */

//    require_once '../bd/connection.php';
//    require_once '../fonctions.php';
//    error_reporting(0);
//
//    //echo 'Hello test';
//    sec_session_start();

if (isset($_POST['num_fact'])) {
    $num_fact = mysqli_real_escape_string($connexion, $_POST['num_fact']);
    $ref_fact = mysqli_real_escape_string($connexion, $_POST['ref_fact']);
    $code_four = mysqli_real_escape_string($connexion, $_POST['code_four']);
    $dateetablissement_fact = mysqli_real_escape_string($connexion, $_POST['dateetablissement_fact']);
    $datereception_fact = mysqli_real_escape_string($connexion, $_POST['datereception_fact']);

    $etatavecfacpro_facture = mysqli_real_escape_string($connexion, $_POST['etatavecfacpro_facture']);
    $remarques_facture = mysqli_real_escape_string($connexion, $_POST['remarques_facture']);

    $req = "UPDATE facture SET
    ref_fact = '" . $ref_fact . "',
    code_four ='" . $code_four . "',
    dateetablissement_fact ='" . $dateetablissement_fact . "',
    datereception_fact ='" . $datereception_fact . "',

    etatavecfacpro_facture ='" . $etatavecfacpro_facture . "',
    remarques_facture ='" . $remarques_facture . "'
    WHERE num_fact ='" . mysqli_real_escape_string($connexion, $num_fact) . "'";

    if ($resul = $connexion->query($req)) {
        header("LOCATION: form_principale.php?page=factures/liste_factures");
    }
} else {
    echo "Une erreur est survenue; veuillez contacter votre administrateur";
}