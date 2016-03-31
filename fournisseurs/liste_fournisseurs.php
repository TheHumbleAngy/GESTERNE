<?php
    /**
     * Created by PhpStorm.
     * User: Ange KOUAKOU
     * Date: 29-Aug-15
     * Time: 8:13 PM
     */
?>
<body onload="afficherInfos()">
    <div id="info"></div>
    <div id="feedback" style="margin-left: 1.5%; margin-right: 1.5%"></div>
</body>

<script>
    function afficherInfos() {
        $.ajax({
            type: 'GET',
            url: 'fournisseurs/getdata.php',
            success: function (data) {
                $('#feedback').html(data);
            }
        });
    }

    function majInfos(code) {
        var id = code;
        var nom_four = $('#nom_four' + code).val();
        var email_four = $('#email_four' + code).val();
        var telephonepro_four = $('#telephonepro_four' + code).val();
        var activite_four = $('#activite_four' + code).val();
        var fax_four = $('#fax_four' + code).val();
        var adresse_four = $('#adresse_four' + code).val();
        var notes_four = $('#notes_four' + code).val();

        var infos = "nom_four=" + nom_four + "&email_four=" + email_four + "&telephonepro_four=" + telephonepro_four + "&activite_four=" + activite_four + "&fax_four=" + fax_four + "&adresse_four=" + adresse_four + "&notes_four=" + notes_four;

        $.ajax({
            type: 'POST',
            url: 'fournisseurs/updatedata.php?id=' + id + '&operation=maj',
            data: infos,
            success: function (data) {
                $('#info').html(data);
                afficherInfos();
                $("div.modal-backdrop.fade.in").remove();
                setTimeout(function(){
                    $(".alert-success").slideToggle("slow");
                }, 2500);
            }
        });
    }

    function suppressionInfos(code) {
        $.ajax({
            type: 'POST',
            url: 'fournisseurs/updatedata.php?operation=suppr',
            data: {
                id: code
            },
            success: function (data) {
                $('#info').html(data);
                afficherInfos();
                $("div.modal-backdrop.fade.in").remove();
                setTimeout(function(){
                    $(".alert-success").slideToggle("slow");
                }, 2500);
            }
        });
    }
</script>