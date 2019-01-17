<?php

require_once "DBFunctions.php";

if (isset($_POST['Register']))
{

  if (same_passwords($_POST['password'],$_POST['Rpassword']))   // check if both passwords match

       add_user($_POST['username'],$_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['tel'],$_POST['password']); // Add to database

   else { $err_message="The two passwords didn't match try again..";
          echo $err_message;
         }

}


echo <<<_END

<h1 align='center'> New User </h1>
<center><form method='POST' action="Register.php">
<input type="text" name="username" placeholder="UserName" required="required"/></br></br>


<input type="text" name="fname" placeholder="First Name" required="required"/></br></br>
<input type="text" name="lname" placeholder="Last Name" required="required"/></br></br>
<input type="text" name="email" placeholder="Your email" required="required"/></br></br>
<input type="text" name="tel" placeholder="Your tel number" required="required"/></br></br>


<input type="password" name="password" placeholder="Type a password" required="required"/></br></br>

<input type="password" name="Rpassword" placeholder="Type again password" required="required"/></br></br>

<input type="submit"  style="width: 178px;" float: right; name="Register"  value="Register"  /></br></br>
_END;
?>

</form></center>
<center><a href="index.php?content=login">Login </a> </br></br>
<a href="index.php?content=login">Cancel Registration </a> </br></br></center>
