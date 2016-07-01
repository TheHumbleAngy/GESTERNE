<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 27-Aug-15
     * Time: 6:03 PM
     */
    if (isset($_GET['action']) && $_GET['action'] == "consultation") : ?>

        <?php
        $code = $_GET['id'];

        $sql = "SELECT * FROM demandes WHERE code_dbs = '" . $code . "'";
        if ($valeur = $connexion->query($sql)) {
            $ligne = $valeur->fetch_all(MYSQL_ASSOC);
            foreach ($ligne as $data) {
                ?>
                <!--suppress ALL -->
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Formulaire Demande
                            <a href='form_principale.php?page=accueil' type='button'
                               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                <span aria-hidden='true'>&times;</span>
                            </a>
                        </div>
                        <div class="panel-body">
                            <form method="post">
                                <table class="formulaire" style="width: 100%" border="0">
                                    <tr>
                                        <td class="champlabel" title="Le numéro de la demande en cours de saisie">Numéro
                                            :
                                        </td>
                                        <td>
                                            <label>
                                                <input type="text" size="10" name="code_dbs" class="form-control"
                                                       id="code_dbs"
                                                       value="<?php echo stripslashes($data['code_dbs']); ?>"
                                                       readonly/>
                                            </label>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td rowspan="3" style="padding-right: 0">
                                            <a href="demandes/fiche_demandes.php?id=<?php echo stripslashes($data['code_dbs']); ?>"
                                               target="_blank" title="Imprimer">
                                                <img src="img/icons_1775b9/agreement_1.png">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="champlabel">Employé :</td>
                                        <td>
                                            <label>
                                                <?php
                                                    $sql = "SELECT e.nom_emp, e.prenoms_emp
                                                            FROM employes AS e
                                                            INNER JOIN demandes AS d
                                                            ON e.code_emp = d.code_emp
                                                            WHERE d.code_dbs = '" . stripslashes($data['code_dbs']) . "'";
                                                    if ($valeur = $connexion->query($sql)) {
                                                        $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                                                        $nom_prenoms_emp = "";
                                                        foreach ($ligne as $list) {
                                                            $nom_prenoms_emp = stripslashes($list['prenoms_emp']) . ' ' . stripslashes($list['nom_emp']);
                                                        }
                                                    }
                                                ?>
                                                <input type="text" name="code_emp" class="form-control"
                                                       value="<?php echo $nom_prenoms_emp; ?>" readonly>
                                            </label>
                                        </td>
                                        <td class="champlabel" rowspan="2">Objet :</td>
                                        <td rowspan="2">
                                            <label>
                                                <textarea id="objets_dbs" name="objets_dbs" rows="3" class="form-control" readonly
                                                          style="resize: none"><?php echo stripslashes($data['objets_dbs']); ?></textarea>
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                                <br>

                                <div class="feedback">
                                    <?php
                                        $sql = "SELECT * FROM details_demande WHERE code_dbs = '" . $code . "'";
                                        if ($valeur = $connexion->query($sql)) {
                                            $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                                            ?>
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                    <table border="0" class="table table-hover table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th class="entete" style="text-align: center; width: 45%">
                                                                Libelle
                                                            </th>
                                                            <th class="entete" style="text-align: center">Nature</th>
                                                            <th class="entete" style="text-align: center">Quantité</th>
                                                            <th class="entete" style="text-align: center; width: 30%">
                                                                Observation
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <?php
                                                            foreach ($ligne as $list) {
                                                                ?>
                                                                <tr>
                                                                    <td style="vertical-align: middle"><?php echo $list['libelle_dd']; ?></td>
                                                                    <td style="text-align: center; vertical-align: middle"><?php echo $list['nature_dd']; ?></td>
                                                                    <td style="text-align: center; vertical-align: middle"><?php echo $list['qte_dd']; ?></td>
                                                                    <td style="vertical-align: middle"><?php echo $list['observations_dd']; ?></td>
                                                                </tr>
                                                                <?php
                                                            } ?>
                                                    </table>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
            }
        }
        ?>
    <?php else : ?>
        <head>
            <meta charset="UTF-8">
            <script>
                $.ajax({
                    type: "POST",
                    url: "demandes/ajax_num_demande.php",
                    success: function (resultat) {
                        $('#code_dbs').val(resultat);
                    }
                });
            </script>
        </head>
        <body>
        <br/>

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaire Demande
                    <a href='form_principale.php?page=accueil' type='button'
                       class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <table class="formulaire" style="width: 100%" border="0">
                            <tr>
                                <td class="champlabel" title="Le numéro de la demande en cours de saisie">Numéro :</td>
                                <td>
                                    <label>
                                        <input type="text" size="10" name="code_dbs" class="form-control" id="code_dbs"
                                               readonly/>
                                    </label>
                                </td>
                                <td></td>
                                <td></td>
                                <td rowspan="3" style="padding-right: 0">
                                    <img src="img/icons_1775b9/agreement_1.png">
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Employé :</td>
                                <td>
                                    <label>
                                        <?php
                                            $sql = "SELECT code_emp, nom_emp, prenoms_emp FROM employes WHERE employes.email_emp = '" . $_SESSION['email'] . "'";
                                            if ($valeur = $connexion->query($sql)) {
                                                $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                                                $nom_prenoms_emp = "";
                                                foreach ($ligne as $data) {
                                                    $code_emp = stripslashes($data['code_emp']);
                                                    $nom_prenoms_emp = stripslashes($data['prenoms_emp']) . ' ' . stripslashes($data['nom_emp']);
                                                }
                                            }
                                        ?>
                                        <input type="text" name="code_emp" class="form-control"
                                               value="<?php echo $nom_prenoms_emp; ?>" readonly>
                                    </label>
                                </td>
                                <td class="champlabel" rowspan="2">Objet :</td>
                                <td rowspan="2">
                                    <label>
                                        <textarea id="objets_dbs" name="objets_dbs" rows="3" class="form-control"
                                                  style="resize: none"></textarea>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Nombre d'articles :</td>
                                <td>
                                    <label>
                                        <input type="number" min="1" class="form-control" id="nbr_articles"
                                               name="nbr"
                                               required/>
                                    </label>
                                </td>
                            </tr>

                            <script>
                                var articles = ["a", "b"],
                                    x = $('input[name*="libelle"]'),
                                    nbr_art = $('input[type=number]#nbr_articles');

                                function smt() {
                                    $.ajax({
                                        url: "articles/libelles_articles.php",
                                        dataType: "json",
                                        type: "GET",
                                        success: function (data) {
                                            for (var i = 0; i < data.length; i += 1) {
                                                articles[i] = data[i].designation_art;
                                            }
                                        }
                                    });
                                }

                                nbr_art.bind('keyup mouseup', function () {
                                    var n = $("#nbr_articles").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "demandes/ajax_saisie_demandes.php",
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

                                nbr_art.bind('blur', function () {
                                    $.ajax({
                                        url: "articles/libelles_articles.php",
                                        dataType: "json",
                                        type: "GET",
                                        success: function (data) {
                                            for (var i = 0; i < data.length; i += 1) {
                                                articles[i] = data[i].designation_art;
                                            }
                                            console.log(articles);
                                            $('input[name*="libelle"]').autocomplete({
                                                source: articles
                                            });
                                        }
                                    })
                                });
                            </script>

                        </table>
                        <br>

                        <div class="feedback"></div>
                    </form>
                </div>
            </div>
        </div>
        </body>

        <?php
        if (isset($_POST['code_dbs'])) {
            include 'class_demandes.php';

            $demande = new demandes();

            if ($demande->recuperation($_SESSION['user_id'])) {
                if ($demande->enregistrement()) {
                    $details_demande = new details_demandes();

                    $nbr = $_POST['nbr'];

                    for ($i = 0; $i < $nbr; $i++) {
                        if ($details_demande->recuperation_details($demande->code_dbs, $i)) {
                            if ($details_demande->enregistrement())
                                header('Location: form_principale.php?page=demandes/form_demandes&action=ajout');
                            else
                                echo "
                                <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative d'enregistrement des détails de la demande. Veuillez contacter l'administrateur.
                                </div>
                                ";
                        } else {
                            echo "
                            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de récupération des informations. Veuillez contacter l'administrateur.
                            </div>
                            ";
                            break;
                        }
                    }
                } else
                    echo "
                    <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                        <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative d'enregistrement de la demande. Veuillez contacter l'administrateur.
                    </div>
                    ";
            } else
                echo "
                <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative de récupération de la demande. Veuillez contacter l'administrateur.
                </div>
                ";
        }
        ?>

    <?php endif; ?>