<?php 
$username1 = $_POST["Username"];
$password1 = $_POST["Password"];
$password2 = $_POST["Confirm_Password"];
$ureal_name = $_POST["Realname"];
$ucity = $_POST["city"];
$ugender = $_POST["Gender"];
$ubirthday = $_POST["Birthday"];
$error="";
$message="";
include "dbconnect.php";
//print_r($_POST);

$sql = "select * from users where username = '$username1'";
$result = $mysqli -> query($sql);
if($username1 == null){
$error .= "please enter a valid username (not null)</br>";
}
else{
if($row = $result->fetch_array()){
$error .= "existing users, please use another username</br>"; 
}
else
{

if ($password1 != $password2){
$error .= "you have entered different passwords</br>";
}
else
{
$password1=md5(md5('$username1').'$password1');
$sql2 = "INSERT INTO users(`username`, `upassword`, `ureal_name`, `ugender`, `ubirthday`,`ucity`) VALUES  ('$username1', '$password1', '$ureal_name', '$ugender', '$ubirthday','$ucity')";
if($mysqli -> query($sql2)){

$message .= "You have signed up!</br>";
}
//$stmt->close();
}
}
}
//$mysqli->close();
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
        #logo{
            width: 250px;
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
  



<div class="container-fluid container-fill-height">
  <div class="container-content-middle">
    <form role="form" class="m-x-auto text-center app-login-form">

      <a id="logo" class="app-brand m-b-lg">
        <img src="./assets/musichub.png" alt="brand">
      </a>

      <div id="error"><?php if($error){
    echo '<div class="alert alert-danger" role="alert">
  '.$error.'</div>';
    echo '<a id="errorlink" href="signup.php">Back</a>';} ?>
    </div>
      <div id="message"><?php if($message){
    echo '<div class="alert alert-success" role="alert">
  '.$message.'</div>';
    echo '<a id="messagelink" href="index.html">Back</a>';} ?>
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

