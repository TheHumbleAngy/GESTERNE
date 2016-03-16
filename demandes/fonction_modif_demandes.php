<?php
    /**
     * Created by PhpStorm.
     * User: JOCO
     * Date: 20/03/14
     * Time: 09:11
     */

    require_once '../../bd/connection.php';
    require_once '../../fonctions.php';
    error_reporting(0);


    if (isset($_POST['code_dbs'])) {
        $code_dbs = mysqli_real_escape_string($connexion, $_POST['code_dbs']);
        $date_dbs = mysqli_real_escape_string($connexion, $_POST['date_dbs']);
        /*$code_emp = mysqli_real_escape_string($connexion, $_POST['code_emp']);*/
        $nature_dbs = mysqli_real_escape_string($connexion, $_POST['nature_dbs']);
        $objets_dbs = mysqli_real_escape_string($connexion, $_POST['objets_dbs']);

        $req = "UPDATE demande_bien_service SET
        date_dbs ='" . $date_dbs . "',
        nature_dbs ='" . $nature_dbs . "',
        objets_dbs ='" . $objets_dbs . "'
        WHERE code_dbs ='" . mysqli_real_escape_string($connexion, $code_dbs) . "'";

        if ($resul = $connexion->query($req)) {
            header("LOCATION: form_principale.php?page=articles/demandes/liste_demandes");
        }
    }
    else {
        echo "Une erreur est survenue; veuillez contacter votre administrateur";
    }