<?php
$bdd = new PDO('mysql:host=localhost;dbname=e-comics' ,  'root', '');
if (isset($_POST['FormeInscription']))
 {
		$pseudo = htmlspecialchars($_POST['pseudo']);
 		$mail = htmlspecialchars($_POST['mail']);
 		$mail2 = htmlspecialchars($_POST['mail2']);
 		$mdp = sha1($_POST['mdp']);
 		$mdp2 = sha1($_POST['mdp2']);
 
 if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) 
 	{


 		$pseudolength = strlen($pseudo);
 		if ($pseudolength <= 20) {

		 			if ($mail == $mail2) {
		 		if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
	 			$reqmail = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
	 			$reqmail->execute(array($mail));
	 			$mailexist = $reqmail->rowCount(); 
	 			if ($mailexist == 0) 
	 			{
		 				if ($mdp == $mdp2) 
		 					{


		 					$inserttmbr = $bdd->prepare("INSERT INTO utilisateur(Pseudo, Mail, MDP) VALUES(?, ?, ?)");
		 					$inserttmbr->execute(array($pseudo, $mail, $mdp));
		 					$_SESSION['Compte_cree'] = "Votre compte a bien ete cree";
		 					header('location: Connection.php');

		 				}
		 				else{
		 					$erreur = "Les mots de passes doivent correspondre";
		 		
		 				}
		 			}			 		else{
		 			$erreur = "Adresse mail deja utiliser";
		 		}

		 			}
		 			else{
		 				$erreur = "Vos adresse mail ne correspondent pas";
		 			}
		 		}
		 		else{$erreur = "L adresse mail n est pas valide !";}
		 		}
		 		else{
		 			$erreur = "Votre pseudo ne doit pas depasser 20 caracteres";
		 		}
		 		


		 	}
		 else {
		 		$erreur= "Tous les champs doivent etre remplis";
		 
		 
		 	}	
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Style_Inscription.css">
	<title>Inscription E-Comics</title>
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
		<h2>Inscription</h2>
	</div>
		<div class="content-area">
		<div class="wrapper">
			<h2>E-Comics</h2>
		<br>
		<div align="center">
		<form class="form_demo" method="POST" action="">
			<table>
			<tr>
				<td align="right">	
							<label for="pseudo">Pseudo :</label>
				</td>
				<td align="right">
							<input type="text" class="input_basic" placeholder="Votre pseudo" id="pseudo" name="pseudo"  value="<?php if(isset($pseudo)) { echo $pseudo;} ?>">
				</td>
			</tr>
						<tr>
				<td align="right">	
							<label for="mail"> Mail :</label>
				</td>
				<td align="right">
							<input type="email" class="input_basic" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail;} ?>">
				</td>
			</tr>
						<tr>
				<td align="right">	
							<label for="mail2">Confirmation du mail :</label>
				</td>
				<td align="right">
							<input type="email" class="input_basic" placeholder="Confirmer mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2;} ?>">
				</td>

			</tr>
									<tr>
				<td align="right">	
							<label for="mdp">Mot de passe:</label>
				</td>
				<td align="right">
							<input type="password" class="input_basic" placeholder="votre mot de passe" id="mdp" name="mdp">
				</td>
				
			</tr>
												<tr>
				<td align="right">	
							<label for="mdp2"> Confimation mot de passe:</label>
				</td>
				<td align="right">
							<input type="password" class="input_basic" placeholder="Confirmer votre mot de passe" id="mdp2" name="mdp2">
				</td>
				
			</tr>
			<tr>
				<td></td>
				<td align="center"><input type="Submit" name="FormeInscription" value="Envoyer"></td>
			</tr>
			</table>	


	 </form>
	 </div>
	 <?php 
	 if (isset($erreur))
	  {
	 	echo '<font color="red">' .$erreur. "</font>";
	 }
	 ?>

		
	</div>
</div>
</div>
</body>
</html>