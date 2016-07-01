<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 27/11/2015
     * Time: 12:44
     */

    if (isset($_POST['code_art'])) {
        $code = $_POST['code_art'];

        $sql = "SELECT * FROM articles WHERE code_art = '" . $code . "'";
        $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
        while ($data = mysqli_fetch_array($res)) :?>
            <!--suppress ALL -->
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="img/icons_1775b9/box_filled.png" width="20" height="20">
                        Suppression Article
                        <a href='form_principale.php?page=form_actions&source=articles&action=supprimer' type='button'
                           class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                            <span aria-hidden='true'>&times;</span>
                        </a>
                    </div>
                    <div class="panel-body">
                        <form action="form_principale.php?page=articles/updatedata" method="POST">
                            <input type="hidden" name="code_art" value="<?php echo $data['code_art']; ?>">
                            <input type="hidden" name="action" value="supprimer">

                            <div class="jumbotron info">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <p style="color: #f81616; font-size: small">Vous êtes sur le point de supprimer l'article
                                                <strong><?php echo $data['code_art']; ?></strong>. Êtes-vous sûr de vouloir continuer cette action?</p>
                                        </td>
                                        <td style="padding-left: 10px; vertical-align: top">
                                            <img src="img/icons_1775b9/roadblock_52.png" height="40" width="40">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <table class="formulaire"
                                   style="margin-left: auto; margin-right: auto; border-spacing: 8px"
                                   border="0">
                                <tr>
                                    <td class="champlabel">Référence :</td>
                                    <td>
                                        <label>
                                            <input type="text" name="code_art" id="code_art" size="10" readonly required
                                                   value="<?php echo $data['code_art']; ?>"
                                                   class="form-control"/>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="champlabel">Désignation :</td>
                                    <td>
                                        <label>
                                            <input type="text" class="form-control" size="30" readonly
                                                   name="designation_art"
                                                   value="<?php echo $data['designation_art']; ?>"/>
                                        </label>
                                    </td>
                                    <td class="champlabel">Stock Initial :</td>
                                    <td>
                                        <label>
                                            <input type="text" name="stock_art" size="3" required readonly
                                                   class="form-control" value="<?php echo $data['stock_art']; ?>"/>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="champlabel">Groupe :</td>
                                    <?php
                                        $code = $data['code_grp'];
                                        $desig = "";
                                        $sql = "SELECT designation_grp FROM groupe_articles WHERE code_grp = '" . $code . "'";
                                        $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                        while ($info = mysqli_fetch_array($res)) {
                                            $desig = $info['designation_grp'];
                                        }
                                    ?>
                                    <td>
                                        <label>
                                            <input type="text" readonly name="code_grp" size="30"
                                                   value="<?php echo $desig; ?>"
                                                   class="form-control"/>
                                        </label>
                                    </td>
                                    <td class="champlabel">Niveau Ciblé :</td>
                                    <td>
                                        <label>
                                            <input type="text" size="2" readonly name="niveau_cible_art"
                                                   value="<?php echo $data['niveau_cible_art']; ?>"
                                                   class="form-control"/>
                                        </label>
                                    </td>
                                    <td class="champlabel" title="Niveau de R�approvisionnement">Niveau Réapp. :</td>
                                    <td>
                                        <label>
                                            <input type="text" name="niveau_reappro_art" size="2" readonly
                                                   value="<?php echo $data['niveau_reappro_art']; ?>"
                                                   class="form-control"/>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="champlabel">Description :</td>
                                    <td colspan="3">
                                        <label>
                                        <textarea cols="30" rows="5" readonly name="description_art"
                                                  style="resize: none"
                                                  class="form-control"><?php echo $data['description_art']; ?></textarea>
                                        </label>
                                    </td>
                                </tr>
                            </table>

                            <br/>

                            <div style="text-align: center;">
                                <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                                    Oui
                                </button>

                                <a class="btn btn-default" style="width: 150px"
                                   href="form_principale.php?page=form_actions&source=articles&action=supprimer"
                                   role="button">Non</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile;
    }
?>