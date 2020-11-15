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
$query = "SELECT * FROM companymenu where username='" . $_GET["c"] . "' and ifnull(deleted,0)=0;";
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
    <div class="container">
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
                                <th>Menu name</th>
                                <th>Price</th>

                            </tr>
                        </thead>
                        <?php if ($result->num_rows > 0) : ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                      
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
                [50, 100, 500, -1],
                [50, 100, 500, "All"]
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

