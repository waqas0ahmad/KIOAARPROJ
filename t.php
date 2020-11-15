
<?php
$input = "SmackFactory";
$output = base64_encode(base64_encode($input));
echo $output;
echo "<br>";
echo base64_decode(base64_decode($output));

// session_start();
// if(empty($_SESSION["user"])){
// 	header("Location: ./login.php");
// }
// include_once './inc/config/db.config.php';
// include_once './inc/db/database.php';
// $query = "select * from visitors";
// $result = $conn->query($query);
// echo json_decode($result);
?>
