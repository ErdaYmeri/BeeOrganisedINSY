<?php 
	
	$pdo = new PDO('mysql:host=localhost;dbname=beeorganised', 'root', '');
	 
	if(isset($_GET['login'])) {
	 $usrname = $_POST['usrname'];
	 $passwort = $_POST['passwort'];
	 
	 $statement = $pdo->prepare("SELECT * FROM beeuser WHERE usrname = :usrname");
	 $result = $statement->execute(array('usrname' => $usrname));
	 $user = $statement->fetch();
	 
	 
	 //Überprüfung des Passworts
	 if ($user !== false && password_verify($passwort, $user['passwort']) && $user['aktiv'] == 1 ) {
	 
	 if ($user['level'] == 'admin'){
	 die('Willkomen Administratorin. Weiter zu <a href="index1.html">internen Bereich</a>');}
	 $_SESSION['userid'] = $user['id'];
	 echo 'Willkomen	' . $usrname; 
	 die ('.		Weiter zu <a href="index1.html">internen Bereich.</a>');
	 } else {
	 $errorMessage = "E-Mail oder Passwort war ungültig. Oder du hast kein Zugriff<br>";
	 }
	 
	}
?>
<!DOCTYPE HTML>

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

		<!-- Banner -->
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
					<h2>Log in</h2>
				</header>
				<?php 
				if(isset($errorMessage)) {
				 echo $errorMessage;
				}
			?>
			<section class="special box">
			<form action="?login=1" method="post">
				Benutzername:<br>
				<input type="text" size="40" maxlength="250" name="usrname"><br>
				 
				Passwort:<br>
				<input type="password" size="40"  maxlength="250" name="passwort"><br><br>
				 
				</br><input type="submit" value="Abschicken"><br>
			</form>
			</section>
			
			
		<!-- Footer -->
			<footer id="footer">
					<ul class="copyright">
						<li>&copy; Copyright HTL SHKODER | Bee Organised Team 2017</li>
						<li>Erda Ymeri</a></li>
						<li>Ersamir Zekaj</a></li>
					</ul>
				
			</footer>

	</body>
</html>