<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 26/11/2015
     * Time: 15:08
     *
     * Ce script permet de supprimer un article et d'afficher un message par la suite
     */

    require_once '../bd/connection.php';

    if (isset($_POST['id'])) {

        $id = $_POST['id'];

        include_once 'class_articles.php';

        $article = new articles();

        if ($article->suppression($id)) {
            echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succès!</strong><br/> L'article " . $id . " a été suprimé.
            </div>
            ";
        } else {
            echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/><br>Une erreur s'est produite lors de la tentative de suppression de l'article " . $id . ". Veuillez contacter l'administrateur.
            </div>
            ";
        }
    } else {
        echo "
        <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Erreur!</strong><br/><br>Une erreur s'est produite. Veuillez contacter l'administrateur.
        </div>
    ";
    }