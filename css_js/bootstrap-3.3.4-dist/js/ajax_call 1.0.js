/**
 * Created by ange-marius.kouakou on 03/06/15.
 */

/*function ajax_call(rollno, name, phone) {*/
function ajax_call() {
    var req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            document.getElementById("testing").innerHTML = req.responseText;
        }
    };
    req.open("GET", "dest_AJAX.php", true);
    req.send(null);
}

/*function ajax_call(rollno, name, phone) {
 params = "url=dest_AJAX.php";
 req = new AjaxRequest();

 req.open("POST", "urlpost.php", true);
 req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 req.setRequestHeader("Content-length", params.length);
 req.setRequestHeader("Connection", "close");
 req.onreadystatechange = function () {
 if (this.readyState == 4) {
 if (this.status == 200) {
 if (this.responseText != null) {
 document.getElementById('info').innerHTML = this.responseText;
 }
 else alert("Ajax error: No data received");
 }
 else alert("Ajax error: " + this.statusText);
 }
 };

 req.send(params);

 function AjaxRequest() {
 try {
 var req = new XMLHttpRequest();
 }
 catch (e1) {
 try {
 req = new ActiveXObject("Msxml2.XMLHTTP");
 }
 catch (e2) {
 try {
 req = new ActiveXObject("Microsoft.XMLHTTP");
 }
 catch (e3) {
 req = false;
 }
 }
 }
 return req;
 }
 }*/


function afficher() {
    document.write("Hello from the file ajax_call 1.0");
}