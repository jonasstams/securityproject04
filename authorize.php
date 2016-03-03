<?php
session_start();

$error='';
$servername = "10.3.1.195";
$username = "jonasuf171";
$password = "7ximqa0v";
$dbname = "jonasuf171_SecurityProject";
$dbh = new PDO('mysql:host=localhost;dbname=jonasuf171_SecurityProject', $username, $password);
if(isset($_POST['login'])){

	if (empty($_POST['userlogin']) || empty($_POST['passlogin'])) {
		$error = 'Username or Password is invalid!';
	}

	else{



		$user = $_POST['userlogin']; //mysqli_real_escape_string gebruiken we om te beveiligen tegen SQL injectie
		$pass = $_POST['passlogin'];

		$userlower = strtolower($user);
		$stmt = $dbh->prepare('SELECT * FROM users WHERE username=?');
		$stmt->bindParam(1, $userlower, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch();
		$row_count = $stmt->rowCount();

		$hash = $row ["passwoord"];
		$id = $row ["user_id"];

		$error = $id . " " . $hash;



		if($row_count > 0){

			if(password_verify ($pass, $hash)) {
				$_SESSION["user_id"]=$id;
				$_SESSION["username"]=$user;
				header("location: encryptionApp.php");
			}else{
				$error = 'Username or Password is invalid!';
			}
		}else {

			$error = 'geen rows selected';
		}
		$dbh = null;
	}
}
if(isset($_POST['signup'] )){

	$email = $_POST['email'];
	$user = $_POST['userregister'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$voornaam = $_POST['voornaam'];
	$achternaam = $_POST['achternaam'];
	$accepted = $_POST['accept'];


	$userlower = strtolower($user);
	$voornaam = ucwords(strtolower($voornaam));
	$achternaam = ucwords(strtolower($achternaam));


	if($accepted == '1'){

		$stmt = $dbh->prepare('SELECT * FROM users WHERE username=?');
		$stmt2 = $dbh->prepare('SELECT * FROM users WHERE email=?');
		$stmt->bindParam(1,$userlower,PDO::PARAM_STR);
		$stmt2->bindParam(1,$email,PDO::PARAM_STR);
		$stmt->execute();
		$stmt2->execute();
		$row_count = $stmt->rowCount();
		$row_count2 = $stmt2->rowCount();

		if($row_count>0){
			$error = "User bestaat al!";
		}elseif ($row_count2>0){
			$error = "Email adres wordt al gebruikt!";
		}else{

			if($pass === $pass2){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$options = ['cost' => 11,'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];
					$hash = password_hash($pass, PASSWORD_BCRYPT, $options);
					$stmt = $dbh->prepare("INSERT INTO users (username, passwoord, naam, voornaam, email)  VALUES (?, ?,?,?,?)");
					$stmt->bindParam(1,$userlower);
					$stmt->bindParam(2,$hash);
					$stmt->bindParam(3,$achternaam);
					$stmt->bindParam(4,$voornaam);
					$stmt->bindParam(5,$email);
					$stmt->execute();
					$dbh = null;
					header("location: index.php");
				}else{
					$error = "Fout ingegeven email.";
				}
			}else{
				$error = "De wachtwoorden zijn niet hetzelfde";
			}

		}
	}else{
		$error = "U heeft niet overeengestemd met de gebruiksvoorwaarden.";
	}
}
?>