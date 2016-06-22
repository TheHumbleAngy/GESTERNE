<!--suppress ALL -->
<script>
    $.ajax({
        type: "POST",
        url: "bons_livraison/ajax_num_bons_livraison.php",
        success: function (resultat) {
            $('#code_bl').val(resultat);
        }
    });
</script>

<div class="col-md-11"  style="margin-left: 4.33%">
    <div class="panel panel-default">
        <div class="panel-heading">
            Bon de Livraison
            <a href='form_principale.php?page=accueil' type='button'
               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                <span aria-hidden='true'>&times;</span>
            </a>
        </div>
        <div class="panel-body">
            <form action="form_principale.php?page=bons_livraison/saisie_bons_livraison" method="POST">
                <div class="row">
                    <div class="col-md-10">
                        <table class="formulaire" style="width= 100%" border="0">
                            <tr>
                                <td class="champlabel">Numéro :</td>
                                <td>
                                    <label>
                                        <input type="text" name="code_bl" id="code_bl" class="form-control"
                                               readonly>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Date d'établissement :</td>
                                <td>
                                    <label>
                                        <input type="text" name="dateetablissement_bl"
                                               id="dateetablissement_bl" readonly
                                               title="Veuillez cliquer ici pour sélectionner une date"
                                               class="form-control"/>
                                    </label>
                                </td>
                                <td class="champlabel">Date de Réception :</td>
                                <td>
                                    <label>
                                        <input type="text" name="datereception_bl"
                                               id="datereception_bl" readonly
                                               title="Veuillez cliquer ici pour sélectionner une date"
                                               class="form-control"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">*Fournisseur :</td>
                                <td>
                                    <label>
                                        <select name="code_four" class="form-control" id="four">
                                            <option selected disabled>Raison sociale</option>
                                            <?php
                                            $sql = "SELECT code_four, nom_four FROM fournisseurs ORDER BY nom_four ASC ";
                                            $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                            while ($data = mysqli_fetch_array($res)) {
                                                echo '<option value="' . $data['code_four'] . '">' . $data['nom_four'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                                <td class="champlabel">Livreur :</td>
                                <td>
                                    <label>
                                        <input type="text" name="nom_livreur" class="form-control" size="40"
                                               onblur="this.value = this.value.toUpperCase();"
                                               required/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel" title="Numéro du bon de commande">Bon de Commande :</td>
                                <td>
                                    <label>
                                        <select name="num_bc" class="form-control" id="bon_commande">
                                            <option selected disabled>Numéro</option>
                                        </select>
                                    </label>
                                </td>
                                <td class="champlabel">Réceptionniste :</td>
                                <td>
                                    <label>
                                        <select name="code_emp" required class="form-control">
                                            <option disabled selected>Employé</option>
                                            <?php
                                                $sql = "SELECT code_emp, nom_emp, prenoms_emp FROM employes WHERE departement_emp IN ('ADMINISTRATION', 'MOYENS GENERAUX') AND nom_emp <> 'ABBEY' ORDER BY nom_emp ASC";
                                                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                                while ($data = mysqli_fetch_array($res)) {
                                                    echo '<option value="' . $data['code_emp'] . '" >' . $data['prenoms_emp'] . ' ' . $data['nom_emp'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Commentaires :</td>
                                <td>
                                    <label>
                                    <textarea name="commentaires_bl" rows=3 cols="20" class="form-control"
                                              style="resize: none"></textarea>
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-2">
                        <img src="img/Icons8/bondelivraison-100.png">
                    </div>
                    <br/>

                    <div class="response"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#datereception_bl').datepicker({ dateFormat: 'yy-mm-dd' });
    $('#dateetablissement_bl').datepicker({ dateFormat: 'yy-mm-dd' });
    /* Ce script permet de remplir le combobox de la liste des bons de commande en fonction du fournisseur sélectionné */
    $(document).ready(function () {
        $("#four").change(function () {
            var four = $("#four").val(); //console.log(four);
            $.ajax({
                type: "POST",
                data: {
                    fournisseur: four
                },
                url: "bons_livraison/ajax_bons_livraison.php",
                success: function (resultat) {
                    //On éclate notre string résultat en un tableau 1D où chaque céllule du tableau est fonction du ";"
                    var option = resultat.split(';');
                    var select = $('#bon_commande');

                    //console.log(option.length);
                    select.empty();
                    select.append("<option selected disabled>Numéro</option>");
                    for (var i = 0; i < option.length - 1; i++) {
                        select.append("<option value='" + option[i] + "'>" + option[i] + "</option>");
                        //console.log(option[i]);
                    }
                }
            });
        });

        /* Ce script permet d'afficher la liste des articles du bon de commande sélectionné */
        $("#bon_commande").change(function () {
            var bon = $("#bon_commande").val(); console.log(bon);
            $.ajax({
                type: "POST",
                url: "bons_livraison/ajax_articles_bons_livraison.php",
                data: {
                    bon_cmd: bon
                },
                success: function (resultat) {
                    $('.response').html(resultat);
                }
            });
        });
    })
</script>
<?php

if (sizeof($_POST) > 0) {

    $code_bl = htmlspecialchars($_POST['code_bl'], ENT_QUOTES);
    $dateetablissement_bl = htmlspecialchars($_POST['dateetablissement_bl'], ENT_QUOTES);
    $datereception_bl = htmlspecialchars($_POST['datereception_bl'], ENT_QUOTES);
    $code_four = htmlspecialchars($_POST['code_four'], ENT_QUOTES);
    $num_bc = htmlspecialchars($_POST['num_bc'], ENT_QUOTES);
    $code_emp = htmlspecialchars($_POST['code_emp'], ENT_QUOTES);
//    $statut_bl = htmlspecialchars($_POST['statut_bl'], ENT_QUOTES);
    $commentaires_bl = htmlspecialchars($_POST['commentaires_bl'], ENT_QUOTES);

    $req = "INSERT INTO bons_livraison (code_bl,
                                        num_bc,
                                        dateetablissement_bl,
                                        datereception_bl,
                                        code_four,
                                        code_emp,
                                        commentaires_bl)
                                 VALUES('$code_bl',
                                        '$num_bc',
                                        '$dateetablissement_bl',
                                        '$datereception_bl',
                                        '$code_four',
                                        '$code_emp',
                                        '$commentaires_bl')";

//    print_r($req);
    $result = mysqli_query($connexion, $req) or die(mysqli_error($connexion));

    $n = $_POST['n'];
    $tot = 0;
    for ($i = 0; $i < $n; $i++) {
        $req = "SELECT code_dbl FROM details_bon_livraison ORDER BY code_dbl DESC LIMIT 1";
        $resultat = $connexion->query($req);

        if ($resultat->num_rows > 0) {
            $ligne = $resultat->fetch_all(MYSQL_ASSOC);

            //reccuperation du code
            $code_dbl = "";
            foreach ($ligne as $data) {
                $code_dbl = stripslashes($data['code_dbl']);
            }

            //extraction des 4 derniers chiffres
            $code_dbl = substr($code_dbl, -4);

            //incrementation du nombre
            $code_dbl += 1;

            $b = "DBL";
            $dat = date("Y");
            $dat = substr($dat, -2);
            $format = '%04d';
            $resultat = $dat . "" . $b . "" . sprintf($format, $code_dbl);

            //echo $resultat;
        } else {
            //s'il n'existe pas d'enregistrements dans la base de données
            $code_dbl = 1;
            $b = "DBL";
            $dat = date("Y");
            $dat = substr($dat, -2);
            $format = '%04d';
            $resultat = $dat . "" . $b . "" . sprintf($format, $code_dbl);
        }
        //on affecte au code le resultat
        $code_dbl = $resultat;

        $libelle_dbl = ($_POST['libelle_dbl'][$i]);
        $qte_cmd = ($_POST['qte_cmd'][$i]);
        $qte_livree = ($_POST['qte_livree'][$i]);

        $libelle_dbl = htmlspecialchars($libelle_dbl, ENT_QUOTES);
        $qte_cmd = htmlspecialchars($qte_cmd, ENT_QUOTES);
        $qte_livree = htmlspecialchars($qte_livree, ENT_QUOTES);

        $qte_restante = $qte_cmd - $qte_livree;

        //On fait la somme des quantites restantes du bon de livraison en cours
        $tot = $tot + $qte_restante;

        $REQ = "INSERT INTO details_bon_livraison (code_dbl, code_bl, libelle_dbl, qte_livree, qte_restante)
	            VALUES ('$code_dbl', '$code_bl', '$libelle_dbl', '$qte_livree', '$qte_restante')";

//        print_r($REQ);
        echo '<br/>';
        //exécution de la requête REQ:
        if ($requete = mysqli_query($connexion, $REQ) or die(mysql_error($connexion))) {
            $_SESSION['temp'] = htmlspecialchars($_POST['code_emp'], ENT_QUOTES);
            //header('Location: form_principale.php?page=articles/details_demandes/saisie_details_demandes_biens_ou_services')
        }
    }

    //On verifie si le total comptabilise des quantites restantes est superieur a 0. Cela voudra donc dire que le bon de livraison
    //satisfait partiellement le bon de commande
    if ($tot > 0)
        $sql = "UPDATE bons_commande SET statut = 'livre partiellement' WHERE num_bc = '" . $num_bc . "'";
    //Sinon, c'est a dire le total est a 0, on marque le bon de commande comme livre; le bon de livraison satisfait otalement la commande
    else
        $sql = "UPDATE bons_commande SET statut = 'livre' WHERE num_bc = '" . $num_bc . "'";

    $result = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    mysqli_close($connexion);
}
?>