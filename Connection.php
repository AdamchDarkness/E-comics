<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=e-comics' ,  'root', '');

if (isset($_POST['formconnect'])) 
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if (!empty($mailconnect) AND !empty($mdpconnect)) 
	{
		$requser = $bdd->prepare("SELECT * FROM utilisateur WHERE Mail = ? AND MDP = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if ($userexist == 1) 
		{
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['Pseudo'] = $userinfo['Pseudo'];
			$_SESSION['Mail'] = $userinfo['Mail'];
			header("Location: Acceuil_Utilisateur.php?id=".$_SESSION['id']);
		}
		else
		{
			$erreur = "Un des champs est incorrect";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent etre completer";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="connection.css">
	<title>Connection E-Comics</title>
</head>
<body>
		<div class="box-area">
		<header>		
			<div class="wrapper">
				<div class="logo">
					<a href="index.php">E-Comics</a>				
			</div>
			<nav>
				<a href="Marvel_Fr.php">Marvel</a>
				<a href="Dc_Fr.php">Dc</a>
				<a href="Image_Fr.php">Image</a>
				<a href="Inscription.php">Inscription</a>
				<a href="Connection.php">Connection</a>
			</nav>
		</div>
	</header>
		<div class="banner-area">
		<h2>Connection</h2>
		</div>
		<div class="content-area">
		<div class="wrapper">
			<h2>E-Comics</h2>
		<br>
		<div align="center">
			<p>
				Ici jeune adeptte de comics vous allez pouvoir vous connecter afin de commencer a telecharger des comics.
			</p>
		<br />
		<form method="POST" action="">
			<input type="email" class="input_basic" name="mailconnect" placeholder="Mail" />
			<input type="password" class="input_basic" name="mdpconnect" placeholder="MDP" />
			<input type="submit" name="formconnect" value="Se Connecter" />

	 </form>
	</div>
	 <?php 
	 if (isset($erreur))
	  {
	 	echo '<font color="red">' .$erreur. "</font>";
	 }
	 ?>

		
	</div>
</div></div>
</body>
</html>