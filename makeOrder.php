<?php
session_start();
require_once "Connect_PDO.php";
GLOBAL $pdo;


$str='  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
           <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
           <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.1/js/bootstrap-dialog.min.js"></script>
           <script type="text/javascript">
               setTimeout(function() {
                  BootstrapDialog.alert(\'Your cart is empty!\')
               },10);
           </script>';
$str1='  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
           <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
           <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.1/js/bootstrap-dialog.min.js"></script>
           <script type="text/javascript">
               setTimeout(function() {
                  BootstrapDialog.alert(\'Your order is accepted. Thank you! We will contact you soon! \')
               },10);
           </script>';

		   
function insertOrder($u_name, $title, $author,  $quantity, $category, $price){
    GLOBAL $pdo;
    $sql = "INSERT INTO orders (u_name, title, author, quantity, category, price, date) 
                 VALUES ( :u_name, :title, :author, :quantity, :category, :price, SYSDATE())";
    $stmt = $pdo->prepare ($sql);
    $stmt->execute(array(
           ':u_name' => $u_name,
           ':title' => $title,
		   ':author' => $author,
           ':quantity' => $quantity,
           ':category' => $category,
           ':price' => $price ));
		   }
		   

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$stmt = $pdo->query("SELECT `author` as author, `image` as image, `title` as title, `category` as category, `price` as price FROM tblproduct WHERE title='" . $_GET["title"] . "'");
			$productByCode = $stmt->fetch(PDO::FETCH_ASSOC);
			$itemArray = array($productByCode["title"]=>array('title'=>$productByCode["title"], 'author'=>$productByCode["author"], 'quantity'=>$_POST["quantity"], 'category'=>$productByCode["category"],'price'=>$productByCode["price"]));

			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode["title"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode["title"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["title"] == $_SESSION["cart_item"][$k]['title']){
						unset($_SESSION["cart_item"][$k]);
					}
					if(empty($_SESSION["cart_item"]))
					{
						unset($_SESSION["cart_item"]);
					}
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;
	case "putOrder":
		if(empty($_SESSION["cart_item"])) {
			echo $str;
		}
		else{
			foreach($_SESSION["cart_item"] as $k => $v){
				$user = $_SESSION["user"];
				$title = $_SESSION["cart_item"][$k]["title"];
				$author = $_SESSION["cart_item"][$k]["author"];
				$quantity = $_SESSION["cart_item"][$k]["quantity"];
				$category = $_SESSION["cart_item"][$k]["category"];
				$price = $_SESSION["cart_item"][$k]["price"];
				insertOrder($user, $title, $author, $quantity, $category, $price); 
			}
			unset($_SESSION["cart_item"]);
			echo $str1;
			
		}
	break;
}
}
?>
<!DOCTYPE HTML>
<HTML>
<head>
  <title>Book Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<BODY>
<?php include("inc_header.php");?>
<br>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="makeOrder.php?action=empty">Empty Cart</a></div>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>

<table cellpadding="10" cellspacing="1" style="width: auto;" class="table table-striped table-condensed">
<tbody>
<tr>
<th style="text-align:left;"><strong>Title</strong></th>
<th style="text-align:left;"><strong>Author</strong></th>
<th style="text-align:right;"><strong>Quantity</strong></th>
<th style="text-align:right;"><strong>Category</strong></th>
<th style="text-align:right;"><strong>Price</strong></th>
<th style="text-align:center;"><strong>Action</strong></th>
</tr>
<?php
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["title"]; ?></strong></td>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["author"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["category"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["price"]; ?></td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="makeOrder.php?action=remove&title=<?php echo $item["title"]; ?>" class="btnRemoveAction">Remove Item</a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="6" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
</tr>
</tbody>
</table>
  <?php
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products <a id="btnEmpty" href="makeOrder.php?action=putOrder">Place the order</a></div>
	<?php
	$stmt = $pdo->query("SELECT `author` as author, `image` as image, `title` as title, `price` as price, `category` as category FROM tblproduct ORDER BY id ASC");
	$product_array = $stmt->fetch(PDO::FETCH_ASSOC);
	if (!empty($product_array)) {
		while($product_array = $stmt->fetch(PDO::FETCH_ASSOC)){
	?>
		<div class="product-item">
			<form method="post" action="makeOrder.php?action=add&title=<?php echo $product_array["title"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array["image"]; ?>" height="130%" width="auto"></div>
			<br>
			<div><strong><?php echo $product_array["title"]; ?></strong></div>
			<div><?php echo $product_array["author"]; ?></div>
			<div><?php echo $product_array["category"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array["price"]; ?></div>
			<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
</div>
</BODY>
</HTML>
