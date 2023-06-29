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
	<title>About Us</title>
	<link rel="icon" type="image/png" sizes="16x16" href="img/small leaf.png">
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner3">
			<h1>about us</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ about</span>
		</div>
		
		<section class="services">
			<div class="title">
				<img src="img/small leaf.png" class="logo">
				<h1>Why Choose The Seed Co.</h1>
				<p>The Seed Co. offers high-quality seeds, excellent customer service, competitive pricing, sustainability, and
					a strong reputation in the industry. Customers can trust that they are getting the best possible seeds for their
					needs, with knowledgeable staff available to provide guidance. Our eco-friendly packaging and support for
					sustainable farming practices demonstrate our commitment to environmental responsibility. With regular
					discounts and promotions, our seeds are affordable for all types of customers. Many satisfied customers
					have successfully grown healthy and productive plants from our seeds.
                </p>
			</div>
			
		</section>
		<div class="about">
			<div class="row">
				<div class="img-box">
					<img src="img/3.png">
				</div>
				<div class="detail">
					<h1>But what is The Seed Co.?</h1>
					<p>Welcome to The Seed Co., where nature's potential blossoms into endless possibilities. We are passionate
						about seeds and believe that within these tiny marvels lie the power to cultivate vibrant gardens,
						bountiful harvests, and flourishing landscapes. With a commitment to quality, innovation, and
						sustainability, we offer a diverse selection of premium seeds, handpicked to inspire both
						seasoned gardeners and budding enthusiasts. Whether you're seeking to create a tranquil backyard
						oasis, grow your own organic produce, or embark on a botanical adventure, trust in The Seed Co.
						to provide you with the seeds that will nurture your vision and help it thrive. Join us on this
						green journey and unlock the boundless potential of nature, one seed at a time.</p>
                    <a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
		</div>
		<div class="testimonial-container">
			<div class="title">
				<img src="img/small leaf.png" class="logo">
				<h1>GROUP MEMBERS</h1>
				<p>The people who made this project possible.
                </p>
            </div>
                <div class="container">
                	<div class="testimonial-item active">
                		<img src="img/kristhia.jpg">
                		<h1>Kristhia Lastra</h1>
                	</div>
                	<div class="testimonial-item">
                		<img src="img/carl.jpg">
                		<h1>Carl Lachica</h1>
                	</div>
                	<div class="testimonial-item">
                		<img src="img/jettro.jpg">
                		<h1>Jettro Yacub</h1>
                	</div>
                	<div class="testimonial-item">
                		<img src="img/ash.jpg">
                		<h1>Ashley Macasadia</h1>
                	</div>
					<div class="testimonial-item">
                		<img src="img/david.jpg">
                		<h1>David Tandiama</h1>
                	</div>
					<div class="testimonial-item">
                		<img src="img/owen.jpg">
                		<h1>Owen Canaria</h1>
                	</div>
					<div class="testimonial-item">
                		<img src="img/mervis.jpg">
                		<h1>Mervis Encelan</h1>
                	</div>
                	<div class="left-arrow" onclick="nextSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
                	<div class="right-arrow" onclick="prevSlide()"><i class="bx bxs-right-arrow-alt"></i></div>
						
				</div>
				
		</div>
		
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<script type="text/javascript">
		let slides = document.querySelectorAll('.testimonial-item');
		let index = 0;

		function nextSlide(){
		    slides[index].classList.remove('active');
		    index = (index + 1) % slides.length;
		    slides[index].classList.add('active');
		}
		function prevSlide(){
		    slides[index].classList.remove('active');
		    index = (index - 1 + slides.length) % slides.length;
		    slides[index].classList.add('active');
		}
	</script>
	<div>
	<?php include 'components/footer.php'; ?>
	<?php include 'components/alert.php'; ?>
	</div>
</body>
</html>