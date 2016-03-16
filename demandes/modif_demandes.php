<?php
/**
 * Created by PhpStorm.
 * User: JOCO
 * Date: 20/03/14
 * Time: 09:09
 */

$code_dbs = $_SESSION['code_temp'];

/*$req = "SELECT * FROM demande_bien_service WHERE code_dbs = '". $code_dbs ."'";*/
$req = "SELECT demande_bien_service.code_dbs, demande_bien_service.date_dbs, demande_bien_service.nature_dbs, demande_bien_service.objets_dbs, employe.nom_emp, employe.prenoms_emp
        FROM demande_bien_service, employe
        WHERE demande_bien_service.code_emp = employe.code_emp
        AND demande_bien_service.code_dbs = '" . $code_dbs . "'";

if ($valeur = $connexion->query($req)) {

    $ligne = $valeur->fetch_all(MYSQL_ASSOC);
    foreach ($ligne as $data) {
        $code_dbs = stripslashes($data['code_dbs']);
        $date_dbs = stripslashes($data['date_dbs']);
        $nature_dbs = stripslashes($data['nature_dbs']);
        $objets_dbs = stripslashes($data['objets_dbs']);
        $nom_emp = stripslashes($data['nom_emp']) . " " . stripslashes($data['prenoms_emp']);
    }
}
?>

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading" style="font-size: 12px; font-weight: bolder">
            [Demande Biens/Services]Modification
        </div>
        <div class="panel-body">
            <form method="POST" action="form_principale.php?page=biens_services/demandes/fonction_modif_demandes">
                <table class="formulaire"
                       style="width= 100%; margin-left: 10%; border-collapse: separate; border-spacing: 10px;"
                       border="0">
                    <tr>
                        <td class="champlabel">Date:</td>
                        <td><label>
                                <input type="date" name="date_dbs" size="20" required class="form-control" value="<?php echo $date_dbs; ?>"/>
                            </label>
                        </td>

                        <td class="champlabel">Employé:</td>
                        <td><label>
                                <input type="text" name="nom_emp" size="20" class="form-control" readonly value="<?php echo $nom_emp; ?>"/>
                            </label></td>
                    </tr>
                    <tr>
                        <td class="champlabel">Nature:</td>
                        <td><label>
                                <input type="text" name="nature_dbs" size="20" class="form-control" value="<?php echo $nature_dbs; ?>"/>
                            </label></td>
                        <td class="champlabel">Objet:</td>
                        <td><label>
                                <input type="text" name="objets_dbs" size="15" class="form-control" value="<?php echo $objets_dbs; ?>"/>
                            </label></td>
                    </tr>
                </table>
                <br/>

                <div style="text-align: center;">
                    <button class="btn btn-default" type="submit" name="valider">
                        Valider
                    </button>

                    <button class="btn btn-default" type="reset" name="effacer">
                        Effacer
                    </button>
                </div>

                <input type="hidden" id="code_dbs" name="code_dbs" value="<?php echo $code_dbs; ?>"/>
            </form>
        </div>
    </div>
</div>