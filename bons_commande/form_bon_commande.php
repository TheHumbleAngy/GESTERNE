<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 17-Jul-15
     * Time: 1:10 PM
     */
    error_reporting(0);
    if (isset($_GET['action']) && $_GET['action'] == "consultation") : ?>

        <?php
        $code = $_GET['id'];

        $sql = "SELECT * FROM bons_commande WHERE num_bc = '" . $code . "'";
        if ($res = $connexion->query($sql)) {
            $lines = $res->fetch_all(MYSQL_ASSOC);
            foreach ($lines as $line) { ?>
                <!--suppress ALL -->
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bon de Commande
                            <a href='form_principale.php?page=form_actions&source=bons_commande&action=rechercher'
                               type='button'
                               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                <span aria-hidden='true'>&times;</span>
                            </a>
                        </div>
                        <div class="panel-body" style="overflow: auto">
                            <div class="col-md-10">
                                <table class="formulaire" border="0" style="margin-right: auto">
                                    <tr>
                                        <td class="champlabel">Numéro :</td>
                                        <td>
                                            <label>
                                                <input type="text" size="10" name="num_bc"
                                                       class="form-control"
                                                       id="num_bc" readonly
                                                       value="<?php echo stripslashes($line['num_bc']); ?>"/>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px">
                                            Fournisseur :
                                        </td>
                                        <td>
                                            <?php
                                                $fournisseur = stripslashes($line['code_four']);
                                                $sql = "SELECT nom_four FROM fournisseurs WHERE code_four = '" . $fournisseur . "'";
                                                $res = $connexion->query($sql);
                                                $rows = $res->fetch_all(MYSQL_ASSOC);
                                                foreach ($rows as $row) {
                                                    $fournisseur = $row['nom_four'];
                                                }
                                            ?>
                                            <label>
                                                <input type="text" size="20" name="fournisseur"
                                                       class="form-control"
                                                       id="four" readonly
                                                       value="<?php echo $fournisseur; ?>"/>
                                            </label>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-2" style="margin-bottom: 15px">
                                <img src="img/icons_1775b9/bon.png">
                            </div>

                            <br/>

                            <div class="zone">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <table border="0" class="table table-hover table-bordered">
                                            <thead>
                                            <th class="entete" style="text-align: center">Libelle</th>
                                            <th class="entete" style="text-align: center">Quantité</th>
                                            <th class="entete" style="text-align: center">Prix Unitaire</th>
                                            <th class="entete" style="text-align: center">Remise</th>
                                            <th class="entete" style="text-align: center">Prix TTC</th>
                                            </thead>
                                            <?php
                                                $sql3 = "SELECT * FROM details_bon_commande WHERE num_bc = '" . stripslashes($line['num_bc']) . "'";
                                                if ($result = $connexion->query($sql3)) { //print_r($sql3);
                                                    $rows = $result->fetch_all(MYSQL_ASSOC);
                                                    $total = 0;
                                                    foreach ($rows as $row) {
                                                        $qte = stripslashes($row['qte_dbc']);
                                                        $pu = stripslashes($row['pu_dbc']);
                                                        $rem = stripslashes($row['remise_dbc']);

                                                        if ($rem > 0) {
                                                            $rem = $rem / 100;
                                                            $ttc = $qte * $pu * (1 - $rem);
                                                        } else
                                                            $ttc = $qte * $pu;

                                                        $total = $total + $ttc;
                                                        ?>

                                                        <tr>
                                                            <td style="text-align: left"><?php echo stripslashes($row['libelle_dbc']); ?></td>
                                                            <td style="text-align: center"><?php echo stripslashes($row['qte_dbc']); ?></td>
                                                            <td style="text-align: right"><?php echo number_format(stripslashes($row['pu_dbc']), 0, ',', ' '); ?></td>
                                                            <td style="text-align: center"><?php echo stripslashes($row['remise_dbc']); ?>
                                                                %
                                                            </td>
                                                            <td style="text-align: right"><?php echo number_format($ttc, 0, ',', ' '); ?></td>
                                                        </tr>

                                                        <?php
                                                    }
                                                }
                                            ?>
                                            <thead>
                                            <th class="entete" style="text-align: center" colspan="4">
                                                TOTAL
                                            </th>
                                            <th class="entete"
                                                style="text-align: right"><?php echo number_format($total, 0, ',', ' '); ?></th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>

    <?php else : ?>

        <script>
            $.ajax({
                type: "POST",
                url: "bons_commande/ajax_num_bon_commande.php",
                success: function (resultat) {
                    $('#num_bc').val(resultat);
                }
            });
        </script>

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Bon de Commande
                    <a href='form_principale.php?page=accueil' type='button'
                       class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body" style="overflow: auto">
                    <form method="POST" name="myForm" onsubmit="return validationForme();">
                        <div class="row">
                            <div class="col-md-10">
                                <table class="formulaire" border="0" style="margin-right: auto">
                                    <tr>
                                        <td class="champlabel">Numéro :</td>
                                        <td>
                                            <label>
                                                <input type="text" size="10" name="num_bc" class="form-control"
                                                       id="num_bc" readonly/>
                                            </label>
                                        </td>
                                        <td style="padding-left: 30px">
                                            A partir d'une proforma ?
                                        </td>
                                        <td style="padding-left: 5px">
                                            <label>
                                                <select name="question" class="form-control" required id="question">
                                                    <option disabled selected></option>
                                                    <option value="oui">OUI</option>
                                                    <option value="non">NON</option>
                                                </select>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="champlabel proforma" style="padding-left: 10px" colspan="3">
                                            Veuillez sélectionner la proforma :
                                        </td>
                                        <td class="proforma" style="padding-left: 5px">
                                            <label>
                                                <select name="num_pro" class="form-control proformas" required>
                                                    <option disabled>N° Proforma</option>
                                                </select>
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2">
                                <img src="img/icons_1775b9/bon.png">
                            </div>
                        </div>

                        <br/>

                        <div class="zone"></div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function validationForme() {
                var code_four = document.forms["myForm"]["code_four"].value;
                if (code_four == null || code_four == "" || code_four == "Raison Sociale") {
                    alert("Veuillez sélectionner un fournisseur.");
                    return false;
                }
            }

            $(document).ready(function () {
                $('.proforma').hide();
                $('.zone').hide();

                $('#question').change(function () {
                    var reponse = $('#question').val();
                    if (reponse == 'oui') {
                        $('.proforma').show();
                        $('.zone').hide();
                    }
                    else {
                        $('.proforma').hide();
                        $('.zone').show();
                        $.ajax({
                            type: 'GET',
                            url: 'bons_commande/ajax_saisie_bon_commande.php',
                            success: function (resultat) {
                                $('.zone').html(resultat);
                            }
                        });
                    }
                });

                /* Ce script permet de remplir le combobox de différentes proformas*/
                $.ajax({
                    type: "POST",
                    url: "bons_commande/ajax_proformas.php",
                    success: function (resultat) {
                        //On éclate notre string résultat en un tableau 1D où chaque céllule du tableau est fonction du ";"
                        var option = resultat.split(';');
                        var select = $('.proformas');
//                    console.log(option.length);
                        for (i = 0; i < option.length - 1; i++) {
                            select.append("<option value='" + option[i] + "'>" + option[i] + "</option>");
//                        console.log(option[i]);
                        }
                        //On initialise le combobox à "N° Proforma"
                        $('.proformas option:contains("N° Proforma")').attr('selected', 'selected');
                    }
                });

                /* Ce script permet d'afficher le fournisseur et les différents articles figurant de la proforma sélectionnée */
                $("select.proformas").change(function () {
                    $('.zone').show();
                    var prof = $(".proformas option:selected").val();
                    //console.log(prof);
                    $.ajax({
                        type: "POST",
                        url: "bons_commande/ajax_bon_commande.php",
                        data: {
                            proforma: prof
                        },
                        success: function (resultat) {
                            //console.log(resultat);
                            $('.zone').html(resultat);
                        }
                    });
                });

                setTimeout(function () {
                    $(".alert-success").remove();
                }, 3000);


            })
        </script>

        <?php
        if (sizeof($_POST) > 0) {

            //Enregistrement du bon dans la table "bons_commande"
            $num_bon = htmlspecialchars($_POST['num_bc'], ENT_QUOTES);
            $code_four = isset($_POST['code_four']) ? htmlspecialchars($_POST['code_four'], ENT_QUOTES) : htmlspecialchars($_POST['cod_four'], ENT_QUOTES);
            $date_bon = date("Y-m-d");
            $code_emp = $_SESSION['user_id'];

            $req = "INSERT INTO bons_commande (num_bc, code_emp, code_four, date_bc) VALUES ('$num_bon', '$code_emp', '$code_four', '$date_bon')";
//        print_r($req); echo $_POST['nbr'];
            echo '<br>'; //TODO: enrégistrer l'identifiant du fournisseur dans la table "bons_commande"
            if ($result = mysqli_query($connexion, $req)) {

                //Enregistrement de chaque article figurant sur le bon
                $n = $_POST['nbr'];
                $test = TRUE;
                for ($i = 0; $i < $n; $i++) {

                    $req = "SELECT id_dbc FROM details_bon_commande ORDER BY id_dbc DESC LIMIT 1";
                    $resultat = $connexion->query($req);

                    $id_dbc = 0;
                    if ($resultat->num_rows > 0) {
                        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                        //reccuperation du code
                        foreach ($ligne as $data) {
                            $id_dbc = stripslashes($data['id_dbc']);
                        }

                        //extraction des 4 derniers chiffres
                        $id_dbc = substr($id_dbc, -4);

                        //incrementation du nombre
                        $id_dbc += 1;
                    } else {
                        //s'il n'existe pas d'enregistrements dans la base de données
                        $id_dbc = 1;
                    }

                    $b = "DBC";
                    $dat = date("Y");
                    $dat = substr($dat, -2);
                    $format = '%04d';
                    $resultat = $dat . "" . $b . "" . sprintf($format, $id_dbc);

                    //on affecte au code le resultat
                    $id_dbc = $resultat;

                    $libelle_dbc = ($_POST['libelle_dbc'][$i]);
                    $qte_dbc = ($_POST['qte_dbc'][$i]);
                    $pu_dbc = ($_POST['pu_dbc'][$i]);
                    $remise_dbc = ($_POST['remise_dbc'][$i]);

                    $libelle_dbc = mysqli_real_escape_string($connexion, $libelle_dbc);

                    $REQ = "INSERT INTO details_bon_commande (id_dbc, num_bc, libelle_dbc, pu_dbc, qte_dbc, remise_dbc)
	                    VALUES ('$id_dbc', '$num_bon', '$libelle_dbc', '$pu_dbc', '$qte_dbc', '$remise_dbc')";

//            print_r($REQ); echo '<br>';
                    if (!mysqli_query($connexion, $REQ)) {
                        $test = FALSE;
                        break;
                    }
                }
                if ($test) {
                    header('Location: form_principale.php?page=bons_commande/form_bon_commande');
                } else {
                    echo "
                    <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                        <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative d'enregistrement des détails du bon de commande. Veuillez contacter l'administrateur.
                    </div>
                    ";
                }
            } else {
                echo "
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <strong>Erreur!</strong><br/> Une erreur s'est produite lors de la tentative d'enregistrement du bon de commande. Veuillez contacter l'administrateur.
            </div>
            ";
            }
            mysqli_close($connexion);
        }
        ?>

    <?php endif; ?>
