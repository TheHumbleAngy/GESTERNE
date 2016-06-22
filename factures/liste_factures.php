<?php
    /**
     * Created by PhpStorm.
     * User: stagiaireinfo
     * Date: 31/03/14
     * Time: 12:00
     */
?>
<!--suppress ALL -->
<div style="margin-left: 1.5%; margin-right: 1.5%">
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 14px; font-weight: bolder">
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
                        <th class="entete" style="text-align: center; width: 10%">Numéro</th>
                        <th class="entete" style="text-align: center; width: 10%">Date d'Etabl.</th>
                        <th class="entete" style="text-align: center; width: 10%">Référence</th>
                        <th class="entete" style="text-align: center; width: 40%">Fournisseur</th>
                        <th class="entete" style="text-align: center; width: 10%">Date Récep.</th>
                        <!--<th class="entete" style="text-align: center">Etat</th>-->
                        <th class="entete" style="text-align: center; width: 10%">Remarques</th>
                        <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')): ?>
                        <th class="entete" colspan="2" style="text-align: center; width: 10%">Actions</th>
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
                                    <td style="text-align: center">
                                        <?php
                                            //Recuperation des détails figurants sur la demande
                                            $req = "SELECT libelle_df FROM details_facture WHERE num_fact = '" . stripslashes($list['num_fact']) . "'";
                                            if ($resultat = $connexion->query($req)) {
                                                $rows = $resultat->fetch_all(MYSQL_ASSOC);
                                                $str = "";
                                                foreach ($rows as $row) {
                                                    $str = $str . stripslashes($row['libelle_df']) . "\r\n";
                                                }
                                            }
                                        ?>
                                        <a class="btn btn-default"
                                           href="form_principale.php?page=factures/form_factures&action=consultation&id=<?php echo stripslashes($list['num_fact']); ?>"
                                           title="<?php echo $str; ?>"
                                           role="button"><?php echo stripslashes($list['num_fact']); ?></a>
                                    </td>

                                    <td><?php echo stripslashes($list['dateetablissement_fact']); ?></td>
                                    <td><?php echo stripslashes($list['ref_fact']); ?></td>
                                    <td><?php echo stripslashes($list['code_four']); ?></td>
                                    <td><?php echo stripslashes($list['datereception_fact']); ?></td>

                                    <!--                                <td>-->
                                    <?php //echo stripslashes($list['etatavecfacpro_facture']); ?><!--</td>-->
                                    <td><?php echo stripslashes($list['remarques_facture']); ?></td>
                                    <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')): ?>
                                    <td>
                                        <div style="text-align: center">
                                            <a class="btn btn-default modifier" data-toggle="modal"
                                               data-target="#modalModifier<?php echo stripslashes($list['num_fact']); ?>">
                                                <img height="20" width="20" src="img/icons8/ball_point_pen.png"
                                                     title="Modifier"/>
                                            </a>
                                            <a class="btn btn-default modifier" data-toggle="modal"
                                               data-target="#modalSupprimer<?php echo stripslashes($list['num_fact']); ?>">
                                                <img height="20" width="20" src="img/icons8/cancel.png" title="Supprimer"/>
                                            </a>
                                        </div>
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