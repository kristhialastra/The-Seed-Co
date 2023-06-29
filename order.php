<?php 
 include 'components/connection.php';
 session_start();
 if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
		// Display the order details
	}else{
		$user_id = '';
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
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
	<title>Orders</title>
	<link rel="icon" type="image/png" sizes="16x16" href="img/small leaf.png">
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner2">
			<h1>my orders</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ order</span>
		</div>
		<section class="orders">
				<div class="title">
					<img src="img/small leaf.png" class="logo">
					<h1>MY ORDERS</h1>
					<p>Stay organized with a comprehensive overview of your orders, from the latest to the ones you've cancelled.</p>
				</div>
				<div class="box-container">
					<?php 
						$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
						$select_orders->execute([$user_id]);
						if ($select_orders->rowCount()>0) {
							while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
								$select_products = $conn->prepare("SELECT * FROM `products` WHERE id=?");
								$select_products->execute([$fetch_order['product_id']]);
								if ($select_products->rowCount()>0) {
									while($fetch_product=$select_products->fetch(PDO::FETCH_ASSOC)){


					?>
					<div class="box" <?php if($fetch_order['status']=='cancle'){echo 'style="border:2px solid red";';} ?>>
						<a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
							<p class="date"><i class="bi bi-calender-fill"></i><span><?=$fetch_order['date']; ?></span></p>
							<img src="<?= $fetch_product['image']; ?>" class="image" >
							<div class="row">
								<h3 class="name"><?= $fetch_product['name']; ?></h3>
								<p class="price">Price: ₱<?= $fetch_order['price']; ?></P>
								<p class="price">Qty: <?= $fetch_order['qty']; ?></p>
								<p class="status" style="color:<?php if($fetch_order['status']=='delivered'){echo 'green';}elseif($fetch_order['status']=='canceled'){echo 'red';}else{echo 'orange';} ?>"><?= $fetch_order['status']; ?></p>
							</div>
						</a>
						
					</div>
					<?php 
									}
								}
							}
						}else{
							echo '<p class="empty">no order takes placed yet!</p>';
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