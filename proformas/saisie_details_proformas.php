<?php
/*require_once '../bd/connection.php';
require_once '../fonctions.php';
sec_session_start();*/
////$_SESSION['expiration'] = time();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">

</head>
<body>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                [Détails Facture Proforma]Saisie Des Coordonnées
            </div>
            <div class="panel-body">
                <form action="form_principale.php?page=proformas/saisie_details_proformas" method="POST">
                    <table class="formulaire" border="0">
                        <tr>
                            <td class="champlabel">
                                Proforma :
                            </td>
                            <td>
                                <label>
                                    <select name="ref_fp" required class="form-control">
                                        <?php
                                        $requ = "SELECT ref_fp from facture_proforma order by ref_fp desc";
                                        $excu = mysqli_query($connexion, $requ) or die(mysqli_error($connexion));
                                        while ($data = mysqli_fetch_array($excu)) {
                                            echo '<option value="' . $data['ref_fp'] . '">' . $data['ref_fp'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </label>
                            </td>
                            <td class="champlabel">
                                Libellé :
                            </td>
                            <td>
                                <label>
                                    <select name="txt_libelle" required class="form-control">
                                        <option></option>
                                        <?php
                                        $requ = "SELECT libelle_dd from detail_demande order by libelle_dd DESC";

                                        $excu = mysqli_query($connexion, $requ) or die(mysqli_error($connexion));

                                        while ($data = mysqli_fetch_array($excu)) {

                                            echo '<option value="' . $data['libelle_dd'] . '">' . $data['libelle_dd'] . '</option>';

                                        }
                                        ?>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">
                                Quantité :
                            </td>
                            <td>
                                <label>
                                    <input type="number" name="qte_dfp" style="width: 70px" min="0" class="form-control"/>
                                </label>
                            </td>
                            <td class="champlabel">
                                Remise:
                            </td>
                            <td>
                                <label>
                                    <input type="number" name="remise_dfp" min="0" class="form-control" style="width: 70px"> %
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <!--<td class="champlabel">
                        Code bien ou service:
                    </td>
                    <td>
                        <label>
                            <select name="code_bs" required>
                                <?php
                                /*                                    $req = "SELECT code_bs from bien_service";

                                                                    $exc = mysqli_query($connexion, $req) or die(mysqli_error($connexion));

                                                                    while ($data = mysqli_fetch_array($exc)) {

                                                                        echo '<option value="' . $data['code_bs'] . '">' . $data['code_bs'] . '</option>';

                                                                    }

                                                                */
                            ?>
                            </select>
                        </label>
                    </td>-->
                            <td class="champlabel">
                                Prix unitaire :
                            </td>
                            <td>
                                <label>
                                    <input type="text" name="pu_dfp" size="6" required class="form-control"/>
                                </label>
                            </td>
                        </tr>

                    </table>
                    <br/>

                    <div style="text-align: center;">
                        <button class="btn btn-default" type="submit" name="valider">
                            Valider
                        </button>

                        <button class="btn btn-default" type="reset" name="effacer">
                            Effacer
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<?php echo $_SESSION['temp1']; ?>
<div class="grid_10">
    <div class="box round first">
        <!--        <div class="box_title">-->
        <!--            <h2>[Détails Facture Proforma]Saisie Des Coordonnées</h2>-->
        <!--        </div>-->

        <!--        <form action="form_principale.php?page=factures_proforma/saisie_details_factures_proforma" method="POST">-->
        <!--            <table class="formulaire" style="width= 100%; margin-left: 20%" border="0">-->
        <!--                <tr>-->
        <!--                    <td class="champlabel">-->
        <!--                        Fact. Pro.:-->
        <!--                    </td>-->
        <!--                    <td>-->
        <!--                        <label>-->
        <!--                            <select name="ref_fp" required>-->
        <!--                                --><?php
        //                                    $requ = "SELECT ref_fp from facture_proforma order by ref_fp desc";
        //
        //                                    $excu = mysqli_query($connexion, $requ) or die(mysqli_error($connexion));
        //
        //                                    while ($data = mysqli_fetch_array($excu)) {
        //
        //                                        echo '<option value="' . $data['ref_fp'] . '">' . $data['ref_fp'] . '</option>';
        //
        //                                    }
        //
        //
        ?>
        <!--                            </select>-->
        <!--                        </label>-->
        <!--                    </td>-->
        <!--                    <td class="champlabel">-->
        <!--                        Libellé:-->
        <!--                    </td>-->
        <!--                    <td>-->
        <!--                        <label>-->
        <!--                            <select name="txt_libelle" required>-->
        <!--                                <option></option>-->
        <!--                                --><?php
        //                                    $requ = "SELECT libelle_dd from detail_demande order by libelle_dd DESC";
        //
        //                                    $excu = mysqli_query($connexion, $requ) or die(mysqli_error($connexion));
        //
        //                                    while ($data = mysqli_fetch_array($excu)) {
        //
        //                                        echo '<option value="' . $data['libelle_dd'] . '">' . $data['libelle_dd'] . '</option>';
        //
        //                                    }
        //
        ?>
        <!--                            </select>-->
        <!--                        </label>-->
        <!--                    </td>-->
        <!--                </tr>-->
        <!--                <tr>-->
        <!--                    <td class="champlabel">-->
        <!--                        Quantité:-->
        <!--                    </td>-->
        <!--                    <td>-->
        <!--                        <label>-->
        <!--                            <input type="number" name="qte_dfp" size="2" min="0"/>-->
        <!--                        </label>-->
        <!--                    </td>-->
        <!--                    <td class="champlabel">-->
        <!--                        Remise:-->
        <!--                    </td>-->
        <!--                    <td>-->
        <!--                        <label>-->
        <!--                            <input type="number" name="remise_dfp" min="0"> %-->
        <!--                        </label>-->
        <!--                    </td>-->
        <!--                </tr>-->
        <!---->
        <!--                <tr>-->
        <!--                    <!--<td class="champlabel">-->
        <!--                        Code bien ou service:-->
        <!--                    </td>-->
        <!--                    <td>-->
        <!--                        <label>-->
        <!--                            <select name="code_bs" required>-->
        <!--                                --><?php
        ///*                                    $req = "SELECT code_bs from bien_service";
        //
        //                                    $exc = mysqli_query($connexion, $req) or die(mysqli_error($connexion));
        //
        //                                    while ($data = mysqli_fetch_array($exc)) {
        //
        //                                        echo '<option value="' . $data['code_bs'] . '">' . $data['code_bs'] . '</option>';
        //
        //                                    }
        //
        //                                */
        ?>
        <!--                            </select>-->
        <!--                        </label>-->
        <!--                    </td>-->
        <!--                    <td class="champlabel">-->
        <!--                        Prix unitaire:-->
        <!--                    </td>-->
        <!--                    <td>-->
        <!--                        <label>-->
        <!--                            <input type="text" name="pu_dfp" size="6" required/>-->
        <!--                        </label>-->
        <!--                    </td>-->
        <!--                </tr>-->
        <!---->
        <!--            </table>-->
        <!--            <br/>-->
        <!---->
        <!--            <div style="text-align: center;">-->
        <!--                <button class="btn btn-blue" type="submit" name="valider">-->
        <!--                    Valider-->
        <!--                </button>-->
        <!---->
        <!--                <button class="btn btn-black" type="reset" name="effacer">-->
        <!--                    Effacer-->
        <!--                </button>-->
        <!--            </div>-->
        <!--        </form>-->
    </div>
</div>


<?php

if (sizeof($_POST) > 0) {
    //On vérifie s'il y a un en registrement dans la base de données
    $req = "SELECT id_dfp FROM detail_factpro ORDER BY id_dfp DESC LIMIT 1";
    $resultat = $connexion->query($req);

    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);

        //reccuperation du code
        foreach ($ligne as $data) {
            $id_dfp = stripslashes($data['id_dfp']);
        }

        //extraction des 4 derniers chiffres
        $id_dfp = substr($id_dfp, -4);

        //incrementation du nombre
        $id_dfp += 1;

        $b = "DFP";
        $dat = date("Y");
        $dat = substr($dat, -2);
        $format = '%04d';
        $resultat = $dat . "" . $b . "" . sprintf($format, $id_dfp);

        //echo $resultat;
    } else {
        //s'il n'existe pas d'enregistrements dans la base de données
        $id_dfp = 1;
        $b = "DFP";
        $dat = date("Y");
        $dat = substr($dat, -2);
        $format = '%04d';
        $resultat = $dat . "" . $b . "" . sprintf($format, $id_dfp);
    }
    $id_dfp = $resultat;
    $ref_fp = htmlspecialchars($_POST['ref_fp'], ENT_QUOTES);
    /*$code_bs = htmlspecialchars($_POST['code_bs'], ENT_QUOTES);*/
    $libelle = htmlspecialchars($_POST['txt_libelle'], ENT_QUOTES);
    $qte_dfp = htmlspecialchars($_POST['qte_dfp'], ENT_QUOTES);
    $pu_dfp = htmlspecialchars($_POST['pu_dfp'], ENT_QUOTES);
    $remise_dfp = htmlspecialchars($_POST['remise_dfp'], ENT_QUOTES);

    $sql = "INSERT INTO detail_factpro(id_dfp, ref_fp, qte_dfp, pu_dfp, remise_dfp, libelle)
            VALUES('$id_dfp', '$ref_fp', '$qte_dfp', '$pu_dfp', '$remise_dfp', '$libelle')";

    //print_r($sql);
    $excute = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    //mysqli_close($connexion);

}

