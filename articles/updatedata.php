<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 26/11/2015
 * Time: 15:03
 */

require_once '../bd/connection.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $designation_art = $_POST['designation_art'];
    $description_art = $_POST['description_art'];
    $code_grp = $_POST['code_grp'];
    $niveau_reappro_art = $_POST['niveau_reappro_art'];
    $niveau_cible_art = $_POST['niveau_cible_art'];

    $designation_art = mysqli_real_escape_string($connexion, $designation_art);
    $description_art = mysqli_real_escape_string($connexion, $description_art);

    $req = "UPDATE articles SET
        designation_art = '" . $designation_art . "',
        code_grp = '" . $code_grp . "',
        description_art = '" . $description_art . "',
        niveau_reappro_art = '" . $niveau_reappro_art . "',
        niveau_cible_art = '" . $niveau_cible_art . "'
        WHERE code_art = '" . $id . "'";
//    print_r($req);
    if ($resultat = $connexion->query($req)) {
        header("refresh:2;url=form_principale.php?page=form_actions&source=articles&action=rechercher");
        echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succès!</strong> Les informations sur l'article " . $id . " ont été mises a jour.
            </div>
            ";
    } else {
        echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong> Une erreur s'est produite lors de la tentative de modification de l'article " . $id . ". Veuillez contacter l'administrateur.
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