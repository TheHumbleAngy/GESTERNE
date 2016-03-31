<?php
    /*require_once 'bd/connection.php';
    require_once 'fonctions.php';
    error_reporting(0);*/

    $req = "SELECT * FROM employes WHERE email_emp = '" . $_SESSION['email'] . "'";

    $matricule = "";
    $nom_empl = "";
    $prenoms_empl = "";
    $fonction_empl = "";
    $email_empl = "";
    $contact_empl = "";
    $departement_empl = "";

    if ($resultat = $connexion->query($req)) {

        $ligne = $resultat->fetch_all(MYSQL_ASSOC);
        foreach ($ligne as $data) {
            $matricule = stripslashes($data['code_emp']);
            $nom_empl = stripslashes($data['nom_emp']);
            $prenoms_empl = stripslashes($data['prenoms_emp']);
            $fonction_empl = stripslashes($data['fonction_emp']);
            $email_empl = stripslashes($data['email_emp']);
            $contact_empl = stripslashes($data['tel_emp']);
            $departement_empl = stripslashes($data['departement_emp']);
        }
    }
?>

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
            Info. Compte Utilisateur
            <a href='form_principale.php?page=accueil' type='button'
               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                <span aria-hidden='true'>&times;</span>
            </a>
        </div>
        <div class="panel-body">
            <form>
                <table style="border-collapse: separate; border-spacing: 30px">
                    <tr>
                        <td>
                            <table class="formulaire" style="width= 100%" border="0">
                                <tr>
                                    <td class="champlabel">Matricule :</td>
                                    <td>
                                        <label>
                                            <input type="text" name="code_empl" value="<?php echo $matricule; ?>"
                                                   size="15"
                                                   readonly class="form-control"/>
                                        </label>
                                    </td>
                                    <!--<td rowspan="3" class="champlabel" style="text-align: left"><?php /*echo '<img width="125" height="200" src="Images_employés/' . $data['img_emp'] . ' " alt="Photo de Profil" />'; */ ?></td>-->
                                </tr>
                                <tr>
                                    <td class="champlabel">Nom et Prénoms :</td>
                                    <td>
                                        <label>
                                            <input type="text" name="nom_empl"
                                                   value="<?php echo $nom_empl . ' ' . $prenoms_empl; ?>"
                                                   size="35" readonly class="form-control"/>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="champlabel">Fonction :</td>
                                    <td>
                                        <label>
                                            <input type="text" name="fonct_empl" value="<?php echo $fonction_empl; ?>"
                                                   size="35"
                                                   readonly class="form-control"/>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="champlabel">Département :</td>
                                    <td>
                                        <label>
                                            <input type="tel" name="type_empl" value="<?php echo $departement_empl; ?>"
                                                   size="20"
                                                   readonly class="form-control"/>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="champlabel">E-mail :</td>
                                    <td>
                                        <label>
                                            <input type="text" name="email_empl" value="<?php echo $email_empl; ?>"
                                                   size="40"
                                                   readonly class="form-control"/>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="champlabel">Contact :</td>
                                    <td>
                                        <label>
                                            <input type="tel" name="contact_empl" value="<?php echo $contact_empl; ?>"
                                                   size="18"
                                                   readonly class="form-control"/>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="margin-left: 20px">
                            <img src="img/Icons8/utilisateur-100.png">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
</div>