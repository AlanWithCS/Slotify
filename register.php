<?php 
	include('./includes/config.php');
	include('./includes/classes/Account.php');
	include('./includes/classes/Constants.php');
	$account = new Account($con);
	include('./includes/handlers/register-handler.php');
	include('./includes/handlers/login-handler.php');

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Slotify!</title>
	<link href="https://fonts.googleapis.com/css?family=Oswald:400,500,600,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./assets/css/register.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="./assets/js/register.js"  type="text/javascript"></script>
</head>
<body>
	<?php 
	if(isset($_POST['registerButton'])) {
		echo '<script>
				$(document).ready(function() {
					$(".loginForm").hide();
					$(".registerForm").show();
				});
			</script>';
	} else {
		echo '<script>
				$(document).ready(function() {
					$(".loginForm").show();
					$(".registerForm").hide();
				});
			</script>';
	}
	?>
	

	<div class="background">
		<div class="loginContainer">
			<div class="inputContainer">
				<form class="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed);	?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. Zhiying" value="<?php getInputValue('loginUsername') ?>" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" name="loginPassword" type="password" placeholder="your password" required>
					</p>
					<button type="submit" name="loginButton">LOG IN</button>
					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Sign up here.</span>
					</div>
				</form>
			
				<form class="registerForm" action="register.php" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters);	?>
						<?php echo $account->getError(Constants::$usernameTaken);	?>
						<label for="username">Username</label>
						<input id="username" name="username" type="text" value="<?php getInputValue('username') ?>" placeholder="e.g. zhiying" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters);	?>
						<label 	for="firstName">First name</label>
						<input id="firstName" name="firstName" type="text" value="<?php getInputValue('firstName') ?>" placeholder="e.g. Zhiying" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters);	?>
						<label for="lastName">Last name</label>
						<input id="lastName" name="lastName" type="text" value="<?php getInputValue('lastName') ?>" placeholder="e.g. Qian" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch);	?>
						<?php echo $account->getError(Constants::$emailInvalid);	?>
						<?php echo $account->getError(Constants::$emailTaken);	?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email" value="<?php getInputValue('email') ?>" placeholder="e.g. zhiying@gmail.com" required>
					</p>

					<p>
						<label for="email2">Confirm Email</label>
						<input id="email2" name="email2" type="email" value="<?php getInputValue('email2') ?>" placeholder="e.g. zhiying@gmail.com" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDoNotMatch);	?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric);	?>
						<?php echo $account->getError(Constants::$passwordCharacters);	?>
						<label for="password">Password</label>
						<input id="password" name="password" type="password" placeholder="your password" required>
					</p>

					<p>
						<label for="password2">Confirm password</label>
						<input id="password2" name="password2" type="password" placeholder="your password" required>
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Log in here.</span>
					</div>
				</form>
			</div>

			<div class="loginText">
				<h1>Life without music?</h1>
				<h1>Can't Imagine.</h1>
				<h2>Listen to loads of songs for free</h1>
				<ul>
					<li><i class="fas fa-headphones-alt"></i> Discover music you fall in love with.</li>
					<li><i class="fas fa-headphones-alt"></i>  Create your own play lists.</li>
					<li><i class="fas fa-headphones-alt"></i>  Follow artists to keep up to date.</li>
				</ul>
			</div>



		</div>
		
	</div>
</body>
</html>






















