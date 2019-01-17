<?php
GLOBAL $rootDir;
require_once ("Connect_PDO.php");




function same_passwords($pass1,$pass2) { 
                                if($pass1==$pass2) return true;
								else return false;}


function encrypt($pass) { $salt="RTui%b*B29";
                          $newPass=$salt.$pass;
                          $token = hash('ripemd128', $newPass);
                         return $token;
			
 }

 function sameAsUserData($uName,$fname,$lname) { 
 GLOBAL $pdo;
   $sql = "SELECT lname, fname FROM All_Users
         WHERE uname = :un ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':un' => $uName));
     if (($row = $stmt->fetch(PDO::FETCH_ASSOC))!=0) {      
	                                                       //echo ($row['lname']); echo($row['fname']);
	 
	                                                        if (($row['lname']==$lname) && ($row['fname']==$fname))return true;
	                                                        else return false;}
  
 }
 
 
 
function userExist($uName) { 
    GLOBAL $pdo;
   $sql = "SELECT lname, fname,email FROM All_Users
         WHERE uname = :un ";
    //echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':un' => $uName));
     if (($row = $stmt->fetch(PDO::FETCH_ASSOC))==0) { return false;}
     else   {return true;}                 



}
 
function changePassword($username,$password)

{
	GLOBAL $pdo;
	$sql = "UPDATE All_Users SET password= :upass WHERE uname=:un";

    // Prepare statement
    $stmt = $pdo->prepare($sql);

    // execute the query
    $stmt->execute(array(
        ':un' => $username,
        ':upass' => $password));
		echo "<h2> Password changed for User $username </h2>";
}


 
function InsertRecord($uname,$fname,$lname,$email,$tel,$password){ 
GLOBAL $pdo;
$sql = "INSERT INTO All_Users (uname, fname,lname,email, tel, password)
               VALUES (:uname,:fname,:lname, :email, :tel, :password)";
    //echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':uname' => $uname,
        ':fname' => $fname,
         ':lname' => $lname,
        ':email' => $email,
		':tel' => $tel,
        ':password' => $password));
		echo "<h2> User $uname added... Go to Login</h2>";
		
}

// check if user and password are saved in table

function validate_user($uName,$uPassword)   
{   GLOBAL $pdo;
    
	//$uName=htmlentities($uName);
	//$uPassword=htmlentities($uPassword); done in fulllogin.php
    
	/*$salt="RTui%b*B29";
    $saltedPass=$salt.$uPassword;
    $encr_password = hash('ripemd128', $saltedPass);*/
	
	$encr_password =encrypt($uPassword);
     //echo"User password is $encr_password<br/>";
     $sql = "SELECT lname, fname,email FROM All_Users
         WHERE uname = :un AND password = :pw";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':un' => $uName,
        ':pw' => $encr_password));
     if (($row = $stmt->fetch(PDO::FETCH_ASSOC))==0) {  echo "<h2> Login incorrect</h2>";
                                                        return false;}
     else   {  //echo"<pre>"; print_r($row);echo"</pre>";
              $_SESSION['userName']=$uName; return true;}
     
   }

function add_user($uName, $uFName, $uLName,$uEmail,$uTel, $uPassword)

{
	// sanitize user inputs   You can use filter_var
  $uName=htmlentities($uName); 
  $uFName=htmlentities($uFName); 
  $uLName=htmlentities($uLName);
  $uEmail=htmlentities($uEmail);
  $utel=htmlentities($uTel);
  $uPassword=htmlentities($uPassword);


  if ( !userExist($uName) ) {      //User doesn't exist 
  InsertRecord($uName, $uFName, $uLName,$uEmail, $utel, encrypt($uPassword));}
  else {echo  " UserName $uName already exists "; echo ' <a href="fullLogin.php"; > Try again ..</a>';}


}


?>









