<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 30-Sep-15
     * Time: 4:36 PM
     *
     * Ce script génère la liste des articles où des opérations de modifications et suppressions peuvent
     * être faites sur chaque article
     */
    require_once '../bd/connection.php';
?>

<!--suppress ALL -->
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
            Liste des Articles
            <a href='form_principale.php?page=accueil' type='button'
               class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                <span aria-hidden='true'>&times;</span>
            </a>
        </div>
        <div class="panel-body" style="overflow: auto">
            <div class="">
                <table border="0" class="table table-hover table-bordered ">
                    <thead>
                    <tr>
                        <th class="entete" style="text-align: center; width: 5%">Numéro</th>
                        <th class="entete" style="text-align: center; width: 20%">Désignation</th>
                        <th class="entete" style="text-align: center; width: 18%">Groupe</th>
                        <th class="entete" style="text-align: center; width: 30%">Description</th>
                        <th class="entete" style="text-align: center; width: 14%">Détails</th>
                        <!--                        <td class="entete" style="text-align: center">Categorie</td>-->
                        <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')): ?>
                        <th class="entete" style="text-align: center; width: 13%">Actions</th>
                        <?php //endif ?>
                    </tr>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM articles ORDER BY code_art ASC";
                        if ($valeur = $connexion->query($sql)) {
                            $ligne = $valeur->fetch_all(MYSQL_ASSOC);
                            foreach ($ligne as $list) {
                                ?>
                                <tr>
                                    <td><?php echo stripslashes($list['code_art']); ?></td>
                                    <td><?php echo ucfirst(stripslashes($list['designation_art'])); ?></td>
                                    <td>
                                        <?php
                                            $code = $list['code_grp'];
                                            $desig = "";
                                            $sql = "SELECT designation_grp FROM groupe_articles WHERE code_grp = '" . $code . "'";
                                            $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                            while ($info = mysqli_fetch_array($res)) {
                                                echo $desig = $info['designation_grp'];
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo mysqli_real_escape_string($connexion, stripslashes($list['description_art'])); ?></td>
                                    <td><?php echo "Stock Actuel : " . stripslashes($list['stock_art']) . "<br>Niveau Réappro. : " . stripslashes($list['niveau_reappro_art']) . "<br>Niveau Ciblé : " . stripslashes($list['niveau_cible_art']); ?></td>
                                    <?php //if (($_SESSION['type_utilisateur'] == 'administrateur') || ($_SESSION['type_utilisateur'] == 'moyens_genereaux')): ?>
                                    <td style="text-align: center">
                                        <div style="text-align: center">
                                            <a class="btn btn-default modifier" data-toggle="modal"
                                               data-target="#modalModifier<?php echo stripslashes($list['code_art']); ?>">
                                                <img height="20" width="20" src="img/icons8/ball_point_pen.png"
                                                     title="Modifier"/>
                                            </a>
                                            <a class="btn btn-default modifier" data-toggle="modal"
                                               data-target="#modalSupprimer<?php echo stripslashes($list['code_art']); ?>">
                                                <img height="20" width="20" src="img/icons8/cancel.png"
                                                     title="Supprimer"/>
                                            </a>
                                        </div>

                                        <!-- Modal Mise à jour des infos -->
                                        <div class="modal fade"
                                             id="modalModifier<?php echo stripslashes($list['code_art']); ?>"
                                             tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title"
                                                            id="modalModifier<?php echo stripslashes($list['code_art']); ?>">
                                                            <?php echo stripslashes($list['code_art']); ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <table border="0" class="formulaire"
                                                                   style="text-align: left; width: 100%; margin-left: auto; margin-right: auto">
                                                                <tr>
                                                                    <td class="champlabel">*Désignation:</td>
                                                                    <td>
                                                                        <label>
                                                                            <input type="text" size="30" required
                                                                                   id="designation_art<?php echo $list['code_art']; ?>"
                                                                                   value="<?php echo $list['designation_art']; ?>"
                                                                                   onblur="this.value = this.value.toUpperCase();"
                                                                                   class="form-control"/>
                                                                        </label>
                                                                    </td>
                                                                    <td class="champlabel">Stock :</td>
                                                                    <td>
                                                                        <label>
                                                                            <input type="number" size="2"
                                                                                   id="stock_art<?php echo $list['code_art']; ?>"
                                                                                   value="<?php echo $list['stock_art']; ?>"
                                                                                   class="form-control"/>
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="champlabel">*Groupe :</td>
                                                                    <td>
                                                                        <label>
                                                                            <select class="form-control"
                                                                                    id="code_grp<?php echo $list['code_art']; ?>"
                                                                                    name="code_grp" required>
                                                                                <option disabled selected></option>
                                                                                <?php
                                                                                    $sql = "SELECT code_grp, designation_grp FROM groupe_articles ORDER BY designation_grp ASC ";
                                                                                    $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                                                                    while ($data = mysqli_fetch_array($res)) {
                                                                                        if ($list['code_grp'] == $data['code_grp']) {
                                                                                            echo '<option value="' . $data['code_grp'] . '" selected >' . $data['designation_grp'] . '</option>';
                                                                                        } else {
                                                                                            echo '<option value="' . $data['code_grp'] . '" >' . $data['designation_grp'] . '</option>';
                                                                                        }
                                                                                        echo '<option value="' . $data['code_grp'] . '" >' . $data['designation_grp'] . '</option>';
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </label>
                                                                    </td>
                                                                    <td class="champlabel">Niveau Ciblé:</td>
                                                                    <td>
                                                                        <label>
                                                                            <input type="number" size="3" min="0"
                                                                                   id="niveau_cible_art<?php echo $list['code_art']; ?>"
                                                                                   value="<?php echo $list['niveau_cible_art']; ?>"
                                                                                   class="form-control"/>
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="champlabel">Description:</td>
                                                                    <td rowspan="1">
                                                                        <label>
                                                                            <textarea cols="30" rows="5"
                                                                                      id="description_art<?php echo $list['code_art']; ?>"
                                                                                      required style="resize: none"
                                                                                      class="form-control"><?php echo $list['description_art']; ?></textarea>
                                                                        </label>
                                                                    </td>
                                                                    <td class="champlabel">Niveau Réapp. :</td>
                                                                    <td>
                                                                        <label>
                                                                            <input type="number" size="3" min="0"
                                                                                   id="niveau_reappro_art<?php echo $list['code_art']; ?>"
                                                                                   name="niveau_reappro_art"
                                                                                   value="<?php echo $list['niveau_reappro_art']; ?>"
                                                                                   class="form-control"/>
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">Fermer
                                                        </button>
                                                        <button class="btn btn-primary" data-dismiss="modal"
                                                                onclick="majInfos('<?php echo $list['code_art']; ?>')">
                                                            Enregistrer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal suppression des infos -->
                                        <div class="modal fade"
                                             id="modalSupprimer<?php echo stripslashes($list['code_art']); ?>"
                                             tabindex="-1"
                                             role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title"
                                                            id="modalSupprimer<?php echo stripslashes($list['code_art']); ?>">
                                                            Confirmation de Suppression</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Voulez-vous supprimer
                                                        l'article <?php echo stripslashes($list['code_art']); ?> ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">Non
                                                        </button>
                                                        <button class="btn btn-primary" data-dismiss="modal"
                                                                onclick="suppressionInfos('<?php echo stripslashes($list['code_art']); ?>')">
                                                            Oui
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <?php //endif ?>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </div>
            <!--<a href="biens_services/impression_biens_ou_services.php" target="_blank"
               title="Télécharger">
                <img src="img/File_Pdf.png" width="40px" height="40px" alt="File" title="Télécharger"/><br/>

                <p>Imprimer</p>
            </a>-->
        </div>
    </div>
</div>
