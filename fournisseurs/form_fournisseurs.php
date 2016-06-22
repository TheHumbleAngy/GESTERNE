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
                <form method="post" id="myform">
                    <table class="formulaire" style="width: 100%; border-collapse: separate; border-spacing: 8px"
                           border="0">
                        <tr>
                            <td class="champlabel">*Raison Sociale :</td>
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
                                    <input type="email" name="email_four" id="email_four" size="30" class="form-control"/>
                                </label>
                            </td>
                            <td></td>
                            <td class="champlabel">*Contact Pro. :</td>
                            <td>
                                <label>
                                    <input type="tel" name="telephonepro_four" id="telephonepro_four" size="25" required class="form-control"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">*Activité :</td>
                            <td>
                                <label>
                                    <input type="text" name="activite_four" id="activite_four" size="30" required class="form-control"/>
                                </label>
                            </td>
                            <td></td>
                            <td class="champlabel">Fax :</td>
                            <td><label>
                                    <input type="tel" name="fax_four" id="fax_four" size="25" class="form-control"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="champlabel">*Adresse :</td>
                            <td>
                                <label>
                                        <textarea name="adresse_four" id="adresse_four" rows="4" cols="25" style="resize: none" required
                                                  class="form-control"></textarea>
                                </label>
                            </td>
                            <td></td>
                            <td class="champlabel">Notes :</td>
                            <td>
                                <label>
                                        <textarea name="notes_four" id="notes_four" rows="4" cols="25" style="resize: none"
                                                  class="form-control"></textarea>
                                </label>
                            </td>
                        </tr>
                        <tr>

                        </tr>
                    </table>
                    <br>

                    <div style="text-align: center;">
                        <button class="btn btn-info" type="button" name="valider" onclick="ajout()" style="width: 150px">
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

        function nomsFournisseurs() {
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
        }

        $(document).ready(nomsFournisseurs());

        $('#nom_four').bind('blur', function () {
            if (fournisseurs.indexOf(this.value) > -1) {
                alert("Ce fournisseur existe déjà dans la base.");
                this.value = "";
            }
        });

        function validation() {
            var i = 0;
            $(':input[required]').each(function () {
                if (this.value == '')
                    i++;
            });
            return i;
        }

        function ajout() {
            if (validation() != 0) {
                alert('Veuillez renseigner tous les champs précédés de * s\'il vous plaît.');
            } else {
                var nom_four = $('#nom_four').val();
                var email_four = $('#email_four').val();
                var telephonepro_four = $('#telephonepro_four').val();
                var activite_four = $('#activite_four').val();
                var fax_four = $('#fax_four').val();
                var adresse_four = $('#adresse_four').val();
                var notes_four = $('#notes_four').val();

                var infos = "nom_four=" + nom_four + "&email_four=" + email_four + "&telephonepro_four=" + telephonepro_four + "&activite_four=" + activite_four + "&fax_four=" + fax_four + "&adresse_four=" + adresse_four + "&notes_four=" + notes_four;
                var operation = "ajout";
//            console.log(infos);

                $.ajax({
                    type: 'POST',
                    url: 'fournisseurs/updatedata.php?operation=' + operation,
                    data: infos,
                    success: function (data) {
                        $('#info').html(data);
                        $('#myform').trigger('reset');
                        setTimeout(function () {
                            $(".alert-success").slideToggle("slow");
                        }, 1000);
                        nomsFournisseurs();
                    }
                });
            }
        }
    </script>