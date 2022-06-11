<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=e-comics' ,  'root', 'root');

if (isset($_GET['id']) AND $_GET['id'] > 0) 
{
	$getid = intval($_GET['id']);
	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Style_Prophil.css">
	<title>Profile E-Comics</title>
</head>
<body>
	<div align="center">
		<h2>Profil de <?php echo $userinfo['Pseudo']; ?></h2>
		<article>
			<p>Bienvenue sur ton prophil Monsieur ou Madame <?php echo $userinfo['Pseudo'];?></p>
			<p>Il faut que je t explique les moyens de gagner des points.<br>Comme tu le sait surement un point 
			te permet de telecharger un nouveau comics de ton choix .</p>
			<p>
				<ul>
					<li>Uploder un comics (Chaque comics te donne 1 points)</li>
					<li>Tu peux nous suivre sur instagram cela te permettera de gagner 2 points bien sur il nous faut une preuve en message</li>
					<li>Tu peux aussi nous suivre sur notre compte twitter cela te rapportera aussi 2 points</li>
				</ul>
			</p>
		</article>
		<br /><br />
		Pseudo = <?php echo $userinfo['Pseudo'] ?>;
		<br />
		Mail = <?php echo $userinfo['Mail'] ?>;

		<br /><br />
		<br/>
		<a href="Acceuil_Utilisateur.php">Acceuil</a>
		<br>
	 <?php 
	 	if ($userinfo['id'] == $_SESSION['id']) {
	 		
	 	
	 ?>
	 <a href="Deconnection.php">Deconnection<a/>
	 	<?php 
	 }

	 ?>
	 		<br />
		<?php

		if(!isset($_SESSION['id']) OR $_SESSION['id'] != 17){
    exit();
}

		?>
		<a href="Administration.php">Prophil Admin</a>


		
	</div>

</body>
</html>
<?php
}
?>	