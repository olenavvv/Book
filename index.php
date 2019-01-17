<?php
// Start the session
session_start();
?>


<!DOCTYPE HTML>
<HTML>
<head>
  <title>ReadMe Book Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
		
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<?php include("inc_header.php");?>
<?php
if (isset($_GET['content']))
{ switch($_GET['content'])
   { 
     case 'Gallery': include("inc_gallery.php"); break;
	 case  'Contact': include("inc_contact.php"); break;
	 case  'login': include("fullLogin.php"); break;
	 case  'Register': include("register.php"); break;
	 case  'Forgot': include("forgotPass.php"); break;
	 case  'Fiction': include("inc_fiction.php"); break;
	 case  'Children': include("inc_children.php"); break;
	 case  'History': include("inc_history.php"); break;
	 case  'Education': include("inc_education.php"); break;
	 case  'Admin': include("admin.php"); break;
	 case  'Description': include("description.php"); break;
	
     case  'Home':
     default: include("inc_home.php"); break;
    }
}
else include("inc_home.php"); 
?>
<?php include("inc_footer.php");?>

</HTML>
