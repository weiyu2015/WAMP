
<?php 
session_start();
$username1 = $_SESSION['username1'];
$usernametemp = $_SESSION['username1'];
$eid = $_GET['eid'];
$lastlogin = $_SESSION['$lastlogin'];
$_SESSION['cid'] = $eid; 
include "dbconnect.php";

$sql = "SELECT username, ureal_name, ulast_login from users where username = '$usernametemp'";
$result = $mysqli->query($sql);

$lastlogintime ="";
if ($row = $result->fetch_array()){
  $lastlogintime=$row[2];
    $activity="";
      $sqlActivity = "SELECT E.event_name, E.estart_time, E.eend_time, E.edescription, E.mlocid,E.eventid from events E
            where E.estart_time > '$lastlogin'";
      $resultSqlActivity = $mysqli->query($sqlActivity);
      if (!$resultSqlActivity) {
        $activity .= "no more activity so far";
      //die("Error running $sql: " . mysql_error());
      } 
      else {
        while($row = $resultSqlActivity->fetch_array()){
        $a = $row[0];
        $activity .= '<a style="text-decoration:none" href="events.php?eid='.$row[5].'">'.$a.'</a><br>';
        }
      }
      $friendpost="";
      $sqlFriendPost = "SELECT C.username, C.ctitle, C.cpost_time, C.mlocid,C.cpostid from contents C
            where C.cpost_time > '$lastlogin'and C.cprivileges=1 and C.username in (". "SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 union 
                        SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1)";
      $resultSqlFriendPost = $mysqli->query($sqlFriendPost);
      if (!$resultSqlFriendPost) {
        $friendpost .= "no more Friend Post so far";
      //die("Error running $sql: " . mysql_error());
      } 
      else {
        while($row = $resultSqlFriendPost->fetch_array())
        {
        $b = $row[1].'<br>';

        $friendpost .= '<a style="text-decoration:none" href="contents.php?cid='.$row[4].'">'.$b.'</a>';
        }
      }
      $fofpost="";
      $sqlPublicPost = "SELECT C.username, C.ctitle, C.cpost_time, C.mlocid,C.cpostid from contents C 
      where C.cpost_time > '$lastlogin' and C.cprivileges=2 and (
      (C.username in (". 
      "(SELECT b.applyname FROM add_friend a join  add_friend b WHERE a.applyname = b.addedname and a.astatus=1 and a.addedname = '".$usernametemp."' and  b.applyname not in (SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1) and b.applyname <> '".$usernametemp."')))".
      "or (C.username in (". 
      "(SELECT b.addedname FROM add_friend a join  add_friend b WHERE a.applyname = b.applyname and a.astatus=1 and a.addedname = '".$usernametemp."' and  b.addedname not in (SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1) and b.addedname <> '".$usernametemp."')))".
        "or (C.username in (". 
      "(SELECT b.applyname FROM add_friend a join  add_friend b WHERE a.addedname = b.addedname and a.astatus=1 and a.applyname = '".$usernametemp."' and  b.applyname not in (SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1) and b.applyname <> '".$usernametemp."')))".
        "or (C.username in (". 
      "(SELECT b.addedname FROM add_friend a join  add_friend b WHERE a.addedname = b.applyname and a.astatus=1 and a.applyname = '".$usernametemp."' and  b.addedname not in (SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1) and b.addedname <> '".$usernametemp."')))"
      .")";
      $resultsqlPublicPost = $mysqli->query($sqlPublicPost);
      if (!$resultsqlPublicPost) {
        $fofpost .= "no more Friend of Friend Post so far";
      //die("Error running $sql: " . mysql_error());
      } 
      else {
        while($row = $resultsqlPublicPost->fetch_array()){
        $b = $row[1] . "   author: " . $row[0].'<br>';

        $fofpost .= '<a style="text-decoration:none" href="contents.php?cid='.$row[4].'">'.$b.'</a>';
        }
      }
      $publicpost="";
      $sqlPublicPost = "SELECT C.username, C.ctitle, C.cpost_time, C.mlocid, C.cpostid from contents C 
      where C.cpost_time > '$lastlogin' and C.cprivileges=0";
      $resultsqlPublicPost = $mysqli->query($sqlPublicPost);
      if (!$resultsqlPublicPost) {
        $publicpost .= "no more Public Post so far";
      //die("Error running $sql: " . mysql_error());
      } 
      else {
        while($row = $resultsqlPublicPost->fetch_array()){
        $b = $row[1] . "   author: " . $row[0];

        $publicpost .= '<a style="text-decoration:none" href="contents.php?cid='.$row[4].'">'.$b.'</a><br>';
        }
      }
        $friend="";
        $sqlListFriends = "SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 union 
        SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1";
        $resultSqlListFriends = $mysqli->query($sqlListFriends);
        if (!$resultSqlListFriends) {
        $friend .= "no more friends so far";
          //die("Error running $sql: " . mysql_error());
        } 
        else {
        while($row = $resultSqlListFriends->fetch_array()) {
        $b = " " .$row[0];
        $friend .= '<a style="text-decoration:none" href="allposts.php?uid='.$row[0].'">'.$b.'</a><br>';
            //echo '<a href="contents.php?cid='.$row[4].'">'.$b.'</a>';
        }
        }
        $fof="";
        $sqlListFriendOfFriend=
        "(SELECT b.applyname FROM add_friend a join  add_friend b WHERE a.applyname = b.addedname and a.astatus=1 and a.addedname = '".$usernametemp."' and  b.applyname not in (SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1) and b.applyname <> '".$usernametemp."')"
        ."union".
        "(SELECT b.addedname FROM add_friend a join  add_friend b WHERE a.applyname = b.applyname and a.astatus=1 and a.addedname = '".$usernametemp."' and  b.addedname not in (SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1) and b.addedname <> '".$usernametemp."')"
        ."union".
        "(SELECT b.applyname FROM add_friend a join  add_friend b WHERE a.addedname = b.addedname and a.astatus=1 and a.applyname = '".$usernametemp."' and  b.applyname not in (SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1) and b.applyname <> '".$usernametemp."')"
        ."union".
        "(SELECT b.addedname FROM add_friend a join  add_friend b WHERE a.addedname = b.applyname and a.astatus=1 and a.applyname = '".$usernametemp."' and  b.addedname not in (SELECT addedname FROM add_friend WHERE applyname = '".$usernametemp."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$usernametemp."' and astatus=1) and b.addedname <> '".$usernametemp."')"
        ;


          $resultSqlListFriendOfFriend = $mysqli->query($sqlListFriendOfFriend);
          if (!$resultSqlListFriendOfFriend) {
            $fof .= "no more friends so far";
          //die("Error running $sql: " . mysql_error());
          } 
          else {
            while($row = $resultSqlListFriendOfFriend->fetch_array()) {

            $b = " " .$row[0];
            //echo $b ; 
            $fof .= '<a style="text-decoration:none" href="allposts.php?uid='.$row[0].'">'.$b.'</a>';
            }
          }
}


  $sqlcopst = "SELECT eventid, event_name, estart_time, eend_time, edescription, mlocid from events where eventid = '$eid'";
  //echo $sql2;
  $resultcpost = $mysqli->query($sqlcopst);
  $row = $resultcpost->fetch_array();
  $eventname = $row[1];
  $starttime = $row[2];
  $endtime = $row[3];
  $description = $row[4];
  $mlocid=$row[5];
  $sqllocation = "SELECT * FROM `maps` WHERE `mlocid`='$mlocid'";
  $resultlocation = $mysqli->query($sqllocation);
  $rowlocation = $resultlocation->fetch_array();
  $des = $rowlocation[1];
  $address = $rowlocation[2];
  $address_encode = urlencode($address);
  $sqltotallike = "SELECT count(*) from com_event where celike=1 and eventid = '$eid'";
  //$sqltotallike = "SELECT count(*) FROM `com_event` WHERE 1";
  $resultlike = $mysqli->query($sqltotallike);
  $rowcount = $resultlike->fetch_array();
  $totallike = $rowcount[0];
  $sqlwhowilin = "SELECT username from  `join_events` where `eventid` = '$eid'";
  $resultsqlwhowilin = $mysqli->query($sqlwhowilin);
$join = "";
  while($row = $resultsqlwhowilin->fetch_array()){
   $join .= $row[0]."<br>";
  }
//load the comments of this post
  $sqlcommentpost = "SELECT username, cetime, cetext, celike from com_event where eventid = '$eid'";
  $resultSqlcommentpost = $mysqli->query($sqlcommentpost);
$commenttime ="";
$commentby ="";
$commentcontent ="";
$like ="";
  while($row = $resultSqlcommentpost->fetch_array()){
    $commenttime .= $row[1];
    $commentby .= $row[0];
    $commentcontent .= $row[2];
    $like .= $row[3];
    
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
      }
        #more{
            height:50px;
        }
        #menu{
           position:absolute;
           left:425px;
        }
        #form{
            height:320px;   
        }
        #commetform{
            padding-top: 70px;
        }
        

    </style>

  </head>


