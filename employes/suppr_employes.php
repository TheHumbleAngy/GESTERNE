<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 29/10/2015
 * Time: 10:01
 */

if (isset($_POST['code'])) {
    $code = $_POST['code'];

    $sql = "SELECT * FROM employes WHERE code_emp = '" . $code . "'";
    $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    while ($data = mysqli_fetch_array($res)) :?>
        <!--suppress ALL -->
        <div class="col-md-9" style="margin-left: 12.66%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="img/icons_1775b9/remove_user.png" width="20" height="20">
                    Suppression Employé
                    <a href='form_principale.php?page=form_actions&source=employes&action=supprimer' type='button' class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <form action="form_principale.php?page=employes/updatedata" method="POST">
                        <input type="hidden" name="code_emp" value="<?php echo $data['code_emp']; ?>">
                        <input type="hidden" name="action" value="supprimer">
                        <div class="jumbotron info">
                            <table border="0">
                                <tr>
                                    <td>
                                        <p style="color: #f81616; font-size: small">Voulez-vous vraiment supprimer l'employé <strong><?php echo $data['code_emp']; ?></strong>?</p>
                                    </td>
                                    <td style="padding-left: 10px; vertical-align: top">
                                        <img src="img/icons_1775b9/roadblock_52.png" height="40" width="40" style="margin-bottom: 15px">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table class="formulaire"
                               style="width= 100%; margin-right: auto; margin-left: auto"
                               border="0">
                            <tr>
                                <td class="champlabel">Titre :</td>
                                <td>
                                    <label>
                                        <input type="text" name="titre_emp" class="form-control" size="3" readonly
                                               value="<?php echo $data['titre_emp']; ?>"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Nom :</td>
                                <td>
                                    <label>
                                        <input type="text" name="nom_emp" class="form-control" readonly
                                               value="<?php echo $data['nom_emp']; ?>"/>
                                    </label>
                                </td>
                                <td class="champlabel">Prénoms :</td>
                                <td>
                                    <label>
                                        <input type="text" name="prenoms_emp" size="40" class="form-control" readonly
                                               value="<?php echo $data['prenoms_emp']; ?>"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Fonction :</td>
                                <td>
                                    <label>
                                        <input type="text" name="fonction_emp" class="form-control" readonly
                                               value="<?php echo $data['fonction_emp']; ?>"/>
                                    </label>
                                </td>
                                <td class="champlabel">Département :</td>
                                <td>
                                    <label>
                                        <input type="text" name="departement_emp" required class="form-control" readonly
                                               value="<?php echo $data['departement_emp']; ?>"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">E-mail :</td>
                                <td>
                                    <label>
                                        <input type="email" name="email_emp" size="30" required class="form-control" readonly
                                               value="<?php echo $data['email_emp']; ?>"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Contact :</td>
                                <td>
                                    <label>
                                        <input type="tel" name="tel_emp" required class="form-control" readonly
                                               value="<?php echo $data['tel_emp']; ?>"/>
                                    </label>
                                </td>
                            </tr>
                        </table>
                        <br/>

                        <div style="text-align: center;">
                            <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                                Oui
                            </button>

                            <a class="btn btn-default" href="form_principale.php?page=form_actions&source=employes&action=supprimer" role="button" style="width: 150px">Non</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endwhile;
}
?>