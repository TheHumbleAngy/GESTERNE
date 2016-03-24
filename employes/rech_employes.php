<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 29/10/2015
 * Time: 16:45
 */
//require_once '../bd/connection.php';

if (isset($_POST['opt'])) {
    $option = $_POST['opt'];
    $element = $_POST['element'];

    switch ($option) {
        case 'matricule':
            $sql = "SELECT * FROM employes WHERE code_emp LIKE '%" . $element . "%'";
            break;
        case 'nom':
            $sql = "SELECT * FROM employes WHERE nom_emp LIKE '%" . $element . "%'";
            break;
        case 'prenoms':
            $sql = "SELECT * FROM employes WHERE prenoms_emp LIKE '%" . $element . "%'";
            break;
        case 'fonction':
            $sql = "SELECT * FROM employes WHERE fonction_emp LIKE '%" . $element . "%'";
            break;
        case 'departement':
            $sql = "SELECT * FROM employes WHERE departement_emp LIKE '%" . $element . "%'";
            break;
        case 'email':
            $sql = "SELECT * FROM employes WHERE email_emp LIKE '%" . $element . "%'";
            break;
        case 'tel':
            $sql = "SELECT * FROM employes WHERE tel_emp LIKE '%" . $element . "%'";
            break;
    }

    $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    if ($res->num_rows > 0) { ?>
        <!--suppress ALL -->

        <div style="margin-left: 1.5%; margin-right: 1.5%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Employes
                    <a href='form_principale.php?page=administration&source=employes' type='button' class='close'
                       data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                </div>
                <div class="panel-body" style="overflow: auto">
                    <table border="0" class="table table-hover table-bordered ">
                        <thead>
                        <tr>
                            <th class="entete">Matricule</th>
                            <th class="entete" style="text-align: center">Nom et Prenoms</th>
                            <th class="entete" style="text-align: center">Fonction</th>
                            <th class="entete" style="text-align: center">Departement</th>
                            <th class="entete" style="text-align: center">E-mail</th>
                            <th class="entete" style="text-align: center">Contact</th>
                            <th class="entete" style="text-align: center; width: 18%">Actions</th>
                        </tr>
                        </thead>
                        <?php while ($data = mysqli_fetch_array($res)) { ?>
                            <tr>
                                <td><?php echo stripslashes($data['code_emp']); ?></td>
                                <td><?php echo stripslashes($data['titre_emp']) . " " . stripslashes($data['nom_emp']) . " " . stripslashes($data['prenoms_emp']); ?></td>
                                <td><?php echo stripslashes($data['fonction_emp']); ?></td>
                                <td><?php echo stripslashes($data['departement_emp']); ?></td>
                                <td><?php echo stripslashes($data['email_emp']); ?></td>
                                <td><?php echo stripslashes($data['tel_emp']); ?></td>
                                <td>
                                    <div style="text-align: center">
                                        <a class="btn btn-default modifier" data-toggle="modal"
                                           data-target="#modalModifier<?php echo stripslashes($data['code_emp']); ?>">
                                            <img height="20" width="20" src="img/icons8/ball_point_pen.png"
                                                 title="Modifier"/>
                                        </a>
                                        <a class="btn btn-default modifier" data-toggle="modal"
                                           data-target="#modalSupprimer<?php echo stripslashes($data['code_emp']); ?>">
                                            <img height="20" width="20" src="img/icons8/cancel.png"
                                                 title="Supprimer"/>
                                        </a>
                                    </div>

                                    <!-- Modal Mise � jour des infos -->
                                    <div class="modal fade"
                                         id="modalModifier<?php echo stripslashes($data['code_emp']); ?>"
                                         tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"
                                                        id="modalModifier<?php echo stripslashes($data['code_emp']); ?>">
                                                        Modifications</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <table>
                                                            <tr>
                                                                <td>Titre:</td>
                                                                <td>
                                                                    <label>
                                                                        <input type="text" class="form-control"
                                                                               readonly
                                                                               id="titre_emp<?php echo $data['code_emp']; ?>"
                                                                               value="<?php echo $data['titre_emp']; ?>">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nom:</td>
                                                                <td>
                                                                    <label>
                                                                        <input type="text" class="form-control"
                                                                               id="nom_emp<?php echo $data['code_emp']; ?>"
                                                                               value="<?php echo $data['nom_emp']; ?>">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Prenoms:</td>
                                                                <td>
                                                                    <label>
                                                                        <input type="text" class="form-control"
                                                                               id="pren_emp<?php echo $data['code_emp']; ?>"
                                                                               value="<?php echo $data['prenoms_emp']; ?>">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Fonction:</td>
                                                                <td>
                                                                    <label>
                                                                        <input type="text" class="form-control"
                                                                               id="fct_emp<?php echo $data['code_emp']; ?>"
                                                                               value="<?php echo $data['fonction_emp']; ?>">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Departement:</td>
                                                                <td>
                                                                    <label>
                                                                        <input type="text" class="form-control"
                                                                               id="dpt_emp<?php echo $data['code_emp']; ?>"
                                                                               value="<?php echo $data['departement_emp']; ?>">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>E-mail:</td>
                                                                <td>
                                                                    <label>
                                                                        <input type="email" class="form-control"
                                                                               id="email_emp<?php echo $data['code_emp']; ?>"
                                                                               value="<?php echo $data['email_emp']; ?>">
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Contact:</td>
                                                                <td>
                                                                    <label>
                                                                        <input type="tel" class="form-control"
                                                                               id="tel_emp<?php echo $data['code_emp']; ?>"
                                                                               value="<?php echo $data['tel_emp']; ?>">
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
                                                            onclick="majInfos('<?php echo $data['code_emp']; ?>')">
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal suppression des infos -->
                                    <div class="modal fade"
                                         id="modalSupprimer<?php echo stripslashes($data['code_emp']); ?>"
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
                                                        id="modalSupprimer<?php echo stripslashes($data['code_emp']); ?>">
                                                        Confirmation</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Voulez-vous supprimer
                                                    l'employé <?php echo stripslashes($data['code_emp']); ?>" de la base ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-default" data-dismiss="modal">Non
                                                    </button>
                                                    <button class="btn btn-primary" data-dismiss="modal"
                                                            onclick="suppressionInfos('<?php echo stripslashes($data['code_emp']); ?>')">
                                                        Oui
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    <?php } else {
        echo "
        <div style='width: 400px; margin-right: auto; margin-left: auto; padding-top: 10px'>
            <div class='alert alert-danger alert-dismissible' role='alert' style='width: 60%; margin-right: auto; margin-left: auto'>
                <a href='form_principale.php?page=form_actions&source=employes&action=rechercher' type='button' class='close'
                       data-dismiss='alert' aria-label='Close' style='position: inherit'>
                        <span aria-hidden='true'>&times;</span>
                    </a>
                La recherche n'a renvoye aucun resultat.
            </div>
        </div>
        ";
    }
}
?>
