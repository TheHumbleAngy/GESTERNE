<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 26/11/2015
     * Time: 15:03
     */

    if (isset($_GET['operation']) && $_GET['operation'] == "ajout") {
        //TODO: Enregistrement d'un nouvel article

        require_once '../bd/connection.php';
        include 'class_articles.php';

        $article = new articles();

        if ($article->recuperation()) {
            if ($article->enregistrement()) {
                echo "
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    L'article a été enregistré avec <strong>succès</strong>.
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
            <div style='width: 480px; margin-right: auto; margin-left: auto'>
                <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <a href='form_principale.php?page=articles/form_articles' type='button' class='close'
                           data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                    </a>
                    Une erreur s'est produite lors de la tentative de récupération des informations entrées.
                </div>
            </div>
            ";
        }
    }
    elseif (isset($_GET['id']) && isset($_GET['operation']) && $_GET['operation'] == "maj") {
        //TODO: MAJ des infos depuis la form liste_articles

        $id = $_GET['id'];
        require_once '../bd/connection.php';
        include_once 'class_articles.php';

        $article = new articles();

        if ($article->recuperation()) {
            if ($article->modification($id)) {
                echo "
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Succès!</strong><br/> Les informations sur l'article " . $id . " ont été mises à jour.
                </div>
                ";
            } else {
                echo "
                <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de modification de l'article " . $id . ". Veuillez contacter l'administrateur.
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
        //TODO: Suppression des infos depuis la form liste_articles

        $id = $_POST['id'];
        require_once '../bd/connection.php';
        include_once 'class_articles.php';

        $article = new articles();

        if ($article->suppression($id)) {
            echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succès!</strong><br/> L'article " . $id . " a été supprimé de la base.
            </div>
            ";
        } else {
            echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/><br/>
                L'article " . $id . " est lié à certains formulaires et ne peut donc pas être supprimé de la base.<br/>
                Veuillez donc contacter un administrateur.
            </div>
            ";
        }

    }
    elseif (isset($_POST['code_art']) || isset($_POST['action'])) {
        //TODO: MAJ et suppression des infos depuis les forms modif_articles et suppr_articles

        $code = $_POST['code_art'];
        require_once 'bd/connection.php';
        include_once 'class_articles.php';

        $article = new articles();

        if ($article->recuperation()) {
            if ($_POST['action'] == "maj") {
                if ($article->modification($code)) {
                    header("refresh:3;url=form_principale.php?page=form_actions&source=articles&action=modifier");
                    echo "
                    <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                        <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=form_actions&source=articles&action=modifier' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                            </a>
                            <p><strong>Succès!</strong><br/> Les informations sur l'article " . $code . " ont été mises a jour.</p>
                        </div>
                    </div>
                    ";
                }
            } elseif ($_POST['action'] == "supprimer") {
                if ($article->suppression($code)) {
                    header("refresh:3;url=form_principale.php?page=form_actions&source=articles&action=supprimer");
                    echo "
                    <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                        <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=suppr_articles' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                            </a>
                            <strong>Succès!</strong><br/> L'article " . $code . " a été supprimé de la base.
                        </div>
                    </div>
                    ";
                } else {
                    echo "
                    <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                        <div class='alert alert-warning alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=suppr_articles' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                            </a>
                            <strong>Erreur!</strong><br/><br/>
                            L'article " . $code . " est lié à certains formulaires et ne peut donc pas être supprimé de la base.<br/>
                            Veuillez donc contacter un administrateur.
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "
                <div style='width: 80%; margin-right: auto; margin-left: auto; margin-top: 10%'>
                    <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                        <a href='form_principale.php' type='button' class='close'
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