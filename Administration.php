<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=e-comics' ,  'root', '');
if (isset($_SESSION['id']) AND $_SESSION['id'] > 0) 
{	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
	$requser->execute(array($_SESSION['id']));
	$userinfo = $requser->fetch();

	if($userinfo['admin'] != 1)
	{
		header('location : Acceuil_Utilisateur.php');
	}


if (isset($_GET['bannir']) AND !empty($_GET['bannir'])) {
	$bannir = (int) $_GET['bannir'];

	$rep = $bdd->prepare('DELETE FROM utilisateur WHERE id = ?');
	$rep->execute(array($bannir));
}

if (isset($_GET['Modifier']) AND !empty($_GET['Modidier'])) {
	$Modifier = (int) $_GET['Modidifier'];

	$rep = $bdd->prepare('SELECT FROM utilisateur WHERE id = ?');
	$rep->execute(array($modifier));
}

$utlisateur = $bdd->query('SELECT * From utilisateur');
 	
if (isset($_POST['New_Categorie']))
 {
		$Categorie = htmlspecialchars($_POST['Categorie']);
if (!empty($_POST['Categorie']))
{
	$inserttmbr = $bdd->prepare("INSERT INTO categorie_comics(Categorie_Comics) VALUES(?)");
	$inserttmbr->execute(array($Categorie));}
}
if (isset($_SESSION['id']) AND $_SESSION['id'] > 0) 
{	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
	$requser->execute(array($_SESSION['id']));
	$userinfo = $requser->fetch();
	if (isset($_POST['UpoladComics']))
	 {
	 	//print_r($_POST);
	 	//exit;
	 	$Nom_Comics = htmlspecialchars($_POST['Nom_Comics']);
	 	$id_Categorie = ($_POST['id_Categorie']);
		$Url_Comics = htmlspecialchars($_POST['Url_Comics']);
		$resumer = nl2br($_POST['resumer']);


	if (!empty($_POST['Nom_Comics']) AND !empty($_POST['resumer']) AND !empty($_POST['Url_Comics']))
{
	$inserttmbr = $bdd->prepare("INSERT INTO comics (Nom_Comics,resumer, id_Categorie, Url_Comics, id_user) VALUES(?,?,?,?)");
	$inserttmbr->execute(array($Nom_Comics,$id_Categorie,$Url_Comics,$userinfo['id']));
	$lastid = $bdd->lastInsertId();
      if(isset($_FILES['imageja']) AND !empty($_FILES['imageja']['name'])) {
              if(exif_imagetype($_FILES['imageja']['tmp_name']) == 2) {
                 $chemin = './jackette/'.$lastid.'.jpg';
                 move_uploaded_file($_FILES['imageja']['tmp_name'], $chemin);
              } else {
                 $message = 'Votre image doit être au format jpg';
              }
          }
}
	}}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Style_Administration.css">
	<title>Profil Administarteur</title>
</head>
<body>
	<div class="box-area">
						<div class="box-area">
		<header>		
			<div class="wrapper">
				<div class="logo">
					<a href="http://localhost/Comics/Acceuil_Utilisateur.php">E-Comics</a>				
			</div>
			<nav>
				<a href="Marvel_Fr.php">Marvel</a>
				<a href="Dc_Fr.php">Dc</a>
				<a href="Image_Fr.php">Image</a>
				<a href="Deconnection.php">Deconnection</a>
			</nav>
		</div>
	</header>
	<div class="banner-area">
			<h2>Administration</h2>
		</div>
			<div class="content-area">
		<div class="wrapper">
    <article>
    	<p align="center">Monsieur l Admin je presume<br>Ici tu peux bannir des membres ou meme rajouter des categorie de comics<br>On dirait que tes devenus un vrai mutant avec ses pouvoirs<br>N oublie pas qu il faut bannir un membres qui upload de faux comics</p>
    </article>
	<h1 align="center">Listes des membres</h1>
		</br> </br>
	<ul>
		<?php while($m = $utlisateur->fetch()){?>
		<li><?= $m['id'] ?> : <?= $m['Pseudo'] ?>  :  <a href="http://localhost/Comics/Administration.php?bannir=<?= $m['id'] ?> : <?= $m['Pseudo'] ?>">Bannir</a>                
	<?php } ?>
	</ul>	
</br> </br>
 	<h1 align="center">Ajouter une catgorie de comics</h1>
 	<div align="center">
 	<form method="POST"  action="">
 		<table>
 			<tr>
 				<td align="right">
 					<label for="Categorie">Nouvelle Categorie de Comics</label>
 				</td>
 				<td align="right">
 					<input type="text" class="input_basic" placeholder="Marvel/Dc/..." id="Categorie" name="Categorie" value="<?php if(isset($Categorie)) { echo $Categorie;} ?>">
 				</td>
 			</tr>
 			<tr>
 				<td>
                  </td>
 				<td align="center">
 					<input type="Submit" name="New_Categorie" value="Ajouter">
 				</td>
 			</tr>
 		</table>
 	</form>
 <br><br>
 <h1 align="center">Upload un comics</h1>
		<form method="POST" action="">
				<table>
					<tr>
						<td align="right"> 
							<label for="Nom_Comics">Nom Comics :</label>
						</td>
						<td align="right">
							<input type="text" class="input_basic" placeholder="Batman/Hulk/..." name="Nom_Comics" value="<?php if(isset($Nom_Comics)) { echo $Nom_Comics;}?>">
						</td>
					</tr>

					<tr>
						<td align="right"> 
							<label for="Url_Comics">Url_Comics :</label>
						</td>
						<td align="right">
							<textarea class="input_basic" placeholder="Drive/Torrent" name="Url_Comics" value="<?php if(isset($Url_Comics)) { echo $Url_Comics;}?>"></textarea>
						</td>
					</tr>
					<tr>
						<td align="right">Resumer</td>
						<td align="right"><textarea class="input_basic" name="resumer"></textarea></td>
					</tr>
										<tr>
						<td align="right"> 
							<label >Categorie Comics :</label>
						</td>
						<td align="right">
							<select class="input_basic" name="id_Categorie">
							<?php
				  			$Categoriee = $bdd->query('SELECT * FROM categorie_comics'); 
				  			while($row = $Categoriee->fetch())
				  			{
				  			?>
				  			<option name="id_Categorie" value="<?php echo $row[0]; ?>"> <?php  echo $row[1]; ?> </option>
				  			<?php
				  			}
				  			?>
				  			</select>
	  					</td> 
	  			</tr>	
	  			<td><label class="form-label" for="form3Example90">Image de la jaquette</label></td>
 				<td><input class="form-control form-control-lg"  name="imageja" id="formFileLg" type="file" /></td>
					<tr>
						<td align="center">
							<input type="submit" name="UpoladComics" value="Uploader votre comics">
						</td>
					</tr>

				</table>
					</div>		
					</form>	
				<br><br>
				<h1 align="center">Liste des comics des utilisateur</h1><br>
				<ul>
		<?php
		$upload = $bdd->query("SELECT * FROM upload");
		while($cc = $upload->fetch()){
			$ut = $bdd->prepare("SELECT * FROM utilisateur WHERE id = ?");
			$ut->execute(array($cc['id_user']));
			$utt=$ut->fetch();
			$ttt = $bdd->prepare("SELECT * FROM categorie_comics WHERE id = ?");
			$ttt->execute(array($cc['id_Categorie']));
			$tt=$ttt->fetch();
			$pts = $utt['points'] + 1;
			$id_u = $utt['id'];
			?>
		<li>Categorie comics : <?= $tt['Categorie_Comics']; ?> || Pseudo utilisateur : <?= $utt['Pseudo']; ?>|| Nom comics  :  <?= $cc['Nom_Comics']; ?>|| Url comics : <?= $cc['Url_Comics']; ?> || <form action="" method="POST">
			<input type="submit" value="Approuver" name="add">
		</form>
	<?php } ?>
	</ul>	

</div>
</div>
</div>
</div>
</div>
</body>
</html>
<?php 
if (isset($_POST['add'])) {
	$up=$bdd->prepare("UPDATE utilisateur set points = ? where id = ?");
	$up->execute(array($pts,$id_u));
}
}
 ?>