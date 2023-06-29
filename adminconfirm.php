<?php
include 'components/connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
} else {
	$user_id = '';
}

// Register user
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$email = filter_var($email, FILTER_SANITIZE_STRING);
	$pass = $_POST['pass'];
	$pass = filter_var($pass, FILTER_SANITIZE_STRING);
	$code = $_POST['code'];
	$code = filter_var($code, FILTER_SANITIZE_STRING);

	$select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
	$select_user->execute([$email, $pass]);
	$row = $select_user->fetch(PDO::FETCH_ASSOC);

	if ($select_user->rowCount() > 0) {
		$storedcode = $row['code'];
		if ($code === $storedcode) {
			$_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['user_type'] = $row['user_type']; // Add user type to the session
			if ($_SESSION['user_type'] == 'user') { // Check user type
				header('location: home.php');
			} else if ($_SESSION['user_type'] == 'admin') {
				header('location: adminindex.php');
			}
		} else {
			$warning_msg[] = 'Incorrect admin code';
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
	<title>Admin Login</title>
	<link rel="icon" type="image/png" sizes="16x16" href="img/small leaf.png">
</head>
<body style= "background-image: url('adminbg.png')">

	<div class="main-container">
		<section class="form-container">
			<div class="title">
				<img src="img/small leaf.png">
				<h1>ADMIN LOGIN</h1>
				<p>Welcome back! Enter your credentials and unique 6-digit admin code to access your account.
                </p>

				<?php
if (isset($warning_msg) && count($warning_msg) > 0) {
    echo '<div class="warning">';
    foreach ($warning_msg as $msg) {
        echo '<p>' . $msg . '</p>';
    }
    echo '</div>';
}
?>
				<form onsubmit="return validateForm()" method="post">
				
	<input type="text" name="email" required placeholder="Enter your email here" maxlength="50" style="text-align: center;" >
	<input type="password" name="pass" required placeholder="Enter your password here" maxlength="50" style="text-align: center;">
	<input type="text" name="code" maxlength="6" style="text-align: center;" required pattern="[0-9]{6}" title="Please enter exactly 6 digits." placeholder="Enter your admin code here" maxlength="50" />

	<div class="user">
		<input type="submit" name="submit" value="Proceed to Dashboard" class="btn" /></div>
	</div>
</form>

<script>
  function validateForm() {
    var inputField = document.querySelector('input[type="text"]');
    if (inputField.validity.valueMissing) {
      alert('Please fill in the required field.');
      return false;
    }
    if (inputField.validity.patternMismatch) {
      alert('Please enter exactly 6 digits.');
      return false;
    }
    return true;
  }
</script>

		</section>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<?php include 'components/alert.php'; ?>
</body>
</html>