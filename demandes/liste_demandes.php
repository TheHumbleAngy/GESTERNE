<?php
    /**
     * Created by PhpStorm.
     * User: stagiaireinfo
     * Date: 31/03/14
     * Time: 10:13
     */
?>
<head>
    <meta charset="UTF-8">
</head>
<body onload="afficherInfos()">
    <div id="info"></div>
    <div id="feedback"></div>
</body>

<script>
    function afficherInfos() {
        $.ajax({
            type: 'GET',
            url: 'demandes/getdata.php',
            success: function (data) {
                $('#feedback').html(data);
            }
        });
    }

    function majInfos(code) {
        var id = code;
        var nom_emp = $('#nom_emp' + code).val();
        var prenoms_emp = $('#prenoms_emp' + code).val();
        var fonction_emp = $('#fonction_emp' + code).val();
        var departement_emp = $('#departement_emp' + code).val();
        var email = $('#email_emp' + code).val();
        var tel = $('#tel_emp' + code).val();

        var infos = "nom_emp=" + nom_emp + "&prenoms_emp=" + prenoms_emp + "&fonction_emp=" + fonction_emp + "&departement_emp=" + departement_emp + "&email_emp=" + email + "&tel_emp=" + tel;

        $.ajax({
            type: 'POST',
            url: 'employes/updatedata.php?id=' + id,
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
            url: 'demandes/deletedata.php',
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