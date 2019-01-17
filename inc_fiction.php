<?php
require_once "Connect_PDO.php";
function showProduct(){
	GLOBAL $pdo;
  	$stmt = $pdo->query("SELECT image, title, author, price FROM tblproduct
	WHERE category = 'fiction' ");
	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		$image=$row['image'];
		$title=$row['title'];
		$author=$row['author'];
		$price=$row['price'];
		echo( '<div class = "col-sm-6 col-md-3">
      <div class = "thumbnail">');
	    echo("<img src = $image alt = $title></div>");
        echo('<div class = "caption">');  
		echo ("<h3>$title</h3>
			   <p>Author: $author</p>
				<p>Price: $price</p>
				<p>");
        echo ('<a href = "description.php" target="_blank" class = "btn btn-primary" role = "button">
			Description
			</a>
         </p>
         
      </div>
   </div>');
		 
	}
}
?>
 
<div class = "row">
   
  <?php showProduct()?>
   
</div>