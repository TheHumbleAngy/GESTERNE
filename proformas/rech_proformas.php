<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 23/11/2015
 * Time: 09:19 AM
 */

if (isset($_POST['opt'])) {
    $option = $_POST['opt'];
    $element = $_POST['element'];

    switch ($option) {
        case 'numero': $sql = "SELECT * FROM proformas WHERE ref_fp LIKE '%" . $element . "%'";
            break;
        case 'date_eta': $sql = "SELECT * FROM proformas WHERE dateetablissement_fp LIKE '%" . $element . "%'";
            break;
        case 'date_rcp': $sql = "SELECT * FROM proformas WHERE datereception_fp LIKE '%" . $element . "%'";
            break;
        case 'notes': $sql = "SELECT * FROM proformas WHERE notes_fp LIKE '%" . $element . "%'";
            break;
    }

    $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    if ($res->num_rows > 0) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                    Proformas
                    <a href='form_principale.php?page=form_actions&source=proformas&action=rechercher' type='button' class='close'
                               data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body" style="overflow: auto">
                    <table border="0" class="table table-hover table-bordered ">
                        <thead>
                        <tr>
                            <td class="entete" style="text-align: center; width: 10%">Numero</td>
                            <td class="entete" style="text-align: center">Fournisseur</td>
                            <td class="entete" style="text-align: center">Date d'Etablissement</td>
                            <td class="entete" style="text-align: center">Date de Reception</td>
                            <td class="entete" style="text-align: center">Notes</td>
                        </tr>
                        </thead>
                        <?php
                        //$req = "SELECT * FROM fournisseurs ORDER BY code_four ASC ";
                        if ($resultat = $connexion->query($sql)) {
                            $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                            foreach ($ligne as $list) {
                        ?>
                        <tr>
                            <td><a class="btn btn-default" href="form_principale.php?page=proformas/form_proformas&action=consultation&id=<?php echo stripslashes($list['ref_fp']); ?>" role="button"><?php echo stripslashes($list['ref_fp']); ?></a></td>
                            <td><?php echo stripslashes($list['code_four']); ?></td>
                            <td><?php echo stripslashes($list['dateetablissement_fp'])?></td>
                            <td><?php echo stripslashes($list['datereception_fp']); ?></td>
                            <td><?php echo stripslashes($list['notes_fp']); ?></td>
                            <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')):?>
                            <!--<td>
                                <div style="text-align: center">
                                    <a class="btn btn-default" href="form_principale.php?page=proformas/form_proformas&action=consultation&id=<?php /*echo stripslashes($list['ref_fp']); */?>" role="button">
                                        <img height="20" width="20" src="img/icons8/visible.png" title="Consulter"/>
                                    </a>
                                </div>
                            </td>-->
                        </tr>
                    <?php
                            }
                        } else echo "La recherche n'a renvoye aucun resultat.";?>
                    </table>
                </div>
            </div>
        </div>
    </div>
            <?php } else echo "
                    <div style='width: 400px; margin-right: auto; margin-left: auto'>
                        <div class='alert alert-info alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                            <a href='form_principale.php?page=form_actions&source=fournisseurs&action=rechercher' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                                </a>
                            <strong>Desole!</strong> La recherche n'a retourne aucun resultat.
                        </div>
                    </div>
                    ";
}
?>