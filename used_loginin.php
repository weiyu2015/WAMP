<?php

$username1 = $_POST["Username"];
$passwords = $_POST["Password"];

session_start();
$_SESSION['username1'] = $username1; 


include "dbconnect.php";
$sql = "SELECT username, ureal_name, ulast_login from users where username = ? and upassword = ?";
//echo $sql;
$stmt = mysqli_prepare($mysqli, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $username1, $passwords);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $username, $urealname, $lastlogin);
    mysqli_stmt_num_rows($stmt);

    while (mysqli_stmt_fetch($stmt)) {
    $sql2 = "UPDATE Users SET ulast_login = CURRENT_TIMESTAMP WHERE username = '$username1' and upassword = '$passwords'";
    $result2 = $mysqli->query($sql2);
    }
if (mysqli_stmt_num_rows($stmt)>0){
  include "titles.php";
  echo "</br>";
  echo  "Welcome";
  echo "</br>";
  echo  "Username: " .$username. ";  "; 
  echo "<br>";
  echo  "Real name:  " .$urealname. ";  ";
  echo "</br>";
  echo  "Last tiem login:  ".$lastlogin."  ";
  $_SESSION['$lastlogin']=$lastlogin ;
  echo "</br></br></br>";
}
//------------------------------------------------
//list events(Activity)
  echo "Unread Activity:";
  $sqlActivity = "SELECT E.event_name, E.estart_time, E.eend_time, E.edescription, E.mlocid,E.eventid from events E
        where E.estart_time > '$lastlogin'";
  $resultSqlActivity = $mysqli->query($sqlActivity);
  echo "<br/>";
  if (!$resultSqlActivity) {
    echo "no more activity so far";
  //die("Error running $sql: " . mysql_error());
  } 
  else {
    while($row = $resultSqlActivity->fetch_array()){
    $a = "event name: " .$row[0] . "   start time: " . $row[1] . "    end time: " . $row[2] . "   description: " . $row[3]. "    location: " . $row[4];
    echo '<a href="events.php?eid='.$row[5].'">'.$a.'</a>';
    echo "<br/>";
    }
  }
  echo "</br></br></br>";
//----------------------------------------------------------------------------------------
//list friend post
  echo "Unread Friend Post:";
  $sqlFriendPost = "SELECT C.username, C.ctitle, C.cpost_time, C.mlocid,C.cpostid from contents C
        where C.cpost_time > '$lastlogin'and C.cprivileges=1 and C.username in (". "SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 union 
                    SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1)";
  $resultSqlFriendPost = $mysqli->query($sqlFriendPost);
  echo "<br/>";
  if (!$resultSqlFriendPost) {
    echo "no more Friend Post so far";
  //die("Error running $sql: " . mysql_error());
  } 
  else {
    while($row = $resultSqlFriendPost->fetch_array())
    {
    $b = "title: " .$row[1] . "   author: " . $row[0] . "    post time: " . $row[2] ."    location: " . $row[3];

    echo '<a href="contents.php?cid='.$row[4].'">'.$b.'</a>';
    echo "<br/>";
    }
  }
  echo "</br></br></br>";
