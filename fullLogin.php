
<!DOCTYPE HTML>
<html>

<?php
// Start the session
require_once ("DBFunctions.php");


$logs=0;

if (isset($_POST['login']))

{
     if (isset($_POST['logs'])) $logs=$_POST['logs']+1;   // We need the hidden var $logs to count the number of user attemps
      $username=htmlentities($_POST['user_name']);
      $password=htmlentities($_POST['password']);
    if (validate_user($username,$password))             // check if user exists in DB
     {
       echo " Successful login, redirect in 1 sec";
	   header('Location: makeOrder.php');
	   session_start();
      $_SESSION['user']=$username;        // You will learn about session later..., if you don't use it it won't affect this code
      $_SESSION['login']=1;
	  if($username=="admin"){
		  header('Refresh:1; url=admin.php');
		  
	  }
	  else{
		header('Refresh:1; url=index.php');
	  }
	
     }

else {    echo " User name or password incorrect! ";

             if ($logs<5) echo ' Try again....';
             else echo 'Cannot login now, Maximum number of attempts is 5'; //Prevent user from trying to login after 5 unsuccessful attempts
           }

}


echo <<<_END
<div class="container">
<center><h1> User Login </h1>
<form method='POST' action="FullLogin.php">
<div class="form-group">
<input type="text" name="user_name" placeholder="UserName" required="required"/></br></br>
</div>
<div class="form-group">
<input type="password" name="password" placeholder="Your password" required="required"/></br></br>
</div>
<div class="form-group">
<input type="submit"  style="width: 178px;" float: right; name="login"  value="Login"  /></br></br>
_END;
?>
</div>
<input type="hidden" name="logs" value="<?php echo $logs;?>"/>
</form>

<a href="index.php?content=Forgot">Forgot Password? </a> </br></br>
<a href="index.php?content=Register">Register </a></br></br></center>
</div>
</HTML>
