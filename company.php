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
			$statement->bind_param("ssssss",$company,$street,$postalcode,$city,$state,$id);
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
			<!-- <div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-10">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue">Admin!</div>
						</h4>
						
					</div>
				</div>
			</div> -->

			<div class="card-box mb-30 p-30">
				<h2 class="h4 pd-20">

					<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#edit-modal">
						<i class="fa fa-edit"></i>
					</button>
					<?php echo translate("company.info.header"); ?>

					<form action="./qr.php" class="pull-right" method="POST">
						<input type="hidden" name="com" value="<?php echo $_SESSION["company"]; ?>">
						<input type="submit" value="<?php echo translate("company.info.genqr"); ?>" class="btn btn-outline-info ml-1" name="g-qr">

					</form>
					<form action="" class="pull-right" method="POST">
						<input type="button" value="<?php echo translate("company.info.printqr"); ?>" class="btn btn-outline-primary" name="print-qr" onclick="printImg()">
					</form>
				</h2>
				<?php if ($result->num_rows > 0) : ?>
					<?php $row = $result->fetch_assoc();
					$data = $row; ?>
					<div class="card-body">
						<table class="w-100">

							<tr>
								<td>
									<label for="" class="h5">
									<?php echo translate("company.info.name"); ?>:
									</label>
									<?php echo $row["companyname"]; ?></td>

								<td>
									<label for="" class="h5">
									<?php echo translate("company.info.street"); ?>:
									</label>
									<?php echo $row["stnstno"]; ?></td>
								<td></td>
								<td rowspan="3">
									<img src="<?php echo $_SESSION["company"]; ?>.png" alt="">
								</td>
							</tr>
							<tr>
								<td>
									<label for="" class="h5">
									<?php echo translate("company.info.postalcode"); ?>:
									</label>
									<?php echo $row["postalcode"]; ?></td>
								<td>
									<label for="" class="h5">
									<?php echo translate("company.info.city"); ?>:
									</label>
									<?php echo $row["city"]; ?></td>
								<td>
									<label for="" class="h5">
									<?php echo translate("company.info.state"); ?>:
									</label>
									<?php echo $row["state"]; ?></td>

							</tr>
							<tr>
								<td class="datatable-nosort">
									<label for="" class="h5"><?php echo translate("company.info.username"); ?>:
									</label>
									<?php echo $row["username"]; ?></td>

							</tr>
							</thead>

						</table>
					</div>
				<?php endif; ?>
			</div>
			<div class="card-box mb-30">				
				<h2 class="h4 pd-20"><?php echo translate("company.visitor.header"); ?></h2>
				<div class="card-body">
				<table class="data-table table nowrap">
					<thead>
						<tr>
							<th class="">Action</th>
							<th>Company Name</th>
							<th>Visitor name</th>
							<th>Visitor address</th>
							<th>Visitor postal code</th>
							<th>Visitor city</th>
							<th>Number of visitors</th>
							<th>Visited on</th>
							<th class="datatable-nosort">Visitor phone</th>

						</tr>
					</thead>
					<?php if ($result1->num_rows > 0) : ?>
						<tbody>
							<?php while ($row = $result1->fetch_assoc()) : ?>
								<tr>
									<td>
										<form method="POST" class="del_form">
											<input type="hidden" name="del_id" value="<?php echo $row["id"]; ?>">
											<input type="submit" value="Delete" class="btn btn-link" name="del">
										</form>
									</td>
									<td>
										<?php echo $row["companyname"]; ?>
									</td>
									<td>
										<?php echo $row["name"]; ?>
									</td>
									<td>
										<?php echo $row["street"]; ?>
									</td>
									<td>
										<?php echo $row["code"]; ?>
									</td>
									<td>
										<?php echo $row["city"]; ?>
									</td>
									<td>
										<?php echo $row["count"]; ?>
									</td>
									<td>
										<?php echo $row["datetime"]; ?>
									</td>
									<td>
										<?php echo $row["phone"]; ?>
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
	<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal" tabindex="-1" aria-labelledby="edit-modal" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<form method="POST">
					<input type="hidden" name="id" value="<?php echo $data["id"]; ?>">
					<div class="modal-header">
						<h5 class="modal-title">Edit information</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="">
										Company name
									</label>
									<input type="text" class="form-control" value="<?php echo $data["companyname"]; ?>" name="comp">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">
										St. & St. no
									</label>
									<input type="text" class="form-control" value="<?php echo $data["stnstno"]; ?>" name="str">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">
										Postal code
									</label>
									<input type="text" class="form-control" autocomplete="OFF" value="<?php echo $data["postalcode"]; ?>" name="cd">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">
										City
									</label>
									<input type="text" class="form-control" value="<?php echo $data["city"]; ?>" name="ct">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">
										State
									</label>
									<input type="text" class="form-control" value="<?php echo $data["state"]; ?>" name="st">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" name="edit-data" value="Save">Save changes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
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
	<script>
		$('document').ready(function() {
			// 		$('.data-table').DataTable({
			//   dom: 'Blfrtip',
			//   buttons: [ 'excel', 'pdf', 'copy' ]
			// });
			$('.data-table').DataTable({
				dom: 'Blfrtip',
				buttons: ['pdf','excel'],
				scrollCollapse: true,
				autoWidth: true,
				responsive: true,
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
		function printImg() {
  var win = window.open('');
  win.document.write('<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/<?php echo $_SESSION["company"];?>.png" onload="window.print();window.close()" />');
  win.focus();
}
	</script>
</body>

</html>



<?php
if ($_SESSION["response"]) {
	if ($_SESSION["response"] == "Updated") {
		echo '<script>swal("Good job!", "Updated", "success");</script>';
	} else {
		echo '<script>swal("Sorry!", "Not updated", "info");</script>';
	}
}
?>