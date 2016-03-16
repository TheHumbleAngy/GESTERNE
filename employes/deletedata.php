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

//    $req = "DELETE FROM employes WHERE code_emp = '" . $id . "'";

    include_once 'class_employes.php';

    $employe = new employes();

    if ($employe->suppression($id)) {
        echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succès!</strong> L'employé " . $id . " a été supprimé.
            </div>
            ";
    } else {
        echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong> Une erreur s'est produite lors de la tentative de suppression de l'employé " . $id . ". Veuillez contacter l'administrateur.
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