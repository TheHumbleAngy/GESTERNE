<?php
/**
 * Created by PhpStorm.
 * User: JOCO
 * Date: 20/03/14
 * Time: 09:09
 */
//    require_once '../bd/connection.php';
//    require_once '../fonctions.php';
//    error_reporting(0);
//
//    sec_session_start();

$num_fact = $_SESSION['code_temp'];

$req = "SELECT * FROM facture WHERE num_fact = '" . $num_fact . "'";

if ($valeur = $connexion->query($req)) {

    $ligne = $valeur->fetch_all(MYSQL_ASSOC);
    foreach ($ligne as $data) {
        $num_fact = stripslashes($data['num_fact']);
        $ref_fact = stripslashes($data['ref_fact']);
        $code_four = stripslashes($data['code_four']);
        $dateetablissement_fact = stripslashes($data['dateetablissement_fact']);
        $datereception_fact = stripslashes($data['datereception_fact']);

        $etatavecfacpro_facture = stripslashes($data['etatavecfacpro_facture']);
        $remarques_facture = stripslashes($data['remarques_facture']);
    }
}
?>

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
            [Factures] Modification
        </div>
        <div class="panel-body" style="overflow: auto">
            <form action="form_principale.php?page=factures/fonction_modification_factures" method="POST">
                <table class="formulaire" style="width= 100%" border="0">
                    <tr>
                        <td class="champlabel">Date détablissement :</td>
                        <td><label>
                                <input type="date" name="dateetablissement_fact" class="form-control"
                                       value="<?php echo $dateetablissement_fact; ?>"/>
                            </label></td>
                        <td class="champlabel">Date de reception :</td>
                        <td><label>
                                <input type="date" name="datereception_fact" class="form-control"
                                       value="<?php echo $datereception_fact; ?>"/>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="champlabel">Référence facture:</td>
                        <td><label>
                                <input type="text" name="ref_fact" value="<?php echo $ref_fact; ?>" class="form-control"/>
                            </label></td>

                        </tr>
                    <tr>
                        <td class="champlabel">Fournisseur</td>
                        <td>
                            <label>
                                <select name="code_four" required="required" class="form-control">

                                    <?php
                                    //on affiche le fournisseur à modifier
                                    $requete = "SELECT code_four, nom_four, prenoms_four FROM fournisseur where code_four='" . $code_four . "' ";
                                    $result = mysqli_query($connexion, $requete) or exit(mysqli_error($connexion));
                                    while ($data = mysqli_fetch_array($result)) {
                                        echo '<option value="' . $data['code_four'] . '" >' . $data['nom_four'] . ' ' . $data['prenoms_four'] . '</option>';
                                    }
                                    ?>

                                    <option>-------------------------</option>

                                    <?php
                                    //on affiche tous les fournisseurs de la base de donnée
                                    $sql = "SELECT code_four, nom_four, prenoms_four FROM fournisseurs order by nom_four Asc ";
                                    $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                    while ($data = mysqli_fetch_array($res)) {
                                        echo '<option value="' . $data['code_four'] . '" >' . $data['nom_four'] . ' ' . $data['prenoms_four'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                        </td>
                        <td class="champlabel">Etat avec facture pro:</td>
                        <td><label>
                                <input type="text" name="etatavecfacpro_facture" class="form-control"
                                       value="<?php echo $etatavecfacpro_facture; ?>"/>
                            </label></td>
                    </tr>

                    <tr>
                        <td class="champlabel">Remarques facture</td>
                        <td><label>
                                <textarea name="remarques_facture" rows="5" cols="20" class="form-control" style="resize: none">
                                    <?php echo $remarques_facture; ?></textarea>
                            </label></td>
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

                <input type="hidden" id="num_fact" name="num_fact" value="<?php echo $num_fact; ?>"/>
            </form>
        </div>
    </div>
</div>

