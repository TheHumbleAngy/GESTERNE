<?php
    /**
     * Created by PhpStorm.
     * User: JOCO
     * Date: 20/03/14
     * Time: 09:11
     */

    /*require_once '../bd/connection.php';
    require_once '../fonctions.php';
    error_reporting(0);

//echo $_POST['code_dbs'];
    sec_session_start();*/

    if (isset($_POST['ref_fp'])) {
        $ref_fp = mysqli_real_escape_string($connexion, $_POST['ref_fp']);
        $code_four = mysqli_real_escape_string($connexion, $_POST['code_four']);
        $code_dbs = mysqli_real_escape_string($connexion, $_POST['code_dbs']);
        $dateetablissement_fp = mysqli_real_escape_string($connexion, $_POST['dateetablissement_fp']);
        $datereception_fp = mysqli_real_escape_string($connexion, $_POST['datereception_fp']);
        $tauxtva_fp = mysqli_real_escape_string($connexion, $_POST['tauxtva_fp']);
        $typepaiement_fp = mysqli_real_escape_string($connexion, $_POST['typepaiement_fp']);
        $conditionsreglt_fp = mysqli_real_escape_string($connexion, $_POST['conditionsreglt_fp']);
        $delaisreglt_fp = mysqli_real_escape_string($connexion, $_POST['delaisreglt_fp']);
        $periodegarantie_fp = mysqli_real_escape_string($connexion, $_POST['periodegarantie_fp']);
        $notes_fp = mysqli_real_escape_string($connexion, $_POST['notes_fp']);

        $req = "UPDATE facture_proforma SET
        ref_fp ='" . $ref_fp . "',
        code_four ='" . $code_four . "',
        code_dbs ='" . $code_dbs . "',
        dateetablissement_fp ='" . $dateetablissement_fp . "',
        datereception_fp ='" . $datereception_fp . "',
        tauxtva_fp ='" . $tauxtva_fp . "',
        typepaiement_fp ='" . $typepaiement_fp . "',
        conditionsreglt_fp ='" . $conditionsreglt_fp . "',
        delaisreglt_fp ='" . $delaisreglt_fp . "',
        periodegarantie_fp ='" . $periodegarantie_fp . "',
        notes_fp ='" . $notes_fp . "'
        WHERE ref_fp ='" . mysqli_real_escape_string($connexion, $ref_fp) . "'";

        /*echo "TEST";
        print_r($req);*/

       /* print_r($connexion->query($req));*/
       if ($resul = $connexion->query($req)) {
            header("LOCATION: form_principale.php?page=proformas/liste_factures_proforma");
        }
        else {
            echo "Requète non exécutée";
        }
    } else {
        echo "Une erreur est survenue; veuillez contacter votre administrateur";
    }

?>

<html>
<body>
    <input type="hidden" name="test" value="<?php echo $req; ?>">
</body>
</html>