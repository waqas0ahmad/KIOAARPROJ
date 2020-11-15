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
 <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    <script src="src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>

    <script type="text/javascript" src="src/plugins/datatables/js//jszip.min.js"></script>
    <script type="text/javascript" src="src/plugins/datatables/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="src/plugins/datatables/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="src/plugins/datatables/js/buttons.html5.min.js"></script>

    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>
<?php
if(!empty($_POST["del"])){
    $query = "update companymenu set deleted=1 where id='".$_POST["del_id"]."'" ;
    $re=$conn->query($query);
    if($re===TRUE){
        echo '<script>swal("'.translate("company.alert.success").'!", "'.translate("company.alert.menudeleted").' '.$_POST["Username"].'!", "success");</script>';
    }else{
        echo '<script>swal("'.translate("company.alert.error").'!", "'.translate("company.alert.menudeletederr").' '.$_POST["Username"].'!", "error");</script>';
    }
}
?>
<?php
$query = "SELECT * FROM companymenu where username='" . $_SESSION["company"] . "' and ifnull(deleted,0)=0;";
$result = $conn->query($query);

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
                      
                    </h2>
                </div>
                <div class="card-body">
                    <table class="data-table table">
                        <thead>
                            <tr>
                                <th class="">Action</th>
                                <th>Menu name</th>
                                <th>Price</th>

                            </tr>
                        </thead>
                        <?php if ($result->num_rows > 0) : ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td>
                                            <form method="POST" class="del_form">
                                                <input type="hidden" name="del_id" value="<?php echo $row["id"]; ?>">
                                                <input type="submit" value="Delete" class="btn btn-link" name="del">
                                            </form>
                                        </td>
                                        <td>
                                            <?php echo $row["menuname"]; ?>
                                        </td>
                                        <td>
                                            $
                                            <?php echo $row["menuprice"]; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            </div>


        </div>
    </div>

    <!-- js -->
   


</body>

</html>



<script>
    $('document').ready(function() {
        // 		$('.data-table').DataTable({
        //   dom: 'Blfrtip',
        //   buttons: [ 'excel', 'pdf', 'copy' ]
        // });
        $('.data-table').DataTable({
            dom: 'Blfrtip',
            buttons: ['pdf', 'excel'],
            scrollCollapse: true,
            autoWidth: true,
            responsive: false,
            searching: true,
            bLengthChange: true,
            bPaginate: true,
            bInfo: true,
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search",
                paginate: {
                    next: '<i class="ion-chevron-right"></i>',
                    previous: '<i class="ion-chevron-left"></i>'
                }
            },
        });
    });
</script>

