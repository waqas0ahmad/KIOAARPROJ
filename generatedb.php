<?php
include_once "inc/config/db.config.php";
$conn = new mysqli($host, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//$result = $conn->query("create database IF NOT EXISTS" . $db);
// $conn->select_db($db);
// if ($conn->multi_query($table1)) {
//   echo "Done";
//   $conn->close();
// } else {
//   echo ("Error description: " . $conn->error);
// }
// $conn = new mysqli($host, $username, $password, $db);
// if ($conn->multi_query("ALTER TABLE company ADD EmailSent boolean;")) {
//   echo "Done";
//   $conn->close();
// } else {
//   echo ("Error description: " . $conn->error);
// }
// $conn = new mysqli($host, $username, $password, $db);
// if ($conn->multi_query("ALTER TABLE company ADD EmailSentTime datetime;")) {
//   echo "Done";
//   $conn->close();
// } else {
//   echo ("Error description: " . $conn->error);
// }
$conn = new mysqli($host, $username, $password, $db);
if ($conn->multi_query("update company set Approved=1;")) {
  echo "Done";
  $conn->close();
} else {
  echo ("Error description: " . $conn->error);
}
