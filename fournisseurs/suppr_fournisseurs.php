<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 30/10/2015
 * Time: 14:49
 */

if (isset($_POST['code'])) {
    $code = $_POST['code'];

    $sql = "SELECT * FROM fournisseurs WHERE code_four = '" . $code . "'";
    $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    while ($data = mysqli_fetch_array($res)) : ?>

        <div class="col-md-9" style="margin-left: 12.66%">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                    Suppression Fournisseur
                    <a href='form_principale.php?page=administration&source=fournisseurs' type='button' class='close'
                       data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body">
                    <form action="form_principale.php?page=form_actions&source=fournisseurs&action=supprimer" method="post">
                        <input type="hidden" name="code_four" value="<?php echo $data['code_four']; ?>">
                        <input type="hidden" name="action" value="supprimer">

                        <div class="jumbotron"
                             style="width: 70%; padding: 30px 30px 20px 30px; background-color: rgba(1, 139, 178, 0.1); margin-left: auto; margin-right: auto">
                            <p style="color: red; font-size: small">Voulez-vous vraiment supprimer le fournisseur
                                <strong><?php echo $data['code_four']; ?></strong>?</p>
                        </div>
                        <table class="formulaire"
                               style="width= 100%; margin-left: auto; margin-right: auto"
                               border="0">
                            <tr>
                                <td class="champlabel">Raison Sociale :</td>
                                <td>
                                    <label>
                                        <input type="text" name="nom_four" size="30" required readonly
                                               class="form-control" value="<?php echo $data['nom_four']; ?>"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">E-mail :</td>
                                <td>
                                    <label>
                                        <input type="email" name="email_four" size="30" required readonly
                                               class="form-control" value="<?php echo $data['email_four']; ?>"/>
                                    </label>
                                </td>
                                <td></td>
                                <td class="champlabel">Contact Pro. :</td>
                                <td>
                                    <label>
                                        <input type="tel" name="telephonepro_four" size="15" required readonly
                                               class="form-control" value="<?php echo $data['telephonepro_four']; ?>"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Activite :</td>
                                <td>
                                    <label>
                                        <input type="text" name="activite_four" size="30" required readonly
                                               class="form-control" value="<?php echo $data['activite_four']; ?>"/>
                                    </label>
                                </td>
                                <td></td>
                                <td class="champlabel">Fax :</td>
                                <td><label>
                                        <input type="tel" name="fax_four" size="15" required readonly
                                               class="form-control" value="<?php echo $data['fax_four']; ?>"/>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="champlabel">Adresse :</td>
                                <td>
                                    <label>
                                        <textarea name="adresse_four" rows="4" cols="25" style="resize: none" required
                                                  readonly
                                                  class="form-control"><?php echo $data['adresse_four']; ?></textarea>
                                    </label>
                                </td>
                                <td></td>
                                <td class="champlabel">Notes :</td>
                                <td>
                                    <label>
                                        <textarea name="notes_four" rows="4" cols="25" style="resize: none" required
                                                  readonly
                                                  class="form-control"><?php echo $data['notes_four']; ?></textarea>
                                    </label>
                                </td>
                            </tr>
                            <tr>

                            </tr>
                        </table>
                        <br>

                        <div style="text-align: center;">
                            <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                                Oui
                            </button>

                            <a class="btn btn-default" href="form_principale.php?page=administration&source=fournisseurs" role="button" style="width: 150px">Non</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <?php endwhile;
}
?>