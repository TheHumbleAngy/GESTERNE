<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 22/01/2016
     * Time: 11:21
     */
    if (isset($_GET['action']) && $_GET['action'] == "entree") : ?>
        <!--suppress ALL -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Mouvement de Stock
                        <a href='form_principale.php?page=accueil' type='button' class='close' data-dismiss='alert'
                           aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="jumbotron"
                             style="width: 70%; height: 120px;
                                    padding: 20px 30px 20px 30px;
                                    background-color: rgba(1, 139, 178, 0.1);
                                    margin-left: auto;
                                    margin-right: auto">
                            <h4 style="margin-top: 0">Saisie des Entrées</h4>

                            <div style="height: 70%; overflow: auto">
                                <p style="font-size: small">Pour saisir une entrée d'articles, veuillez entrer le nombre
                                    d'articles
                                    à saisir. Dans les differents champs "Désignation", sélectionnez un article à partir
                                    de
                                    la liste déroulante; vous avez entre parenthèses, le stock en temps réel de chaque
                                    article. En face se trouve le champ de saisie du nombre de chaque entrée d'articles
                                    et un
                                    autre
                                    (facultatif) pour mentionner un commentaire.</p>
                            </div>
                        </div>

                        <form method="post">
                            <table class="formulaire" border="0">
                                <tr>
                                    <td class="champlabel" style="vertical-align: bottom; padding-bottom: 5px">Nombre d'articles :</td>
                                    <td style="vertical-align: bottom">
                                        <label>
                                            <input type="number" min="1" class="form-control" id="nbr_articles"
                                                   name="nbr"
                                                   required/>
                                        </label>
                                    </td>
                                    <td>
                                        <table id="table"
                                               data-toggle="table"
                                               data-url="articles/infos_articles.php?opt=mvt"
                                               data-height="288"
                                               data-pagination="true"
                                               data-page-size="4"
                                               data-show-refresh="true"
                                               data-search="true">
                                            <thead>
                                            <tr>
                                                <th data-field="designation_art" data-sortable="true">Désignation</th>
                                                <th data-field="stock_art" data-sortable="true">Stock Actuel</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <div class="feedback"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            //Ce script permet d'afficher la liste des articles à saisir
            var articles = ["a", "b"],
                nbr_art = $('input[type=number]#nbr_articles');

            nbr_art.bind('keyup mouseup', function () {
                var n = $("#nbr_articles").val();
                $.ajax({
                    type: "POST",
                    url: "articles/entrees_stock.php",
                    data: {
                        nbr: n
                    },
                    success: function (resultat) {
                        if (n > 0) {
                            $('.feedback').html(resultat);
                        }
                    }
                });
            });

        </script>

        <?php
        if ((sizeof($_POST) > 0) && ((int)$_POST['nbr'] > 0)) {
            include 'class_articles.php';

            $entree = new entrees_articles();

            if ($entree->recuperation()) {
                if (!($entree->enregistrement())) {
                    echo "Une erreur s'est produite lors de la tentative d'enregistrement des informations";
                }
            } else {
                echo "Une erreur s'est produite lors de la tentative de récupération des informations entrées";
            }
        }
        ?>

    <?php else : ?>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Mouvement de Stock
                        <a href='form_principale.php?page=accueil' type='button' class='close' data-dismiss='alert'
                           aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="jumbotron"
                             style="width: 70%; height: 120px;
                                    padding: 20px 30px 20px 30px;
                                    background-color: rgba(1, 139, 178, 0.1);
                                    margin-left: auto;
                                    margin-right: auto">
                            <h4 style="margin-top: 0">Saisie des Sorties</h4>

                            <div style="height: 70%; overflow: auto">
                                <p style="font-size: small">Pour saisir une sortie d'articles, veuillez entrer le nombre
                                    d'articles à saisir. Dans les differents champs "Désignation", sélectionnez un article à partir de
                                    la liste déroulante; vous avez entre parenthèses, le stock en temps réel de chaque article. En face se trouve le champ de saisie du nombre de chaque entrée d'articles et un
                                    autre
                                    (facultatif) pour mentionner un commentaire.</p>
                                <p style="font-size: small">*Notez que les articles en rupture de stock ne sont pas disponibles dans la liste déroulante.</p>
                            </div>
                        </div>

                        <form method="post">
                            <table class="formulaire" border="0">
                                <tr>
                                    <td class="champlabel" style="vertical-align: bottom; padding-bottom: 5px">Nombre d'articles :</td>
                                    <td style="vertical-align: bottom">
                                        <label>
                                            <input type="number" min="1" class="form-control" id="nbr_articles"
                                                   name="nbr"
                                                   required/>
                                        </label>
                                    </td>
                                    <td>
                                        <table id="table"
                                               data-toggle="table"
                                               data-url="articles/infos_articles.php?opt=mvt"
                                               data-height="288"
                                               data-pagination="true"
                                               data-page-size="4"
                                               data-show-refresh="true"
                                               data-search="true">
                                            <thead>
                                            <tr>
                                                <th data-field="designation_art" data-sortable="true">Désignation</th>
                                                <th data-field="stock_art" data-sortable="true">Stock Actuel</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <div class="feedback"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            //Ce script permet d'afficher la liste des articles à saisir
            var articles = ["a", "b"],
                nbr_art = $('input[type=number]#nbr_articles');

            nbr_art.bind('keyup mouseup', function () {
                var n = $("#nbr_articles").val();
                $.ajax({
                    type: "POST",
                    url: "articles/sorties_stock.php",
                    data: {
                        nbr: n
                    },
                    success: function (resultat) {
                        if (n > 0) {
                            $('.feedback').html(resultat);
                        }
                    }
                });
            });

            //Ce script permet de générer la liste sélectionnable des articles dans les différents textbox
            /*nbr_art.bind('blur', function () {
                $.ajax({
                    url: "articles/libelles_articles.php",
                    dataType: "json",
                    type: "GET",
                    success: function (data) {
                        for (var i = 0; i < data.length; i += 1) {
                            articles[i] = data[i].designation_art;
                        }
//                console.log(articles);
                        $('input[name*="libelle"]').autocomplete({
                            source: articles
                        });
                    }
                })
            });*/
        </script>

        <?php
        if ((sizeof($_POST) > 0) && ((int)$_POST['nbr'] > 0)) {
            include 'class_articles.php';

            $sortie = new sorties_articles();

            if ($sortie->recuperation()) {
                if (!($sortie->enregistrement())) {
                    echo "Une erreur s'est produite lors de la tentative d'enregistrement des informations";
                }
            } else {
                echo "Une erreur s'est produite lors de la tentative de r�cup�ration des informations entr�es";
            }
        }
        ?>
    <?php endif; ?>
