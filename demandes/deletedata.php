<?php
/**
 * Created by PhpStorm.
 * User: ange-marius.kouakou
 * Date: 26/08/2015
 * Time: 6:58 PM
 */
require_once '../bd/connection.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $req = "DELETE FROM demandes WHERE code_dbs = '" . $id . "'";
//    print_r($req);
    if ($resultat = $connexion->query($req)) {
        echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succ�s!</strong><br/> La demande " . $id . " a �t� supprim�e.
            </div>
            ";
    } else {
        echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de suppression de la demande " . $id . ". Veuillez contacter l'administrateur.
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