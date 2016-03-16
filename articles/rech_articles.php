<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 26/11/2015
     * Time: 18:24
     */

    if (isset($_POST['opt'])) {
        $option = $_POST['opt'];
        $element = $_POST['element'];

        switch ($option) {
            case 'numero':
                $sql = "SELECT * FROM articles WHERE code_art LIKE '%" . $element . "%'";
                break;
            case 'designation':
                $sql = "SELECT * FROM articles WHERE designation_art LIKE '%" . $element . "%'";
                break;
            case 'description':
                $sql = "SELECT * FROM articles WHERE description_art LIKE '%" . $element . "%'";
                break;
            case 'stock':
                $sql = "SELECT * FROM articles WHERE stock_art = $element";
                break;
            case 'groupe':
                $sql = "SELECT code_grp FROM groupe_articles WHERE designation_grp LIKE '%" . $element . "%'";
                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                $grp = "";
                while ($data = mysqli_fetch_array($res)) {
                    $grp = $data['code_grp'];
                }
                $sql = "SELECT * FROM articles WHERE code_grp = '" . $grp . "'";
                break;
        }

        $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

        if ($res->num_rows > 0) { ?>
            <!--suppress ALL -->
            <div id="info"></div>
            <div id="feedback">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                                Articles
                                <a href='form_principale.php?page=form_actions&source=articles&action=rechercher'
                                   type='button' class='close' data-dismiss='alert' aria-label='Close'
                                   style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                                </a>
                            </div>
                            <div class="panel-body" style="overflow: auto">
                                <table border="0" class="table table-hover table-bordered ">
                                    <thead>
                                    <tr>
                                        <th class="entete" style="text-align: center">Numéro</th>
                                        <th class="entete" style="text-align: center">Désignation</th>
                                        <th class="entete" style="text-align: center">Groupe</th>
                                        <th class="entete" style="text-align: center">Description</th>
                                        <th class="entete" style="text-align: center">Détails</th>
                                        <!--                        <td class="entete" style="text-align: center">Categorie</td>-->
                                        <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')): ?>
                                        <th class="entete" style="text-align: center">Actions</th>
                                        <?php //endif ?>
                                    </tr>
                                    </thead>
                                    <?php while ($data = mysqli_fetch_array($res)) { ?>
                                        <tr>
                                            <td><?php echo stripslashes($data['code_art']); ?></td>
                                            <td><?php echo ucfirst(stripslashes($data['designation_art'])); ?></td>
                                            <td>
                                                <?php
                                                    $code = $data['code_grp'];
                                                    $desig = "";
                                                    $req = "SELECT designation_grp FROM groupe_articles WHERE code_grp = '" . $code . "'";
                                                    $result = mysqli_query($connexion, $req);
                                                    while ($info = mysqli_fetch_array($result)) {
                                                        echo $desig = $info['designation_grp'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo stripslashes($data['description_art']); ?></td>
                                            <td><?php echo "Stock Actuel : " . stripslashes($data['stock_art']) . "<br>Niveau Réappro. : " . stripslashes($data['niveau_reappro_art']) . "<br>Niveau Ciblé : " . stripslashes($data['niveau_cible_art']); ?></td>
                                            <td>
                                                <div style="text-align: center">
                                                    <a class="btn btn-default modifier" data-toggle="modal"
                                                       data-target="#modalModifier<?php echo stripslashes($data['code_art']); ?>">
                                                        <img height="20" width="20" src="img/icons8/ball_point_pen.png"
                                                             title="Modifier"/>
                                                    </a>
                                                    <a class="btn btn-default modifier" data-toggle="modal"
                                                       data-target="#modalSupprimer<?php echo stripslashes($data['code_art']); ?>">
                                                        <img height="20" width="20" src="img/icons8/cancel.png"
                                                             title="Supprimer"/>
                                                    </a>
                                                </div>

                                                <!-- Modal Mise à jour des infos -->
                                                <div class="modal fade"
                                                     id="modalModifier<?php echo stripslashes($data['code_art']); ?>"
                                                     tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title"
                                                                    id="modalModifier<?php echo stripslashes($data['code_art']); ?>">
                                                                    <?php echo stripslashes($data['code_art']); ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <table border="0" class="formulaire"
                                                                           style="text-align: left; width: 100%; margin-left: auto; margin-right: auto">
                                                                        <tr>
                                                                            <td class="champlabel">*Désignation:</td>
                                                                            <td>
                                                                                <label>
                                                                                    <input type="text" size="30"
                                                                                           required
                                                                                           id="designation_art<?php echo $data['code_art']; ?>"
                                                                                           value="<?php echo $data['designation_art']; ?>"
                                                                                           onblur="this.value = this.value.toUpperCase();"
                                                                                           class="form-control"/>
                                                                                </label>
                                                                            </td>
                                                                            <td class="champlabel">Stock :</td>
                                                                            <td>
                                                                                <label>
                                                                                    <input type="number" size="2"
                                                                                           id="stock_art<?php echo $data['code_art']; ?>"
                                                                                           value="<?php echo $data['stock_art']; ?>"
                                                                                           class="form-control"/>
                                                                                </label>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="champlabel">*Groupe :</td>
                                                                            <td>
                                                                                <label>
                                                                                    <select class="form-control"
                                                                                            id="code_grp<?php echo $data['code_art']; ?>"
                                                                                            name="code_grp" required>
                                                                                        <option disabled
                                                                                                selected></option>
                                                                                        <?php
                                                                                            $str = "SELECT code_grp, designation_grp FROM groupe_articles ORDER BY designation_grp ASC ";
                                                                                            $resultat = mysqli_query($connexion, $str) or exit(mysqli_error($connexion));
                                                                                            while ($infos = mysqli_fetch_array($resultat)) {
                                                                                                if ($data['code_grp'] == $infos['code_grp']) {
                                                                                                    echo '<option value="' . $infos['code_grp'] . '" selected >' . $infos['designation_grp'] . '</option>';
                                                                                                } else {
                                                                                                    echo '<option value="' . $infos['code_grp'] . '" >' . $infos['designation_grp'] . '</option>';
                                                                                                }
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                                                                </label>
                                                                            </td>
                                                                            <td class="champlabel">Niveau Ciblé:</td>
                                                                            <td>
                                                                                <label>
                                                                                    <input type="number" size="3"
                                                                                           min="0"
                                                                                           id="niveau_cible_art<?php echo $data['code_art']; ?>"
                                                                                           value="<?php echo $data['niveau_cible_art']; ?>"
                                                                                           class="form-control"/>
                                                                                </label>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="champlabel">Description:</td>
                                                                            <td rowspan="1">
                                                                                <label>
                                                                            <textarea cols="30" rows="5"
                                                                                      id="description_art<?php echo $data['code_art']; ?>"
                                                                                      required style="resize: none"
                                                                                      class="form-control"><?php echo $data['description_art']; ?></textarea>
                                                                                </label>
                                                                            </td>
                                                                            <td class="champlabel">Niveau Réapp. :</td>
                                                                            <td>
                                                                                <label>
                                                                                    <input type="number" size="3"
                                                                                           min="0"
                                                                                           id="niveau_reappro_art<?php echo $data['code_art']; ?>"
                                                                                           name="niveau_reappro_art"
                                                                                           value="<?php echo $data['niveau_reappro_art']; ?>"
                                                                                           class="form-control"/>
                                                                                </label>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-default" data-dismiss="modal">
                                                                    Fermer
                                                                </button>
                                                                <button class="btn btn-primary" data-dismiss="modal"
                                                                        onclick="majInfos('<?php echo $data['code_art']; ?>')">
                                                                    Enregistrer
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal suppression des infos -->
                                                <div class="modal fade"
                                                     id="modalSupprimer<?php echo stripslashes($data['code_art']); ?>"
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
                                                                    id="modalSupprimer<?php echo stripslashes($data['code_art']); ?>">
                                                                    Confirmation</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                Voulez-vous supprimer
                                                                l'article <?php echo stripslashes($data['code_art']); ?>
                                                                ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-default" data-dismiss="modal">Non
                                                                </button>
                                                                <button class="btn btn-primary" data-dismiss="modal"
                                                                        onclick="suppressionInfos('<?php echo stripslashes($data['code_art']); ?>')">
                                                                    Oui
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
            header("refresh: 3;url=form_principale.php?page=form_actions&source=articles&action=rechercher");
            echo "
            <div class='alert alert-info alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                La recherche n'a renvoyé aucun résultat.
            </div>
            ";
        }
    }
?>

<script>

    function majInfos(code) {
        var id = code;
        var nature_art = $('#nature_art' + code).val();
        var designation_art = $('#designation_art' + code).val();
        var description_art = $('#description_art' + code).val();
        var niveau_reappro_art = $('#niveau_reappro_art' + code).val();
        var niveau_cible_art = $('#niveau_cible_art' + code).val();

        var infos = "nature_art=" + nature_art + "&designation_art=" + designation_art + "&description_art=" + description_art + "&niveau_reappro_art=" + niveau_reappro_art + "&niveau_cible_art=" + niveau_cible_art;

        $.ajax({
            type: 'POST',
            url: 'articles/updatedata.php?id=' + id,
            data: infos,
            success: function (data) {
                $('#info').html(data);
                afficherInfos();
                $("div.modal-backdrop.fade.in").remove();
                setTimeout(function () {
                    $(".alert-success").slideToggle("slow");
                }, 2500);
            }
        });
    }

    function suppressionInfos(code) {
        $.ajax({
            type: 'POST',
            url: 'articles/deletedata.php',
            data: {
                id: code
            },
            success: function (data) {
                $('#info').html(data);
                afficherInfos();
                $("div.modal-backdrop.fade.in").remove();
                setTimeout(function () {
                    $(".alert-success").slideToggle("slow");
                }, 2500);
            }
        });
    }
</script>
