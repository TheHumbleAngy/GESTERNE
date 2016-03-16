<?php
/**
 * Created by PhpStorm.
 * User: stagiaireinfo
 * Date: 31/03/14
 * Time: 12:00
 */
?>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
            Factures
            <a href='form_principale.php?page=accueil' type='button'
               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                <span aria-hidden='true'>&times;</span>
            </a>
        </div>
        <div class="panel-body" style="overflow: auto">
            <div class="box_content" style="overflow: auto">
                <table border="0" class="table table-hover table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="entete" style="text-align: center">Numéro</th>
                        <th class="entete" style="text-align: center">Date d'établ</th>
                        <th class="entete" style="text-align: center">Référence</th>
                        <th class="entete" style="text-align: center">Code F/S</th>
                        <th class="entete" style="text-align: center">Date récep</th>
                        <th class="entete" style="text-align: center">Etat</th>
                        <th class="entete" style="text-align: center">Remarques</th>
                        <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')): ?>
                        <th class="entete" colspan="2" style="text-align: center">Actions</th>
                        <?php //endif ?>
                    </tr>
                    </thead>

                    <?php
                    $sql = "SELECT * FROM factures ORDER BY dateetablissement_fact ASC";
                    if ($valeur = $connexion->query($sql)) {
                        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                        foreach ($ligne as $list) {
                            ?>
                            <tr>
                                <td><?php echo stripslashes($list['num_fact']); ?></td>
                                <td><?php echo stripslashes($list['dateetablissement_fact']); ?></td>
                                <td><?php echo stripslashes($list['ref_fact']); ?></td>
                                <td><?php echo stripslashes($list['code_four']); ?></td>
                                <td><?php echo stripslashes($list['datereception_fact']); ?></td>

                                <td><?php echo stripslashes($list['etatavecfacpro_facture']); ?></td>
                                <td><?php echo stripslashes($list['remarques_facture']); ?></td>
                                <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')): ?>
                                    <td style="text-align: center">
                                        <a href="form_principale.php?page=factures/process_modif_factures&id=<?php echo stripslashes($list['num_fact']); ?>"><img
                                                height="20" width="20" src="images/edit.png" title="Modifier"/></a>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="form_principale.php?page=factures/suppression_factures&id=<?php echo stripslashes($list['num_fact']); ?> "><img
                                                height="20" width="20" src="images/delete.png" title="Supprimer"/></a>
                                    </td>
                                <?php //endif ?>
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