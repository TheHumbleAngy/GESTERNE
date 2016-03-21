<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 25/01/2016
     * Time: 17:13
     */
    require_once '../bd/connection.php';

    if (isset($_POST["nbr"])) {
        $nbr = htmlspecialchars($_POST['nbr'], ENT_QUOTES);

        echo '
<div class="col-md-12">
    <div style="text-align: center; margin-bottom: 1%">
        <button class="btn btn-info" id="valider" type="submit"
        name="valider" style="width: 150px">
            Valider
        </button>
    </div>
    <div class="panel panel-default">
        <input type="hidden" name="type_mvt" value="entree">
        <table border="0" class="table table-hover table-condensed" id="details">
        <thead>
            <tr>
                <th class="entete" style="text-align: center; width: 60%"">Désignation</th>
                <th class="entete" style="text-align: center">Quantité</th>
                <th class="entete" style="text-align: center; width: 40%"">Commentaires</th>
            </tr>
        </thead>
            ';

        for ($i = 1; $i <= $nbr; $i++) {
            echo '<tr>
                <td style="vertical-align: middle">
                    <label style="width: 100%" class="nomargin_tb">
                        <select name="libelle[]" required class="form-control">
                            <option disabled selected>--- Sélectionner un article ---</option>';

            $sql = "SELECT designation_art FROM articles ORDER BY designation_art ASC ";
            $res = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
            while ($data = mysqli_fetch_array($res)) {
                echo '<option value="' . $data['designation_art'] . '" >' . $data['designation_art'] . '</option>';
            }

            echo '
                        </select>
                    </label>
                </td>
                <td style="text-align: center; vertical-align: middle">
                    <label style="margin-left: auto; margin-right: auto" class="nomargin_tb">
                        <input type="number" value="1" min="1" maxlength="4" class="form-control nomargin_tb" name="qte[]">
                    </label>
                </td>
                <td style="vertical-align: middle">
                    <label style="width: 100%" class="nomargin_tb">
                        <input type="text" class="form-control" name="cmt[]" style="font-weight: lighter">
                    </label>
                </td>
              </tr>
            ';
        }

        echo '
        </table>
    </div>
</div>';
    }