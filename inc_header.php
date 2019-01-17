<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  <script language="javascript"> 
</script>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
	<form action="index.php" method="get" id="my_form">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php?content=Home">Home</a></li>
        <li><a href="index.php?content=Gallery">Gallery</a></li>
        <li><a href="checkLogin.php">Make an order</a></li>
        <li><a href="index.php?content=Contact">Contact</a></li>
		<?php
		if(isset($_SESSION["login"])){
			
			if($_SESSION['user']=="admin"){
				echo '<li><a href="index.php?content=Admin">Admin area</a></li>';
			}
		}
		?>
      </ul>
	  </form>
      <ul class="nav navbar-nav navbar-right">
	  <?php
	  if (isset($_SESSION["login"])){
		 $link = "logout.php"; 
		 $username = $_SESSION['user'];
		 echo "<li><a href=$link><span>Welcome, $username !&nbsp;</span><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
	  }
	  else{
		 echo '<li><a href="index.php?content=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
	  }
	  ?>
      </ul>
    </div>
  </div>
</nav>