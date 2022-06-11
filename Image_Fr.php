<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=e-comics' ,  'root', '');

if (isset($_SESSION['id']) AND $_SESSION['id'] > 0) 
{	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
	$requser->execute(array($_SESSION['id']));
	$userinfo = $requser->fetch();

		$Marv = $bdd->prepare('SELECT * FROM comics WHERE id_Categorie = 3');
	$Marv->execute(array());
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<title>E-Comics le premier site de partage de comics</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Image.css">
</head>
<body>
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
				<a href="up.php">Upload Comics</a>
				<a href="Deconnection.php">Deconnection</a>
			</nav>
		</div>
	</header>
	<div class="banner-area">
		<h2>Image Comics</h2>
	</div>
	<div class="content-area">
		<div class="wrapper">
			<h2>E-Comics</h2>
			<article>
 <p>Ici vous vous  trouverz dans la section Image Comics</p>
 <p>Vous trouvererais des classics du monde des comics ainsi que des histoires plus courantes et plus recentes</p>
 <p>Si vous commencez dans le monde des comics Image Comics : Voici quelques suggestions
 Premierement si vous ne connaissait rien vous pouvais commencer par Spawn ou Invincible </p>

 	</article>
 	<?php while($ma = $Marv->fetch()){?>
			    <div class="card mb-3" style="max-width: 1000px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img
        src="./jackette/<?= $ma['id']; ?>.jpg"
        alt="Trendy Pants and Shoes"
        class="img-fluid rounded-start"
      />
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $ma['Nom_Comics']; ?></h5>
        <br>
        <p class="card-text">
          <?= $ma['resumer']; ?>
        </p>
        <?php $url = $ma['$Url_Comics']; ?>
        <br>
        <form method="POST" action="">
        	<input type="submit" class="btn btn-primary" value="Telecharger" name="point">
        </form>
        <button></button>
      </div>
    </div>           
		<?php } ?>

				
			</div>
		</div>
	</div>
			</div>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</html>
<?php
if (isset($_POST['Point'])) 
	{

		$pts = $userinfo['Point'] - 1;
		$update = $bdd->prepare("UPDATE utilisateur set Point = ? WHERE id = ?");
		$update->execute(array($pts,$userinfo['id']));
		header(location($url));
	}
} 
else
header("Location: connection.php");
?>