*<?php
    /*require_once '../../bd/connection.php';
    require_once '../../fonctions.php';*/
?>
<!--suppress ALL -->
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="img/icons_1775b9/box_filled.png" width="20" height="20">
            Formulaire Article
            <a href='form_principale.php?page=accueil' type='button' class='close' data-dismiss='alert'
               aria-label='Close' style='position: inherit'>
                <span aria-hidden='true'>&times;</span>
            </a>
        </div>
        <div class="panel-body">
            <form method="post" id="myform"
                  action="form_principale.php?page=articles/form_articles">
                <table class="formulaire"
                       style="margin-left: auto; margin-right: auto; border-spacing: 8px"
                       border="0">
                    <tr>
                        <td class="champlabel">*Désignation :</td>
                        <td colspan="2">
                            <label>
                                <input type="text" name="designation_art" id="designation_art" size="30"
                                       required
                                       class="form-control" onblur="this.value = this.value.toUpperCase();"/>
                            </label>
                        </td>
                        <td class="champlabel">*Stock Initial :</td>
                        <td>
                            <label>
                                <input type="number" name="stock_art" id="stock_art" size="3" min="0" required
                                       class="form-control"/>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="champlabel">*Groupe :</td>
                        <td colspan="2">
                            <label>
                                <select class="form-control" name="code_grp" id="code_grp" required>
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
                                <input type="number" name="niveau_cible_art" id="niveau_cible_art" size="3" min="0"
                                       value="0"
                                       class="form-control"/>
                            </label>
                        </td>
                        <td class="champlabel" title="Niveau de Réapprovisionnement">Niveau Réapp. :</td>
                        <td>
                            <label>
                                <input type="number" name="niveau_reappro_art" id="niveau_reappro_art" size="3"
                                       min="0" value="0"
                                       class="form-control"/>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="champlabel">Description :</td>
                        <td colspan="2">
                            <label>
                                        <textarea name="description_art" id="description_art" cols="30" rows="2"
                                                  style="resize: none" class="form-control"></textarea>
                            </label>
                        </td>
                    </tr>
                </table>
                <br/>

                <div style="text-align: center;">
                    <button class="btn btn-info" type="button" name="valider" style="width: 150px"
                            onclick="ajout()">
                        Valider
                    </button>
                </div>

                <div id="info"></div>
            </form>

            <div class="container">
                <table id="table"
                       data-toggle="table"
                       data-url="articles/infos_articles.php?opt=saisie"
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

<script>
    var articles = ["a", "b"];

    function libellesArticles() {
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
    }

    $(document).ready(libellesArticles());

    $('#designation_art').bind('blur', function () {
        if (articles.indexOf(this.value) > -1) {
            alert("Cet article existe déjà dans la base.");
            this.value = "";
        }
    });

    function validation() {
        var i = 0;
        $(':input[required]').each(function () {
            if (this.value == '')
                i++;
        });
        return i;
    }

    function ajout() {
        if (validation() != 0) {
            alert('Veuillez renseigner tous les champs précédés de * s\'il vous plaît.');
        }
        else {
            var code_grp = $('#code_grp').val();
            var designation_art = $('#designation_art').val();
            var description_art = $('#description_art').val();
            var niveau_cible_art = $('#niveau_cible_art').val();
            var niveau_reappro_art = $('#niveau_reappro_art').val();
            var stock_art = $('#stock_art').val();

            var infos = "code_grp=" + code_grp + "&designation_art=" + designation_art + "&description_art=" + description_art + "&niveau_cible_art=" + niveau_cible_art + "&niveau_reappro_art=" + niveau_reappro_art + "&stock_art=" + stock_art;
            var operation = "ajout";

            $.ajax({
                type: 'POST',
                url: 'articles/updatedata.php?operation=' + operation,
                data: infos,
                success: function (data) {
                    $('#info').html(data);
                    $('#myform').trigger('reset');
                    setTimeout(function () {
                        $(".alert-success").slideToggle("slow");
                    }, 2500);
                    libellesArticles();
                }
            });
        }
    }
</script>