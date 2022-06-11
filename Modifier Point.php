<?php 
session_start();
if(!isset($_SESSION['id']) OR $_SESSION['id'] != 17){
    exit();
}

$bdd = new PDO('mysql:host=localhost;dbname=e-comics' ,  'root', 'root');
if (isset($_SESSION['id']) AND $_SESSION['id'] > 0) 
{	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
	$requser->execute(array($_SESSION['id']));

		$Ptsinfo =$requser->fetch(); 
	$Point = $Ptsinfo['Point'];
	if (isset($_POST['Valider'])) {
	
	$Pts = htmlspecialchars($_POST['Point']);
	$updatePts = $bdd->prepare('UPDATE utilisateur SET Point = ? WHERE id = ?');
	$updatePts->execute(array($Pts, $_SESSION));
	header("location: Administration.php");

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edition Points</title>
</head>
<body>
	<form method="POST" action="">
		<input type="text" name="Point" value="<?= $Point['Point']; ?>">
		<input type="submit" name="valider">
	</form>
</body>
</html>
<?php 
}
 ?>