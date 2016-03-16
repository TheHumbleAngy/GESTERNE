<?php
/**
 * Created by PhpStorm.
 * User: stagiaireinfo
 * Date: 03/04/14
 * Time: 09:48
 */

?>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
            Bons de Livraison
        </div>
        <div class="panel-body" style="overflow: auto">
            <table border="0" class="table table-hover table-bordered table-condensed">
                <tr>
                    <td class="entete" style="text-align: center">Numéro</td>
                    <td class="entete" style="text-align: center">Date établ.</td>
                    <td class="entete" style="text-align: center">Date recept</td>
                    <td class="entete" style="text-align: center">Code F/S</td>
                    <td class="entete" style="text-align: center">Matricule employé</td>
                    <!--<td class="entete" style="text-align: center">Numero Bon Cmd</td>-->
                    <td class="entete" style="text-align: center">Statut</td>
                    <td class="entete" style="text-align: center">Commentaire</td>
                    <?php /*if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')):*/ ?>
                    <td class="entete" colspan="2" style="text-align: center">Actions</td>
                    <?php /*endif*/ ?>
                </tr>
                <?php
                $sql = "SELECT * FROM bons_livraison";

                if ($valeur = $connexion->query($sql)) {
                    $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                    foreach ($ligne as $list) {
                        ?>
                        <tr>
                            <td><?php echo stripslashes($list['code_bl']); ?></td>
                            <td><?php echo stripslashes($list['dateetablissement_bl']); ?></td>
                            <td><?php echo stripslashes($list['datereception_bl']); ?></td>
                            <td><?php echo stripslashes($list['code_four']); ?></td>
                            <td><?php echo stripslashes($list['code_emp']); ?></td>
                            <!--<td><?php /*echo stripslashes($list['num_bc']); */ ?></td>-->
                            <td><?php echo stripslashes($list['statut_bl']); ?></td>
                            <td><?php echo stripslashes($list['commentaires_bl']); ?></td>
                            <?php /*if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')):*/ ?>
                            <td style="text-align: center">
                                <a href="form_principale.php?page=bons_livraison/process_modif_bons_livraison&id=<?php echo stripslashes($list['code_bl']); ?>"><img
                                        height="20" width="20" src="img/edit.png" title="Modifier"/></a>
                            </td>
                            <td style="text-align: center">
                                <a href="form_principale.php?page=bons_livraison/suppr_bons_livraison&id=<?php echo $list['code_bl'] ?> "><img
                                        height="20" width="20" src="img/delete.png" title="Supprimer"/></a>
                            </td>
                            <?php /*endif*/ ?>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>