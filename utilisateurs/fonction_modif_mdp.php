<?php
    /**
     * Created by PhpStorm.
     * User: ange-marius.kouakou
     * Date: 15/04/14
     * Time: 13:35
     */

    /*require_once '../bd/connection.php';
    require_once '../fonctions.php';*/

    session_start();

    $email_empl = $_SESSION['email'];

    $req = "SELECT * FROM employes WHERE email_emp = '" . $email_empl . "'";

    if ($resultat = $connexion->query($req)) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
        foreach ($ligne as $data) {
            $mdp = stripslashes($data['mdp']);
        }
    }

    $ancien_mdp = mysqli_real_escape_string($connexion, $_POST['ancien_mdp']);
    $nvo_mdp = mysqli_real_escape_string($connexion, $_POST['nvo_mdp']);
    $re_nvo_mdp = mysqli_real_escape_string($connexion, $_POST['re_nvo_mdp']);

    //On vérifie si le mot de passe entré est le bon
    if ($ancien_mdp == $mdp) {
        //On vérifie si les deux nouveaux mot de passe entrés sont identiques
        if ($nvo_mdp == $re_nvo_mdp) {
            $req = "UPDATE employes SET mdp ='" . $nvo_mdp . "' WHERE email_emp ='" . mysqli_real_escape_string($connexion, $email_empl) . "'";
            if ($result = $connexion->query($req)) {
                header("LOCATION: form_principale.php?page=utilisateurs/modif_mdp&success=1");
            }
        } else {
            header('Location: form_principale.php?page=utilisateurs/modif_mdp&error=1');
        }
    }
    else {
        header('Location: form_principale.php?page=utilisateurs/modif_mdp&error=1');
    }
