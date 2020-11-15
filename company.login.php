
<?php
session_start();
if(!empty($_SESSION["company"])){
	header("Location: ./company.php");
}
include_once './inc/config/db.config.php';
include_once './inc/db/database.php';
include_once "./inc/lang/index.php";
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>1+ Agency</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	
</head>
<body class="login-page">
	
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
		
				<div class="col-md-6 col-lg-5" style="margin: auto;">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary"><?php echo translate("company.login.header");?></h2>
						</div>
						<form method="POST">
							
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Username" name="username" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********" name="password" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<input type="submit" class="btn btn-primary btn-lg btn-block" name="form-submit" value="<?php echo translate("company.login.button");?>">
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373"> <?php echo translate("company.login.or");?> </div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="addcompany.php"><?php echo translate("company.create.button"); ?></a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
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
        $query="select * from company where username='".$_POST["username"]."' and password='".md5($_POST["password"])."'";
        $result=$conn->query($query);
        if($result->num_rows>0){
			$r = $result->fetch_assoc();
			if($r["Approved"]==="1"){
				echo '<script>swal("'.translate("company.alert.success").'!", "'.translate("company.alert.loginsuccess").' '.$_POST["Username"].'!", "success");</script>';
				$_SESSION["company"]=$_POST["username"];
				echo '<script>setTimeout(function(){location.href="./company.php"},500);</script>';
			}else{
				echo '<script>swal("'.translate("company.alert.error").'!", "'.translate("company.alert.notapproved").' '.$_POST["Username"].'!", "success");</script>';
				//$_SESSION["company"]=$_POST["username"];
				//echo '<script>setTimeout(function(){location.href="./company.php"},500);</script>';
			}
            
            
        }else{
            echo '<script>swal("'.translate("company.alert.error").'!", "'.translate("company.alert.loginerror").' '.$_POST["Username"].' not registered!", "error");</script>';
        }
    }
}
?>