<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 13/11/2015
 * Time: 11:07
 */
require_once '../bd/connection.php';
$action = $_POST['action'];
?>

<?php if ($action == "ajout"): ?>
    <div class="col-md-7 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                Utilisateur > Ajout
                <a href='form_principale.php?page=administration&source=utilisateurs' type='button'
                   class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </a>
            </div>
            <div class="panel-body">
                <form method="post" action="">
                    <table class="formulaire" style="width: 100%; margin-left: auto; margin-right: auto;" border="0">
                        <tr>
                            <td class="champlabel">Employe: </td>
                            <td>
                                <label>
                                    <select class="form-control employe" name="emp" required>
                                        <option disabled selected></option>
                                        <?php
                                        $sql = "SELECT code_emp, nom_emp, prenoms_emp FROM employes WHERE code_emp NOT IN (SELECT code_emp FROM droits) ORDER BY nom_emp ASC ";
                                        $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                        while ($data = mysqli_fetch_array($res)) {
                                            echo '<option value="' . $data['code_emp'] . '">' . $data['prenoms_emp'] . ' ' . $data['nom_emp'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </label>
                            </td>
                            <td></td><td></td><td></td><td></td>
                            <td rowspan="2" style="padding-right: 0">
                                <img src="img/Icons8/add_user-100.png" height="80" width="80">
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">Groupe:</td>
                            <td>
                                <label>
                                    <select class="form-control" name="compte" required>
                                        <option disabled selected></option>
                                        <option value="administrateur">Administrateur</option>
                                        <option value="moyens generaux">Moyens Generaux</option>
                                        <option value="normal">Normal</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                    </table>
                    <br/>

                    <div style="text-align: center">
                        <input type="hidden" name="validation" value="<?php echo 'valider ' . $action; ?>">
                        <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                            Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php elseif ($action == "modification"): ?>
    <div class="col-md-7 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                Utilisateur > Modification
                <a href='form_principale.php?page=administration&source=utilisateurs' type='button'
                   class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </a>
            </div>
            <div class="panel-body">
                <form method="post" action="">
                    <table style="border-collapse: separate; border-spacing: 10px" border="0">
                        <tr>
                            <td class="champlabel">Employe: </td>
                            <td>
                                <label>
                                    <select class="form-control" name="emp" required>
                                        <option disabled selected></option>
                                        <?php //la liste des employes à qui un droit a déjà été attriué
                                        $sql = "SELECT code_emp, nom_emp, prenoms_emp FROM employes WHERE code_emp IN (SELECT code_emp FROM droits) ORDER BY nom_emp ASC ";
                                        $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
                                        while ($data = mysqli_fetch_array($res)) {
                                            echo '<option value="' . $data['code_emp'] . '" >' . $data['prenoms_emp'] . ' ' . $data['nom_emp'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </label>
                            </td>
                            <td></td><td></td><td></td><td></td>
                            <td rowspan="2" style="padding-right: 0">
                                <img src="img/Icons8/edit_user.png" height="80" width="80">
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">Groupe:</td>
                            <td>
                                <label>
                                    <select class="form-control" name="compte" required>
                                        <option disabled selected></option>
                                        <option value="administrateur">Administrateur</option>
                                        <option value="moyens generaux">Moyens Generaux</option>
                                        <option value="normal">Normal</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                    </table>
                    <br/>

                    <div style="text-align: center">
                        <input type="hidden" name="validation" value="<?php echo 'valider ' . $action; ?>">
                        <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                            Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php elseif ($action == "liste"): ?>
    <div class="col-md-7 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
                Utilisateurs
                <a href='form_principale.php?page=administration&source=utilisateurs' type='button'
                   class='close' data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </a>
            </div>
            <div class="panel-body" style="overflow: auto">
                <table border="0" class="table table-hover table-bordered ">
                    <thead>
                    <tr>
                        <td class="entete" style="text-align: center">Matricule</td>
                        <td class="entete" style="text-align: center">Utilisateur</td>
                        <td class="entete" style="text-align: center">Groupe</td>
                    </tr>
                    </thead>
                    <?php
                        $sql = "SELECT e.code_emp, e.nom_emp, e.prenoms_emp, d.libelle_droit
                                FROM employes AS e
                                INNER JOIN droits AS d
                                ON e.code_emp = d.code_emp
                                WHERE e.code_emp IN (SELECT code_emp FROM droits) ORDER BY e.nom_emp ASC ";

                        if ($resultat = $connexion->query($sql)) {
                            $ligne = $resultat->fetch_all(MYSQL_ASSOC);
                            foreach ($ligne as $list) {
                                ?>
                                <tr>
                                    <td><?php echo stripslashes($list['code_emp']); ?></td>
                                    <td><?php echo stripslashes($list['prenoms_emp']) . ' ' . stripslashes($list['nom_emp']); ?></td>
                                    <td><?php echo stripslashes($list['libelle_droit']); ?></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

<?php endif; ?>