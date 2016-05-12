<html> 
<body> 
<h2><center>MUSIC FRIEND</center>  <br /></h2>
<?php

session_start();
$usernametemp = $_SESSION['username1']; 
include "dbconnect.php";

//--------------------------------------------------------------------------
//welcome
$sql = "SELECT username, ureal_name, ulast_login from users where username = '$usernametemp'";
$result = $mysqli->query($sql);

if ($row = $result->fetch_array()){
  include "titles.php";
  echo "</br>";
  echo  "Welcome";
  echo "</br>";
  echo  "Username: " .$row[0]. ";  "; 
  echo "<br>";
  echo  "Real name:  " .$row[1]. ";  ";
  echo "</br>";
  echo  "Last tiem login:  ".$row[2]."  ";
  echo "</br></br></br>";
}
session_destroy();
echo "you have successfully logout";
echo "</br></br>";
echo '<a href="index.html">login again!</a>';
$mysqli->close();
?> 

</body> 
</html> 