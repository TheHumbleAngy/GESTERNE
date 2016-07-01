<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 01/12/2015
 * Time: 09:20
 */

if (isset($_POST['opt'])) {
    $option = $_POST['opt'];
    $element = $_POST['element'];

    switch ($option) {
        case 'numero': $sql = "SELECT * FROM bons_commande WHERE num_bc LIKE '%" . $element . "%'"; //print_r($sql);
            break;
        case 'employe':
            $sql = "SELECT * FROM bons_commande WHERE code_emp IN (SELECT code_emp FROM employes WHERE nom_emp LIKE '%" . $element . "%' OR prenoms_emp LIKE '%" . $element . "%')"; //print_r($sql);
            break;
        case 'fournisseur': $sql = "SELECT * FROM bons_commande WHERE code_four LIKE '%" . $element . "%'"; //print_r($sql);
            break;
        case 'date': $sql = "SELECT * FROM bons_commande WHERE date_bc LIKE '%" . $element . "%'"; //print_r($sql);
            break;
    }

    $resultat = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    if ($resultat->num_rows > 0) { ?>
        <div id="info"></div>
        <div id="feedback">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                            Bons de Commande
                            <a href='form_principale.php?page=administration&source=bons_commande' type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                <span aria-hidden='true'>&times;</span>
                            </a>
                        </div>
                        <div class="panel-body" style="overflow: auto">
                            <table border="0" class="table table-hover table-bordered ">
                                <thead>
                                <tr>
                                    <td class="entete" style="text-align: center">Numero</td>
                                    <td class="entete" style="text-align: center">Employé</td>
                                    <td class="entete" style="text-align: center">Fournisseur</td>
                                    <td class="entete" style="text-align: center">Date</td>
                                    <td class="entete" style="text-align: center; width: 18%">Actions</td>
                                </tr>
                                </thead>
                                <?php while ($data = mysqli_fetch_array($resultat)) { ?>
                                    <tr>
                                        <td style="text-align: center"><a class="btn btn-default" href="form_principale.php?page=bons_commande/form_bon_commande&action=consultation&id=<?php echo stripslashes($data['num_bc']); ?>" role="button"><?php echo stripslashes($data['num_bc']); ?></a></td>
                                        <td><?php echo stripslashes($data['code_emp']); ?></td>
                                        <td><?php echo stripslashes($data['code_four']); ?></td>
                                        <td><?php echo stripslashes($data['date_bc']); ?></td>
                                        <td>
                                            <div style="text-align: center">
                                                <a class="btn btn-default modifier" data-toggle="modal"
                                                   data-target="#modalSupprimer<?php echo stripslashes($data['num_bc']); ?>">
                                                    <img height="20" width="20" src="img/icons8/cancel.png" title="Supprimer"/>
                                                </a>
                                            </div>

                                            <!-- Modal suppression des infos -->
                                            <div class="modal fade"
                                                 id="modalSupprimer<?php echo stripslashes($data['num_bc']); ?>" tabindex="-1"
                                                 role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h4 class="modal-title"
                                                                id="modalSupprimer<?php echo stripslashes($data['num_bc']); ?>">
                                                                Confirmation</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            Voulez-vous supprimer
                                                            le bon de commande <?php echo stripslashes($data['num_bc']); ?>" de la base ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-default" data-dismiss="modal">Non</button>
                                                            <button class="btn btn-primary" data-dismiss="modal"
                                                                    onclick="suppressionInfos('<?php echo stripslashes($data['num_bc']); ?>')">
                                                                Oui
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        echo "La recherche n'a renvoye aucun resultat.";
    }
}
?>

<script>
    function suppressionInfos(code) {
        $.ajax({
            type: 'POST',
            url: 'bons_commande/deletedata.php',
            data: {
                id: code
            },
            success: function (data) {
                $('#info').html(data);
                $("div.modal-backdrop.fade.in").remove();
                /*setTimeout(function(){
                    $(".alert-success").slideToggle("slow");
                }, 2500);*/
            }
        });
    }
</script>