<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 22-Oct-15
     * Time: 11:21 AM
     */
    $source = $_GET['source'];
//    echo $source;
?>

<?php if ($source == 'employes') : ?>
    <!--suppress ALL -->
    <div class="col-md-9" style="padding-top: 5%; margin-left: 12.66%">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="icons8-clipboard"> Administration - Employés</span>
                <a href='form_principale.php?page=accueil' type='button' class='close'
                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </a>
            </div>
            <div class="panel-body">
                <table class="formulaire" border="0" style="width: 100%">
                    <tr>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=employes/form_employes">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/Businessman-100.png" width="30" height="30">
                                    Ajouter
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=form_actions&source=employes&action=modifier">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/Edit_User-100.png" width="30" height="30">
                                    Modifier
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=form_actions&source=employes&action=supprimer">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/Remove_User-100.png" width="30" height="30">
                                    Supprimer
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=employes/liste_employes">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/List-100.png" width="30" height="30">
                                    Liste
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=form_actions&source=employes&action=rechercher">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/Find_User-100.png" width="30" height="30">
                                    Rechercher
                                </div>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

<?php elseif ($source == 'fournisseurs') : ?>
    <div class="col-md-9" style="padding-top: 5%; margin-left: 12.66%">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="icons8-clipboard"> Administration - Fournisseurs</span>
                <a href='form_principale.php?page=accueil' type='button' class='close'
                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </a>
            </div>
            <div class="panel-body">
                <table class="formulaire" border="0" style="width: 100%">
                    <tr>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=fournisseurs/form_fournisseurs">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/fournisseur-100.png" width="30" height="30">
                                    Ajouter
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=form_actions&source=fournisseurs&action=modifier">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/Edit_User-100.png" width="30" height="30">
                                    Modifier
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=form_actions&source=fournisseurs&action=supprimer">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/Remove_User-100.png" width="30" height="30">
                                    Supprimer
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=fournisseurs/liste_fournisseurs">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/List-100.png" width="30" height="30">
                                    Liste
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu"
                               href="form_principale.php?page=form_actions&source=fournisseurs&action=rechercher">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/Find_User-100.png" width="30" height="30">
                                    Rechercher
                                </div>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

<?php elseif ($source == 'utilisateurs') : ?>
    <div class="col-md-9" style="padding-top: 5%; margin-left: 12.66%">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="icons8-clipboard"> Utilisateurs</span>
                <a href='form_principale.php?page=accueil' type='button' class='close'
                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </a>
            </div>
            <div class="panel-body">
                <table class="formulaire" border="0" style="width: 100%">
                    <tr>
                        <td>
                            <a class="a-minimenu" onclick="ajouter();">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/add_user-100.png" width="30" height="30">
                                    Ajouter
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu" onclick="modifier();">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/edit_user.png" width="30" height="30">
                                    Modifier
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu" onclick="lister();">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/user_groups.png" width="30" height="30">
                                    Liste
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="a-minimenu" onclick="rechercher();">
                                <div class="btn-minimenu">
                                    <img src="img/Icons8/find_user.png" width="30" height="30">
                                    Rechercher
                                </div>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="feedback"></div>
    </div>

<?php endif ?>

    <script>
        function ajouter() {
            //alert("Scripting...");
            $.ajax({
                type: "POST",
                url: "utilisateurs/form_utilisateurs.php",
                data: {
                    action: "ajout"
                },
                success: function (resultat) {
                    $(".feedback").html(resultat);
                }
            })
        }

        function modifier() {
            $.ajax({
                type: "POST",
                url: "utilisateurs/form_utilisateurs.php",
                data: {
                    action: "modification"
                },
                success: function (resultat) {
                    $(".feedback").html(resultat);
                }
            })
        }

        function lister() {
            $.ajax({
                type: "POST",
                url: "utilisateurs/form_utilisateurs.php",
                data: {
                    action: "liste"
                },
                success: function (resultat) {
                    $(".feedback").html(resultat);
                }
            })
        }

        function rechercher() {
            $.ajax({
                type: "POST",
                url: "utilisateurs/form_utilisateurs.php",
                data: {
                    action: "rechercher",
                },
                success: function (resultat) {
                    $(".feedback").html(resultat);
                }
            })
        }
    </script>

<?php //echo sizeof($_POST);
    if (sizeof($_POST) > 0) { //echo $_POST['validation']; //echo "test";

        if (isset($_POST['validation'])) {
            if ($_POST['validation'] == "valider ajout") {
                $req = "SELECT code_droit FROM droits ORDER BY code_droit DESC LIMIT 1";
                $resultat = $connexion->query($req); //print_r($req); echo '<br>'; print_r($resultat); echo '<br>';

                if ($resultat->num_rows > 0) {
                    $ligne = $resultat->fetch_all(MYSQL_ASSOC);

                    //reccuperation du code
                    $code = "";
                    foreach ($ligne as $data) {
                        $code = stripslashes($data['code_droit']);
                    }

                    //extraction des 4 derniers chiffres
                    $code = substr($code, -4);

                    //incrementation du nombre
                    $code += 1;
                } else
                    $code = 1;

                $b = "DRT";
                $dat = date("Y");
                $dat = substr($dat, -2);
                $format = '%04d';
                $resultat = $dat . "" . $b . "" . sprintf($format, $code);

                $code = $resultat; //print_r($code);
                $code_emp = $_POST['emp'];
                $type = $_POST['compte'];

                $sql = "INSERT INTO droits VALUES ('$code', '$code_emp', '$type')"; //print_r($sql);

                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

                //header('Location: form_principale.php?page=utilisateurs\form_utilisateurs&action=ajout');

            } elseif ($_POST['validation'] == "valider modification") {

                $code_emp = $_POST['emp'];
                $type = $_POST['compte'];
                $sql = "UPDATE droits SET libelle_droit = '" . $type . "' WHERE code_emp = '" . $code_emp . "'"; //print_r($sql);
                $requete = mysqli_query($connexion, $sql);
            }
        }

        if (isset($_POST['element'])) {
            $sql = "SELECT e.code_emp, e.nom_emp, e.prenoms_emp, d.libelle_droit
                FROM employes AS e
                INNER JOIN droits AS d
                ON e.code_emp = d.code_emp
                WHERE e.code_emp LIKE '%" . $_POST['element'] . "%' AND e.code_emp IN (SELECT code_emp FROM droits) ORDER BY e.nom_emp ASC ";

            if ($resultat = $connexion->query($sql)) {
                ?>
                <div class="col-md-7 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                            Utilisateurs
                            <a href='form_principale.php?page=administration&source=utilisateurs' type='button'
                               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                <span aria-hidden='true'>&times;</span>
                            </a>
                        </div>
                        <div class="panel-body" style="overflow: auto">
                            <table border="0" class="table table-hover table-bordered ">
                                <thead>
                                <tr>
                                    <td class="entete" style="text-align: center">Matricule</td>
                                    <td class="entete" style="text-align: center">Utilisateur</td>
                                    <td class="entete" style="text-align: center">Droit</td>
                                </tr>
                                </thead>
                                <?php
                                    $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                                    foreach ($ligne as $list) {
                                        ?>
                                        <tr>
                                            <td><?php echo stripslashes($list['code_emp']); ?></td>
                                            <td><?php echo stripslashes($list['prenoms_emp']) . ' ' . stripslashes($list['nom_emp']); ?></td>
                                            <td><?php echo stripslashes($list['libelle_droit']); ?></td>
                                        </tr>
                                        <?php
                                    } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
?>