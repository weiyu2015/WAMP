<?php
session_start();
$username1 = $_SESSION['username1'];
$applyname = $_GET['applyname'];

include "dbconnect.php";
$error = "";
$sql1 ="DELETE FROM `add_friend`where addedname = '$username1' and applyname = '$applyname'";
if($result1 = $mysqli->query($sql1)){
$error .= "You have declined " .$applyname. " 's request.";}
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
      
        Login &middot; 
      
    </title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="./assets/css/toolkit.css" rel="stylesheet">
    
    <link href="./assets/css/application.css" rel="stylesheet">

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
         #more{
            height:50px;
        }
        #errorlink{
            color: azure;
        }
        #messagelink{
            color:azure;
        }
    </style>

  </head>


<body>
  
<?php include "titles.php"; ?>


<div class="container-fluid container-fill-height">
  <div class="container-content-middle">
    <form role="form" class="m-x-auto text-center app-login-form">
         <div id="error"><?php if($error){
    echo '<div class="alert alert-danger" role="alert">
  '.$error.'</div>';
    echo '<a id="errorlink" href="request.php">Back</a>';} ?>
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