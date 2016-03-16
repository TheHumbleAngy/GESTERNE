<?php
/**
 * Created by PhpStorm.
 * User: stagiaireinfo
 * Date: 31/03/14
 * Time: 10:13
 */
?>

<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                Détails de votre demande
            </div>
            <div class="panel-body" style="overflow: auto">
                <table border="0" class="table table-hover table-bordered table-condensed">
                    <tr>
                        <td class="entete" style="text-align: center">Date demande</td>
                        <td class="entete" style="text-align: center">Code demande</td>
                        <td class="entete" style="text-align: center">Libellé</td>
                        <td class="entete" style="text-align: center">Quantités</td>
                        <td class="entete" style="text-align: center">Observations</td>
                    </tr>
                    <?php
                    $id = $_GET['id'];

                    $req = "SELECT demande_bien_service.date_dbs, detail_demande.code_dbs, employe.nom_emp, employe.prenoms_emp, libelle_dd, qte_dd, observations_dd, code_dd
                                FROM detail_demande, demande_bien_service, employe
                                WHERE detail_demande.code_dbs = demande_bien_service.code_dbs
                                AND employe.code_emp = demande_bien_service.code_emp
                                AND demande_bien_service.code_dbs = '" . $id . "'";

                    if ($valeur = $connexion->query($req)) {
                        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                        foreach ($ligne as $list) {
                            ?>
                            <tr>
                                <td style="text-align: center"><?php echo stripslashes($list['date_dbs']); ?></td>
                                <td style="text-align: center"><?php echo stripslashes($list['code_dbs']); ?></td>
                                <td><?php echo stripslashes($list['libelle_dd']); ?></td>
                                <td style="text-align: center"><?php echo stripslashes($list['qte_dd']); ?></td>
                                <td><?php echo stripslashes($list['observations_dd']); ?></td>
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