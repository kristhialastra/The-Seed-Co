<?php 
	include 'components/connection.php';
	session_start();

	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}

	//register user
	if (isset($_POST['submit'])) {

		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$pass = $_POST['pass'];
		$pass = filter_var($pass, FILTER_SANITIZE_STRING);

		$select_user = $conn->prepare("SELECT * FROM `users` WHERE  email = ? AND password = ?");
		$select_user->execute([$email, $pass]);
		$row = $select_user->fetch(PDO::FETCH_ASSOC);

		if ($select_user->rowCount() > 0) {
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['user_name'] = $row['name'];
			$_SESSION['user_email'] = $row['email'];
			$_SESSION['user_type'] = $row['user_type']; // Add user type to the session
			if ($_SESSION['user_type'] == 'user') { // Check user type
				header('location: home.php');
			} else if ($_SESSION['user_type'] == 'admin') {
				header('location: adminconfirm.php');
			}
		} else {
			$warning_msg[] = 'Incorrect username or password';
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
	<title>Login</title>
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
			}, 100); // hide slowly after 1 second
		});
	</script>
	<br><br><br>
	<div class="main-container">
		<section class="form-container">
		<div class="btn" style="position: absolute; top: 6.5rem; right: 22rem; margin: 15px;  font-size: 12px;">
		<p><a href="adminconfirm.php">ADMIN LOGIN HERE ➜</a></p>
	</div>
			<div class="title">
				<img src="img/small leaf.png">
				<h1>LOGIN NOW</h1>
				<p>Welcome back! Enter your info to access your account.
                </p>
			
			</div>
			<form action="" method="post">
				<div class="input-field">
					<p>your email <sup>*</sup></p>
					<div style="text-align: center;">
					<input type="email" name="email" required placeholder="mariacruz@gmail.com" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
					</div>
				</div>
				<div class="input-field">
					<p>your password <sup>*</sup></p>
					<div style="text-align: center;">
					<input type="password" name="pass" required placeholder="••••••" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
					</div>
				</div>
				<div style="text-align: center;">
				<input type="submit" name="submit" value="login now" class="btn">
				</div>
				<br>
				<div style="text-align: center;">
				<p><a href="forgot.php">Forgot Password?</a></p>
				<br>
 				<p><a href="register.php">Do not have an account? Register now.</a></p>
 				<br>
    			<p><a href="home.php">Go back to home →</a></p>
				<div>
			</form>
		</section>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<?php include 'components/alert.php'; ?>
</body>
</html>