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
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
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
                        <?php echo translate("company.add.header"); ?>
                            <a href="./company.login.php" class="pull-right btn btn-link"><?php echo translate("company.add.header.link.login"); ?></a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                        <?php echo translate("company.add.name"); ?>
                        </label>
                        <input class="form-control" type="text" name="CName" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                        <?php echo translate("company.add.street"); ?>
                        </label>
                        <input class="form-control" type="text" name="ST" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                <?php echo translate("company.add.postalcode"); ?>
                                </label>
                                <input class="form-control" type="text" name="PC" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">
                                <?php echo translate("company.add.city"); ?>
                                </label>
                                <input class="form-control" type="text" name="city" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                        <?php echo translate("company.add.state"); ?>
                        </label>
                        <input class="form-control" type="text" name="state" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                        <?php echo translate("company.add.email"); ?>
                        </label>
                        <input class="form-control" type="text" name="email" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                        <?php echo translate("company.add.username"); ?>
                        </label>
                        <input class="form-control" type="text" name="username" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                        <?php echo translate("company.add.password"); ?>
                        </label>
                        <input class="form-control" type="password" name="pass" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="btn btn-outline-primary btn-block" type="submit" name="form-submit" value="<?php echo translate("company.add.button"); ?>">
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

if(!empty($_POST)){
    if($_POST["form-submit"]){
        $query="INSERT INTO `company`(`companyname`,`stnstno`,`postalcode`,`city`,`state`,`username`,`password`,`email`)
        VALUES('".$_POST["CName"]."','".$_POST["ST"]."','".$_POST["PC"]."','".$_POST["city"]."','".$_POST["state"]."','".$_POST["username"]."','".md5($_POST["pass"])."','".$_POST["email"]."')";
        $result=$conn->query($query);
        if($result===TRUE){

            include('phpqrcode/qrlib.php');
            echo '<script>swal("Good job!", "'.$_POST["CName"].' registered!", "success");</script>';
            $_SESSION["company"]=$_POST["username"];
            QRcode::png($host."userform.php?uname=".$_POST["username"], $_POST["username"].'.png',QR_ECLEVEL_L, 4);
            echo '<script>setTimeout(function(){location.href="./accountverfication.php?u='.urlencode(base64_encode(base64_encode( $_POST["username"]))).'&em='.$_POST["email"].'"},500);</script>';
        }else{
            echo '<script>swal("Good job!", "'.$_POST["CName"].' not registered!", "error");</script>';
        }
    }
}
?>