<?php
    /*require_once '../bd/connection.php';
    require_once '../fonctions.php';
    sec_session_start();
    $_SESSION['expiration'] = time();*/
?>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
            [Liste Des Factures Proforma]
        </div>
        <div class="box_content" style="overflow: auto">
            <div class="controls-row">
                <table border=0" class="table table-hover table-bordered ">
                    <tr>
                        <td class="entete" style="text-align: center">Ref. fact.pro</td>
                        <td class="entete" style="text-align: center">Code détail</td>
                        <td class="entete" style="text-align: center">Libellé</td>
                        <td class="entete" style="text-align: center">Quantité</td>
                        <td class="entete" style="text-align: center">Prix Unitaire</td>
                        <td class="entete" style="text-align: center">Remise</td>
                        <td class="entete" style="text-align: center">Etat</td>
                        <?php /*if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')):*/ ?><!--
                            <td class="entete" colspan="2" style="text-align: center">Actions</td>
                        --><?php /*endif*/ ?>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM detail_factpro ";
                        if ($valeur = $connexion->query($sql)) {
                            $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                            foreach ($ligne as $list) {
                                ?>
                                <tr>
                                    <td><?php echo stripslashes($list['ref_fp']); ?></td>
                                    <td><?php echo stripslashes($list['id_dfp']); ?></td>
                                    <td><?php echo stripslashes($list['libelle']); ?></td>
                                    <td><?php echo stripslashes($list['qte_dfp']); ?></td>
                                    <td><?php echo stripslashes($list['pu_dfp']); ?></td>
                                    <td> <?php echo stripslashes($list['remise_dfp']); ?></td>
                                    <td> <?php echo stripslashes($list['etat']); ?></td>
                                    <!-- <?php /*if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')):*/ ?>
                                    <td style="text-align: center">
                                        <a href="form_principale.php?page=factures_proforma/process_modif_factures_proforma&id=<?php /*echo stripslashes($list['ref_fp']); */ ?>"><img height="20" width="20" src="img/edit.png" title="Modifier"/></a>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="form_principale.php?page=factures_proforma/suppression_factures_proforma&id=<?php /*echo stripslashes($list['ref_fp']); */ ?> "><img height="20" width="20" src="img/delete.png" title="Supprimer"/></a>
                                    </td>
                                --><?php /*endif*/ ?>
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



