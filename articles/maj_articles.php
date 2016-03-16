<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 27/11/2015
     * Time: 18:03
     *
     * Ce script permet de modifier ou supprimer un article
     */

    if (isset($_POST['code_art'])) {

        $code = $_POST['code_art'];
        include 'class_articles.php';

        $article = new articles();

        if ($article->recuperation()) {
            if ($_POST['action'] == "maj") {
                if ($article->modification($code)) {
                    header("refresh:2;url=form_principale.php?page=form_actions&source=articles&action=modifier");
                    echo "
            <div style='width: 400px; margin-right: auto; margin-left: auto'>
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <a href='form_principale.php?page=form_actions&source=articles&action=modifier' type='button' class='close'
                           data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                    </a>
                    <strong>Succès!</strong> Les informations sur l'article " . $code . " ont été mises a jour.
                </div>
            </div>
            ";
                }
            } elseif ($_POST['action'] == "supprimer") {
                if ($article->suppression($code)) {
                    echo "
            <div style='width: 400px; margin-right: auto; margin-left: auto'>
                <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <a href='form_principale.php?page=form_actions&source=articles&action=supprimer' type='button' class='close'
                           data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                        </a>
                    <strong>Succès!</strong> L'article " . $code . " a été supprimé de la base.
                </div>
            </div>
            ";
                }

            } else {
                echo "Une erreur s'est produite lors de la tentative de récupération des informations entrées";
            }
        }
    }