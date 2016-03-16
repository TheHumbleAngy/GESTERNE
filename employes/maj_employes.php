<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 03/11/2015
 * Time: 16:25
 */

if (isset($_POST['code_emp'])) {

    $code = $_POST['code_emp'];
    include 'class_employes.php';

    $employe = new employes();

    if ($employe->recuperation()) {
        if ($_POST['action'] == "maj") {
            if ($employe->modification($code)) {
                header("refresh:3;url=form_principale.php?page=administration&source=employes");
                echo "
            <div style='width: 480px; margin-right: auto; margin-left: auto'>
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <a href='form_principale.php?page=administration&source=employes' type='button' class='close'
                           data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                    </a>
                    <p><strong>Succes!</strong> Les informations sur l'employe " . $code . " ont ete mises a jour.</p>
                </div>
            </div>
            ";
            }
        } elseif ($_POST['action'] == "supprimer") {
            if ($employe->suppression($_POST['code_emp'])) {
                header("refresh:3;url=form_principale.php?page=administration&source=employes");
                echo "
            <div style='width: 400px; margin-right: auto; margin-left: auto'>
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <a href='form_principale.php?page=administration&source=employes' type='button' class='close'
                           data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                        </a>
                    <strong>Succes!</strong> L'employe " . $code . " a ete supprime de la base.
                </div>
            </div>
            ";
            }

        } else {
            echo "Une erreur s'est produite lors de la tentative de récupération des informations entrées";
        }
    }
}