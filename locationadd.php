<?php

session_start();
$usernametemp = $_SESSION['username1']; 
//$uid = $_GET['uid']; 
$lastlogin = $_SESSION['$lastlogin'];
include "dbconnect.php";
?> 

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
        #postform{
            padding-top:300px;
        }
        
        #more{
            height:50px;
        }
        #read{
            color: azure;
            font-weight: bold;
        }

    </style>

  </head>
<body>
    <?php include "titles.php"; ?>

<form id="postform" name="getaddress" action='locationinsert.php' method='post' role="form" class="m-x-auto text-center app-login-form">
        <div id="address" class="form-group">
          <input type="text" name="address" class="form-control" placeholder="Enter you address">
        </div>
        <div id="description" class="form-group">
          <input type="text" name="des" class="form-control" placeholder="Description">
        </div>
        <input id ="post" type="submit" value="Add">
        </form>
  </body>
</html>

