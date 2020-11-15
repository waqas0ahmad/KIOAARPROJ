<?php
$host="https://xn--bro-mannheim-dlb.de/";
// $host="http://localhost/oneplusagency";
if ($_POST) {
    if ($_POST["g-qr"]) {
        if ($_POST["com"]) {
            $companyusername=base64_encode(base64_encode($_POST["com"]));
            include('phpqrcode/qrlib.php');
            QRcode::png($host."userform.php?uname=".$companyusername, $_POST["com"].'.png',QR_ECLEVEL_L, 4);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else{
            echo "unhandled request";
        }
    }else{
        echo "unhandled request";
    }
}
?>