<?php
    /**
     * Created by PhpStorm.
     * User: ange-marius.kouakou
     * Date: 26/08/2015
     * Time: 16:05
     */
    require_once '../bd/connection.php';

    if (isset($_GET['operation']) && $_GET['operation'] == "ajout") {
        $operation = $_GET['operation'];
        include_once 'class_employes.php';

        $employe = new employes();

        if ($employe->recuperation()) {
            $employe->motdepasse("ncare");
            if ($employe->enregistrement()) {
                echo "
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    " . $_POST['nom_emp'] . " a été enregistré avec <strong>succès</strong>.
                </div>
                ";
            } else {
                echo "
                <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative d'enregistrement des informations. Veuillez contacter l'administrateur.
                </div>
                ";
            }
        }

    } elseif (isset($_GET['id']) && isset($_GET['operation']) && $_GET['operation'] == "maj") {
        $id = $_GET['id'];
        include_once 'class_employes.php';

        $employe = new employes();

        if ($employe->recuperation()) {
            if ($employe->modification($id)) {
                echo "
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Succès!</strong><br/> Les informations sur l'employé " . $id . " ont été mises à jour.
                </div>
                ";
            } else {
                echo "
                <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de modification de l'employé " . $id . ". Veuillez contacter l'administrateur.
                </div>
                ";
            }
        } else {
            echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de récupération des informations. Veuillez contacter l'administrateur.
            </div>
            ";
        }

    }