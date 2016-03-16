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
        var pren_emp = $('#pren_emp' + code).val();
        var fct_emp = $('#fct_emp' + code).val();
        var dpt_emp = $('#dpt_emp' + code).val();
        var email = $('#email_emp' + code).val();
        var tel = $('#tel_emp' + code).val();

        var infos = "nom_emp=" + nom_emp + "&pren_emp=" + pren_emp + "&fct_emp=" + fct_emp + "&dpt_emp=" + dpt_emp + "&email_emp=" + email + "&tel_emp=" + tel;

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