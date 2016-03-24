<?php
require_once 'fonctions.php';
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css_js/bootstrap-3.3.4-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css_js/bootstrap-3.3.4-dist/css/bootstrap-theme.css">
    <link rel="stylesheet" href="css_js/stylish.css">
    <link rel="stylesheet" href="css_js/windows-10-icons-1.0.0/windows-10-icons-1.0.0/font/styles.min.css">
    <script src="css_js/bootstrap-3.3.4-dist/js/jquery-1.11.3.js"></script>
    <script src="css_js/bootstrap-3.3.4-dist/js/bootstrap.js"></script>

    <link rel="shortcut icon" href="img/icone_ncare.ico"/>

    <title>NCA Re | Gesterne</title>

</head>
<body class="arriere_plan">
<div class="connection">
    <div class="centrer_image">
        <img src="img/logo2.jpg" width="80"/>
    </div>
    <div class="titre">
        <h2 style="color: #01addd">
            Gestion Automatisée de Biens & Services
        </h2>
    </div>
    <div class="sb sb_blue">
        <div class="box_title">
            <p style="margin: 0; font-size: 16px; font-weight: bold">
                <span class="icons8-lock-2" style="font-size: 24px"> Login</span>
            </p>
        </div>
        <div class="box_content" style="overflow: auto">
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 1) {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: inherit">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                Erreur de connection! Veuillez verifier les informations entrées.
                              </div>';
                } else {
                    echo '<div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: inherit">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Oups!</strong><br/> Vous êtes déjà connecté à partir d\'un autre navigateur! Veuillez vous en déconnecter avant de continuer.
                              </div>';
                }
            }
            ?>
            <form action="processing.php" method="post" id="myForm">
                <table border="0" style="border-collapse: separate; border-spacing: 8px">
                    <tbody>
                    <tr class="champ">
                        <td style="width: 25%; margin: auto">Identifiant :</td>
                        <td style="width: 75%; text-align: center">
                            <input type="email" name="email"
                                   class="form-control" placeholder="Adresse e-mail"
                                   required size="35">
                        </td>
                    </tr>
                    <tr class="champ">
                        <td style="width: 25%; margin: auto">Mot de passe :</td>
                        <td style="width: 75%; text-align: center">
                            <input type="password" name="password"
                                   class="form-control" placeholder="Mot de passe"
                                   required size="35">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br/>

                <div class="centrer_boutton" style="width: 170px">
                    <button class="btn btn-default" type="submit" name="connexion" style="width: 100%">
                        <span class="icons8-unlock-2">Se Connecter</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#myForm').reset();
    });
    function myFunction() {
        alert("Hello");

//        return "Hello";
    }
</script>

</body>
</html>