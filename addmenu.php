<?php
session_start();
if (empty($_SESSION["company"])) {
    header("Location: ./company.login.php");
}
include './inc/config/db.config.php';
include './inc/db/database.php';
include_once "./inc/lang/index.php";
// $query = "select * from company where username ='" . $_SESSION["company"] . "'";
// $result = $conn->query($query);
// $query = "select *,(select companyname from company where username=visitors.company limit 1) as companyname from visitors where company='" . $_SESSION["company"] . "'";
// $result1 = $conn->query($query);
?>

<?php
$_SESSION["response"] = "";
if (!empty($_POST)) {
    if ($_POST["edit-data"]) {
        if ($_POST["id"]) {
            $id = $_POST["id"];
            $company = $_POST["comp"];
            $street = $_POST["str"];
            $postalcode = $_POST["cd"];
            $city = $_POST["ct"];
            $state = $_POST["st"];
            //$query = "UPDATE company SET companyname='$company', stnstno = '$street', postalcode = '$postalcode', city = '$city', state = '$state' WHERE id = '$id';";
            $statement = $conn->prepare("UPDATE company SET companyname=?, stnstno = ?, postalcode = ?, city = ?, state = ? WHERE id = ?;");
            $statement->bind_param("ssssss", $company, $street, $postalcode, $city, $state, $id);
            $res = $statement->execute();
            if ($res === TRUE) {
                $_SESSION["response"] = "Updated";
                // echo '<script>swal("Good job!", "Updated", "success");</script>';
            } else {
                $_SESSION["response"] = "Not updated";
                // echo '<script>swal("Sorry!", "Not updated", "info");</script>';
            }
        }
    }
}
?>
<?php
$query = "select * from company where username ='" . $_SESSION["company"] . "'";
$result = $conn->query($query);
$query = "select *,(select companyname from company where username=visitors.company limit 1) as companyname from visitors where company='" . $_SESSION["company"] . "'";
$result1 = $conn->query($query);
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
    <style>
        .modal {
            backdrop-filter: blur(5px);
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
            <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
            <div class="header-search">

            </div>
        </div>
        <div class="header-right">
        </div>
    </div>



    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="index.html">
                <h3 class="text-white">1+ Agency</h3>
                <!-- <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo"> -->
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">

                    <li>
                        <a href="company.php" class="dropdown-toggle no-arrow">
                            <span class="mtext"><?php echo translate("company.menu.dashboard"); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="addmenu.php" class="dropdown-toggle no-arrow">
                            <span class="mtext"><?php echo translate("company.menu.addmenu"); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="./logout.php" class="dropdown-toggle no-arrow">
                            <span class="mtext"><i class="dw dw-logout"></i> <?php echo translate("company.menu.logout"); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box mb-30 p-30">
                <div class="card-header">
                    <h2 class="h4">
                        <?php echo translate("company.menu.header"); ?>
                        <form action="./showmenu.php" class="pull-right" method="get">
						<input type="submit" value="<?php echo translate("company.menu.showmenu"); ?>" class="btn btn-outline-primary">
					</form>
                    </h2>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="inputFormRow">
                                    <div class="input-group mb-3">
                                        <input type="text" name="name[]" required class="form-control m-input" placeholder="Enter name" autocomplete="off">
                                        <input type="text" name="price[]" required class="form-control m-input" placeholder="Enter price" autocomplete="off">
                                        <div class="input-group-append">
                                            <button id="removeRow" type="button" class="btn btn-danger"><?php echo translate("company.menu.removebtn"); ?></button>
                                        </div>
                                    </div>
                                </div>

                                <div id="newRow"></div>
                                <button id="addRow" type="button" class="btn btn-info"><?php echo translate("company.menu.addrowbtn"); ?></button>
                                <button id="addRow" type="submit" class="btn btn-info"><?php echo translate("company.menu.submitbtn"); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>


    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>
    <script type="text/javascript">
        // add row
        $("#addRow").click(function() {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="name[]" required class="form-control m-input" placeholder="Enter name" autocomplete="off">';
            html += '<input type="text" name="price[]" required class="form-control m-input" placeholder="Enter price" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger"><?php echo translate("company.menu.removebtn"); ?></button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function() {
            if ($("[name='name[]']").length > 1) {
                $(this).closest('#inputFormRow').remove();
            }
        });
    </script>

</body>

</html>



<?php
if (!empty($_POST)) {
    $names = $_POST["name"];
    $price = $_POST["price"];
    
    $sql = array();
    for ($i = 0; $i < count($names); $i++) {
        $sql[] = "('" . $_SESSION["company"] . "','" . $names[$i] . "', '" . $price[$i] . "')";
    }
    $query = "insert into companymenu(username,menuname,menuprice) values " . trim(implode(',', $sql));
    $result=$conn->query($query);
    if($result===TRUE){
        echo '<script>swal("'.translate("company.alert.error").'!", "'.translate("company.alert.menuadded").' '.$_POST["Username"].'!", "success");</script>';
    }else{
        echo '<script>swal("'.translate("company.alert.error").'!", "'.translate("company.alert.menuaddederr").' '.$_POST["Username"].'!", "error");</script>';
    }
}
?>