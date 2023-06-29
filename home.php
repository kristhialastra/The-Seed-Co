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
	<script src="https://unpkg.com/scrollreveal"></script>
	<title>Home</title>
	<link rel="icon" type="image/png" sizes="16x16" href="img/small leaf.png">
</head>

<body>
<div class="preloader">
		<video class="video" src="img/load1.mp4" autoplay muted></video>
	</div>

	<script>
		// Hide preloader after video ends
		const preloader = document.querySelector('.preloader');
		const video = preloader.querySelector('.video');
		video.addEventListener('ended', () => {
			preloader.style.opacity = '0';
			setTimeout(() => {
				preloader.style.display = 'none';
			}, 1000); // hide slowly after 1 second
		});
	</script>
	<script>
      // Set default cursor on page load
      document.addEventListener('DOMContentLoaded', function() {
        document.body.style.cursor = 'url("cur.png"), auto';
      });
	  </script>
	<?php include 'components/header.php'; ?>
	<div class="main">
		
		<section class="home-section">
			<div class="slider">
			<div class="slider__slider slide2">
					<div class="overlay"></div>
					<div class="slide-detail">
						<img src="img/welcome1.png">
						<br>
						<br>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide1">
					<div class="overlay"></div>
					<div class="slide-detail">
					<img src="img/welcome2.png">
						<br>
						<br>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide3">
					<div class="overlay"></div>
					<div class="slide-detail">
					<img src="img/welcome3.png">
						<br>
						<br>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide4">
					<div class="overlay"></div>
					<div class="slide-detail">
					<img src="img/welcome4.png">
						<br>
						<br>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="left-arrow"><i class='bx bxs-left-arrow'></i></div>
                <div class="right-arrow"><i class='bx bxs-right-arrow'></i></div>
			</div>
		</section>
		<!-- home slider end -->
		<section class="thumb">
			<div class="box-container">
				<div class="box">
					<img src="img/ship.png" style="width: 1100px; height: 200px;">
					
				</div>
				
				
				
			</div>
		</section>
		<section class="thumb">
			<div class="box-container">
				<div class="box">
					<img src="img/thumbveg.jpg">
					<h3>Vegetable and Fruit Seeds</h3>
					<p>From farm to table, experience the joy of growing your own produce with us</p>
					<a href="view_products.php"><i class="bx bx-chevron-right"></i></a>
				</div>
				<div class="box">
					<img src="img/thumbherb.jpg">
					<h3>Herb Seeds</h3>
					<p>Add flavor and fragrance to your life with our high-quality herb seeds</p>
					<a href="view_products.php"><i class="bx bx-chevron-right"></i></a>
				</div>
				<div class="box">
					<img src="img/thumbflower.jpg">
					<h3>Flower Seeds</h3>
					<p>Bring beauty and color to your world with our premium flower seeds</p>
					<a href="view_products.php"><i class="bx bx-chevron-right"></i></a>
				</div>
				<div class="box">
					<img src="img/thumbtree.jpg">
					<h3>Tree Seeds</h3>
					<p>Plant a tree, grow a legacy - start your own with our quality tree seeds</p>
					<a href="view_products.php"><i class="bx bx-chevron-right"></i></a>
				</div>
			</div>
		</section>
		<section class="container">
			<div class="box-container">
				<div class="box">
					<img src="img/aboutus.jpg">
				</div>
				<div class="box">
					<center><img src="img/small leaf.png"></center>
					<span>Why plant and grow seeds?</span>
					<h1>Growing seeds is sustainable and rewarding.</h1>
					<p>One should try growing seeds in their lifetime because it is sustainable, it promotes self-sufficiency and biodiversity, and rewarding because it yields healthy produce and a sense of accomplishment. </p>
					</div>
				</div>
			</div>
		</section>
		<div class="main-explore">
		<section class="shop">
			<div class="title">
				<img src="img/small leaf.png">
				<h1>EXPLORE</h1>
			</div>
			<div class="row">
			
				<div class="row-detail">
				
					<div style="color: white; background-color: #87a243;">
						<h1>Expand your knowledge in plant care!</h1>
					</div>
				</div>
			</div>
			<section class="shop-category">
			<div class="box-container">
				<div class="box">
					<img src="img/tips.jpg">
					<div class="detail">
						<h1 style="color: white; background-color: #87a243; background-opacity: 0.5;">Gardening Tips & Tricks</h1>
						<br><br>
						<a href="https://www.gardenersworld.com/how-to/grow-plants/gardening-for-beginners-10-tips/" target="_blank" class="btn">Learn More</a>
					</div>
				</div>
				<div class="box">
					<img src="img/community.jpg">
					<div class="detail">
						<h1 style="color: white; background-color: #87a243; background-opacity: 0.5;">Get involved in the community!</h1>
						<br><br>
						<a href="https://www.reddit.com/r/gardening/" target="_blank" class="btn">Go to community</a>
					</div>
				</div>
			</div>
</section>
</div>
		<div class="main-clearance">
		<section class="services">
			<div class="box-container">
				<div class="box">
					<img src="img/icon2.png">
					<div class="detail">
						<h3>Clearance Sales</h3>
						<p>Save money on your orders</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon1.png">
					<div class="detail">
						<h3>Quick Response Times</h3>
						<p>Leave us a message and we'll get back to you</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon0.png">
					<div class="detail">
						<h3>Gift Dropshipping</h3>
						<p>Send orders directly to your loved ones</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon.png">
					<div class="detail">
						<h3>Fast shipping</h3>
						<p>24-hour ship out for local orders</p>
					</div>
				</div>
			</div>
			
		</section>
		
</div>
<br><br><br><br>
<?php include 'components/footer.php'; ?>
	

	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>
	<script>
            ScrollReveal({ 
            reset: false, 
            distance: '500px',
            duration: 3500, 
            delay: 300
        });

     
		ScrollReveal().reveal('.container', { delay: 300, origin: 'left' });
		ScrollReveal().reveal('.main-explore', { delay: 300, origin: 'right' });
		ScrollReveal().reveal('.shop-category', { delay: 300, origin: 'left' });
		ScrollReveal().reveal('.main-clearance', { delay: 300, origin: 'right' });

        </script>
</body>
</html>