<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 02/12/2015
 * Time: 15:36
 */

require_once '../bd/connection.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM details_bon_commande WHERE num_bc = '" . $id . "'"; //print_r($sql);

    if ($result = mysqli_query($connexion, $sql)) {

        $sql = "DELETE FROM bons_commande WHERE num_bc = '" . $id . "'"; //print_r($sql);

        if ($result = mysqli_query($connexion, $sql)) {
            //header("refresh:3;url=form_principale.php?page=form_actions&source=bons_commande&action=rechercher");
            echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succes!</strong><br/> Le bon de commande " . $id . " a ete supprime. Cliquez <a href='form_principale.php?page=form_actions&source=bons_commande&action=rechercher'>ici</a> pour continuer.
            </div>
            ";
        } else {
            echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de suppression du bon de commande " . $id . ". Veuillez contacter l'administrateur.
            </div>
            ";
        }
    } else {
        echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de suppression des articles du bon de commande " . $id . ". Veuillez contacter l'administrateur.
            </div>
            ";
    }
}