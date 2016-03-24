<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 15-Sep-15
     * Time: 9:17 AM
     */
?>
    <!--suppress ALL -->
    <div class="col-md-9" style="margin-left: 12.66%">
        <div class="panel panel-default">
            <div class="panel-heading">
                Formulaire Employé
                <a href='form_principale.php?page=administration&source=employes' type='button' class='close'
                   data-dismiss='alert' aria-label='Close' style='position: inherit'>
                    <span aria-hidden='true'>&times;</span>
                </a>
            </div>
            <div class="panel-body">
                <form method="POST">
                    <table class="formulaire" style="width: 100%; border-collapse: separate; border-spacing: 8px"
                           border="0">
                        <tr>
                            <td class="champlabel">*Titre :</td>
                            <td>
                                <label>
                                    <select name="titre_emp" class="form-control" required>
                                        <option value="M.">M.</option>
                                        <option value="Mme.">Mme.</option>
                                        <option value="Mlle.">Mlle.</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">*Nom :</td>
                            <td>
                                <label>
                                    <input type="text" name="nom_emp" required class="form-control"
                                           onblur="this.value = this.value.toUpperCase();"/>
                                </label>
                            </td>
                            <td class="champlabel">Prénoms :</td>
                            <td>
                                <label>
                                    <input type="text" name="prenoms_emp" size="40" class="form-control"
                                           onblur="this.value = this.value.toUpperCase();"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">Fonction :</td>
                            <td>
                                <label>
                                    <input type="text" name="fonction_emp" class="form-control"
                                           onblur="this.value = this.value.toUpperCase();"/>
                                </label>
                            </td>
                            <td class="champlabel">*Département :</td>
                            <td>
                                <label>
                                    <select name="departement_emp" required class="form-control">
                                        <option disabled selected></option>
                                        <option value="FINANCE ET COMPTABILITE">FINANCE ET COMPTABILITE</option>
                                        <option value="INFORMATIQUE">INFORMATIQUE</option>
                                        <option value="MOYENS GENEREAUX">MOYENS GENEREAUX</option>
                                        <option value="PRODUCTION">PRODUCTION</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">*Email :</td>
                            <td>
                                <label>
                                    <input type="email" name="email_emp" id="email_emp" size="30" required class="form-control"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">*Contact :</td>
                            <td>
                                <label>
                                    <input type="tel" name="tel_emp" required class="form-control"/>
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

                <div class="container">
                    <table id="table"
                           data-toggle="table"
                           data-url="employes/infos_employes.php"
                           data-height="288"
                           data-pagination="true"
                           data-page-size="4"
                           data-show-pagination-switch="true"
                           data-show-refresh="true"
                           data-search="true">
                        <thead>
                        <tr>
                            <th data-field="code_emp" data-sortable="true">Matricule</th>
                            <th data-field="nom_emp" data-sortable="true">Nom</th>
                            <th data-field="prenoms_emp" data-sortable="true">Prénoms</th>
                            <th data-field="departement_emp">Département</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        var email = ["a", "b"];

        $(document).ready(function () {
            $.ajax({
                url: "employes/email_employes.php",
                dataType: "json",
                type: "GET",
                success: function (data) {
                    for (var i = 0; i < data.length; i += 1) {
                        email[i] = data[i].email_emp;
                    }
                }
            })
        });

        $('#email_emp').bind('blur', function () {
            if (email.indexOf(this.value) > -1) {
                alert("Cette addresse existe déjà dans la base.");
                this.value = "";
            }
        });
    </script>

<?php
    if (sizeof($_POST) > 0) {
        include 'class_employes.php';

        $employe = new employes();

        if ($employe->recuperation()) {
            $employe->motdepasse("ncare");
            if (!($employe->enregistrement())) {
                echo "Une erreur s'est produite lors de la tentative d'enregistrement des informations";
            }
        } else {
            echo "Une erreur s'est produite lors de la tentative de récupération des informations entrées";
        }
    }
?>