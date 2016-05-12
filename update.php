<?php 
include "dbconnect.php";
session_start();
$username1 = $_SESSION['username1'];
$sql = "SELECT username, ureal_name, ucity, ubirthday from Users where username = '$username1'";
//echo $sql;
$result = $mysqli->query($sql);
$ucity="";
$ubirthday="";
$ureal_name="";
if($row = $result->fetch_array())
  {
  $ucity = $row['ucity'];
  $ubirthday = $row['ubirthday'];
  $ureal_name = $row['ureal_name'];
  
  } 
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

    </style>

  </head>
<body>
    <?php include "titles.php"; ?>

  <form id="form1" action="updatecheck.php" method="post" role="form" class="m-x-auto text-center app-login-form">
      <div id="name" class="form-group">
        <input name="oldpasswords" type="password" class="form-control" placeholder="Old Password">
      </div>
      <div id="password" class="form-group m-b-md">
        <input name="newpasswords" type="password" class="form-control" placeholder="New Password">
      </div>
      <div id="confirm" class="form-group">
        <input name="newpasswords2" type="password" class="form-control" placeholder="Confirm Password">
      </div>
      <div class="m-b-lg">
        <input id="signup" type="submit" class="btn btn-primary" value="Reset Password">
      </div>
      </form>
    <form id="form2" action="updateprofile.php" method="post" role="form" class="m-x-auto text-center app-login-form">
      <div id="realname" class="form-group">
        <input name="ureal_name" class="form-control" value=<?php echo "$ureal_name"; ?>>
      </div>
      <div id="city" class="form-group">
        <input name="ucity" class="form-control" value=<?php  echo "$ucity"; ?>>
      </div>
      <div id="birthday" class="form-group">
        <input name="ubirthday" type="date" class="form-control" value=<?php echo "$ubirthday" ?>>
      </div>
      <div class="m-b-lg">
        <input id="signup" type="submit" class="btn btn-primary" value="Update"/>
      </div>
    </form>
</form>
</body> 
</html> 