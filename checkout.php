<?php 
 include 'components/connection.php';
 session_start();
 if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
	}

	$warning_msg = [];

	if (isset($_POST['place_order'])) {
		if ($user_id != '') {
		

		$name = $_POST['name'];
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$number = $_POST['number'];
		$number = filter_var($number, FILTER_SANITIZE_STRING);
		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', '. $_POST['pincode'];
		$address = filter_var($address, FILTER_SANITIZE_STRING);
		$method = $_POST['method'];
		$method = filter_var($method, FILTER_SANITIZE_STRING);
		$method = $_POST['method'];
		$method = filter_var($method, FILTER_SANITIZE_STRING);

		$varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
		$varify_cart->execute([$user_id]);

		$order_success = false;

		if (isset($_GET['get_id'])) {
			$get_product = $conn->prepare("SELECT * FROM `products` WHERE id=? LIMIT 1");
			$get_product->execute([$_GET['get_id']]);
			if ($get_product->rowCount() > 0) {
				while($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)){
					$insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?)");
			        $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $method, $fetch_p['id'], $fetch_p['price'], 1]);
					
					if ($insert_order) {
						$order_success = true;
					}					
				}
			}else{
				$warning_msg[] = 'somthing went wrong';
			}
		}elseif ($varify_cart->rowCount()>0) {
			while($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)){
				$insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?)");
			        $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty']]);
					if ($insert_order) {
						$order_success = true;
					}
				}
		
				if ($order_success) {
					$delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
					$delete_cart_id->execute([$user_id]);
				}
			} else {
				$warning_msg[] = 'somthing went wrong';
			}
		
			if ($order_success) {
				// Check the selected payment method and redirect accordingly
				if ($method == 'Credit/Debit Card') {
					header('location: cc.php');
				} else {
					header('location: order.php');
				}
			}
		}else {
			$warning_msg[] = 'You must be logged in to place an order.';
		}
	}
	?>
	
		  

<style type="text/css">
	<?php include 'style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<title>Checkout</title>
	<link rel="icon" type="image/png" sizes="16x16" href="img/small leaf.png">
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner5">
			<h1>checkout summary</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ checkout summary</span>
		</div>
		<section class="checkout">
			<div class="title">
				<img src="img/small leaf.png" class="logo">
				<h1>CHECKOUT SUMMARY</h1>
				
            </div>
			<div class="row">
                	<form method="post">
                		<h3>billing details</h3>
                		<div class="flex">
                			<div class="box">
                				<div class="input-field">
                					<p>full name <span>*</span></p>
                					<input type="text" name="name" required maxlength="50" class="input">
                				</div>
                				<div class="input-field">
                					<p>cellphone number <span>*</span></p>
                					<input type="number" name="number" required maxlength="10" class="input">
                				</div>
                				<div class="input-field">
                					<p>e-mail <span>*</span></p>
                					<input type="email" name="email" required maxlength="50" class="input">
                				</div>
                				<div class="input-field">
                					<p>payment method <span>*</span></p>
                					<select name="method" class="input">
                						<option value="Cash on Delivery">Cash on Delivery</option>
                						<option value="Credit/Debit Card">Credit/Debit Card</option>
                					</select>
                				</div>
                				
                			</div>
                			<div class="box">
                				<div class="input-field">
                					<p>address line 01 <span>*</span></p>
                					<input type="text" name="flat" required maxlength="50" placeholder="e.g. flat & building number" class="input">
                				</div>
                				<div class="input-field">
                					<p>address line 02 <span></span></p>
                					<input type="text" name="street" maxlength="50" placeholder="e.g. street & district name" class="input">
                				</div>
                				<div class="input-field">
                					<p>city name <span>*</span></p>
                					<input type="text" name="city" required maxlength="50"  class="input">
                				</div>
                				<div class="input-field">
								<p>Zip Code <span>*</span></p>
                					<input type="text" name="pincode" required maxlength="6" min="0" max="999999" class="input">
                					
                				</div>
                				
                			</div>
                		</div>
                		<button type="submit" name="place_order" class="btn">place order</button>
                	</form>
                	<div class="summary">
                		<h3>my bag</h3>
                		<div class="box-container">
                			<?php 
                				$grand_total=0;
                				if (isset($_GET['get_id'])) {
                					$select_get = $conn->prepare("SELECT * FROM `products` WHERE id=?");
                					$select_get->execute([$_GET['get_id']]);
                					while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)){
                						$sub_total = $fetch_get['price'];
                						$grand_total+=$sub_total;
                					
                			?>
                			<div class="flex">
                				<img src="image/<?=$fetch_get['image']; ?>" class="image">
                				<div>
                					<h3 class="name"><?=$fetch_get['name']; ?></h3>
                					<p class="price">₱<?=$fetch_get['price']; ?></p>
                				</div>
                			</div>
                			<?php 
                					}
                				}else{
                					$select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
                					$select_cart->execute([$user_id]);
                					if ($select_cart->rowCount()>0) {
                						while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                							$select_products=$conn->prepare("SELECT * FROM `products` WHERE id=?");
                							$select_products->execute([$fetch_cart['product_id']]);
                							$fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                							$sub_total= ($fetch_cart['qty'] * $fetch_product['price']);
                							$grand_total += $sub_total;
                						
                			?>
                			<div class="flex">
								<img src="<?=$fetch_product['image']; ?>" class="img">
                				<div>
                					<h3 class="name"><?=$fetch_product['name']; ?></h3>
                					<p class="price">₱<?=$fetch_product['price']; ?> ea</p>
									<p>Qty: <?=$fetch_cart['qty']; ?></p>
									
								</div>
                			</div>
                			<?php 
                						}
                					}else{
                						echo '<p class="empty">your cart is empty</p>';
                					}
                				}
                			?>
                		</div>
                		<div class="grand-total"><span>Order Total: </span>₱<?= $grand_total ?></div>
                	</div>
			</div>
		</section>
		
	</div>
	<?php include 'components/footer.php'; ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>
							
</body>
</html>