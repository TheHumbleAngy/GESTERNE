<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 1-Nov-15
     * Time: 9:17 AM
     */
?>
    <!--suppress ALL -->
    <div class="col-md-9" style="margin-left: 12.66%">
        <div class="panel panel-default">
            <div class="panel-heading">
                Formulaire Fournisseur
                <a href='form_principale.php?page=administration&source=fournisseurs' type='button' class='close'
                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </a>
            </div>
            <div class="panel-body">
                <form method="post">
                    <table class="formulaire" style="width: 100%; border-collapse: separate; border-spacing: 8px"
                           border="0">
                        <tr>
                            <td class="champlabel">Raison Sociale :</td>
                            <td>
                                <label>
                                    <input type="text" name="nom_four" id="nom_four" size="20" required
                                           class="form-control"
                                           onblur="this.value = this.value.toUpperCase();"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">E-mail :</td>
                            <td>
                                <label>
                                    <input type="email" name="email_four" size="30" required class="form-control"/>
                                </label>
                            </td>
                            <td></td>
                            <td class="champlabel">Contact Pro. :</td>
                            <td>
                                <label>
                                    <input type="tel" name="telephonepro_four" size="25" required class="form-control"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">Activité :</td>
                            <td>
                                <label>
                                    <input type="text" name="activite_four" size="30" required class="form-control"/>
                                </label>
                            </td>
                            <td></td>
                            <td class="champlabel">Fax :</td>
                            <td><label>
                                    <input type="tel" name="fax_four" size="25" class="form-control"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">Adresse :</td>
                            <td>
                                <label>
                                        <textarea name="adresse_four" rows="4" cols="25" style="resize: none" required
                                                  class="form-control"></textarea>
                                </label>
                            </td>
                            <td></td>
                            <td class="champlabel">Notes :</td>
                            <td>
                                <label>
                                        <textarea name="notes_four" rows="4" cols="25" style="resize: none"
                                                  class="form-control"></textarea>
                                </label>
                            </td>
                        </tr>
                        <tr>

                        </tr>
                    </table>
                    <br>

                    <div style="text-align: center;">
                        <button class="btn btn-info" type="submit" name="valider" style="width: 150px">
                            Valider
                        </button>
                    </div>
                </form>

                <div class="container">
                    <table id="table"
                           data-toggle="table"
                           data-url="fournisseurs/infos_fournisseurs.php"
                           data-height="288"
                           data-pagination="true"
                           data-page-size="4"
                           data-show-pagination-switch="true"
                           data-show-refresh="true"
                           data-search="true">
                        <thead>
                        <tr>
                            <th data-field="code_four" data-sortable="true">Numéro</th>
                            <th data-field="nom_four" data-sortable="true">Raison Sociale</th>
                            <th data-field="telephonepro_four">Contact</th>
                            <th data-field="activite_four">Activité</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        var fournisseurs = ["a", "b"];

        $(document).ready(function () {
            $.ajax({
                url: "fournisseurs/nom_fournisseurs.php",
                dataType: "json",
                type: "GET",
                success: function (data) {
                    for (var i = 0; i < data.length; i += 1) {
                        fournisseurs[i] = data[i].nom_four;
                    }
                }
            })
        });

        $('#nom_four').bind('blur', function () {
            if (fournisseurs.indexOf(this.value) > -1) {
                alert("Ce fournisseur existe déjà dans la base.");
                this.value = "";
            }
        });
    </script>

<?php
    if (sizeof($_POST) > 0) {
        include_once 'class_fournisseurs.php';

        $fournisseur = new fournisseurs();
        if ($fournisseur->recuperation()) {
            if (!($fournisseur->enregistrement())) {
                echo "Une erreur s'est produite lors de la tentative d'enregistrement des informations";
            }
        } else {
            echo "Une erreur s'est produite lors de la tentative de récupération des informations entrées";
        }
    }
?>