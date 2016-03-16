<?php
/**
 * Created by PhpStorm.
 * User: ange-marius.kouakou
 * Date: 26/08/2015
 * Time: 15:10
 */
    require_once '../bd/connection.php';
?>

<div class="panel panel-default">
    <div class="panel-heading">
        Employés
        <a href='form_principale.php?page=administration&source=employes' type='button' class='close'
           data-dismiss='alert' aria-label='Close' style='position: inherit'>
            <span aria-hidden='true'>&times;</span>
        </a>
    </div>
    <div class="panel-body">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th class="entete" style="text-align: center">Matricule</th>
                <th class="entete" style="text-align: center">Nom et Prenoms</th>
                <th class="entete" style="text-align: center">Fonction</th>
                <th class="entete" style="text-align: center">Departement</th>
                <th class="entete" style="text-align: center">Email</th>
                <th class="entete" style="text-align: center">Contact</th>
                <th class="entete" style="text-align: center; width: 13%">Actions</th>
            </tr>
            </thead>
            <?php
            $req = "SELECT * FROM employes ORDER BY code_emp ASC ";
            if ($resultat = $connexion->query($req)) {
                $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                foreach ($ligne as $list) {
                    ?>
                    <tr>
                        <td><?php echo stripslashes($list['code_emp']); ?></td>
                        <td><?php echo stripslashes($list['titre_emp']) . " " . stripslashes($list['nom_emp']) . " " . stripslashes($list['prenoms_emp']); ?></td>
                        <td><?php echo stripslashes($list['fonction_emp']); ?></td>
                        <td><?php echo ucfirst(stripslashes($list['departement_emp'])); ?></td>
                        <td><?php echo stripslashes($list['email_emp']); ?></td>
                        <td><?php echo stripslashes($list['tel_emp']); ?></td>
                        <td>
                            <div style="text-align: center">
                                <a class="btn btn-default modifier" data-toggle="modal"
                                   data-target="#modalModifier<?php echo stripslashes($list['code_emp']); ?>">
                                    <img height="20" width="20" src="img/icons8/ball_point_pen.png"
                                         title="Modifier"/>
                                </a>
                                <a class="btn btn-default modifier" data-toggle="modal"
                                   data-target="#modalSupprimer<?php echo stripslashes($list['code_emp']); ?>">
                                    <img height="20" width="20" src="img/icons8/cancel.png" title="Supprimer"/>
                                </a>
                            </div>

                            <!-- Modal Mise � jour des infos -->
                            <div class="modal fade"
                                 id="modalModifier<?php echo stripslashes($list['code_emp']); ?>"
                                 tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"
                                                id="modalModifier<?php echo stripslashes($list['code_emp']); ?>">
                                                Modifications</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <div class="ligne">
                                                    <div class="cellule">Titre :</div>
                                                    <div class="cellule titre">
                                                        <label>
                                                            <input type="text" class="form-control" readonly
                                                                   id="titre_emp<?php echo $list['code_emp']; ?>"
                                                                   value="<?php echo $list['titre_emp']; ?>">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ligne">
                                                    <div class="cellule">Nom :</div>
                                                    <div class="cellule titre">
                                                        <label>
                                                            <input type="text" class="form-control"
                                                                   onblur="this.value = this.value.toUpperCase();"
                                                                   id="nom_emp<?php echo $list['code_emp']; ?>"
                                                                   value="<?php echo $list['nom_emp']; ?>">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ligne">
                                                    <div class="cellule">Prenoms :</div>
                                                    <div class="cellule titre">
                                                        <label>
                                                            <input type="text" class="form-control" size="30"
                                                                   onblur="this.value = this.value.toUpperCase();"
                                                                   id="pren_emp<?php echo $list['code_emp']; ?>"
                                                                   value="<?php echo $list['prenoms_emp']; ?>">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ligne">
                                                    <div class="cellule">Fonction :</div>
                                                    <div class="cellule titre">
                                                        <label>
                                                            <label>
                                                                <input type="text" class="form-control" size="25"
                                                                       onblur="this.value = this.value.toUpperCase();"
                                                                       id="fct_emp<?php echo $list['code_emp']; ?>"
                                                                       value="<?php echo $list['fonction_emp']; ?>">
                                                            </label>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ligne">
                                                    <div class="cellule">Departement :</div>
                                                    <div class="cellule titre">
                                                        <label>
                                                            <input type="text" class="form-control" size="30"
                                                                   id="dpt_emp<?php echo $list['code_emp']; ?>"
                                                                   value="<?php echo $list['departement_emp']; ?>">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ligne">
                                                    <div class="cellule">E-mail :</div>
                                                    <div class="cellule titre">
                                                        <label>
                                                            <input type="email" class="form-control" size="25"
                                                                   id="email_emp<?php echo $list['code_emp']; ?>"
                                                                   value="<?php echo $list['email_emp']; ?>">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ligne">
                                                    <div class="cellule">Contact :</div>
                                                    <div class="cellule titre">
                                                        <label>
                                                            <input type="tel" class="form-control"
                                                                   id="tel_emp<?php echo $list['code_emp']; ?>"
                                                                   value="<?php echo $list['tel_emp']; ?>">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            <button class="btn btn-primary" data-dismiss="modal"
                                                    onclick="majInfos('<?php echo $list['code_emp']; ?>')">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal suppression des infos -->
                            <div class="modal fade"
                                 id="modalSupprimer<?php echo stripslashes($list['code_emp']); ?>"
                                 tabindex="-1"
                                 role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span
                                                    aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title"
                                                id="modalSupprimer<?php echo stripslashes($list['code_emp']); ?>">
                                                Confirmation</h4>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous supprimer
                                            l'employe <?php echo stripslashes($list['code_emp']); ?> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">Non
                                            </button>
                                            <button class="btn btn-primary" data-dismiss="modal"
                                                    onclick="suppressionInfos('<?php echo stripslashes($list['code_emp']); ?>')">
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

<script>
    var articles = ["a", "b"],
        dpt = $('input[id*="dpt_emp"]');

    console.log(articles);

    $(document).ready(function() {
        dpt.autocomplete({
            source: ["FINANCE-COMPTABILITE", "INFORMATIQUE"]
        });

        $.ajax({
            url: "articles/libelles_articles.php",
            dataType: "json",
            type: "GET",
            success: function(data) {
                for (var i = 0; i < data.length; i += 1) {
                    articles[i] = data[i].designation_art;
                }
                console.log(articles);
                elt.autocomplete({
                    source: articles
                });
            }
        })
    });

    /*$('#autocomplete').autocomplete({
        source: articles,
        minLength: 1
    });*/

    function smt() {

        /*$.ajax({
            url: "articles/libelles_articles.php",
            dataType: "json",
            type: "GET",
            success: function(data) {
                for (var i = 0; i < data.length; i += 1) {
                    articles[i] = data[i].designation_art;
                }
            }
        });*/
    }

</script>