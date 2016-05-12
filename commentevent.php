<?php 
include "dbconnect.php";
session_start();
$username1 = $_SESSION['username1'];
 $celike = $_POST["celike"];
 $eventbody = $_POST["eventbody"]; 
 $eid = $_POST["eid"];
 $cereg = $_POST["cereg"];
$message = "";
if ($cereg==1){
	$sqlReg = "INSERT INTO `join_events` (`username`, `eventid`) VALUES ('$username1', '$eid')";
	$resultReg = $mysqli->query($sqlReg);
	$message .= "You are in, registered<br>";
} 


$sql1 = "INSERT INTO `com_event` (`ceid`, `username`, `eventid`, `cetime`, `cetext`, `celike`) VALUES ( NULL,'$username1', '$eid', CURRENT_TIMESTAMP, '$eventbody', '$celike')";
$result1 = $mysqli->query($sql1);


  $message .= "Comment posted";
  
$mysqli->close();


?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>
      
        Home &middot; 
      
    </title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="assets/css/toolkit.css" rel="stylesheet">
    
    <link href="assets/css/application.css" rel="stylesheet">

    <style>
      /* note: this is a hack for ios iframe for bootstrap themes shopify page */
      /* this chunk of css is not part of the toolkit :) */
      body {
        width: 1px;
        min-width: 100%;
        *width: 100%;
          background-image: url("./assets/login_background.jpg");
        background-size: cover;
      }
        #messagelink{
            color: azure;
        }
        #more{
            height:50px;
        }
        #menu{
           position:absolute;
           left:425px;
        }

    </style>

  </head>
<body>
    <?php include "titles.php"; ?>
    
    <div class="container-fluid container-fill-height">
  <div class="container-content-middle">
    <form role="form" class="m-x-auto text-center app-login-form">
      <div id="message"><?php if($message){
    echo '<div class="alert alert-success" role="alert">
  '.$message.'</div>';
    echo '<a style="text-decoration:none" id="messagelink" href="events.php?eid='.$eid.'">Take a look</a>';} ?>
    </div>
    </form>
  </div>
</div>


    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/chart.js"></script>
    <script src="./assets/js/toolkit.js"></script>
    <script src="./assets/js/application.js"></script>
    <script type="text/javascript">
        
    </script>
  </body>
</html>