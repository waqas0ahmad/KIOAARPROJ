
<?php
session_start();
if(empty($_SESSION["user"])){
	header("Location: ./login.php");
}
include_once './inc/config/db.config.php';
include_once './inc/db/database.php';
$query = "select *,(select companyname from company where username=visitors.company limit 1) as companyname from visitors";
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
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap4.min.css"/>
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
			<!-- <div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div> -->
			<!-- <div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name">Ross C. Lopez</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div> -->
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="./">
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
						<a href="./" class="dropdown-toggle no-arrow">
							<span class="mtext">Dashboard</span>
						</a>
					</li>
					<li>
						<a href="./logout.php" class="dropdown-toggle no-arrow">
							<span class="mtext"><i class="dw dw-logout"></i> Logout</span>
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
	
			<div class="card-box mb-30">
				<h2 class="h4 pd-20">Visitors</h2>
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
                    <?php if($result->num_rows > 0):?>
				<tbody>
<?php  while($row = $result->fetch_assoc()):?>
                    <tr>
					<td>
					<form method="POST" class="del_form">
					<input type="hidden" name="del_id" value="<?php echo $row["id"] ;?>" >
					<input type="submit" value="Delete" class="btn btn-link" name="del">
					</form>
					</td>
                        <td>
                            <?php echo $row["companyname"];?>
                        </td>
                        <td>
                            <?php echo $row["name"];?>
                        </td>
                        <td>
                            <?php echo $row["street"];?>
                        </td>
                        <td>
                            <?php echo $row["code"];?>
                        </td>
                        <td>
                            <?php echo $row["city"];?>
                        </td>
                        <td>
                            <?php echo $row["count"];?>
                        </td>
						<td>
                            <?php echo $row["datetime"];?>
                        </td>
						<td>
                            <?php echo $row["phone"];?>
                        </td>
                    </tr>
<?php endwhile;?>
                </tbody>
                    <?php endif; ?>
				</table>
			</div>
		
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
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
	$('document').ready(function(){
// 		$('.data-table').DataTable({
//   dom: 'Blfrtip',
//   buttons: [ 'excel', 'pdf', 'copy' ]
// });
	$('.data-table').DataTable({
		  dom: 'Blfrtip',
		buttons: [ 'pdf' ],
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
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
	function submit_del(e){
			swal({
				title: "Are you sure?",
				text: "You will not be able to undo this.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes",
				cancelButtonText: "No, cancel please!",
				closeOnConfirm: false,
				closeOnCancel: false
				}).then(
				function(isConfirm){
					debugger;
					if (isConfirm.value===true) {
						e.submit();          // submitting the form when user press yes
					} else {
						//swal("Cancelled", "Your imaginary file is safe :)", "error");
					}
				});
			return false;
		};
	// $(document).ready(function(){
	// 	$(".del_form").on("submit",
	// });
		
	</script>
</body>
</html>

<?php
if(!empty($_POST)){
    if($_POST["del"]){
        echo '<script>swal("Deleted!", "Record removed succesfully.", "success");</script>';
        $query="delete from  `visitors` where id='".$_POST["del_id"]."'";
        $result2=$conn->query($query);        
        if($result2===TRUE){
            echo '<script>swal("Deleted!", "Record removed succesfully.", "success");setTimeout(function(){window.location.reload();},500);</script>';
        }
    }
}
?>