<body class="with-top-navbar">
  


<div class="growl" id="app-growl"></div>

<?php include "titles.php";?>

<div class="container p-t-md">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default panel-profile m-b-md">
        <div class="panel-heading" style="background-image: url(assets/nirvana.jpg);"></div>
        <div class="panel-body text-center">
          <a href="update.php">
            <img
              class="panel-profile-img"
              src="assets/avatar1.png">
          </a>

          <h5 class="panel-title">
            <a class="text-inherit" href="update.php"><?php echo "$usernametemp"; ?></a>
          </h5>

          <p class="m-b-md">I wish i was a little bit taller, wish i was a baller, wish i had a girl… also.</p>

          <ul class="panel-menu">
            <li class="panel-menu-item">
              <a href="#userModal" class="text-inherit" data-toggle="modal">
                Friends
                <h5 class="m-y-0">3</h5>
              </a>
            </li>

            <li class="panel-menu-item">
              <a href="#userModal" class="text-inherit" data-toggle="modal">
                Enemies
                <h5 class="m-y-0">0</h5>
              </a>
            </li>
          </ul>
        </div>
      </div>
       <div class="panel panel-default visible-md-block visible-lg-block">
           
        <div class="panel-body">
          <h5 class="m-t-0">Friends:</h5>
          <li class="media list-group-item p-a">
            <p>
              <?php echo "$friend"; ?>
            </p>
        </li>
        </div>
           
        <div class="panel-body">
          <h5 class="m-t-0">Friend of Friend:</h5>
          <li class="media list-group-item p-a">
            <p>
              <?php echo "$fof"; ?>
            </p>
        </li>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <ul class="list-group media-list media-list-stream">

        
        <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <h5 id="activitytitle">Event name:</h5>
            </div>

            <p id="eventname">
              <?php echo "$eventname"; ?>
            </p>
          </div>
        </li> 
          <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <h5 id="activitytitle">Start time:</h5>
            </div>

            <p id="starttime">
              <?php echo "$starttime"; ?>
            </p>
          </div>
        </li>   
          <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <h5 id="activitytitle">End time:</h5>
            </div>

            <p id="posttime">
              <?php echo "$endtime"; ?>
            </p>
          </div>
        </li>   
          <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <h5 id="activitytitle">Description:</h5>
            </div>

            <p id="description">
              <?php echo "$description"; ?>
            </p>
          </div>
        </li>   
          <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <h5 id="activitytitle">Location:</h5>
            </div>

            <p id="eventlocation">
              <?php echo "$address"; ?>
            </p>
              <iframe id="map" width="540" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $address_encode; ?>&key=AIzaSyBn_uYUy864K4-kDBqTNzg3ShAc9g2yNzw"></iframe>
          </div>
        </li>   
          <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <h5 id="activitytitle">Total likes:</h5>
            </div>

            <p id="totallike">
              <?php echo "$totallike"; ?>
            </p>
          </div>
        </li>   
          <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <h5 id="activitytitle">Who will in:</h5>
            </div>

            <p id="whowillin">
              <?php echo "$join"; ?>
            </p>
          </div>
        </li>   
          <li class="media list-group-item p-a">
          <div class="media-body">
            <div class="media-heading">
              <h5 id="activitytitle">Comments:</h5>
            </div>

            <p id="commentcontent">
              <?php echo "$commentcontent"; ?>
            </p>
          </div>
        </li>   
        <li id="form" class="media list-group-item p-a">
            <div class="media-body">
          <form id="commetform" action='commentevent.php' method='post' role="form" class="m-x-auto text-center app-login-form">
        <div id="newcomment" class="form-group">
            <textarea rows="6" cols="50" name ="eventbody" class="form-control" placeholder="Your comments" ></textarea>
        </div>
        <div id="like" class="form-group">
            <span id="read">Do you like this post?:</span>
        <select name="celike"> 
        <option value= 1>like</option>
        <option value= 0>don't like</option></select>
        </div>
        <div id="register" class="form-group">
            <span id="read">Do you like this post?:</span>
        <select name="cereg"> 
        <option value= 1>I am in!</option>
        <option value= 0>No interests...</option></select>
        </div>
              <?php echo "<input type = "."'"."hidden"."'"." name="."'"."eid"."'"." value=".$eid.">"; ?>
        <input id ="post" type="submit" value="Comment">
        </form>
            </div>
          </li>
       </ul>   
    </div>
    <div class="col-md-3">
        <div class="alert alert-warning alert-dismissible hidden-xs" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <?php echo "Last login: "."$lastlogintime"; ?>
      </div>
      <div class="panel panel-default m-b-md hidden-xs">
        <div class="panel-body">
          <h5 class="m-t-0">Event</h5>
          <div data-grid="images" data-target-height="150">
            <img class="media-object" data-width="640" data-height="640" data-action="zoom" src="assets/leonard-cohen-014.jpg">
          </div>
          <?php echo "$activity"; ?>
        </div>
      </div>

      <div class="panel panel-default m-b-md hidden-xs">
        <div class="panel-body">
          <h5 class="m-t-0">CDs <small>· <a href="collectionpost.php">Edit</a></small></h5>
          <div data-grid="images" data-target-height="150">
            <div>
              <img data-width="640" data-height="640" data-action="zoom" src="assets/61y69fyxsfL._SL1248_.jpg">
            </div>

            <div>
              <img data-width="640" data-height="640" data-action="zoom" src="assets/aladdin_sane_89mVtla.jpg">
            </div>
          </div>
        </div>
        <div class="panel-footer">
          Username1 really likes these music, no one knows why though.
        </div>
      </div>

      <div class="panel panel-default panel-link-list">
        <div class="panel-body">
          May 1st 2016

          <p>
              Jiming Ye, jy1769.<br>
              Wei Yu, wy596.
            </p>
        </div>
      </div>
    </div>
  </div>
</div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/toolkit.js"></script>
    <script src="assets/js/application.js"></script>
    <script>
      // execute/clear BS loaders for docs
      $(function(){
        if (window.BS&&window.BS.loader&&window.BS.loader.length) {
          while(BS.loader.length){(BS.loader.pop())()}
        }
      })
    </script>
    
  </body>
</html>
