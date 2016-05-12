<?php

session_start();
$username1 = $_SESSION['username1']; 
include "dbconnect.php";
//--------------------------------------------------------------------------------
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
            padding-top:180px;
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

<form id="postform" action='collectioninsert.php' method='post' role="form" class="m-x-auto text-center app-login-form">
        <div id="description" class="form-group">
            <textarea rows="6" cols="50" name ="collection_name" class="form-control" placeholder="Type description here" ></textarea>
        </div>
        <div id="link" class="form-group">
            <textarea rows="6" cols="50" name ="c_description" class="form-control" placeholder="Collection link" ></textarea>
        </div>
        <div id="price" class="form-group">
          <input type="text" name="cprice" class="form-control" placeholder="Price">
        </div>
        <input id ="post" type="submit" value="Post">
        </form>
  </body>
</html>