<?php
include "dbconnect.php";
session_start();
$username1 = $_SESSION['username1'];
$cid = $_SESSION['cid'];
$sql = "select cpicture from contents where cpostid = '$cid'";

  //e$sqlcopst = "SELECT cpostid, username, ctitle, cpost_time, ctext, cpicture, mlocid from contents where cpostid = '$cid'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_assoc($result);
$image = $row['cpicture'];
header("Content-type: image/jpeg"); 
echo $image;

?>