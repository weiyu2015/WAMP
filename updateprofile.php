<?php 
include "dbconnect.php";
session_start();
$username1 = $_SESSION['username1'];
$ureal_name = $_POST["ureal_name"];
//echo $uname;
 $ucity = $_POST["ucity"];
 $ubirthday = $_POST["ubirthday"];

$sql = "update Users set ureal_name = '$ureal_name',ucity = '$ucity', ubirthday = '$ubirthday' where username = '$username1'"; 
//echo $sql;
$result = $mysqli -> query($sql);

$sql1 = "SELECT username, ureal_name, ucity, ubirthday from Users where username = '$username1'";
//echo $sql;
$message = "";
$result1 = $mysqli->query($sql1);
If($row = $result1->fetch_array())
  {
  $message .= "update successfully";
  }
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
        #form2{
            padding-top:80px;
        }
        #form1{
            padding-top:150px;
        }
        #password{
            height:20px;
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
    echo '<a id="messagelink" href="loginin3.php">Back</a>';} ?>
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