<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 27/11/2015
     * Time: 17:12
     */

    if (isset($_POST['code'])) {
        $code = $_POST['code'];

        $sql = "SELECT * FROM articles WHERE code_art = '" . $code . "'";
        $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
        while ($data = mysqli_fetch_array($res)) :?>

            <!--suppress ALL -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Formulaire Article
                            <a href='form_principale.php?page=form_actions&source=articles&action=modifier'
                               type='button'
                               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                                <span aria-hidden='true'>&times;</span>
                            </a>
                        </div>
                        <div class="panel-body">
                            <div class="jumbotron info">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <p style="color: grey; font-size: small"><strong>Modification des infos.</strong><br/>
                                                Les champs precedes de "*" sont imperatifs,
                                                veuillez donc les renseigner.</p>
                                        </td>
                                        <td style="padding-left: 10px; vertical-align: top">
                                            <img src="img/Icons8/About_1.png" height="30" width="30">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <form method="post" action="form_principale.php?page=articles/maj_articles">
                                <input type="hidden" name="code_art" value="<?php echo $data['code_art']; ?>">
                                <input type="hidden" name="action" value="maj">
                                <table class="formulaire"
                                       style="width: 100%"
                                       border="0">
                                    <tr>
                                        <td class="champlabel">Référence :</td>
                                        <td>
                                            <label>
                                                <input type="text" name="code_art" id="code_art" size="10" readonly
                                                       required
                                                       value="<?php echo $data['code_art']; ?>"
                                                       class="form-control"/>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="champlabel">*Désignation :</td>
                                        <td colspan="3">
                                            <label>
                                                <input type="text" name="designation_art" size="30" required
                                                       onblur="this.value = this.value.toUpperCase();"
                                                       class="form-control"
                                                       value="<?php echo $data['designation_art']; ?>"/>
                                            </label>
                                        </td>
                                        <td class="champlabel">*Stock Actuel :</td>
                                        <td colspan="3">
                                            <label>
                                                <input type="number" name="stock_art" size="3" min="0" required
                                                       class="form-control"
                                                       value="<?php echo $data['stock_art']; ?>"/>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="champlabel">Groupe :</td>
                                        <td colspan="3">
                                            <label>
                                                <select class="form-control" name="code_grp" required>
                                                    <option disabled></option>
                                                    <?php
                                                        $sql = "SELECT code_grp, designation_grp FROM groupe_articles ORDER BY designation_grp ASC ";
                                                        $res = mysqli_query($connexion, $sql);
                                                        while ($data_grp = mysqli_fetch_array($res)) {
                                                            if ($data['code_grp'] == $data_grp['code_grp']) {
                                                                echo '<option value="' . $data_grp['code_grp'] . '" selected >' . $data_grp['designation_grp'] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $data_grp['code_grp'] . '" >' . $data_grp['designation_grp'] . '</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </label>
                                        </td>
                                        <td class="champlabel">Niveau Ciblé :</td>
                                        <td>
                                            <label>
                                                <input type="number" name="niveau_cible_art" size="3" min="0"
                                                       class="form-control"
                                                       value="<?php echo $data['niveau_cible_art']; ?>"/>
                                            </label>
                                        </td>
                                        <td class="champlabel" title="Niveau de R�approvisionnement">Niveau Réapp. :
                                        </td>
                                        <td>
                                            <label>
                                                <input type="number" name="niveau_reappro_art" size="3" min="0"
                                                       class="form-control"
                                                       value="<?php echo $data['niveau_reappro_art']; ?>"/>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="champlabel">*Description :</td>
                                        <td rowspan="1" colspan="3">
                                            <label>
                                        <textarea name="description_art" cols="30" rows="3" required
                                                  style="resize: none"
                                                  class="form-control"><?php echo $data['description_art']; ?></textarea>
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                                <br/>

                                <div style="text-align: center;">
                                    <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                                        Valider
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile;
    }
?>