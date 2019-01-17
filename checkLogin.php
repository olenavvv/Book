<?php
session_start();
if (isset($_SESSION["login"])){
  header('Location: makeOrder.php');
}
else{
  echo "</br></br><p style ='font:14px Arial,sans-serif; color:black;' align='center'>Please login before!</p>";
  echo "<p style ='font:14px Arial,sans-serif; color:black;' align='center'>Redirect to login page in 2 sec!</p></br>";
  header('Refresh:2; url=index.php?content=login');
}
 ?>
