<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 22-Oct-15
     * Time: 2:59 PM
     */
    $source = $_GET['source'];
    $action = $_GET['action'];
//    echo $action;
?>

<?php if ($source == 'employes') {
    if ($action == 'modifier') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Modif. Employé
                    <a href='form_principale.php?page=administration&source=employes' type='button'
                       class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez sélectionner l'employé à modifier à l'aide de
                                        la liste déroulante puis cliquez sur le boutton en face pour procéder.</p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=employes/modif_employes" method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>Employe:</td>
                                <td>
                                    <label>
                                        <select name="code" required class="form-control">
                                            <option disabled selected></option>
                                            <?php
                                                $sql = "SELECT code_emp, prenoms_emp, nom_emp FROM employes ORDER BY nom_emp ASC ";
                                                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                                while ($data = mysqli_fetch_array($res)) {
                                                    echo '<option value="' . $data['code_emp'] . '" >' . $data['prenoms_emp'] . " " . $data['nom_emp'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php } elseif ($action == 'rechercher') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="icons8-clipboard"> Recherche > Employes</span>
                    <a href='form_principale.php?page=administration&source=employes' type='button'
                       class='close'
                       data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez sélectionner le critère de recherche à l'aide
                                        de la liste déroulante. Entrez ensuite le texte a rechercher ou tapez quelques
                                        carateres qui, selon vous, existent dans l'élément a rechercher. Puis, cliquez
                                        sur le boutton en face pour procéder.</p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=employes/rech_employes" method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>
                                    Critere :
                                </td>
                                <td>
                                    <label>
                                        <select name="opt" required class="form-control">
                                            <option disabled selected></option>
                                            <option value="matricule">Matricule</option>
                                            <option value="nom">Nom</option>
                                            <option value="prenoms">Prenoms</option>
                                            <option value="fonction">Fonction</option>
                                            <option value="departement">Departement</option>
                                            <option value="email">E-mail</option>
                                            <option value="tel">Telephone</option>
                                        </select>
                                    </label>
                                </td>
                                <td style="padding-left: 15px">
                                    Texte a rechercher :
                                </td>
                                <td>
                                    <label>
                                        <input type="text" class="form-control" name="element" required>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php } elseif ($action == 'supprimer') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Suppr. Employé
                    <a href='form_principale.php?page=administration&source=employes' type='button'
                       class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez sélectionner l'employé à supprimer à l'aide de
                                        la liste deroulante puis cliquez sur le boutton en face pour procéder.</p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=employes/suppr_employes" method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>Employe :</td>
                                <td>
                                    <label>
                                        <select name="code" required class="form-control">
                                            <option disabled selected></option>
                                            <?php
                                                $sql = "SELECT code_emp, prenoms_emp, nom_emp FROM employes ORDER BY nom_emp ASC ";
                                                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                                while ($data = mysqli_fetch_array($res)) {
                                                    echo '<option value="' . $data['code_emp'] . '" >' . $data['prenoms_emp'] . " " . $data['nom_emp'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php }
} elseif ($source == 'fournisseurs') {
    if ($action == 'modifier') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Modif. Fournisseur
                    <a href='form_principale.php?page=administration&source=fournisseurs' type='button'
                       class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez sélectionner le fournisseur à modifier à l'aide
                                        de la liste déroulante puis cliquez sur le boutton en face pour procéder.</p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=fournisseurs/modif_fournisseurs" method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>Fournisseur:</td>
                                <td>
                                    <label>
                                        <select name="code" required class="form-control">
                                            <option disabled selected></option>
                                            <?php
                                                $sql = "SELECT code_four, nom_four FROM fournisseurs ORDER BY nom_four ASC";
                                                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                                while ($data = mysqli_fetch_array($res)) {
                                                    echo '<option value="' . $data['code_four'] . '" >' . $data['nom_four'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php } elseif ($action == 'rechercher') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="icons8-clipboard"> Rechercher > Fournisseur</span>
                    <a href='form_principale.php?page=administration&source=fournisseurs' type='button'
                       class='close'
                       data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez sélectionner le critère de recherche à l'aide
                                        de la liste déroulante. Entrez ensuite le texte a rechercher ou tapez quelques
                                        carateres qui, selon vous, existent dans l'élément a rechercher. Puis, cliquez
                                        sur le boutton en face pour procéder.</p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=fournisseurs/rech_fournisseurs"
                          method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>
                                    Critere :
                                </td>
                                <td>
                                    <label>
                                        <select name="opt" required class="form-control">
                                            <option disabled selected></option>
                                            <option value="matricule">Numero</option>
                                            <option value="nom">Raison Sociale</option>
                                            <option value="adresse">Adresse</option>
                                            <option value="activite">Activite</option>
                                            <option value="email">E-mail</option>
                                            <option value="tel">Telephone</option>
                                            <option value="fax">Fax</option>
                                        </select>
                                    </label>
                                </td>
                                <td style="padding-left: 15px">
                                    Texte a rechercher :
                                </td>
                                <td>
                                    <label>
                                        <input type="text" class="form-control" name="element" required>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php } elseif ($action == 'supprimer') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Suppr. Fournisseur
                    <a href='form_principale.php?page=administration&source=fournisseurs' type='button'
                       class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez selectionner le fournisseur a supprimer a
                                        l'aide de la
                                        liste deroulante puis cliquez sur le boutton en face pour proceder.</p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=fournisseurs/suppr_fournisseurs"
                          method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>Fournisseur :</td>
                                <td>
                                    <label>
                                        <select name="code" required class="form-control">
                                            <option disabled selected></option>
                                            <?php
                                                $sql = "SELECT code_four, nom_four FROM fournisseurs ORDER BY nom_four ASC ";
                                                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                                while ($data = mysqli_fetch_array($res)) {
                                                    echo '<option value="' . $data['code_four'] . '" >' . $data['nom_four'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php }
} elseif ($source == 'demandes') {
    if ($action == 'rechercher') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="icons8-clipboard"> Rechercher > Demandes</span>
                    <a href='form_principale.php?page=accueil' type='button'
                       class='close' data-dismiss='alert' aria-label='Close'
                       style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez selectionner le critere de recherche a l'aide
                                        de la liste deroulante. Entrez ensuite le texte a rechercher ou tapez quelques
                                        carateres qui, selon vous, existent dans l'element a rechercher. Puis, cliquez
                                        sur le boutton en face pour proceder.</p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=demandes/rech_demandes"
                          method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>
                                    Critere :
                                </td>
                                <td>
                                    <label>
                                        <select name="opt" required class="form-control">
                                            <option disabled selected></option>
                                            <option value="numero">Numero</option>
                                            <option value="emp">Employe</option>
                                            <option value="date">Date</option>
                                            <option value="obj">Objet</option>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    Texte a rechercher :
                                </td>
                                <td>
                                    <label>
                                        <input type="text" class="form-control" name="element"
                                               required>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php }
} elseif ($source == 'articles') {
    if ($action == 'rechercher') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="icons8-clipboard"> Rechercher > Article</span>
                    <a href='form_principale.php?page=accueil' type='button'
                       class='close' data-dismiss='alert' aria-label='Close'
                       style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez selectionner le critere de recherche a l'aide
                                        de la liste deroulante. Entrez ensuite le texte a rechercher ou tapez quelques
                                        carateres qui, selon vous, existent dans l'element a rechercher. Puis, cliquez
                                        sur le boutton en face pour proceder.
                                    </p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=articles/rech_articles"
                          method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>
                                    Critere :
                                </td>
                                <td>
                                    <label>
                                        <select name="opt" required class="form-control">
                                            <option disabled selected></option>
                                            <option value="numero">Numero</option>
                                            <option value="groupe">Groupe</option>
                                            <option value="designation">Désignation</option>
                                            <option value="description">Description</option>
                                            <option value="stock">Stock Actuel</option>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    Texte a rechercher :
                                </td>
                                <td>
                                    <label>
                                        <input type="text" class="form-control" name="element"
                                               required>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php } elseif ($action == 'supprimer') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Suppr. Article
                    <a href='form_principale.php?page=accueil' type='button'
                       class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez selectionner l'article a supprimer a l'aide de
                                        la liste
                                        deroulante puis cliquez sur le boutton en face pour proceder.</p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=articles/suppr_articles" method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>Article :</td>
                                <td>
                                    <label>
                                        <select name="code_art" required class="form-control">
                                            <option disabled selected></option>
                                            <?php
                                                $sql = "SELECT * FROM articles ORDER BY designation_art ASC ";
                                                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                                while ($data = mysqli_fetch_array($res)) {
                                                    echo '<option value="' . $data['code_art'] . '" >' . $data['code_art'] . " | " . $data['designation_art'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php } elseif ($action == 'modifier') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Modif. Article
                    <a href='form_principale.php?page=accueil' type='button'
                       class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez selectionner l'article a modifier a l'aide de
                                        la liste
                                        deroulante puis cliquez sur le boutton en face pour proceder a la modification.
                                    </p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="form_principale.php?page=articles/modif_articles" method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td>Article :</td>
                                <td>
                                    <label>
                                        <select name="code_art" required class="form-control">
                                            <option disabled selected></option>
                                            <?php
                                                $sql = "SELECT code_art, designation_art FROM articles ORDER BY designation_art ASC ";
                                                $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                                while ($data = mysqli_fetch_array($res)) {
                                                    echo '<option value="' . $data['code_art'] . '" >' . $data['code_art'] . " | " . $data['designation_art'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-default" type="submit" name="valider"
                                            style="margin-left: 5px">
                                        <span class="ui-icon ui-icon-circle-triangle-e"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    <?php }
} elseif ($source == 'proformas') {
    if ($action == 'rechercher') { ?>

        <div class="col-md-7 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="icons8-clipboard"> Rechercher > Proformas</span>
                    <a href='form_principale.php?page=accueil' type='button'
                       class='close' data-dismiss='alert' aria-label='Close'
                       style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <form action="form_principale.php?page=proformas/rech_proformas"
                          method="post">
                        <table class="formulaire"
                               style="border-collapse: separate; border-spacing: 8px"
                               border="0">
                            <tr>
                                <td class="champlabel">
                                    Veuillez selectionner le critere de recherche :
                                </td>
                                <td>
                                    <label>
                                        <select name="opt" required class="form-control">
                                            <option disabled selected></option>
                                            <option value="numero">Numero</option>
                                            <option value="date_eta">Date d'Etablissement</option>
                                            <option value="date_rcp">Date de Reception</option>
                                            <option value="notes">Notes</option>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">
                                    Texte a rechercher :
                                </td>
                                <td>
                                    <label>
                                        <input type="text" class="form-control" name="element"
                                               required>
                                    </label>
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: center">
                            <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                                Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php }
} elseif ($source == 'bons_commande') {
    if ($action == 'rechercher') { ?>

        <div class="col-md-7 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="icons8-clipboard"> Rechercher > Bons de Commande</span>
                    <a href='form_principale.php?page=accueil' type='button'
                       class='close' data-dismiss='alert' aria-label='Close'
                       style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <form action="form_principale.php?page=bons_commande/rech_bons_commande"
                          method="post">
                        <table class="formulaire"
                               style="border-collapse: separate; border-spacing: 8px"
                               border="0">
                            <tr>
                                <td class="champlabel">
                                    Veuillez selectionner le critere de recherche :
                                </td>
                                <td>
                                    <label>
                                        <select name="opt" required class="form-control">
                                            <option disabled selected></option>
                                            <option value="numero">Numero</option>
                                            <option value="employe">Employe</option>
                                            <option value="fournisseur">Fournisseur</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">
                                    Texte a rechercher :
                                </td>
                                <td>
                                    <label>
                                        <input type="text" class="form-control" name="element"
                                               required>
                                    </label>
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: center">
                            <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                                Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php }
} elseif ($source == 'utilisateurs') {
    if ($action == 'rechercher') { ?>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="icons8-clipboard"> Rechercher</span>
                    <a href='form_principale.php?page=administration&source=utilisateurs' type='button'
                       class='close' data-dismiss='alert' aria-label='Close'
                       style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron info">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-size: small">Veuillez selectionner le critere de recherche a l'aide
                                        de la liste deroulante. Entrez ensuite le texte a rechercher ou tapez quelques
                                        carateres qui, selon vous, existent dans l'element a rechercher. Puis, cliquez
                                        sur le boutton en face pour proceder.</p>
                                </td>
                                <td style="padding-left: 10px; vertical-align: top">
                                    <img src="img/Icons8/About_1.png">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <form action="" method="post">
                        <table class="formulaire" border="0" style="margin-left: auto; margin-right: auto">
                            <tr>
                                <td class="champlabel">
                                    Veuillez selectionner l'employé :
                                </td>
                                <td>
                                    <label>
                                        <input type="text" class="form-control" name="element"
                                               required>
                                    </label>
                                </td>
                            </tr>
                            <tr></tr>
                            <tr></tr>
                        </table>
                        <div style="text-align: center">
                            <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                                Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php }
} ?>