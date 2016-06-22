<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 27/08/2015
     * Time: 6:58 PM
     */
    require_once '../bd/connection.php';
    session_start();
?>
<!--suppress ALL -->
<div class="panel panel-default">
    <div class="panel-heading" style="font-size: 14px; font-weight: bolder">
        Demandes
        <a href='form_principale.php?page=accueil' type='button'
           class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
            <span aria-hidden='true'>&times;</span>
        </a>
    </div>
    <div class="panel-body">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th class="entete" style="text-align: center; width: 5%">Numero</th>
                <th class="entete" style="text-align: center; width: 5%">Date</th>
                <th class="entete" style="text-align: center; width: 20%">Demandeur</th>
                <th class="entete" style="text-align: center; width: 20%">Objet</th>
                <th class="entete" style="text-align: center; width: 5%">Action</th>
                <?php /*if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')|| ($_SESSION['type_utilisateur'] == 'normal') ):*/ ?>
                <!--                    <td class="entete" colspan="3" style="text-align: center">Actions</td>-->
                <?php /*endif*/ ?>
            </tr>
            </thead>
            <?php
                $req = "SELECT d.code_dbs, d.date_dbs, d.objets_dbs, e.nom_emp, e.prenoms_emp
                            FROM demandes AS d, employes AS e
                            WHERE d.code_emp = e.code_emp AND e.email_emp = '" . $_SESSION['email'] . "'
                            ORDER BY d.date_dbs DESC";
                if ($resultat = $connexion->query($req)) {
                    $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                    foreach ($ligne as $list) {
                        ?>
                        <tr>
                            <td style="text-align: center">
                                <?php
                                    //Recuperation des articles figurants sur la demande
                                    $req = "SELECT libelle_dd FROM details_demande WHERE code_dbs = '" . stripslashes($list['code_dbs']) . "'";
                                    if ($resultat = $connexion->query($req)) {
                                        $rows = $resultat->fetch_all(MYSQL_ASSOC);
                                        $str = "";
                                        foreach ($rows as $row) {
                                            $str = $str . stripslashes($row['libelle_dd']) . "\r\n";
                                        }
                                    }
                                ?>
                                <a class="btn btn-default"
                                   href="form_principale.php?page=demandes/form_demandes&action=consultation&id=<?php echo stripslashes($list['code_dbs']); ?>"
                                   title="<?php echo $str; ?>"
                                   role="button"><?php echo stripslashes($list['code_dbs']); ?></a>
                            </td>
                            <td style="text-align: center"><?php echo stripslashes($list['date_dbs']); ?></td>
                            <td style="text-align: center"><?php echo stripslashes($list['prenoms_emp']) . " " . stripslashes($list['nom_emp']); ?></td>
                            <td><?php echo stripslashes($list['objets_dbs']); ?></td>
                            <td style="text-align: center">
                                <a class="btn btn-default" data-toggle="modal"
                                   data-target="#modalSupprimer<?php echo stripslashes($list['code_dbs']); ?>">
                                    <img height="20" width="20" src="img/icons8/cancel.png" title="Supprimer"/>
                                </a>
                                <div class="modal fade"
                                     id="modalSupprimer<?php echo stripslashes($list['code_dbs']); ?>"
                                     tabindex="-1"
                                     role="dialog">
                                    <div class="modal-dialog delete" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title"
                                                    id="modalSupprimer<?php echo stripslashes($list['code_dbs']); ?>">
                                                    Confirmation</h4>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous supprimer
                                                la demande "<?php echo stripslashes($list['code_dbs']); ?>" de la
                                                base ?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-default" data-dismiss="modal">Non</button>
                                                <button class="btn btn-primary" data-dismiss="modal"
                                                        onclick="suppressionInfos('<?php echo stripslashes($list['code_dbs']); ?>')">
                                                    Oui
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>
    </div>
</div>