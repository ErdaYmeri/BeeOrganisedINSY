<!DOCTYPE HTML>
	<?php
	$pdo = new PDO('mysql:host=localhost;dbname=beeorganised', 'root', '');
	?>
<html>
	<head>

		<title>Bee Organised</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body id="top">
		
		<?php
				$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
				 
				if(isset($_GET['register'])) {
				 $error = false;
				 $vname = $_POST['vname'];
				 $fname = $_POST['fname'];
				 $email = $_POST['email'];
				 $usrname = $_POST['usrname'];
				 $passwort = $_POST['passwort'];
				 $passwort2 = $_POST['passwort2'];
				 $gebtag = $_POST['gebtag'];
				  
				 if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				 echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
				 $error = true;
				 } 
				 if(strlen($passwort) == 0) {
				 echo 'Bitte ein Passwort angeben<br>';
				 $error = true;
				 }
				 if($passwort != $passwort2) {
				 echo 'Die Passwörter müssen übereinstimmen<br>';
				 $error = true;
				 }
				 
				 //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
				 if(!$error) { 
				 $statement = $pdo->prepare("SELECT * FROM beeuser WHERE email = :email");
				 $result = $statement->execute(array('email' => $email));
				 $user = $statement->fetch();
				 
				 if($user !== false) {
				 echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
				 $error = true;
				 } 
				 }
				 //Überprüfe, dass der Benutzername noch nicht registriert wurde
				 if(!$error) { 
				 $statement = $pdo->prepare("SELECT * FROM beeuser WHERE usrname = :usrname");
				 $result = $statement->execute(array('usrname' => $usrname));
				 $user = $statement->fetch();
				 
				 if($user !== false) {
				 echo 'Dieser Benutzername ist bereits vergeben<br>';
				 $error = true;
				 } 
				 }
				 //Keine Fehler, wir können den Nutzer registrieren
				 if(!$error) { 
				 $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
				 
				 $statement = $pdo->prepare("UPDATE beeuser SET vname=:vname, fname=:fname, email=:email, usrname=:usrname, gebtag =:gebtag Where  );
				 $result = $statement->execute(array('vname' => $vname,'fname' => $vname, 'email' => $email, 'usrname' => $usrname, 'gebtag' => $gebtag));

				
				 if($result) { 
				 echo 'Dein Nachfrage wurdest erfolgreich geschickt. <a href="login.php">Zum Login</a>';
				 $showFormular = false;
				 } else {
				 echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
				 }
				 } 
				}
				
				// define variables and set to empty values
				$vnameErr = $fnameErr = $emailErr = $usrErr = $pswErr = $gebtagErr  = "";
				$vname = $fname = $email =  $usr = $psw = $gebtag =  "";

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
				  if (empty($_POST["vname"])) {
					$vnameErr = "Name is required";
				  } else {
					$vname = test_input($_POST["vname"]);
					// check if name only contains letters and whitespace
					if (!preg_match("/^[a-zA-Z ]*$/",$vname)) {
					  $vnameErr = "Only letters and white space allowed"; 
					}
				  }
				  if (empty($_POST["fname"])) {
					$fnameErr = "Name is required";
				  } else {
					$fname = test_input($_POST["fname"]);
					// check if name only contains letters and whitespace
					if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
					  $fnameErr = "Only letters and white space allowed"; 
					}
				  }
				   if (empty($_POST["email"])) {
					$emailErr = "Email is required";
				  } else {
					$email = test_input($_POST["email"]);
					// check if e-mail address is well-formed
					 // check if e-mail address is well-formed
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					  $usrErr = "Invalid username format"; 
					}
				  }
				   if (empty($_POST["usrname"])) {
					$usrErr = "Username is required";
				  } else {
					$usr = test_input($_POST["usrname"]);
					// check if e-mail address is well-formed
				  }
				  if (empty($_POST["passwort"])) {
					$pswErr = "Password is required";
				  } else {
					$psw = test_input($_POST["passwort"]);
				  }

				  if (empty($_POST["gebtag"])) {
					$gebtagErr = "Birthdate is required";
				  } else {
					$gebtag = test_input($_POST["gebtag"]);
				  }

				}

				function test_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
				}
				 
				if($showFormular) {
			?> 
		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="BeeOrganised_Diplomarbeit_2017_18_V5.0.pdf">Bee Organised</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="sign.php">Sign Up</a></li>
						<li><a href="login.php" class="button special">Log in</a></li>
					</ul>
				</nav>
			</header>
			<section id="banner">
				<div class="inner">
					<h2>Was ist BeeOrganised?</h2>
					<p>Observe, Messure, Organise</p>
				<!-- <p>A free responsive template by <a href="http://templated.co">TEMPLATED</a></p> -->
				</div>
			</section>
			
		<!-- One -->
			<section id="middle" class="container">
				<header class="major">
					<h2>Sign up </h2> 
				</header>
				<section class="special box">
				<form action="?register=1" method="post">
				Vorname:*<br>
				<input type="text" size="40" maxlength="250" name="vname" placeholder="Ihre Vorname ...">
				<span class="error">  <?php echo $vnameErr;?></span>
				<br><br>
				Nachname:*<br>
				<input type="text" size="40" maxlength="250" name="fname" placeholder="Ihre Nachname ...">
				<span class="error"> <?php echo $fnameErr;?></span>
				<br><br>
				E-Mail:*<br>
				<input type="email" size="40" maxlength="250" name="email" placeholder="E-Mail Addresse ...">
				<span class="error"><?php echo $emailErr;?></span>
				<br><br>
				Benutzername:*<br>
				<input type="text" size="40" maxlength="250" name="usrname" placeholder="Ihre gew&uuml;nschte Benutzername ...">
				<span class="error"><?php echo $usrErr;?></span>
				<br><br>
				Passwort:*<br>
				<input type="password" size="40"  maxlength="250" name="passwort" placeholder="Ihr Password ..">
				<span class="error"><?php echo $pswErr;?></span>
				<br><br>
				 
				Passwort wiederholen:*<br>
				<input type="password" size="40" maxlength="250" name="passwort2" placeholder="Password wiederholen ...">
				<span class="error"><?php echo $pswErr;?></span>
				<br><br>
				Geburtstag:<br>
				<input type="date"  name="gebtag"><br><br>
			 
				<input type="submit" name="submit"  onclick="alert('Danke dass Sie sich für unser System entschieden haben ')" value="Submit">  
				<input type="reset">
			</form>
				</section>
			</section>
			

		<!-- Footer -->
			<footer id="footer">
					<ul class="copyright">
						<li>&copy; Copyright HTL SHKODER | Bee Organised Team 2017</li>
						<li>Erda Ymeri</a></li>
						<li>Ersamir Zekaj</a></li>
					</ul>
				
			</footer>
	<?php
			 }  //Ende von if($showFormular)
			?>
	</body>
</html>