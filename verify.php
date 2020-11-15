<?php
include_once './inc/config/db.config.php';
include_once './inc/db/database.php';
$host="https://xn--bro-mannheim-dlb.de/";
echo $_GET["user"];
// $result = $conn->query("select id from company where username='".base64_decode(base64_decode(urldecode($_GET["u"])))."' limit 1");
// $row = $result->fetch_assoc();
// $conn->query("update comapny set Approved where id='".$row["id"]."'");

$stmt = $conn->prepare("select id from company where username='".base64_decode(base64_decode(urldecode($_GET["user"])))."' limit 1");
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();

$stmt->close();
$stmt = $conn->prepare("update company set Approved=1 where id='".$id."'");
$stmt->execute();
$stmt->close();
header("Location: ./index.php");