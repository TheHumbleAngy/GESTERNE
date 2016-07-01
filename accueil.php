<?php //if ($_SESSION['type_utilisateur'] == 'administrateur' || $_SESSION['type_utilisateur'] == 'directeur') : ?>
<!--suppress ALL -->
<script>
    $(document).ready(function () {
        $(".slider-attente").slick({
            autoplay: true,
            autoplaySpeed: 1500,
            vertical: false,
            arrows: false,
        });

        $(".slider-partielle").slick({
            autoplay: true,
            autoplaySpeed: 1500,
            vertical: false,
            arrows: false,
        });

        $(".slider-rupture").slick({
            autoplay: true,
            autoplaySpeed: 1500,
            vertical: true,
            arrows: false,
            slidesToShow: 3
        });

        $(".slider-stock").slick({
            autoplay: true,
            autoplaySpeed: 1500,
            vertical: true,
            arrows: false,
            slidesToShow: 3
        });

        $(".slider-mouvement").slick({
            autoplay: true,
            autoplaySpeed: 1500,
            vertical: true,
            arrows: false,
            slidesToShow: 2
        });
    })
</script>
<div class="container-fluid">
    <div class="row" style="color: #29487d">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="img/icons_1775b9/administrative_tools.png" width="20"> Tableau de Bord
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img src="img/icons_1775b9/box.png" width="20"> Etat des stocks
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>
                                                <h5>A la date du <?php echo date('j/m/Y'); ?>:</h5>
                                            </strong>

                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="slider-stock">
                                                        <?php
                                                            $sql = "SELECT * FROM articles";
                                                            if ($resultat = $connexion->query($sql)) {
                                                                $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                                foreach ($ligne as $list) {
                                                                    ?>
                                                                    <div><?php echo stripslashes($list['designation_art']) . " (<strong>" . stripslashes($list['stock_art']) . "</strong>)"; ?></div>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>
                                                <h5>Seuil minimum:</h5>
                                            </strong>

                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="slider-stock">
                                                        <?php
                                                            $sql = "SELECT * FROM articles WHERE stock_art = niveau_reappro_art OR stock_art < niveau_reappro_art";
                                                            if ($resultat = $connexion->query($sql)) {
                                                                $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                                foreach ($ligne as $list) {
                                                                    ?>
                                                                    <div
                                                                        ><?php echo stripslashes($list['designation_art']) . " (<strong>" . stripslashes($list['stock_art']) . "</strong>)"; ?></div>
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
                                        <div class="col-md-12">
                                            <strong>
                                                <h5>Rupture de stock:</h5>
                                            </strong>

                                            <div class="col-md-9">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="slider-rupture">
                                                            <?php
                                                                $sql = "SELECT * FROM articles WHERE stock_art = 0";
                                                                if ($resultat = $connexion->query($sql)) {
                                                                    $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                                    foreach ($ligne as $list) {
                                                                        ?>
                                                                        <div><?php echo stripslashes($list['designation_art']); ?></div>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <img src="img/icons_1775b9/agreement_1.png" width="20"> Demandes
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
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
                                                        <strong>
                                                            <h5>En Attente (<?php echo $nbr; ?>):</h5>
                                                        </strong>
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="slider-attente">
                                                                    <?php
                                                                        $sql = "SELECT * FROM demandes WHERE statut = 'non satisfaite'";
                                                                        if ($resultat = $connexion->query($sql)) {
                                                                            $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                                            foreach ($ligne as $list) {
                                                                                ?>
                                                                                <div
                                                                                    ><?php echo stripslashes($list['code_dbs']); ?></div>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } else { ?>
                                                        <strong>
                                                            <h5>En Attente:</h5>
                                                        </strong>
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <p style="text-align: center; ">Il n'y a en ce moment
                                                                    aucune
                                                                    demande en attente.</p>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                    $sql = "SELECT COUNT(*) FROM demandes WHERE statut = 'partielle'";
                                                    $nbr = 0;
                                                    if ($resultat = $connexion->query($sql)) {
                                                        $ligne = $resultat->fetch_all(MYSQL_NUM);
                                                        foreach ($ligne as $list) {
                                                            $nbr = $list[0];
                                                        }
                                                    }
                                                    if ($nbr > 0) {
                                                        ?>
                                                        <strong>
                                                            <h5>Partielles (<?php echo $nbr; ?>):</h5>
                                                        </strong>
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="slider-partielle">
                                                                    <?php
                                                                        $sql = "SELECT * FROM demandes WHERE statut = 'partielle'";
                                                                        if ($resultat = $connexion->query($sql)) {
                                                                            $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                                            foreach ($ligne as $list) {
                                                                                ?>
                                                                                <div><?php echo stripslashes($list['code_dbs']); ?></div>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } else { ?>
                                                        <strong>
                                                            <h5>Partielles:</h5>
                                                        </strong>
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <p style="text-align: center; ">Il n'y a en ce moment
                                                                    aucune
                                                                    demande partielle.</p>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img src="img/icons_1775b9/box_filled_2.png" width="20"> Mouvements de Stock
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- TODO: interroger la BD sur la dernière entrée d'articles -->
                                            <?php
                                                $sql = "SELECT MAX(date_entr) FROM entrees_stock";
                                                if ($resultat = $connexion->query($sql)) {
                                                    $ligne = $resultat->fetch_all(MYSQL_NUM);
                                                    foreach ($ligne as $list) {
                                                        $dat = $list[0];
                                                    }
                                                }
                                                $date_entr = date('j/m/Y', strtotime($dat));
                                            ?>
                                            <strong>
                                                <h5>Entrées au <?php echo $date_entr; ?>:</h5>
                                            </strong>

                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="slider-mouvement">
                                                        <?php
                                                            $sql = "SELECT A.designation_art, D.qte_dentr FROM articles AS A
                                                                    INNER JOIN details_entree AS D
                                                                    ON A.code_art = D.code_art
                                                                    INNER JOIN entrees_stock AS E
                                                                    ON D.num_entr = E.num_entr
                                                                    WHERE E.date_entr = '$dat'";
                                                            if ($resultat = $connexion->query($sql)) {
                                                                $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                                foreach ($ligne as $list) { ?>
                                                                    <div><?php echo stripslashes($list['designation_art']) . " <img src='img/icons_1775b9/reply_arrow.png' width='20' style='margin-bottom: 5px'> (<strong>" . stripslashes($list['qte_dentr']) . "</strong>)" ?></div>
                                                                <?php }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- TODO: interroger la BD sur la dernière sortie d'articles -->
                                            <?php
                                                $sql = "SELECT max(date_sort) FROM sorties_stock";
                                                if ($resultat = $connexion->query($sql)) {
                                                    $ligne = $resultat->fetch_all(MYSQL_NUM);
                                                    foreach ($ligne as $list) {
                                                        $dat = $list[0];
                                                    }
                                                }
                                                $date_sort = date('j/m/Y', strtotime($dat));
                                            ?>
                                            <strong>
                                                <h5>Sorties au <?php echo $date_sort; ?>:</h5>
                                            </strong>

                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="slider-mouvement">
                                                        <?php
                                                            $sql = "SELECT A.designation_art, D.qte_dsort FROM articles AS A
                                                                    INNER JOIN details_sortie AS D
                                                                    ON A.code_art = D.code_art
                                                                    INNER JOIN sorties_stock AS S
                                                                    ON D.num_sort = S.num_sort
                                                                    WHERE S.date_sort = '$dat'";
                                                            if ($resultat = $connexion->query($sql)) {
                                                                $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                                                foreach ($ligne as $list) { ?>
                                                                    <div><?php echo stripslashes($list['designation_art']) . " <img src='img/icons_1775b9/forward_arrow.png' width='20' style='margin-bottom: 5px'> (<strong>" . stripslashes($list['qte_dsort']) . "</strong>)" ?></div>
                                                                <?php }
                                                            }
                                                        ?>
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
    </div>
</div>
<?php //elseif ($_SESSION['type_utilisateur'] == 'moyens_genereaux') : ?>

<?php //elseif ($_SESSION['type_utilisateur'] == 'normal') : ?>

<?php //endif ?>
