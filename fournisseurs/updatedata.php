<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 29-Aug-15
     * Time: 8:13 PM
     */
require_once '../bd/connection.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $nom_four = $_POST['nom_four'];
    $email_four = $_POST['email_four'];
    $telephonepro_four = $_POST['telephonepro_four'];
    $activite_four = $_POST['activite_four'];
    $fax_four = $_POST['fax_four'];
    $adresse_four = $_POST['adresse_four'];
    $notes_four = $_POST['notes_four'];

    $req = "UPDATE fournisseurs SET
        nom_four='" . $nom_four . "',
        email_four='" . $email_four . "',
        telephonepro_four='" . $telephonepro_four . "',
        activite_four='" . $activite_four . "',
        fax_four='" . $fax_four . "',
        adresse_four='" . $adresse_four . "',
        notes_four='" . $notes_four . "'
        WHERE code_four = '" . $id . "'";
//    print_r($req);
    if ($resultat = $connexion->query($req)) {
        echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succ�s!</strong><br/> Les informations sur le fournisseur " . $id . " ont �t� mises � jour.
            </div>
            ";
    } else {
        echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de modification du fournisseur " . $id . ". Veuillez contacter l'administrateur.
            </div>
            ";
    }
} else {
    echo "
        <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Erreur!</strong><br/> Une erreur s'est produite. Veuillez contacter l'administrateur.
        </div>
    ";
}