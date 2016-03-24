<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 23/11/2015
 * Time: 10:13 AM
 */

if (isset($_POST['opt'])) {
    $option = $_POST['opt'];
    $element = $_POST['element'];

    switch ($option) {
        case 'numero': $sql = "SELECT * FROM demandes WHERE code_dbs LIKE '%" . $element . "%' ORDER BY code_dbs DESC ";
            break;
        case 'emp': $sql = "SELECT * FROM demandes WHERE code_emp LIKE '%" . $element . "%' ORDER BY code_dbs DESC ";
            break;
        case 'date': $sql = "SELECT * FROM demandes WHERE date_dbs LIKE '%" . $element . "%' ORDER BY code_dbs DESC ";
            break;
        case 'obj': $sql = "SELECT * FROM demandes WHERE objets_dbs LIKE '%" . $element . "%' ORDER BY code_dbs DESC ";
            break;
    }

    $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    if ($res->num_rows > 0) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                    Demandes
                    <a href='form_principale.php?page=form_actions&source=demandes&action=rechercher' type='button' class='close'
                               data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body" style="overflow: auto">
                    <table border="0" class="table table-hover table-bordered ">
                        <thead>
                        <tr>
                            <td class="entete" style="text-align: center; width: 10%">Numero</td>
                            <td class="entete" style="text-align: center">Employe</td>
                            <td class="entete" style="text-align: center">Date d'Etablissement</td>
                            <td class="entete" style="text-align: center">Objet</td>
                            <td class="entete" style="text-align: center">Actions</td>
                        </tr>
                        </thead>
                        <?php
                        //$req = "SELECT * FROM fournisseurs ORDER BY code_four ASC ";
                        if ($resultat = $connexion->query($sql)) {
                            $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                            foreach ($ligne as $list) {
                        ?>
                        <tr>
                            <td><?php echo stripslashes($list['code_dbs']); ?></td>
                            <td><?php echo stripslashes($list['code_emp']); ?></td>
                            <td><?php echo stripslashes($list['date_dbs'])?></td>
                            <td><?php echo stripslashes($list['objets_dbs']); ?></td>
                            <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')):?>
                            <td>
                                <div style="text-align: center">
                                    <a class="btn btn-default" href="form_principale.php?page=demandes/form_demandes&action=consultation&id=<?php echo stripslashes($list['code_dbs']); ?>" role="button">
                                        <img height="20" width="20" src="img/icons8/visible.png" title="Consulter"/>
                                    </a>
                                </div>
                            </td>
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
                            <a href='form_principale.php?page=form_actions&source=proformas&action=rechercher' type='button' class='close'
                                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                                </a>
                            <strong>Desole!</strong><br/> La recherche n'a retourne aucun resultat.
                        </div>
                    </div>
                    ";
}
?>