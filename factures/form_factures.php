<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 12-Aug-15
 * Time: 10:14 AM
 */
?>

<meta charset="utf-8">
<script>
    $.ajax({
        type: "POST",
        url: "factures/ajax_num_facture.php",
        success: function (resultat) {
            $('#num_fact').val(resultat);
        }
    });
</script>

<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
            Facture
            <a href='form_principale.php?page=accueil' type='button'
               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                <span aria-hidden='true'>&times;</span>
            </a>
        </div>
        <div class="panel-body">
            <form action="form_principale.php?page=factures/form_factures" method="POST">
                <div class="row">
                    <div class="col-md-10">
                        <table class="formulaire" style="width= 100%" border="0">
                            <tr>
                                <td class="champlabel" title="Référence facture">Référence :</td>
                                <td>
                                    <label>
                                        <input type="text" name="num_fact" class="form-control" size="15"
                                               readonly
                                               id="num_fact"/>
                                    </label>
                                </td>
                                <td class="champlabel" title="Numéro figurant sur la facture">N° Facture :
                                </td>
                                <td>
                                    <label>
                                        <input type="text" name="ref_fact" class="form-control" size="15"
                                               onblur="this.value = this.value.toUpperCase();"
                                               required/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Date d'Etablissement :</td>
                                <td>
                                    <label>
                                        <input type="text" name="dateetablissement_fact"
                                               id="date_e" readonly
                                               title="Veuillez cliquer ici pour sélectionner une date"
                                               class="form-control"/>
                                    </label>
                                </td>
                                <td class="champlabel">Date de reception :</td>
                                <td>
                                    <label>
                                        <input type="text" name="datereception_fact"
                                               class="form-control" id="date_r" readonly
                                               title="Veuillez cliquer ici pour sélectionner une date"
                                               required/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel" rowspan="2">Remarques facture :</td>
                                <td>
                                    <label>
                                        <textarea name="remarques_facture" rows="3" cols="20" style="resize: none"
                                                  maxlength="200"
                                                  class="form-control"></textarea>
                                    </label>
                                </td>
                                <td class="champlabel">Proforma :</td>
                                <td>
                                    <label>
                                        <!--                                <input type="text" name="etatavecfacpro_facture" class="form-control"/>-->
                                        <select class="form-control proforma" name="etatavecfacpro_facture">
                                            <option disabled selected></option>
                                            <?php
                                            $sql = "SELECT ref_fp FROM proformas ORDER BY ref_fp DESC ";
                                            $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                            while ($data = mysqli_fetch_array($res)) {
                                                echo '<option value="' . $data['ref_fp'] . '">' . $data['ref_fp'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-2">
                        <img src="img/Icons8/facture-100.png">
                    </div>
                    <br/>

                    <div class="response"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#date_e').datepicker({ dateFormat: 'dd-mm-yy' });
        $('#date_r').datepicker({ dateFormat: 'dd-mm-yy' });

        $("select.proforma").change(function () {
            var pro = $(".proforma option:selected").val();
            //console.log(prof);
            $.ajax({
                type: "POST",
                url: "factures/ajax_factures_proforma.php",
                data: {
                    proforma: pro
                },
                success: function (resultat) {
                    $('.response').html(resultat);
                }
            });
        });
    })
</script>

<?php

