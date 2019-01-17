<?php
session_start();
$user=$_SESSION['user'];
 echo "<h2> Successfully logged out  $user </h2>"; 
 
session_unset(); 

// destroy the session 
session_destroy(); 

echo '<a href="index.php"; > Login</a>';
 header('Location: index.php');
?>