<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 30/06/2016
     * Time: 14:35
     */
?>
<!--suppress ALL -->
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Récap. Entrées/Sorties
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>
                            <h5 style="color: #29487d">Entrées :</h5>
                        </strong>
                        <div class="panel panel-default">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th class="entete" style="text-align: center">Numéro</th>
                                    <th class="entete" style="text-align: center">Date</th>
                                    <?php /*if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')|| ($_SESSION['type_utilisateur'] == 'normal') ):*/ ?>
                                    <!--                    <td class="entete" colspan="3" style="text-align: center">Actions</td>-->
                                    <?php /*endif*/ ?>
                                </tr>
                                </thead>
                                <?php
                                    $req = "SELECT * FROM entrees_stock ORDER BY date_entr DESC ";
                                    if ($resultat = $connexion->query($req)) {
                                        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                        foreach ($ligne as $list) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center">
                                                    <a class="btn btn-default" data-toggle="modal"
                                                       data-target="#modalConsultation<?php echo stripslashes($list['num_entr']); ?>">
                                                        <?php echo stripslashes($list['num_entr']); ?>
                                                    </a>

                                                    <div class="modal fade"
                                                         id="modalConsultation<?php echo stripslashes($list['num_entr']); ?>"
                                                         tabindex="-1"
                                                         role="dialog">
                                                        <div class="modal-dialog delete" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close"><span
                                                                            aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title"
                                                                        id="modalConsultation<?php echo stripslashes($list['num_entr']); ?>">
                                                                        Entrée <?php echo stripslashes($list['num_entr']); ?> au <?php echo stripslashes($list['date_entr']); ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table border="0" class="table table-hover table-bordered ">
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="entete" style="text-align: center">Article</th>
                                                                            <th class="entete" style="text-align: center">Quantité</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <?php
                                                                            $sql = "SELECT * FROM details_entree WHERE num_entr = '" . stripslashes($list['num_entr']) . "'";
                                                                            if ($result = $connexion->query($sql)) {
                                                                                $lignes = $result->fetch_all(MYSQL_ASSOC);
                                                                                foreach ($lignes as $liste) {
                                                                                    $sql1 = "SELECT designation_art FROM articles WHERE code_art = '" . stripslashes($liste['code_art']) . "'";
                                                                                    $art = "";
                                                                                    if ($result1 = $connexion->query($sql1)) {
                                                                                        $lignes1 = $result1->fetch_all(MYSQL_ASSOC);
                                                                                        foreach ($lignes1 as $liste1) {
                                                                                            $art = stripslashes($liste1['designation_art']);
                                                                                        }
                                                                                    }
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $art; ?></td>
                                                                            <td><?php echo stripslashes($liste['qte_dentr']); ?></td>
                                                                        </tr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align: center"><?php echo stripslashes($list['date_entr']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <strong>
                            <h5 style="color: #29487d">Sorties :</h5>
                        </strong>
                        <div class="panel panel-default">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th class="entete" style="text-align: center">Numéro</th>
                                    <th class="entete" style="text-align: center">Date</th>
                                    <?php /*if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')|| ($_SESSION['type_utilisateur'] == 'normal') ):*/ ?>
                                    <!--                    <td class="entete" colspan="3" style="text-align: center">Actions</td>-->
                                    <?php /*endif*/ ?>
                                </tr>
                                </thead>
                                <?php
                                    $req = "SELECT * FROM sorties_stock ORDER BY date_sort DESC ";
                                    if ($resultat = $connexion->query($req)) {
                                        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                        foreach ($ligne as $list) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center">
                                                    <a class="btn btn-default" data-toggle="modal"
                                                       data-target="#modalConsultation<?php echo stripslashes($list['num_sort']); ?>">
                                                        <?php echo stripslashes($list['num_sort']); ?>
                                                    </a>

                                                    <div class="modal fade"
                                                         id="modalConsultation<?php echo stripslashes($list['num_sort']); ?>"
                                                         tabindex="-1"
                                                         role="dialog">
                                                        <div class="modal-dialog delete" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close"><span
                                                                            aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title"
                                                                        id="modalConsultation<?php echo stripslashes($list['num_sort']); ?>">
                                                                        Sortie <?php echo stripslashes($list['num_sort']); ?> au <?php echo stripslashes($list['date_sort']); ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table border="0" class="table table-hover table-bordered ">
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="entete" style="text-align: center">Article</th>
                                                                            <th class="entete" style="text-align: center">Quantité</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <?php
                                                                            $sql = "SELECT * FROM details_sortie WHERE num_sort = '" . stripslashes($list['num_sort']) . "'";
                                                                            if ($result = $connexion->query($sql)) {
                                                                                $lignes = $result->fetch_all(MYSQL_ASSOC);
                                                                                foreach ($lignes as $liste) {
                                                                                    $sql1 = "SELECT designation_art FROM articles WHERE code_art = '" . stripslashes($liste['code_art']) . "'";
                                                                                    $art = "";
                                                                                    if ($result1 = $connexion->query($sql1)) {
                                                                                        $lignes1 = $result1->fetch_all(MYSQL_ASSOC);
                                                                                        foreach ($lignes1 as $liste1) {
                                                                                            $art = stripslashes($liste1['designation_art']);
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo $art; ?></td>
                                                                                        <td><?php echo stripslashes($liste['qte_dsort']); ?></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align: center"><?php echo stripslashes($list['date_sort']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
    function afficherInfos() {
        $.ajax({
            type: 'GET',
            url: 'articles/getdata.php',
            success: function (data) {
                $('#feedback').html(data);
            }
        });
    }
</script>