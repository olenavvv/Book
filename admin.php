<?php
require_once "Connect_PDO.php";
if(!$_SESSION['user']=="admin"){
		header('Refresh:0; url=index.php');
	  }
function prodExists($title){
  	GLOBAL $pdo;
  	$sql = "SELECT title FROM tblproduct WHERE title =:title";
  	//echo "<pre>\n$sql\n</pre>\n";
  	$stmt = $pdo->prepare ($sql);
  	$stmt -> execute(array (':title' => $title));
  	if (($row = $stmt -> fetch (PDO::FETCH_ASSOC))==0) { return true;}
  	else {return false;}
  }
  
function insertProd($title, $author, $image,  $price, $category){
    GLOBAL $pdo;
    $sql = "INSERT INTO tblproduct(title, author, image, price, category) 
                 VALUES ( :title, :author, :image, :price, :category)";
    $stmt = $pdo->prepare ($sql);
    $stmt->execute(array(
           ':title' => $title,
           ':author' => $author,
           ':image' => $image,
           ':price' => $price,
		   ':category' => $category));
}
  
 function getProduct(){
	GLOBAL $pdo;
  	$stmt = $pdo->query("SELECT title, price FROM tblproduct");
	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		$titleR=$row['title'];
		$priceR=$row['price'];		
		echo ("<option value=$titleR>$titleR</option>");
	}	 
 }
 
function deleteProd($title){
	GLOBAL $pdo;
	$sql = "DELETE from tblproduct where title = :title";
	$stmt = $pdo->prepare ($sql);
    $stmt->execute(array(':title' => $title));
}


if(isset($_POST['delP'])){
	GLOBAL $pdo;
	$delCode = htmlentities($_POST['delCode']);
	deleteProd($delCode);
	echo "Data was deleted ! ";
}

if(isset($_POST['addP']))
{    GLOBAL $pdo;
	$title = htmlentities($_POST['title']);
    $author = htmlentities($_POST['author']);	
    $image = htmlentities($_POST['image']);	
	$price = htmlentities($_POST['price']);
	$category = htmlentities($_POST['category']);
	if(prodExists($title)) {
	insertProd ($title, $author,$image,  $price, $category);
			echo "Data was added ! ";
		
	}
	else 
		echo "Product has already existed!";
}	
?>

<div class="col-md-2">
  <h2>Add new book</h2>

  </br>
  <form method="POST" action="index.php?content=Admin">
    <div class="form-group">
      <input type="text" name="title"   placeholder="title of book" required="required">
    </div>
    <div class="form-group">
      <input type="text" name="author"   placeholder="author" required="required">
    </div>
    <div class="form-group">
	 <input type="text" name="image"   placeholder="image" required="required">
	</div>
	<div class="form-group">
	<input type="text" name="price"   placeholder="price" required="required">
	</div>
	<div class="form-group">
	<select name="category" >
    <option value="fiction" >fiction</option>
	<option value="children">children</option>
    <option value="history">history</option>
	<option value="education">education</option>
  </select>
	</div>
	
    <button type="submit" class="btn btn-default" name="addP" value="Add book">Submit</button>
  </form>
</div>

<div class="col-md-2">
<h2>Delete book</h2>
<form method="POST" action="index.php?content=Admin">
 <div class="form-group">
 <select name="delCode">
					<?php getProduct()?>
</select>
 </div>
 <div class="form-group">
 <button type="submit" class="btn btn-default"  name="delP" value="Delete book">Delete</button>
 </div>
 </form>
</div>

	</br>
    <div class="clearfix"></div>
	<div>
	<h2>Orders</h2>
      <table class="table table-striped" style="max-width: 60%;">
      <thead>
        <tr>
          <th>User name</th>
          <th>Title</th>
          <th>Author</th>
          <th>Quantity</th>
          <th>Category</th>
          <td>Price</td>
		  <td>Date</td>
        </tr>
      </thead>
      <tbody>
        <?php
		require_once "Connect_PDO.php";
		GLOBAL $pdo;
		$stmt = $pdo->query("SELECT * FROM orders");
		while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            echo
            "<tr>
              <td>{$row['u_name']}</td>
              <td>{$row['title']}</td>
              <td>{$row['author']}</td>
              <td>{$row['quantity']}</td>
              <td>{$row['category']}</td>
              <td>{$row['price']}</td> 
			  <td>{$row['date']}</td> 
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
   </div>
   <div >






