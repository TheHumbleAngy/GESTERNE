<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 02/11/2015
 * Time: 11:47
 */
if (isset($_POST['code_four'])) {

    include 'class_fournisseurs.php';

    $fournisseur = new fournisseurs();

    if ($fournisseur->recuperation()) {
        if ($_POST['action'] == "maj") {
            if ($fournisseur->modification($_POST['code_four'])) {
                header( "refresh:5;url=form_principale.php?page=administration&source=fournisseurs" );
                echo "
            <div style='width: 400px; margin-right: auto; margin-left: auto'>
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <a href='form_principale.php?page=administration&source=fournisseurs' type='button' class='close'
                           data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                        </a>
                    <strong>Succes!</strong> Les informations sur le fournisseur " . $_POST['code_four'] . " ont ete mises a jour.
                </div>
            </div>
            ";
            }
        } elseif ($_POST['action'] == "supprimer") {
            $code = $_POST['code_four'];
            if ($fournisseur->suppression($_POST['code_four'])) {
                header( "refresh:5;url=form_principale.php?page=administration&source=fournisseurs" );
                echo "
            <div style='width: 400px; margin-right: auto; margin-left: auto'>
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <a href='form_principale.php?page=administration&source=fournisseurs' type='button' class='close'
                           data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                        </a>
                    <strong>Succes!</strong> Le fournisseur " . $code . " a ete supprime de la base.
                </div>
            </div>
            ";
            }
        } else {
            echo "Une erreur s'est produite lors de la tentative de récupération des informations entrées";
        }
    }
}