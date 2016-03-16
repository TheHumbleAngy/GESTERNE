<?php
/**
 * Created by PhpStorm.
 * User: ange-marius.kouakou
 * Date: 26/08/2015
 * Time: 16:05
 */
require_once '../bd/connection.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $titre_emp = $_POST['titre_emp'];
    $nom = $_POST['nom_emp'];
    $pren = $_POST['pren_emp'];
    $fct = $_POST['fct_emp'];
    $dpt = $_POST['dpt_emp'];
    $email = $_POST['email_emp'];
    $tel = $_POST['tel_emp'];

    $req = "UPDATE employes SET
        titre_emp='" . $titre_emp . "',
        nom_emp='" . $nom . "',
        prenoms_emp='" . $pren . "',
        fonction_emp='" . $fct . "',
        departement_emp='" . $dpt . "',
        email_emp='" . $email . "',
        tel_emp='" . $tel . "'
        WHERE code_emp = '" . $id . "'";
//    print_r($req);
    if ($resultat = $connexion->query($req)) {
        echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succes!</strong> Les informations sur employe " . $id . " ont ete mises a jour.
            </div>
            ";
    } else {
        echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong> Une erreur s'est produite lors de la tentative de modification de l'employé " . $id . ". Veuillez contacter l'administrateur.
            </div>
            ";
    }
} else {
    echo "
        <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Erreur!</strong> Une erreur s'est produite. Veuillez contacter l'administrateur.
        </div>
    ";
}