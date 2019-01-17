

<?php
require_once ("DBFunctions.php");

if (isset($_POST['ChangePass']))

{ $username=htmlentities($_POST['username']);
   $fname=htmlentities($_POST['fname']);
   $lname=htmlentities($_POST['lname']);
   // check if username registred
  if (!userExist($username))    {echo " <h2> Username not Registered </h2>";  echo '<a href="$rootDir/login/register.php"; > Register? </a>';}
  
   else { // check if same passwords
           if (!same_passwords($_POST['pass'],$_POST['Rpass'])) echo "The two passwords didn't match try again..";
		   else
		   {   //Check if fname and lname are the same in DB  
	         if (sameAsUserData($username,$fname,$lname)) {
	         $newPass=htmlentities($_POST['pass']);
			 $newPass=encrypt($newPass);
			 // change password in DB
			 ChangePassword($username,$newPass);
			 //send email to user to confirm his password was changed
			 echo ' <a href="fulllogin.php"; > Login ? </a> ';
			 }
			 else echo " Sorry! One or more data not matching to our records, Try again";
					 
	        }
      
   }
}
 



echo <<<_END

<center><h1> Set new password </h1>
<form method='POST' action="forgotPass.php">
<input type="text" name="username" placeholder="UserName" required="required"/></br></br>


<input type="text" name="fname" placeholder="First Name" required="required"/></br></br>
<input type="text" name="lname" placeholder="Last Name" required="required"/></br></br>

<input type="password" name="pass" placeholder="Type a new password" required="required"/></br></br>

<input type="password" name="Rpass" placeholder="Type again password" required="required"/></br></br>

<input type="submit" style="width: 178px;" float: right; name="ChangePass"  value="Change Password"  /></br></br>
</form>
<a href="index.php?content=login";> Cancel </a></br></br></center>
_END;

?>