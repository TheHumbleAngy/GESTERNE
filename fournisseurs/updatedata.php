<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 29-Aug-15
     * Time: 8:13 PM
     */

    if (isset($_GET['operation']) && $_GET['operation'] == "ajout") {
        //TODO: Enregistrement d'un nouveau fournisseur

        require_once '../bd/connection.php';
        include_once 'class_fournisseurs.php';

        $fournisseur = new fournisseurs();

        if ($fournisseur->recuperation()) {
            if ($fournisseur->enregistrement()) {
                echo "
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    " . $_POST['nom_four'] . " a été enregistré avec <strong>succès</strong>.
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

    }
    elseif (isset($_GET['id']) && isset($_GET['operation']) && $_GET['operation'] == "maj") {
        //TODO: MAJ des infos depuis la form liste_fournisseurs

        $id = $_GET['id'];
        require_once '../bd/connection.php';
        include_once 'class_fournisseurs.php';

        $fournisseur = new fournisseurs();

        if ($fournisseur->recuperation()) {
            if ($fournisseur->modification($id)) {
                echo "
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Succès!</strong><br/> Les informations sur le fournisseur " . $id . " ont été mises à jour.
                </div>
                ";
            } else {
                echo "
                <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de modification du fournisseur " . $id . ". Veuillez contacter l'administrateur.
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
        //TODO: Suppression des infos depuis la form liste_fournisseurs

        $id = $_POST['id'];
        require_once '../bd/connection.php';
        include_once 'class_fournisseurs.php';

        $fournisseur = new fournisseurs();

        if ($fournisseur->suppression($id)) {
            echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succès!</strong><br/> Le fournisseur " . $id . " a été supprimé de la base.
            </div>
            ";
        } else {
            echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/><br/>
                Le fournisseur " . $id . " est lié à certains formulaires et ne peut donc pas être supprimé de la base.<br/>
                Veuillez donc contacter un administrateur.
            </div>
            ";
        }

    }
    elseif (isset($_POST['code_four']) || isset($_POST['action'])) {
        //TODO: MAJ et suppression des infos depuis les forms modif_fournisseurs et suppr_fournisseurs
        $code = $_POST['code_four'];
        require_once 'bd/connection.php';
        include_once 'class_fournisseurs.php';

        $fournisseur = new fournisseurs();

        if ($fournisseur->recuperation()) {
            if ($_POST['action'] == "maj") {
                if ($fournisseur->modification($code)) {
                    header("refresh:3;url=form_principale.php?page=administration&source=fournisseurs");
                    echo "
                    <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                        <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=administration&source=fournisseurs' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                            </a>
                            <p><strong>Succès!</strong><br/> Les informations sur le fournisseur " . $code . " ont été mises a jour.</p>
                        </div>
                    </div>
                    ";
                }
            } elseif ($_POST['action'] == "supprimer") {
                if ($fournisseur->suppression($code)) {
                    header("refresh:3;url=form_principale.php?page=administration&source=fournisseurs");
                    echo "
                    <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                        <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=administration&source=fournisseurs' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                            </a>
                            <strong>Succès!</strong><br/> Le fournisseur " . $code . " a été supprimé de la base.
                        </div>
                    </div>
                    ";
                } else {
                    echo "
                    <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                        <div class='alert alert-warning alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=administration&source=fournisseurs' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                            </a>
                            <strong>Erreur!</strong><br/><br/>
                            Le fournisseur " . $code . " est lié à certains formulaires et ne peut donc pas être supprimé de la base.<br/>
                            Veuillez donc contacter un administrateur.
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "
                <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                    <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                        <a href='form_principale.php?page=administration&source=fournisseurs' type='button' class='close'
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