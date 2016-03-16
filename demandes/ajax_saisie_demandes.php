<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 15-Jul-15
 * Time: 6:55 PM
 */

require_once '../bd/connection.php';
//echo "Hello";

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
        <table border="0" class="table table-hover table-condensed" id="details">
        <thead>
            <tr>
                <th class="entete" style="text-align: center; width: 45%"">Libelle</th>
                <th class="entete" style="text-align: center">Nature</th>
                <th class="entete" style="text-align: center">Quantité</th>
                <th class="entete" style="text-align: center; width: 30%">Observation</th>
            </tr>
        </thead>
            ';

    for ($i = 1; $i <= $nbr; $i++) {
        echo '<tr>
                <td style="vertical-align: middle">
                    <label style="width: 100%" class="nomargin_tb">
                        <input type="text" class="form-control" id="test" name="libelle[]" required style="font-weight: lighter" onblur="this.value = this.value.toUpperCase();">
                    </label>
                </td>
                <td style="text-align: center; vertical-align: middle">
                    <label style="margin-left: auto; margin-right: auto" class="nomargin_tb">
                        <select class="form-control" name="nature[]">
                            <option value="bien">Bien</option>
                            <option value="service">Service</option>
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
                        <input type="text" class="form-control" name="obv[]" style="font-weight: lighter">
                    </label>
                </td>
              </tr>
            ';
    }

    echo '
        </table>
    </div>
</div>';
    //echo $info;
}

