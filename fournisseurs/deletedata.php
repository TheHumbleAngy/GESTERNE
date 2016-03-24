<?php
/**
 * Created by PhpStorm.
 * User: ange-marius.kouakou
 * Date: 26/08/2015
 * Time: 16:51
 */
require_once '../bd/connection.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $req = "DELETE FROM fournisseurs WHERE code_four = '" . $id . "'";
//    print_r($req);
    if ($resultat = $connexion->query($req)) {
        echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succ�s!</strong><br/> Le fournisseur " . $id . " a �t� supprim�.
            </div>
            ";
    } else {
        echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de suppression du fournisseur " . $id . ". Veuillez contacter l'administrateur.
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