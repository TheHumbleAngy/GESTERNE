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
            Factures Proformas
            <a href='form_principale.php?page=accueil' type='button'
               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                <span aria-hidden='true'>&times;</span>
            </a>
        </div>
        <div class="panel-body" style="overflow: auto">
            <table class="table table-hover table-bordered ">
                <thead>
                <tr>
                    <th class="entete" style="text-align: center">Numero</th>
                    <th class="entete" style="text-align: center">Date d'Etablissement</th>
                    <th class="entete" style="text-align: center">Date de Reception</th>
                    <th class="entete" style="text-align: center">Notes</th>
                    <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')): ?>
                    <!--                        <td class="entete" style="text-align: center">Actions</td>-->
                    <?php //endif ?>
                </tr>
                </thead>

                <?php
                    $sql = "SELECT * FROM proformas ORDER BY dateetablissement_fp DESC";
                    if ($valeur = $connexion->query($sql)) {
                        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                        foreach ($ligne as $list) {
                            ?>
                            <tr>
                                <td style="text-align: center">
                                    <?php
                                        //Recuperation des articles figurants sur la proforma
                                        $req = "SELECT libelle FROM details_proforma WHERE ref_fp = '" . stripslashes($list['ref_fp']) . "'";
                                        if ($resultat = $connexion->query($req)) {
                                            $rows = $resultat->fetch_all(MYSQL_ASSOC);
                                            $str = "";
                                            foreach ($rows as $row) {
                                                $str = $str . stripslashes($row['libelle']) . "\r\n";
                                            }
                                        }
                                    ?>
                                    <a class="btn btn-default"
                                       href="form_principale.php?page=proformas/form_proformas&action=consultation&id=<?php echo stripslashes($list['ref_fp']); ?>"
                                       title="<?php echo $str; ?>"
                                       role="button"><?php echo stripslashes($list['ref_fp']); ?></a>
                                </td>
                                <td><?php echo stripslashes($list['dateetablissement_fp']); ?></td>
                                <td><?php echo stripslashes($list['datereception_fp']); ?></td>
                                <td><?php echo stripslashes($list['notes_fp']); ?></td>

                                <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')): ?>
                                <input type="hidden" name="ref_fp"
                                       value="<?php echo stripslashes($list['ref_fp']); ?>"/>
                                <!--<td style="text-align: center">
                                    <div style="text-align: center">
                                        <a class="btn btn-default modifier" data-toggle="modal"
                                           data-target="#modalModifier<?php /*echo stripslashes($list['ref_fp']); */ ?>">
                                            <img height="20" width="20" src="img/icons8/ball_point_pen.png"
                                                 title="Modifier"/>
                                        </a>
                                        <a class="btn btn-default modifier" data-toggle="modal"
                                           data-target="#modalSupprimer<?php /*echo stripslashes($list['ref_fp']); */ ?>">
                                            <img height="20" width="20" src="img/icons8/cancel.png" title="Supprimer"/>
                                        </a>
                                    </div>
                                </td>-->
                                <!--<td style="text-align: center">
                                                    <a href="form_principale.php?page=factures_proforma/suppression_factures_proforma&id=<?php /*echo stripslashes($list['ref_fp']); */ ?> "><img
                                                            height="20" width="20" src="img/delete.png"
                                                            title="Supprimer"/></a>
                                                </td>-->
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