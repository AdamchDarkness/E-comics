<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=e-comics' ,  'root', '');

if (isset($_SESSION['id']) AND $_SESSION['id'] > 0) 
{	
	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
	$requser->execute(array($_SESSION['id']));
	$userinfo = $requser->fetch();
	if(isset($_GET['id']) AND !empty($_GET['id']))
	{	
	$get_id = htmlspecialchars($_GET['id']);
	$comics = $bdd->prepare('SELECT * FROM comics WHERE id = ?');
	$comics->execute(array($get_id));
	$url = $comics->fetch();
	}
?>
<!DOCYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<a href="<?= $url['Url_Comics']; ?>">Lien du comics</a>
</body>
</html>
<?php
} 
else
header("Location: connection.php");
?>