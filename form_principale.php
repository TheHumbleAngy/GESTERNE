<?php
    ob_start();
    require_once 'bd\connection.php';
    require_once 'fonctions.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
    }

    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

    $page = "accueil";
    if (isset($_GET['page']))
        $page = $_GET['page'];
    $page .= '.php';

    header('Content-Type: text/html; charset=utf-8');

    $sql = "SELECT nom_emp, prenoms_emp FROM employes WHERE code_emp = '" . $_SESSION['user_id'] . "'";
    if ($resultat = $connexion->query($sql)) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
        foreach ($ligne as $data) {
            $nom = $data['prenoms_emp'] . ' ' . $data['nom_emp'];
            ?>

            <!DOCTYPE html>
            <head>
                <meta charset="utf-8">
                <link type="text/css" href="css_js/bootstrap-3.3.4-dist/css/bootstrap.css" rel="stylesheet">
                <link type="text/css" href="css_js/bootstrap-3.3.4-dist/css/bootstrap-theme.css" rel="stylesheet">
                <link type="text/css" href="css_js/bootstrap-table-master/src/bootstrap-table.css" rel="stylesheet">
                <link type="text/css" href="css_js/menu_nav.css" rel="stylesheet"/>
                <link type="text/css" href="css_js/stylish.css" rel="stylesheet">
                <link type="text/css" href="css_js/jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet">
                <link type="text/css" href="css_js/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
                <link type="text/css" href="css_js/windows-10-icons-1.0.0/windows-10-icons-1.0.0/font/styles.min.css"
                      rel="stylesheet">

                <script src="css_js/bootstrap-3.3.4-dist/js/jquery-1.11.3.js"></script>
                <script src="css_js/bootstrap-3.3.4-dist/js/bootstrap.js"></script>
                <script src="css_js/bootstrap-table-master/src/bootstrap-table.js"></script>
                <script src="css_js/menu_vertical.js"></script>
                <script src="css_js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
                <script src="css_js/bootstrap3-editable/js/bootstrap-editable.js"></script>

                <link rel="shortcut icon" href="img/icone_ncare.ico"/>

                <title>Gestion de Stock</title>
            </head>
            <html>
        <body class="arriere_plan">
        <?php //header('Content-Type: text/html; charset=UTF-8'); ?>
        <div class="container" style="padding-right: 0; padding-left: 0">

            <div style="position: fixed; top: 0; z-index: 100; width: 100%; box-shadow: 0 0 8px #000">
                <!-- Entête -->
                <div class="row hautdepage">
                    <div class="col-md-12 nopadding">
                        <div class="row nomargin_lr">
                            <div class="col-md-3 nopadding">
                                <div class="logo_entete">
                                    <a href="form_principale.php?page=accueil">
                                        <img alt="Logo" src="img/logowebsitencare.png" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-md-offset-6" style="color: #01addd; text-align: right; top: -5px">
                                <p style="padding-top: 40px; margin: 0"><?php echo utf8_encode(ucwords(strftime("%A %d %B %Y"))); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Entête -->

                <!-- Menu horizontal -->
                <div class="row menuhorizontal" style="">
                    <div class="col-md-12 nopadding">
                        <div style="max-width: 100%; height: 44px; background-color: #01addd; position: relative;">
                            <ul class="nav main">
                                <li class="ic-form-style">
                                    <a>
                                        <span>Fichiers</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="form_principale.php?page=demandes/form_demandes&action=ajout">Demande</a>
                                        </li>
                                        <li><a href="form_principale.php?page=proformas/form_proformas">Proforma</a>
                                        </li>
                                        <li><a href="form_principale.php?page=bons_commande/form_bon_commande">Bon de
                                                Commande</a></li>
                                        <li><a href="form_principale.php?page=factures/form_factures">Facture</a></li>
                                        <li><a href="form_principale.php?page=bons_livraison/form_bons_livraison">Bon de
                                                Livraison</a></li>
                                    </ul>
                                </li>
                                <li class="ic-grid-tables">
                                    <a>
                                        <span>Listes</span>
                                    </a>
                                    <ul>
                                        <li><a href="form_principale.php?page=employes/liste_employes">Employés</a></li>
                                        <li>
                                            <a href="form_principale.php?page=fournisseurs/liste_fournisseurs">Fournisseurs</a>
                                        </li>
                                        <li><a href="form_principale.php?page=demandes/liste_demandes">Demandes</a></li>
                                        <li><a href="form_principale.php?page=proformas/liste_proformas">Proformas</a>
                                        </li>
                                        <li><a href="form_principale.php?page=bons_de_livraison/liste_bordereaux">Bons
                                                de
                                                Livraison</a></li>
                                        <li><a href="form_principale.php?page=factures/liste_factures">Factures</a></li>
                                    </ul>
                                </li>
                                <li class="ic-imprimer">
                                    <a>
                                        <span>Imprimer</span>
                                    </a>
                                    <ul>
                                        <li><a href="employes/fiche_employes.php" target="_blank">Liste des Employés</a>
                                        </li>
                                        <li><a href="fournisseurs/fiche_fournisseurs.php" target="_blank">Liste
                                                des Fournisseurs</a>
                                        </li>
                                        <li><a href="articles/fiche_articles.php" target="_blank">Liste des Articles</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="ic-statistique">
                                    <a>
                                        <span>Statistiques</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="form_principale.php?page=">Etats Periodiques</a>
                                        </li>
                                        <li>
                                            <a href="form_principale.php?page=">Utilisation/Employé</a>
                                        </li>
                                        <li>
                                            <a href="form_principale.php?page=">Interaction/Fournisseur</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="ic-recherche">
                                    <a>
                                        <span>Recherche</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="form_principale.php?page=form_actions&source=employes&action=rechercher">Employés</a>
                                        </li>
                                        <li>
                                            <a href="form_principale.php?page=form_actions&source=fournisseurs&action=rechercher">Fournisseurs</a>
                                        </li>
                                        <li>
                                            <a href="form_principale.php?page=form_actions&source=demandes&action=rechercher">Demandes</a>
                                        </li>
                                        <li>
                                            <a href="form_principale.php?page=form_actions&source=proformas&action=rechercher">Proformas</a>
                                        </li>
                                        <li>
                                            <a href="form_principale.php?page=form_actions&source=factures&action=rechercher">Factures</a>
                                        </li>
                                        <li>
                                            <a href="form_principale.php?page=form_actions&source=bons_commande&action=rechercher">Bons
                                                de Commande</a></li>
                                        <li>
                                            <a href="form_principale.php?page=form_actions&source=bons_livraison&action=rechercher">Bons
                                                de Livraison</a></li>
                                    </ul>
                                </li>
                                <li class="ic-a_propos">
                                    <a href="form_principale.php?page=a_propos">
                                        <span>A propos</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Fin Menu horizontal -->
            </div>

            <!-- Corps de page -->
            <div class="row corpsdepage" style="overflow: auto; position: relative; top: 110px; ">
                <!-- Menu vertical -->
                <div class="col-md-2 nopadding" style="border-right: 1px solid #01addd; position: fixed; top: 115px">
                    <div class="box sidemenu">
                        <ul class="section menu">
                            <li>
                                <a>Administration</a>
                                <ul>
                                    <li>
                                        <a href="form_principale.php?page=administration&source=employes">Employés</a>
                                    </li>
                                    <li>
                                        <a href="form_principale.php?page=administration&source=fournisseurs">Fournisseurs</a>
                                    </li>
                                    <li>
                                        <a href="form_principale.php?page=administration&source=utilisateurs">Utilisateurs</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a>Gestion des Articles</a>
                                <ul>
                                    <li>
                                        <a href="form_principale.php?page=articles/form_articles">Ajouter un Article</a>
                                    </li>
                                    <li>
                                        <a href="form_principale.php?page=form_actions&source=articles&action=modifier">Modifier
                                            un Article</a>
                                    </li>
                                    <li>
                                        <a href="form_principale.php?page=form_actions&source=articles&action=supprimer">Supprimer
                                            un Article</a>
                                    </li>
                                    <li>
                                        <a href="form_principale.php?page=articles/liste_articles">Lister les
                                            Articles</a>
                                    </li>
                                    <li>
                                        <a href="form_principale.php?page=form_actions&source=articles&action=rechercher">Rechercher
                                            un Article</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a>Mouvements de Stock</a>
                                <ul>
                                    <li>
                                        <a href="form_principale.php?page=articles/mouvements_stock&action=entree">Entrées
                                            d'Articles</a>
                                    </li>
                                    <li>
                                        <a href="form_principale.php?page=articles/mouvements_stock&action=sortie">Sorties
                                            d'Articles</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a>Gestion des Sorties</a>
                                <ul>
                                    <li>
                                        <a href="">1</a>
                                    </li>
                                    <li>
                                        <a href="">2</a>
                                    </li>
                                    <li>
                                        <a href="">3</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Fin Menu vertical -->
                <div class="col-md-8 nopadding col-xs-offset-2">
                    <div style="margin-bottom: 10px"></div>

                    <?php include($page); ?>


                </div>
                <!-- Widget -->
                <div class="col-md-2 col-md-offset-10"
                     style="position: fixed; top: 116px; padding-left: 0; padding-right: 5px">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center; font-size: 12px">
                            <?php echo 'Bonjour ' . $nom . ' !'; ?>
                        </div>
                        <div class="panel-body">
                            <ul class="widget">
                                <li><a href="form_principale.php?page=accueil"><span class="icons8-home"> Accueil</span></a>
                                </li>
                                <li><a href="form_principale.php?page=utilisateurs/infos_utilisateur"><span
                                            class="icons8-gender-neutral-user"> Mon Compte</span></a></li>
                                <li><a href="form_principale.php?page=utilisateurs/modif_mdp"><span class="icons8-key"> Changer de Mot de Passe</span></a>
                                </li>
                                <li><a href="processing.php"><span class="icons8-shutdown"> Déconnexion</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Fin widget -->
            </div>
        </div>
        </body>

            <?php
        }
    }
    ob_end_flush();
?>