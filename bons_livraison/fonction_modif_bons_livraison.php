<?php
/**
 * Created by PhpStorm.
 * User: stagiaireinfo
 * Date: 11/04/14
 * Time: 17:02
 */

if (isset($_POST['code_bl'])) {
    /*print_r($_POST['code_bl']);
    echo '<br>';
    print_r($_POST['dateetablissement_bl']);
    echo '<br>';
    print_r($_POST['datereception_bl']);
    echo '<br>';
    print_r($_POST['code_four']);
    echo '<br>';
    print_r($_POST['code_emp']);
    echo '<br>';
    print_r($_POST['num_bc']);
    echo '<br>';
    print_r($_POST['statut_bl']);
    echo '<br>';*/

    $code_bl = mysqli_real_escape_string($connexion, $_POST['code_bl'], ENT_QUOTES);
    $dateetablissement_bl = mysqli_real_escape_string($connexion, $_POST['dateetablissement_bl'], ENT_QUOTES);
    $datereception_bl = mysqli_real_escape_string($connexion, $_POST['datereception_bl'], ENT_QUOTES);
    $code_four = mysqli_real_escape_string($connexion, $_POST['code_four'], ENT_QUOTES);
    $code_emp = mysqli_real_escape_string($connexion, $_POST['code_emp'], ENT_QUOTES);
    /*$num_bc = mysqli_real_escape_string($connexion, $_POST['num_bc'], ENT_QUOTES);*/
    $statut_bl = mysqli_real_escape_string($connexion, $_POST['statut_bl'], ENT_QUOTES);
    $commentaires_bl = mysqli_real_escape_string($connexion, $_POST['commentaires_bl'], ENT_QUOTES);

    /*$code_bl = mysqli_real_escape_string($connexion, $_POST['code_bl'], ENT_QUOTES);
    $dateetablissement_bl = mysqli_real_escape_string($connexion, $_POST['dateetablissement_bl'], ENT_QUOTES);
    $datereception_bl = mysqli_real_escape_string($connexion, $_POST['datereception_bl'], ENT_QUOTES);
    $code_four = mysqli_real_escape_string($connexion, $_POST['code_four'], ENT_QUOTES);
    $code_emp = mysqli_real_escape_string($connexion, $_POST['code_emp'], ENT_QUOTES);
    $num_bc = mysqli_real_escape_string($connexion, $_POST['num_bc'], ENT_QUOTES);
    $statut_bl = mysqli_real_escape_string($connexion, $_POST['statut_bl'], ENT_QUOTES);
    $commentaires_bl = mysqli_real_escape_string($connexion, $_POST['commentaires_bl'], ENT_QUOTES);*/


    /*$sql= "UPDATE bord_livraison SET
      dateetablissement_bl='" . $dateetablissement_bl . "',
      datereception_bl='" . $datereception_bl . "',
      code_four='" . $code_four . "',
      num_bc='" . $num_bc . "',
      code_emp='" . $code_emp . "',
      statut_bl='" . $statut_bl . "',
      commentaires_bl='" . $commentaires_bl . "'
    WHERE code_bl='" . mysqli_real_escape_string($connexion, $code_bl) . "'";*/

    $sql = "UPDATE bons_livraison SET
            dateetablissement_bl='" . $_POST['dateetablissement_bl'] . "',
            datereception_bl='" . $_POST['datereception_bl'] . "',
            code_four='" . $_POST['code_four'] . "',
            code_emp='" . $_POST['code_emp'] . "',
            statut_bl='" . $_POST['statut_bl'] . "',
            commentaires_bl='" . $_POST['commentaires_bl'] . "'
            WHERE code_bl='" . $_POST['code_bl'] . "'";

    /*print_r($sql);*/

    if ($result = $connexion->query($sql)) {
        header("LOCATION: form_principale.php?page=bons_livraison/liste_bons_livraison");
    }
} else {
    echo "Une erreur est survenue; veuillez contacter votre administrateur";
}