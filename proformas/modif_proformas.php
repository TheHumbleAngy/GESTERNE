<?php
/**
 * Created by PhpStorm.
 * User: JOCO
 * Date: 20/03/14
 * Time: 09:09
 */
/*require_once '../bd/connection.php';
require_once '../fonctions.php';
error_reporting(0);

sec_session_start();*/

$ref_fp = $_SESSION['code_temp'];

$req = "SELECT * FROM facture_proforma WHERE ref_fp= '".$ref_fp."'";

if ($valeur = $connexion->query($req)) {

    $ligne = $valeur->fetch_all(MYSQL_ASSOC);
    foreach ($ligne as $data) {
        $ref_fp = stripslashes($data['ref_fp']);
        $code_four = stripslashes($data['code_four']);
        $code_dbs = stripslashes($data['code_dbs']);
        $dateetablissement_fp = stripslashes($data['dateetablissement_fp']);
        $datereception_fp = stripslashes($data['datereception_fp']);
        $tauxtva_fp = stripslashes($data['tauxtva_fp']);
        $typepaiement_fp = stripslashes($data['typepaiement_fp']);
        $conditionsreglt_fp = stripslashes($data['conditionsreglt_fp']);
        $delaisreglt_fp = stripslashes($data['delaisreglt_fp']);
        $periodegarantie_fp = stripslashes($data['periodegarantie_fp']);
        $notes_fp = stripslashes($data['notes_fp']);
    }
}
?>



<?php
require_once '../bd/connection.php';
require_once '../fonctions.php';
sec_session_start();
//$_SESSION['expiration'] = time();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
<!--    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css"/>-->
<!--    <link rel="stylesheet" href="../css/stylish.css" type="text/css"/>-->
    <title>Facture Proforma</title>
</head>
<body>

<div class="grid_8">
<div class="box round first">
    <div class="box_title">
        <h2>[Facture Proforma]Modificaition</h2>
    </div>
    <br/>
    <div class="box_content" style="overflow: auto">
        <form action="form_principale.php?page=factures_proforma/fonction_modification_factures_proforma" method="POST">
            <table class="formulaire" style="width= 100%" border="0">

                <tr>


                    <td class="champlabel">* Fournisseur</td>
                    <td><select name="code_four" required="required">

                            <?php
                            //on affiche le fournisseur à modifier
                            $requete = "SELECT code_four, nom_four, prenoms_four FROM fournisseur where code_four='".$code_four."' ";
                            $result = mysqli_query($connexion, $requete) or exit(mysqli_error($connexion));
                            while ($data = mysqli_fetch_array($result)) {
                                echo '<option value="' . $data['code_four'] . '" >' . $data['nom_four'] . ' ' . $data['prenoms_four'] . '</option>';
                            }
                            ?>

                            <option>-----------------------</option>

                            <?php
                            $sql = "SELECT code_four,nom_four,prenoms_four FROM fournisseur order by nom_four Asc ";
                            //Execute la requête
                            $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                            //receuil les valeurs dans un tableau
                            while ($data = mysqli_fetch_array($res)) {

                                echo '<option value="' . $data['code_four'] . '" >' . $data['nom_four'] . ' ' . $data['prenoms_four'] . '</option>';
                                //Attention à ne pas oublier le . qui sert à concaténer ton expression
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="champlabel">Date d'établissement</td>
                    <td><input type="date" name="dateetablissement_fp" value="<?php echo $dateetablissement_fp; ?>"/></td>
                    <td class="champlabel">Date de reception</td>
                    <td><input type="date" name="datereception_fp" value="<?php echo $datereception_fp; ?>"/></td>

                </tr>

                <tr>
                    <td class="champlabel">* Code demande de bien ou service</td>
                    <td>
                        <select name="code_dbs" required="required">

                            <option value="<?php echo $code_dbs; ?>"><?php echo $code_dbs; ?></option>
                            <option>-------------------------</option>
                            <?php
                            $req = "SELECT code_dbs from demande_bien_service ORDER BY code_dbs DESC";

                            $exc = mysqli_query($connexion, $req) or die(mysqli_error($connexion));

                            while ($data = mysqli_fetch_array($exc)) {

                                echo '<option value="' . $data['code_dbs'] . '">' . $data['code_dbs'] . '</option>';

                            }

                            ?>
                        </select></td>
                    <td class="champlabel">Taux de TVA</td>
                    <td><input type="text" name="tauxtva_fp" value="<?php echo $tauxtva_fp; ?>" /></td>
                </tr>
                <tr>

                    <td class="champlabel">Type de paiement</td>
                    <td><input type="text" name="typepaiement_fp"  value="<?php echo $typepaiement_fp; ?>" /></td>

                    <td class="champlabel">Condition de règlement</td>
                    <td><input type="text" name="conditionsreglt_fp" value="<?php echo $conditionsreglt_fp; ?>" /></td>
                </tr>

                <tr>

                    <td class="champlabel">Delais de règlement</td>
                    <td><input type="text" name="delaisreglt_fp" value="<?php echo $delaisreglt_fp; ?>" /></td>
                    <td class="champlabel">Période de garantie</td>
                    <td><input type="text" name="periodegarantie_fp" value="<?php echo $periodegarantie_fp; ?>" /></td>
                </tr>

                <tr>
                    <td class="champlabel">Notes</td>
                    <td><input type="text" name="notes_fp" value="<?php echo $notes_fp; ?>" /></td>


                </tr>
            </table>

<!--            <br/>-->
<!--            <div style="text-align: center;">-->
<!--                <button class="btn btn-blue" type="submit" name="valider">-->
<!--                    Valider-->
<!--                </button>-->
<!---->
<!--                <button class="btn btn-black" type="reset" name="effacer">-->
<!--                    Effacer-->
<!--                </button>-->
<!--                <input type="hidden" id="ref_fp" name="ref_fp" value="--><?php //echo $ref_fp; ?><!--"/>-->
<!--            </div>-->


        </form>
    </div>
    </div>
    </div>
</div>
</body>
</html>




