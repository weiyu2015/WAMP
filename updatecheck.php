<?php 
include "dbconnect.php";
session_start();
$username1 = $_SESSION['username1'];
$opwd = $_POST["oldpasswords"];
$password1 = $_POST["newpasswords"];
$password2 = $_POST["newpasswords2"];
// $uname = $_POST["$uname"];
// $uaddress = $_POST["$uaddress"];
// $introduction = $_POST["$introduction"];
$error="";
$message="";
$sql = "select upassword from Users where username = '$username1'";
$result = $mysqli -> query($sql);
if($row = $result->fetch_array()){
$oldpassword = $row['upassword'];
if($opwd == $oldpassword ){
	if($password1 != $password2){
	$error .= "You entered different passwords, cannot update your passwords.";
	}
	else{
	$sql2 = "update Users set upassword = '$password1' where username = '$username1'"; 
	$result2 = $mysqli -> query($sql2);
	$message .= "your password has been changed!";
	}
}
else{
$error .= "please enter the right old password!";
}
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
      <div id="error"><?php if($error){
    echo '<div class="alert alert-danger" role="alert">
  '.$error.'</div>';
    echo '<a id="errorlink" href="update.php">Back</a>';} ?>
    </div>
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