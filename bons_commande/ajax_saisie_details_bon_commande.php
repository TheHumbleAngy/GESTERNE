<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 31-Aug-15
     * Time: 2:59 PM
     */

    require_once '../bd/connection.php';

    if (isset($_POST["nbr"])) {
        $nbr = htmlspecialchars($_POST['nbr'], ENT_QUOTES);

        echo '
<div class="col-md-12">
    <div style="text-align: center; margin-bottom: 1%">
        <button class="btn btn-info" id="valider" type="submit" name="valider" style="width: 150px">
            Valider
        </button>
    </div>
    <div class="panel panel-default">
        <table border="0" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th class="entete" style="text-align: center; width: 60%">Libelle</th>
                <th class="entete" style="text-align: center">Quantité</th>
                <th class="entete" style="text-align: center; width: 15%" title="Prix Unitaire">P.U.</th>
                <th class="entete" style="text-align: center; width: 15%" title="En pourcentage">Remise</th>
            </tr>
        </thead>
            ';

        for ($i = 1; $i <= $nbr; $i++) {
            echo '<tr>
                <td style="vertical-align: middle">
                    <label style="width: 100%" class="nomargin_tb">
                        <input type="text" class="form-control" name="libelle_dbc[]" required style="font-weight: lighter" onblur="this.value = this.value.toUpperCase();">
                    </label>
                </td>
                <td style="text-align: center; vertical-align: middle">
                    <label style="margin-left: auto; margin-right: auto" class="nomargin_tb">
                        <input type="number" value="1" min="1" maxlength="4" class="form-control nomargin_tb" name="qte_dbc[]" id="qte" required>
                    </label>
                </td>
                <td style="vertical-align: middle">
                    <label style="width: 100%" class="nomargin_tb">
                        <input type="text" class="form-control" name="pu_dbc[]" id="pu" style="font-weight: lighter; text-align: right" placeholder="0" required>
                    </label>
                </td>
                <td style="vertical-align: middle">
                    <label style="width: 100%" class="nomargin_tb">
                        <input type="text" class="form-control" name="remise_dbc[]" id="rem" style="font-weight: lighter; text-align: right" placeholder="0" value="0">
                    </label>
                </td>
              </tr>
            ';
        }

        echo '
        </table>
    </div>
</div>';
        echo '<input type="hidden" name="nbr" value="' . $nbr . '">';
    }