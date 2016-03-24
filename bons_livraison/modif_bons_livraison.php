<?php
/**
 * Created by PhpStorm.
 * User: stagiaireinfo
 * Date: 11/04/14
 * Time: 16:35
 */

$code_bl = $_SESSION['code_temp'];

$req = "SELECT * FROM bons_livraison WHERE code_bl ='" . $code_bl . "'";

if ($result = $connexion->query($req)) {

    $lignes = $result->fetch_all(MYSQL_ASSOC);
    foreach ($lignes as $ligne) {
        $code_bl = stripslashes($ligne['code_bl']);
        $dateetablissement_bl = stripslashes($ligne['dateetablissement_bl']);
        $datereception_bl = stripslashes($ligne['datereception_bl']);
        $code_four = stripslashes($ligne['code_four']);
        $code_emp = stripslashes($ligne['code_emp']);
        /*$num_bc = stripslashes($ligne['num_bc']);*/
        $statut_bl = stripslashes($ligne['statut_bl']);
        $commentaires_bl = stripslashes($ligne['commentaires_bl']);
    }
}
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                Bon de Livraison (Modification)
            </div>
            <div class="panel-body">
                <form action="form_principale.php?page=bons_livraison/fonction_modif_bons_livraison" method="POST">
                    <table class="formulaire" style="width= 100%" border="0">
                        <tr>
                            <td class="champlabel">Date d'établissement :</td>
                            <td><label>
                                    <input type="date" name="dateetablissement_bl" class="form-control"
                                           value="<?php echo $dateetablissement_bl; ?>"/>
                                </label>
                            </td>
                            <td class="champlabel">Date de réception :</td>
                            <td><label>
                                    <input type="date" name="datereception_bl" class="form-control"
                                           value="<?php echo $datereception_bl; ?>"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">Fournisseur :</td>
                            <td>
                                <label>
                                    <select name="code_four" required="required" class="form-control">
                                        <?php
                                        //on affiche le fournisseur à modifier
                                        $requete = "SELECT code_four, nom_four FROM fournisseurs WHERE code_four='" . $code_four . "'";
                                        $result = mysqli_query($connexion, $requete) or exit(mysqli_error($connexion));
                                        while ($ligne = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $ligne['code_four'] . '" >' . $ligne['nom_four'] . '</option>';
                                        }
                                        ?>
                                        <option></option>
                                        <?php
                                        //on affiche tous les fournisseurs de la base de données
                                        $sql = "SELECT code_four, nom_four FROM fournisseurs ORDER BY nom_four ASC";
                                        //Execute la requête
                                        $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                        //recueille les valeurs dans un tableau
                                        while ($ligne = mysqli_fetch_array($res)) {
                                            echo '<option value="' . $ligne['code_four'] . '" >' . $ligne['nom_four'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </label>
                            </td>
                            <!--<td class="champlabel">Bon de Commande :</td>
                            <td>
                                <label>
                                    <select name="num_bc" required="required" class="form-control">
                                        <option value="<?php /*echo $num_bc; */ ?>"><?php /*echo $num_bc; */ ?></option>
                                        <option></option>
                                        <?php
                            /*                                        $requ = "SELECT num_bc from bons_commande";
                                                                    $excu = mysqli_query($connexion, $requ) or die(mysqli_error($connexion));
                                                                    while ($ligne = mysqli_fetch_array($excu)) {
                                                                        echo '<option value="' . $ligne['num_bc'] . '">' . $ligne['num_bc'] . '</option>';
                                                                    }
                                                                    */ ?>
                                    </select>
                                </label>
                            </td>-->
                        </tr>
                        <tr>
                            <td class="champlabel">Employé :</td>
                            <td>
                                <label>
                                    <select name="code_emp" required="required" class="form-control">
                                        <?php
                                        //L'employé à modifier
                                        $req1 = "SELECT code_emp, nom_emp, prenoms_emp FROM employes WHERE code_emp='" . $code_emp . "'";
                                        //Execute la requête
                                        $res1 = mysqli_query($connexion, $req1) or exit(mysqli_error($connexion));
                                        //receuil les valeurs dans un tableau
                                        while ($ligne = mysqli_fetch_array($res1)) {
                                            echo '<option value="' . $ligne['code_emp'] . '" >' . $ligne['nom_emp'] . ' ' . $ligne['prenoms_emp'] . '</option>';
                                        }
                                        ?>
                                        <option></option>
                                        <?php
                                        //on affiche tous les employés
                                        $sql = "SELECT code_emp, nom_emp, prenoms_emp FROM employes ORDER BY nom_emp ASC ";
                                        //Execute la requête
                                        $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                        //receuil les valeurs dans un tableau
                                        while ($ligne = mysqli_fetch_array($res)) {
                                            echo '<option value="' . $ligne['code_emp'] . '" >' . $ligne['nom_emp'] . ' ' . $ligne['prenoms_emp'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </label>
                            </td>
                            <td class="champlabel">Statut :</td>
                            <td><label>
                                    <input type="text" name="statut_bl" class="form-control"
                                           value="<?php echo $statut_bl; ?>"/>
                                </label></td>
                        </tr>
                        <tr>
                            <td class="champlabel">Commentaires :</td>
                            <td><label>
                                    <textarea name="commentaires_bl" rows="5" class="form-control"
                                              cols="40"><?php echo $commentaires_bl; ?></textarea>
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

                    <input type="hidden" id="code_bl" name="code_bl" value="<?php echo $code_bl; ?>"/>
                </form>
            </div>
        </div>
    </div>
</div>