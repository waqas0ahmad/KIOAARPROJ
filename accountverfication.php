<?php
include_once './inc/config/db.config.php';
include_once './inc/db/database.php';
$host="https://xn--bro-mannheim-dlb.de/";
include_once "./inc/lang/index.php";
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>One Plus Agency</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">
</head>

<body>
    <div class="container">
<form method="POST">
        <div class="card-box mb-30 mt-15">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                        <?php echo translate("company.mail.sent"); ?>
                            <a href="#" class="pull-right btn btn-link"><?php echo translate("company.mail.sendagain"); ?></a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>
</body>

</html>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './mail/PHPMailer/src/Exception.php';
require './mail/PHPMailer/src/PHPMailer.php';
require './mail/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'waqas@codendevs.com';                     // SMTP username
    $mail->Password   = 'KionBtaon?';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('waqas@codendevs.com', '1+ Agency');
    $mail->addAddress($_GET["em"], '');     // Add a recipient    
    
    //$mail->addCustomHeader('Message-ID', '<02WvJkfIGMykflQsRwPN0lEAEZQHnN7yBE1pIEhzRCo@localhost>');
    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject =base64_decode(base64_decode(urldecode($_GET["u"]))).' => Account verification';
    $mail->Body    = 'Click here to activate your account: <a href="http://'.$_SERVER['HTTP_HOST'].'/verify.php?user='.$_GET["u"].'">Activate</>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    $stmt = $conn->prepare("select id from company where username='".base64_decode(base64_decode(urldecode($_GET["u"])))."' limit 1");
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();

    $stmt->close();
    $stmt = $conn->prepare("update company set EmailSent=1,EmailSentTime=now() where id='".$id."'");
    $stmt->execute();
    $stmt->close();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}