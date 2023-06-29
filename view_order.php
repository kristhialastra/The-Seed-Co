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
	if (isset($_GET['get_id'])) {
		$get_id = $_GET['get_id'];
	}else{
		$get_id = '';
		header('location:order.php');
	}
	if (isset($_POST['cancel'])) {
		$update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id=?");
		$update_order->execute(['cancelled', $get_id]);
		header('location:order.php');
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<title>View Order</title>
	<link rel="icon" type="image/png" sizes="16x16" href="img/small leaf.png">
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner9">
			<h1>order detail</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ order detail</span>
		</div>
		<section class="order-detail">
				<div class="title">
					<img src="img/small leaf.png" class="logo">
					<h1>ORDER DETAILS</h1>
				</div>
				<div class="box-container">
					<?php 
						$grand_total=0;
						$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id=? LIMIT 1");
						$select_orders->execute([$get_id]);
						if ($select_orders->rowCount()>0) {
							while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
								$select_product = $conn->prepare("SELECT * FROM `products` WHERE id=? LIMIT 1");
								$select_product->execute([$fetch_order['product_id']]);
								if ($select_product->rowCount()>0) {
									while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
										$sub_total= ($fetch_order['price']* $fetch_order['qty']);
										$grand_total += $sub_total;
									
					?>
					<div class="box">
						<div class="col">
							<img src="<?= $fetch_product['image']; ?>" class="image">
							<p class="price">₱<?= $fetch_product['price']; ?> ea x <?= $fetch_order['qty']; ?></p>
							<h3 class="name"><?= $fetch_product['name']; ?></h3>
							<br><br>
							<p class="grand-total">Order Total: ₱ <?= $grand_total; ?> </p>
						</div>
						<div class="col">
						<p class="title">Order Date and Time</p>
						<p><?= $fetch_order['date']; ?></p> <br>
						<p class="title">Transaction ID:</P>
						<P><?= $fetch_order['id']; ?></p><br>
							<p class="title">billing address</p>
							<p class="user"><i class="bi bi-person-bounding-box"></i><?= $fetch_order['name']; ?></p>
							<p class="user"><i class="bi bi-phone"></i><?= $fetch_order['number']; ?></p>
							<p class="user"><i class="bi bi-envelope"></i><?= $fetch_order['email']; ?></p>
							<p class="user"><i class="bi bi-pin-map-fill"></i><?= $fetch_order['address']; ?></p>
							<p class="title">Payment Method</p>
							<p class="user"><i class="bi bi-credit-card"></i><?= $fetch_order['method']; ?></p>
							<p class="title">status</p>
							<p class="status" style="color:<?php if ($fetch_order['status']=='delivered'){echo 'green';}elseif($fetch_order['status']=='cancelled') {echo 'red';}else{echo 'orange';}?>"><?=$fetch_order['status'] ?></p>
							<?php if ($fetch_order['status']=='cancelled') { ?>
								<a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">Order Again</a>
							<?php }else{ ?>
								<form method="post">
									
									<button type="submit" name="cancel" class="btn" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</button>
								</form>
							<?php } ?>
						</div>
					</div>
					<?php 
								}
							}else{
								echo '<p class="empty">product not found</p>';
							}
						}

					}else{
						echo '<p class="empty">no order found</p>';
					}
					?>
				</div>
			
		</section>
		
	</div>
	<div>
	<?php include 'components/footer.php'; ?>
				</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>
</body>
</html>