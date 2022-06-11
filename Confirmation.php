<?php 
$bdd = new PDO('mysql:host=localhost;dbname=e-comics' ,  'root', 'root');
	if (isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key'])) {
		$pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
		$key = intval($_GET['key']);
		$requser = $bdd->perpare("SELECT * FROM utilisateur WHERE Pseudo = ? AND confirmkey = ?");
		$requser->execute(array($pseudo, $key));
		$userexist = $requser->rowCount();
	if 
	($userexist == 1) 
		{$user = $requser->fetch();
	if 
		($user['Confirme'] == 0) {	
			$updateuser = $bdd->perpare("UPDATE utilisateur SET confirme = 1 WHERE Pseudo = ? AND confirmkey = ?");
			$updateuser->execute(array($pseudo, $key));
			echo "VOTRE COMPTE A ETE CONFIRMER";
}else
		{echo "Votre compte a deja ete confirmer";}
}eles
		{echo "L utilisateur n existe pas !";}
}
?>