?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-body" style="overflow: auto">

                <table border="0" class="table table-hover table-bordered table-condensed">
                    <tr>
                        <td class="entete" style="text-align: center">Date</td>
                        <td class="entete" style="text-align: center">Proforma</td>
                        <td class="entete" style="text-align: center">Article</td>
                        <td class="entete" style="text-align: center">Quantité</td>
                        <td class="entete" style="text-align: center" title="Prix unitaire">P.U.</td>
                        <td class="entete" style="text-align: center">Remise</td>
                        <td class="entete" style="text-align: center">Prix Total</td>
                        <!--<td class="entete" colspan="2" style="text-align: center">Actions</td>-->
                    </tr>

                    <?php
                    $sql = "SELECT facture_proforma.dateetablissement_fp, facture_proforma.ref_fp,
                    detail_factpro.libelle, detail_factpro.qte_dfp, detail_factpro.pu_dfp,
                    detail_factpro.remise_dfp
                    FROM facture_proforma, detail_factpro, employe, demande_bien_service
                    WHERE facture_proforma.ref_fp = detail_factpro.ref_fp
                    AND facture_proforma.code_dbs = demande_bien_service.code_dbs
                    AND demande_bien_service.code_emp = employe.code_emp
                    AND employe.email_emp = '" . $_SESSION['user_id'] . "'
                    ORDER BY facture_proforma.dateetablissement_fp DESC";

                    /*$sql = "SELECT facture_proforma.dateetablissement_fp, facture_proforma.ref_fp,
                    detail_factpro.libelle, detail_factpro.qte_dfp, detail_factpro.pu_dfp,
                    detail_factpro.remise_dfp, detail_factpro.id_dfp
                    FROM facture_proforma, detail_factpro, employe
                    WHERE facture_proforma.ref_fp = detail_factpro.ref_fp
                    AND facture_proforma.code_dbs = demande_bien_service.code_dbs
                    AND demande_bien_service.code_emp = employe.code_emp
                    AND employe.email_emp = '" . $_SESSION['user_id'] ."'
                    ORDER BY facture_proforma.dateetablissement_fp DESC";*/

                    if ($valeur = $connexion->query($sql)) {
                        //print_r($valeur);
                        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                        foreach ($ligne as $list) {
                            ?>
                            <tr>
                                <td class="contenu" style="text-align: center">
                                    <input type="hidden" id="id_dfp" name="id_dfp"
                                           value="<?php echo stripslashes($list['id_dfp']); ?>">
                                    <?php echo stripslashes($list['dateetablissement_fp']); ?></td>
                                <td class="contenu"><?php echo stripslashes($list['ref_fp']); ?></td>
                                <td class="contenu"><?php echo stripslashes($list['libelle']) . " " . stripslashes($list['prenoms_emp']); ?></td>
                                <td class="contenu"
                                    style="text-align: center"><?php echo stripslashes($list['qte_dfp']); ?></td>
                                <td class="contenu"
                                    style="text-align: center"><?php echo stripslashes($list['pu_dfp']); ?></td>
                                <td class="contenu"
                                    style="text-align: center"><?php echo stripslashes($list['remise_dfp']) . "%"; ?></td>
                                <!-- ptt = (pu * qte) * (1 - (rem / 100))-->
                                <td class="contenu" style="text-align: center">
                                    <?php
                                    $pu = stripslashes($list['pu_dfp']);
                                    $qte = stripslashes($list['qte_dfp']);
                                    $rem = stripslashes($list['remise_dfp']);

                                    $ptt = ($pu * $qte) * (1 - ($rem / 100));

                                    echo $ptt;
                                    ?>
                                </td>

                                <!--<td style="text-align: center">
                                    <a href="form_principale.php?page=factures_proforma/"><img height="20" width="20"
                                                                                              src="img/edit.png"
                                                                                              title="Modifier"/></a>
                                </td>
                                <td style="text-align: center">
                                    <a href="form_principale.php?page=factures_proforma/suppression_details_factures_proforma&id=<?php /*echo stripslashes($list['id_dfp']); */ ?> "><img
                                            height="20" width="20" src="img/delete.png" title="Supprimer"/></a>
                                </td>-->
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>