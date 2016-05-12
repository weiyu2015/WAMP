<html>

<body>
<h2><center>MUSIC FRIEND</center>  <br /></h2>
<form c> 
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
//--------------------------------------------------------------------------------
echo "You can search posts you interested<br><br>";
echo "Keywords in title or context: <br><br>";
echo '<input type="text" name="searchposts"/>';
echo "<input type='submit' value='search'><br>";

?>
</form>

</body>
</html>