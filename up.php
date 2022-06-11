<?php 
session_start();
	$bdd = new PDO('mysql:host=localhost;dbname=e-comics' ,  'root', ''); 
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


	if (!empty($_POST['Nom_Comics']) AND !empty($_POST['Url_Comics']))
{
	$inserttmbr = $bdd->prepare("INSERT INTO upload (Nom_Comics, id_Categorie, Url_Comics, id_user) VALUES(?,?,?,?)");
	$inserttmbr->execute(array($Nom_Comics,$id_Categorie,$Url_Comics,$userinfo['id']));	
}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="Upload.css">
		<title></title>
	</head>
	<body>
		<div class="box-area">
				<div class="box-area">
		<header>		
			<div class="wrapper">
				<div class="logo">
					<a href="Acceuil_Utilisateur.php">E-Comics</a>				
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
			<h2>Uploader un comics</h2>
		</div>
			<div class="content-area">
		<div class="wrapper">
			<h2>E-Comics</h2>
		<br>
		<div align="center">
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
						<td align="center">
							<input type="submit" name="UpoladComics" value="Uploader votre comics">
						</td>
					</tr>

				</table>
					</div>		
					</form>	
					</div>
					</div>
					</div>


	</body>
</html>
<?php 
}
?>