<?php //if ($_SESSION['type_utilisateur'] == 'administrateur' || $_SESSION['type_utilisateur'] == 'directeur') : ?>
    <!--suppress ALL -->
    <script>
        $(document).ready(function() {
            $(".my-slider").slick({
                autoplay: true,
                autoplaySpeed: 1500,
                vertical: true,
                arrows: false
            });
        })
    </script>
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
                                        $sql = "SELECT COUNT(*) FROM demandes WHERE statut = 'non satisfaite'";
                                        $nbr = 0;
                                        if ($resultat = $connexion->query($sql)) {
                                            $ligne = $resultat->fetch_all(MYSQL_NUM);
                                            foreach ($ligne as $list) {
                                                $nbr = $list[0];
                                            }
                                        }
                                        if ($nbr > 0) {
                                            ?>
                                            <div class="panel-heading">
                                                <span class="icons8-clipboard"
                                                      style="font-size: 14px"> Demandes en attente (<?php echo $nbr; ?>)</span>
                                            </div>
                                            <div class="panel-body">
                                                <div class="my-slider">
                                                    <?php
                                                        $sql = "SELECT * FROM demandes WHERE statut <> 'satisfaite'";
                                                        if ($resultat = $connexion->query($sql)) {
                                                            $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                            foreach ($ligne as $list) {
                                                                ?>
                                                                <div style="color: #01ADDD"><?php echo stripslashes($list['code_dbs']); ?></div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="panel-heading">
                                                <span class="icons8-clipboard"
                                                      style="font-size: 11px"> Demandes en attente</span>
                                            </div>
                                            <div class="panel-body">
                                                <p style="text-align: center; color: #01ADDD">Il n'y a en ce moment aucune demande en attente.</p>
                                            </div>
                                        <?php } ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="icons8-clipboard" style="font-size: 14px"> Rupture de Stock</span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="my-slider">
                                            <?php
                                                $sql = "SELECT * FROM articles WHERE niveau_reappro_art = 0";
                                                if ($resultat = $connexion->query($sql)) {
                                                    $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                    foreach ($ligne as $list) {
                                                        ?>
                                                        <div style="color: #01ADDD"><?php echo stripslashes($list['designation_art']); ?></div>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span class="icons8-clipboard" style="font-size: 14px"> Etat des stocks au <?php echo date('j/m/Y'); ?></span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="my-slider">
                                            <?php
                                                $sql = "SELECT * FROM articles";
                                                if ($resultat = $connexion->query($sql)) {
                                                    $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                    foreach ($ligne as $list) {
                                                        ?>
                                                        <div
                                                            style="color: #01ADDD"><?php echo stripslashes($list['designation_art']) . " (" . stripslashes($list['niveau_reappro_art']) . ")"; ?></div>
                                                        <?php
                                                    }
                                                }
                                            ?>
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