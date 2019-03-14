<?php 
	class Account {
		private $errorArray;
		private $con;

		public function __construct($con) {
			$this->errorArray = array();
			$this->con = $con;
		}

		public function login($un, $pw) {
			$pw = md5($pw);
			$query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$un' and password = '$pw'");
			if (mysqli_num_rows($query) == 1) {
				return true;
			} else {
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}
		}

		// 
		public function register($username, $firstName, $lastName, $email, $email2, $password, $password2) {
			$this->validateUsername($username);
			$this->validateFirstName($firstName);
			$this->validateLastName($lastName);
			$this->validateEmails($email, $email2);
			$this->validatePasswords($password, $password2);

			if (empty($this->errorArray)) {
				// Insert into db
				return $this->insertUserDetails($username, $firstName, $lastName, $email, $password);
			} else {
				return false;
			}
		}

		public function getError($error) {
			if (!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($un, $fn, $ln, $em, $pw) {
			$encryptedPw = md5($pw); 
			$profilePic = "./assets/images/profile-pics/header.jpg";
			$date = date("Y-m-d");

			$result = mysqli_query($this->con, "INSERT INTO users VALUES ('','$un','$fn','$ln','$em','$encryptedPw','$date', '$profilePic')");
			return $result;
		}

		private function validateUsername($un) {
			if (strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, Constants::$usernameCharacters);
				return;
			}
			
			$checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
			if (mysqli_num_rows($checkUsernameQuery) != 0) {
				array_push($this->errorArray, Constants::$usernameTaken);
				return;
			}
		} 

		private function validateFirstName($fn) {
			if (strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
				return;
			}
		} 

		private function validateLastName($ln) {
			if (strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, Constants::$lastNameCharacters);
				return;
			}
		} 

		private function validateEmails($em, $em2) {
			if ($em != $em2) {
				array_push($this->errorArray, Constants::$emailsDoNotMatch);
				return;
			}

			if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailInvalid);
				return;
			}

			//TODO: check that username hasn't been already used
			$checkEmailQuery = mysqli_query($this->con, "SELECT email from users WHERE email = '$em'");
			if (mysqli_num_rows($checkEmailQuery) != 0) {
				array_push($this->errorArray, Constants::$emailTaken);
			} 

		} 

		private function validatePasswords($pw, $pw2) {
			if ($pw != $pw2) {
				array_push($this->errorArray, Constants::$passwordsDoNotMatch);
				return;
			}

			if (preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
				return;
			}

			if (strlen($pw) > 30 || strlen($pw) < 5) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			}
		} 
	}

 ?>






















