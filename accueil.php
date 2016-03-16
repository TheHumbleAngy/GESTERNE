<?php //if ($_SESSION['type_utilisateur'] == 'administrateur' || $_SESSION['type_utilisateur'] == 'directeur') : ?>
    <!--suppress ALL -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="icons8-clipboard" style="font-size: 16px"> Tableau de Bord</span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <?php
                                    $sql = "SELECT COUNT(*) FROM demandes WHERE statut = ''";
                                    $nbr = 0;
                                    if ($resultat = $connexion->query($sql)) {
                                        $ligne = $resultat->fetch_all(MYSQL_NUM);
                                        foreach ($ligne as $list) {
                                            $nbr = $list[0];
                                        }
                                    }
                                    ?>
                                    <div class="panel-heading">
                                        <span class="icons8-clipboard"
                                              style="font-size: 11px"> Demandes en attente (<?php echo $nbr; ?>)</span>
                                    </div>
                                    <div class="panel-body">
                                        <div id="carousel-demandes" class="carousel slide" data-ride="carousel"
                                             data-interval="2000">
                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                <div class="item active">
                                                    <?php
                                                    $sql = "SELECT * FROM demandes WHERE statut = '' ORDER BY code_dbs DESC LIMIT 1";
                                                    if ($resultat = $connexion->query($sql)) {
                                                        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                        foreach ($ligne as $list) {

                                                        }
                                                    }
                                                    ?>
                                                    <img src="img/btn-icons.png" alt="">

                                                    <div class="carousel-caption"
                                                         style="color: #01ccff; padding-bottom: 0; bottom: 0; padding-top: 0; margin-bottom: 12px">
                                                        Demandes
                                                    </div>
                                                </div>
                                                <?php
                                                $sql = "SELECT * FROM demandes WHERE statut = ''";
                                                if ($resultat = $connexion->query($sql)) {
                                                    $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                    foreach ($ligne as $list) {
                                                        ?>
                                                        <div class="item">
                                                            <img src="img/btn-icons.png">

                                                            <div class="carousel-caption"
                                                                 style="padding-bottom: 0; bottom: 0; padding-top: 0; margin-bottom: 12px">
                                                                <?php /*echo stripslashes($list['code_dbs']);*/ ?>
                                                                <a href="form_principale.php?page=demandes/form_demandes&action=consultation&id=<?php echo stripslashes($list['code_dbs']); ?>">
                                                                    <?php echo stripslashes($list['code_dbs']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#carousel-demandes"
                                               role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"
                                                      aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-demandes"
                                               role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"
                                                      aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="icons8-clipboard"
                                              style="font-size: 11px"> Articles en Rupture de stock</span>
                                    </div>
                                    <div class="panel-body">
                                        <div id="carousel-articles-rupture" class="carousel slide"
                                             data-ride="carousel">

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                <div class="item active">
                                                    <img src="img/btn-icons.png" alt="">
                                                    <div class="carousel-caption" style="color: #01ccff; padding-bottom: 0; bottom: 0; padding-top: 0; margin-bottom: 12px">
                                                        Rupture de Stock
                                                    </div>
                                                </div>
                                                <?php
                                                $sql = "SELECT * FROM articles WHERE niveau_reappro_art = 0";
                                                if ($resultat = $connexion->query($sql)) {
                                                    $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                    foreach ($ligne as $list) {
                                                        ?>
                                                        <div class="item">
                                                            <img src="img/btn-icons.png" alt="">

                                                            <div class="carousel-caption" style="color: #01ccff; padding-bottom: 0; bottom: 0; padding-top: 0; margin-bottom: 12px">
                                                                <?php echo stripslashes($list['designation_art']); ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </div>

                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#carousel-articles-rupture"
                                               role="button" data-slide="prev">
                                                        <span class="glyphicon glyphicon-chevron-left"
                                                              aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-articles-rupture"
                                               role="button" data-slide="next">
                                                        <span class="glyphicon glyphicon-chevron-right"
                                                              aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="icons8-clipboard"
                                              style="font-size: 11px"> Etat des stocks au <?php echo date('j/m/Y'); ?></span>
                                    </div>
                                    <div class="panel-body">

                                        <div id="carousel-articles" class="carousel slide"
                                             data-ride="carousel">

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                <div class="item active">
                                                    <img src="img/btn-icons.png" alt="">

                                                    <div class="carousel-caption"
                                                         style="color: #01ccff; padding-bottom: 0; bottom: 0; padding-top: 0; margin-bottom: 12px">
                                                        Articles Dispo.
                                                    </div>
                                                </div>
                                                <?php
                                                $sql = "SELECT * FROM articles";
                                                if ($resultat = $connexion->query($sql)) {
                                                    $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                    foreach ($ligne as $list) {
                                                        ?>
                                                        <div class="item">
                                                            <img src="img/btn-icons.png" alt="">

                                                            <div class="carousel-caption"
                                                                 style="color: #01ccff; padding-bottom: 0; bottom: 0; padding-top: 0; margin-bottom: 12px">
                                                                <?php echo stripslashes($list['designation_art']) . " (" . stripslashes($list['niveau_reappro_art']) . ")"; ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </div>

                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#carousel-articles"
                                               role="button" data-slide="prev">
                                                        <span class="glyphicon glyphicon-chevron-left"
                                                              aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-articles"
                                               role="button" data-slide="next">
                                                        <span class="glyphicon glyphicon-chevron-right"
                                                              aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="icons8-clipboard" style="font-size: 16px"> Saisies Rapides</span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3" style="margin-left: 12%">
                                                <a class="a-minimenu"
                                                   href="form_principale.php?page=demandes/form_demandes">
                                                    <div class="btn-minimenu btn-accueil">
                                                        <img src="img/Icons8/demande-100.png" width="40" height="40">
                                                        Demande
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a class="a-minimenu"
                                                   href="form_principale.php?page=proformas/form_proformas">
                                                    <div class="btn-minimenu btn-accueil">
                                                        <img src="img/Icons8/facture-100.png" width="40" height="40">
                                                        Proforma
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a class="a-minimenu"
                                                   href="form_principale.php?page=factures/form_factures">
                                                    <div class="btn-minimenu btn-accueil">
                                                        <img src="img/Icons8/facture-100.png" width="40" height="40">
                                                        Facture
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="icons8-list" style="font-size: 16px"> Listes</span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-8" style="width: 100%">
                                                <a class="a-minimenu"
                                                   href="form_principale.php?page=demandes/liste_demandes">
                                                    <div class="btn-minimenu">Demandes</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px">
                                            <div class="row">
                                                <div class="col-md-8" style="width: 100%">
                                                    <a class="a-minimenu"
                                                       href="form_principale.php?page=fournisseurs/liste_fournisseurs">
                                                        <div class="btn-minimenu">Fournisseurs</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px">
                                            <div class="row">
                                                <div class="col-md-8" style="width: 100%">
                                                    <a class="a-minimenu"
                                                       href="form_principale.php?page=articles/liste_articles">
                                                        <div class="btn-minimenu">Articles</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px">
                                            <div class="row">
                                                <div class="col-md-8" style="width: 100%">
                                                    <a class="a-minimenu"
                                                       href="form_principale.php?page=employes/liste_employes">
                                                        <div class="btn-minimenu">Employés</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px">
                                            <div class="row">
                                                <div class="col-md-8" style="width: 100%">
                                                    <a class="a-minimenu"
                                                       href="form_principale.php?page=proformas/liste_proformas">
                                                        <div class="btn-minimenu">Proformas</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php //elseif ($_SESSION['type_utilisateur'] == 'moyens_genereaux') : ?>

<?php //elseif ($_SESSION['type_utilisateur'] == 'normal') : ?>

<?php //endif ?>