//--------------------------------------------------------------------------------
//list friend of friend post
  echo "Unread Friend of Friend Post:";
  $sqlPublicPost = "SELECT C.username, C.ctitle, C.cpost_time, C.mlocid,C.cpostid from contents C 
        where C.cpost_time > '$lastlogin' and C.cprivileges=2 and (
  (C.username in (". 
  "(SELECT b.applyname FROM add_friend a join  add_friend b WHERE a.applyname = b.addedname and a.astatus=1 and a.addedname = '".$username."' and  b.applyname not in (SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1) and b.applyname <> '".$username."')))".
  "or (C.username in (". 
  "(SELECT b.addedname FROM add_friend a join  add_friend b WHERE a.applyname = b.applyname and a.astatus=1 and a.addedname = '".$username."' and  b.addedname not in (SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1) and b.addedname <> '".$username."')))".
    "or (C.username in (". 
  "(SELECT b.applyname FROM add_friend a join  add_friend b WHERE a.addedname = b.addedname and a.astatus=1 and a.applyname = '".$username."' and  b.applyname not in (SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1) and b.applyname <> '".$username."')))".
    "or (C.username in (". 
  "(SELECT b.addedname FROM add_friend a join  add_friend b WHERE a.addedname = b.applyname and a.astatus=1 and a.applyname = '".$username."' and  b.addedname not in (SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1) and b.addedname <> '".$username."')))"
  .")";
  $resultsqlPublicPost = $mysqli->query($sqlPublicPost);
  echo "<br/>";
  if (!$resultsqlPublicPost) {
    echo "no more Friend of Friend Post so far";
  //die("Error running $sql: " . mysql_error());
  } 
  else {
    while($row = $resultsqlPublicPost->fetch_array()){
    $b = "title: " .$row[1] . "   author: " . $row[0] . "    post time: " . $row[2] ."    location: " . $row[3];

    echo '<a href="contents.php?cid='.$row[4].'">'.$b.'</a>';
    echo "<br/>";
    }
  }
  echo "</br></br></br>";

//----------------------------------------------------------------------------------------
//list public post
  echo "Unread Public Post:";
  $sqlPublicPost = "SELECT C.username, C.ctitle, C.cpost_time, C.mlocid, C.cpostid from contents C 
        where C.cpost_time > '$lastlogin' and C.cprivileges=0";
  $resultsqlPublicPost = $mysqli->query($sqlPublicPost);
  echo "<br/>";
  if (!$resultsqlPublicPost) {
    echo "no more Public Post so far";
  //die("Error running $sql: " . mysql_error());
  } 
  else {
    while($row = $resultsqlPublicPost->fetch_array()){
    $b = "title: " .$row[1] . "   author: " . $row[0] . "    post time: " . $row[2] ."    location: " . $row[3];

    echo '<a href="contents.php?cid='.$row[4].'">'.$b.'</a>';
    echo "<br/>";
    }
  }
  echo "</br></br></br>";
//--------------------------------------------------------------------------------
//list friends
  $sqlListFriends = "SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 union 
                    SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1";
  $resultSqlListFriends = $mysqli->query($sqlListFriends);
  echo "friends<br/>";
  if (!$resultSqlListFriends) {
    echo "no more friends so far";
  //die("Error running $sql: " . mysql_error());
  } 
  else {
    while($row = $resultSqlListFriends->fetch_array()) {
    $b = " " .$row[0];
    echo '<a href="allposts.php?uid='.$row[0].'">'.$b.'</a>';
    //echo '<a href="contents.php?cid='.$row[4].'">'.$b.'</a>';
    echo "<br/>";
    }
  }
  echo "</br></br></br>";
  echo "<br/>";
  echo "</br></br>";

//---------------------------------------------------------------------------------
//list friend of frined
$sqlListFriendOfFriend=
"(SELECT b.applyname FROM add_friend a join  add_friend b WHERE a.applyname = b.addedname and a.astatus=1 and a.addedname = '".$username."' and  b.applyname not in (SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1) and b.applyname <> '".$username."')"
."union".
"(SELECT b.addedname FROM add_friend a join  add_friend b WHERE a.applyname = b.applyname and a.astatus=1 and a.addedname = '".$username."' and  b.addedname not in (SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1) and b.addedname <> '".$username."')"
."union".
"(SELECT b.applyname FROM add_friend a join  add_friend b WHERE a.addedname = b.addedname and a.astatus=1 and a.applyname = '".$username."' and  b.applyname not in (SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1) and b.applyname <> '".$username."')"
."union".
"(SELECT b.addedname FROM add_friend a join  add_friend b WHERE a.addedname = b.applyname and a.astatus=1 and a.applyname = '".$username."' and  b.addedname not in (SELECT addedname FROM add_friend WHERE applyname = '".$username."' and astatus=1 UNION SELECT applyname FROM add_friend WHERE addedname = '".$username."' and astatus=1) and b.addedname <> '".$username."')"
;


  $resultSqlListFriendOfFriend = $mysqli->query($sqlListFriendOfFriend);
  echo "friend of friend<br/>";
  if (!$resultSqlListFriendOfFriend) {
    echo "no more friends so far";
  //die("Error running $sql: " . mysql_error());
  } 
  else {
    while($row = $resultSqlListFriendOfFriend->fetch_array()) {

    $b = " " .$row[0];
    //echo $b ; 
    echo '<a href="allposts.php?uid='.$row[0].'">'.$b.'</a>';
    echo "<br/>";
    }
  }
  echo "</br></br></br>";
  echo "<br/>";
  echo "</br></br>";

}

//--------------------------------------------------------------------------------

else {
  echo "invalid username and passwords! New Users please ";
  echo '<a href="signup.php">Sign up</a>';
  echo "</br>or</br>";
  echo '<a href="index.html">Retry</a>';
}


$mysqli->close();
?> 