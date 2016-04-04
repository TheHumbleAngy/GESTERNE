<?php
    /**
     * Created by PhpStorm.
     * User: ange-marius.kouakou
     * Date: 26/08/2015
     * Time: 16:05
     */

    if (isset($_GET['operation']) && $_GET['operation'] == "ajout") {
        //TODO: Enregistrement d'un nouvel employé

        require_once '../bd/connection.php';
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
        } else {
            echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de récupération des informations. Veuillez contacter l'administrateur.
            </div>
            ";
        }

    }
    elseif (isset($_GET['id']) && isset($_GET['operation']) && $_GET['operation'] == "maj") {
        //TODO: MAJ des infos depuis la form liste_employes

        $id = $_GET['id'];
        require_once '../bd/connection.php';
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
                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de récupération des informations. Veuillez contacter l'administrateur.
            </div>
            ";
        }

    }
    elseif (isset($_POST['id']) && isset($_GET['operation']) && $_GET['operation'] == "suppr") {
        //TODO: Suppression des infos depuis la form liste_employes

        $id = $_POST['id'];
        require_once '../bd/connection.php';
        include_once 'class_employes.php';

        $employe = new employes();

        if ($employe->suppression($id)) {
            echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succès!</strong><br/> L'employé " . $id . " a été supprimé de la base.
            </div>
            ";
        } else {
            echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/><br/>
                L'employé " . $id . " est lié à certains formulaires et ne peut donc pas être supprimé de la base.<br/>
                Veuillez donc contacter un administrateur.
            </div>
            ";
        }

    }
    elseif (isset($_POST['code_emp']) || isset($_POST['action'])) {
        //TODO: MAJ et suppression des infos depuis les forms modif_employes et suppr_employes

        $code = $_POST['code_emp'];
        require_once 'bd/connection.php';
        include_once 'class_employes.php';

        $employe = new employes();

        if ($employe->recuperation()) {
            if ($_POST['action'] == "maj") {
                if ($employe->modification($code)) {
                    header("refresh:3;url=form_principale.php?page=administration&source=employes");
                    echo "
                    <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                        <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=administration&source=employes' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                            </a>
                            <p><strong>Succès!</strong><br/> Les informations sur l'employé " . $code . " ont été mises a jour.</p>
                        </div>
                    </div>
                    ";
                }
            } elseif ($_POST['action'] == "supprimer") {
                if ($employe->suppression($code)) {
                    header("refresh:3;url=form_principale.php?page=administration&source=employes");
                    echo "
                    <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                        <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=administration&source=employes' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                            </a>
                            <strong>Succès!</strong><br/> L'employé " . $code . " a été supprimé de la base.
                        </div>
                    </div>
                    ";
                } else {
                    echo "
                    <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                        <div class='alert alert-warning alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=administration&source=employes' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                            </a>
                            <strong>Erreur!</strong><br/><br/>
                            L'employé " . $code . " est lié à certains formulaires et ne peut donc pas être supprimé de la base.<br/>
                            Veuillez donc contacter un administrateur.
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "
                <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                    <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                        <a href='form_principale.php?page=administration&source=employes' type='button' class='close'
                               data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                <span aria-hidden='true'>&times;</span>
                        </a>
                        <strong>Erreur!</strong><br/><br/>
                        Une erreur s'est produite lors de la tentative de récupération des informations entrées.<br/>
                        Veuillez contacter votre administrateur.
                    </div>
                </div>
                ";
            }
        }
    }