<?php
/**
 * Created by PhpStorm.
 * User: ange-marius.kouakou
 * Date: 15/04/14
 * Time: 11:16
 */
$email_empl = $_SESSION['email'];
?>

    <div class="col-md-7 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                Modification du Mot de Passe
                <a href='form_principale.php?page=accueil' type='button'
                   class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </a>
            </div>
            <div class="panel-body">
                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="text-error" style="text-align: center; font-size: large">Erreur lors de la saisie des mots de passe.</p>';
                } elseif (isset($_GET['success'])) {
                    echo '<p class="text-info" style="text-align: center; font-size: large">Le mot de passe a été modifié avec succès.</p>';
                }
                ?>
                <form action="form_principale.php?page=utilisateurs/modif_mdp" method="POST">
                    <table style="border-collapse: separate; border-spacing: 30px">
                        <tr>
                            <td>
                                <table class="formulaire" style="width= 100%" border="0">
                                    <tr>
                                        <td class="champlabel">Ancien Mot de Passe:</td>
                                        <td>
                                            <input type="password" name="ancien_mdp" size="30"
                                                   placeholder="Mot de passe"
                                                   required class="form-control"
                                                   title="Mot de passe"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="champlabel">Nouveau Mot de Passe:</td>
                                        <td>
                                            <input type="password" name="nvo_mdp" size="30" placeholder="Mot de passe"
                                                   required
                                                   class="form-control"
                                                   title="Entrez le nouveau mot de passe ici" contextmenu="hello"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="champlabel">Nouveau Mot de Passe:</td>
                                        <td>
                                            <input type="password" name="re_nvo_mdp" placeholder="Mot de passe"
                                                   size="30"
                                                   required class="form-control"
                                                   title="Entrez à nouveau le nouveau mot de passe ici"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="margin-left: 20px">
                                <img src="img/Icons8/Key-100.png">
                            </td>
                        </tr>
                    </table>
                    <br/>

                    <div style="text-align: center;">
                        <button class="btn btn-default" type="submit" name="valider">
                            Valider
                        </button>
                        <button class="btn btn-default" type="reset" name="effacer">
                            Effacer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
ob_start();
if (sizeof($_POST) > 0) {
    $req = "SELECT * FROM employes WHERE email_emp = '" . $email_empl . "'";
    if ($resultat = $connexion->query($req)) {
        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
        foreach ($ligne as $data) {
            $mdp = stripslashes($data['mdp']);
        }
    }
    $ancien_mdp = mysqli_real_escape_string($connexion, $_POST['ancien_mdp']);
    $nvo_mdp = mysqli_real_escape_string($connexion, $_POST['nvo_mdp']);
    $re_nvo_mdp = mysqli_real_escape_string($connexion, $_POST['re_nvo_mdp']);
//On vérifie si le mot de passe entré est le bon
    if ($ancien_mdp == $mdp) {
        //On vérifie si les deux nouveaux mot de passe entrés sont identiques
        if ($nvo_mdp == $re_nvo_mdp) {
            $req = "UPDATE employes SET mdp ='" . $nvo_mdp . "' WHERE email_emp ='" . mysqli_real_escape_string($connexion, $email_empl) . "'";
            if ($result = $connexion->query($req)) {
                header("LOCATION: form_principale.php?page=utilisateurs/modif_mdp&success=1");
                echo "Success";
            }
        } else {
            header('Location: form_principale.php?page=utilisateurs/modif_mdp&error=1');
            echo "Failure2";
        }
    } else {
        header('Location: form_principale.php?page=utilisateurs/modif_mdp&error=1');
//        print_r(header());
        echo "Failure1";
    }
}
ob_end_flush();
?>