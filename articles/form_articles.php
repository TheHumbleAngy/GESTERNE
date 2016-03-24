<?php
    /*require_once '../../bd/connection.php';
    require_once '../../fonctions.php';*/
?>
    <!--suppress ALL -->
    <script>
        $.ajax({
            type: "POST",
            url: "articles/ajax_num_article.php",
            success: function (resultat) {
                $('#code_art').val(resultat);
            }
        });
    </script>

    <div class="row">
        <div id="info"></div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                    Ajouter un Article
                    <a href='form_principale.php?page=accueil' type='button' class='close' data-dismiss='alert'
                       aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <form method="post" action="form_principale.php?page=articles/form_articles">
                        <table class="formulaire"
                               style="margin-left: auto; margin-right: auto; border-spacing: 8px"
                               border="0">
                            <tr>
                                <td class="champlabel">Référence :</td>
                                <td>
                                    <label>
                                        <input type="text" name="code_art" id="code_art" size="10" readonly required
                                               class="form-control"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">*Désignation :</td>
                                <td>
                                    <label>
                                        <input type="text" name="designation_art" id="designation_art" size="30"
                                               required
                                               class="form-control" onblur="this.value = this.value.toUpperCase();"/>
                                    </label>
                                </td>
                                <td class="champlabel">*Stock Initial :</td>
                                <td>
                                    <label>
                                        <input type="number" name="stock_art" size="3" min="0" required
                                               class="form-control"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">*Groupe :</td>
                                <td>
                                    <label>
                                        <select class="form-control" name="code_grp" required>
                                            <option disabled selected></option>
                                            <?php
                                                $sql = "SELECT code_grp, designation_grp FROM groupe_articles ORDER BY designation_grp ASC ";
                                                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                                while ($data = mysqli_fetch_array($res)) {
                                                    echo '<option value="' . $data['code_grp'] . '" >' . $data['designation_grp'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                                <td class="champlabel">Niveau Ciblé :</td>
                                <td>
                                    <label>
                                        <input type="number" name="niveau_cible_art" size="3" min="0" value="0"
                                               class="form-control"/>
                                    </label>
                                </td>
                                <td class="champlabel" title="Niveau de Réapprovisionnement">Niveau Réapp. :</td>
                                <td>
                                    <label>
                                        <input type="number" name="niveau_reappro_art" size="3" min="0" value="0"
                                               class="form-control"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Description :</td>
                                <td colspan="3">
                                    <label>
                                        <textarea name="description_art" cols="30" rows="2"
                                                  style="resize: none" class="form-control"></textarea>
                                    </label>
                                </td>
                            </tr>
                        </table>
                        <br/>

                        <div style="text-align: center;">
                            <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                                Valider
                            </button>
                        </div>
                    </form>

                    <div class="container">
                        <table id="table"
                               data-toggle="table"
                               data-url="articles/infos_articles.php"
                               data-height="288"
                               data-pagination="true"
                               data-page-size="4"
                               data-show-pagination-switch="true"
                               data-show-refresh="true"
                               data-search="true">
                            <thead>
                            <tr>
                                <th data-field="code_art" data-sortable="true">Numéro</th>
                                <th data-field="designation_art" data-sortable="true">Désignation</th>
                                <th data-field="description_art">Description</th>
                                <th data-field="stock_art" data-sortable="true">Stock Actuel</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var articles = ["a", "b"];

        $(document).ready(function () {
            $.ajax({
                url: "articles/libelles_articles.php",
                dataType: "json",
                type: "GET",
                success: function (data) {
                    for (var i = 0; i < data.length; i += 1) {
                        articles[i] = data[i].designation_art;
                    }
                }
            })
        });

        $('#designation_art').bind('blur', function () {
            if (articles.indexOf(this.value) > -1) {
                alert("Cet article existe déjà dans la base.");
                this.value = "";
            }
        });
    </script>

<?php
    if (isset($_POST['code_art']) && isset($_POST['designation_art']) && $_POST['designation_art'] != "") {
        include 'class_articles.php';

        $article = new articles();

        if ($article->recuperation()) {
//            $article->enregistrement();
            if (!($article->enregistrement())) {
                echo "
            <div style='width: 480px; margin-right: auto; margin-left: auto'>
                <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <a href='form_principale.php?page=articles/form_articles' type='button' class='close'
                           data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                    </a>
                    Une erreur s'est produite lors de la tentative d'enregistrement des informations. Veuillez contacter
                    l'administrateur.
                </div>
            </div>
            ";
            }
        } else {
            echo "
            <div style='width: 480px; margin-right: auto; margin-left: auto'>
                <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <a href='form_principale.php?page=articles/form_articles' type='button' class='close'
                           data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                    </a>
                    Une erreur s'est produite lors de la tentative de récupération des informations entrées.
                </div>
            </div>
            ";
        }
    }
?>