if (sizeof($_POST) > 0) {

    //Saisie de la facture dans la table "factures"
    $num_fact = htmlspecialchars($_POST['num_fact'], ENT_QUOTES);
    $ref_fact = htmlspecialchars($_POST['ref_fact'], ENT_QUOTES);
    $code_four = htmlspecialchars($_POST['code_four'], ENT_QUOTES);
//    $num_bc = htmlspecialchars($_POST['num_bc'], ENT_QUOTES);
    $dateetablissement_fact = htmlspecialchars($_POST['dateetablissement_fact'], ENT_QUOTES);
    $datereception_fact = htmlspecialchars($_POST['datereception_fact'], ENT_QUOTES);
//    $etatavecfacpro_facture = htmlspecialchars($_POST['etatavecfacpro_facture'], ENT_QUOTES);
    $remarques_facture = htmlspecialchars($_POST['remarques_facture'], ENT_QUOTES);

//on insert dans la table

    $req = "INSERT INTO factures (num_fact,
                            code_four,
                            ref_fact,
                            dateetablissement_fact,
                            datereception_fact,
                            remarques_facture)
             VALUES         ('$num_fact',
                            '$code_four',
                            '$ref_fact',
                            '$dateetablissement_fact',
                            '$datereception_fact',
                            '$remarques_facture')";
    //exécution de la requête
    print_r($req);
    if ($result = mysqli_query($connexion, $req)) {
//    $result = mysqli_query($connexion, $req) or die(mysqli_error($connexion));
//    mysqli_close($connexion);

        //Saisie de chaque article de la facture dans la table "details_facture"
        $n = $_POST['nbr'];
        for ($i = 0; $i < $n; $i++) {

            $req = "SELECT code_df FROM details_facture ORDER BY code_df DESC LIMIT 1";
            $resultat = $connexion->query($req);

            if ($resultat->num_rows > 0) {
                $ligne = $resultat->fetch_all(MYSQL_ASSOC);

                //reccuperation du code
                $code_df = "";
                foreach ($ligne as $data) {
                    $code_df = stripslashes($data['code_df']);
                }

                //extraction des 4 derniers chiffres
                $code_df = substr($code_df, -4);

                //incrementation du nombre
                $code_df += 1;

                $b = "DF";
                $dat = date("Y");
                $dat = substr($dat, -2);
                $format = '%04d';
                $resultat = $dat . "" . $b . "" . sprintf($format, $code_df);

                //echo $resultat;
            } else {
                //s'il n'existe pas d'enregistrements dans la base de données
                $code_df = 1;
                $b = "DF";
                $dat = date("Y");
                $dat = substr($dat, -2);
                $format = '%04d';
                $resultat = $dat . "" . $b . "" . sprintf($format, $code_df);
            }
            //on affecte au code le resultat
            $code_df = $resultat;

            $libelle_df = ($_POST['libelle'][$i]);
            $qte_df = ($_POST['qte'][$i]);
            $pu_df = ($_POST['pu'][$i]);
            $rem = ($_POST['rem'][$i]);

            $libelle_df = htmlspecialchars($libelle_df, ENT_QUOTES);
            $qte_df = htmlspecialchars($qte_df, ENT_QUOTES);
            $pu_df = htmlspecialchars($pu_df, ENT_QUOTES);
            $rem = htmlspecialchars($rem, ENT_QUOTES);

            $REQ = "INSERT INTO details_facture (code_df, num_fact, libelle_df, qte_df, pu_df, remise_df)
	            VALUES ('$code_df', '$num_fact', '$libelle_df', '$qte_df', '$pu_df', '$rem')";

            /*print_r($REQ);
            echo '<br/>';*/
            //exécution de la requête REQ:
            if ($requete = mysqli_query($connexion, $REQ) or die(mysql_error($connexion))) {
//                $_SESSION['temp'] = htmlspecialchars($_POST['code_emp'], ENT_QUOTES);
                //header('Location: form_principale.php?page=articles/details_demandes/saisie_details_demandes_biens_ou_services');
            }
        }
        echo "
            <div class='alert alert-success alert-dismissible' role='alert' style='width: 98%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Succes!</strong> La facture a bien ete enregistree. La facture a bien été enregistree sous le numéro $num_fact
            </div>
            ";
    } else {
        echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Une erreur s'est produite lors de la tentative d'enregistrement de la facture. Veuillez contacter l'administrateur.</strong>
            </div>
            ";
    }
    mysqli_close($connexion);
}
?>  
