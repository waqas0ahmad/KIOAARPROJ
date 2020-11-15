<?php
include_once './inc/config/db.config.php';
include_once './inc/db/database.php';
$username= base64_decode(base64_decode($_GET["uname"]));
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
                        <h4>Survey
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                            Name
                        </label>
                        <input class="form-control" type="text" name="Name" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                        Phone
                        </label>
                        <input class="form-control" type="text" name="phn" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                        Street and Street number
                        </label>
                        <input class="form-control" type="text" name="ST" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    Postal code
                                </label>
                                <input class="form-control" type="text" name="PC" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">
                                    City
                                </label>
                                <input class="form-control" type="text" name="city" required>
                            </div>
                        </div>
                    </div>
                </div>
               
                <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                            Date and time
                        </label>
                        <input class="form-control" type="text" name="username" required>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">
                            How many person you are?
                        </label>
                        <input class="form-control" type="number" name="cnt" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="btn btn-outline-primary btn-block" type="submit" name="form-submit">
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
        
        $query="INSERT INTO `visitors`(`name`,`phone`,`street`,`code`,`city`,`datetime`,`count`,`company`)
        VALUES('".$_POST["Name"]."','".$_POST["phn"]."','".$_POST["ST"]."','".$_POST["PC"]."','".$_POST["city"]."',now(),'".$_POST["cnt"]."','".$username."');";
        $result=$conn->query($query);        
        if($result===TRUE){
            echo '<script>swal("Greeting!", "Thank you", "success");window.location.href="./hotelmenu.php?c='.$username.'"</script>';
        }else{
            echo $conn->error;
        }
    }
}
?>