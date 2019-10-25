
<?php
include("connexion.php");


session_start();
if (isset($_POST['pseudo'])&&isset($_POST['mdp'])) {
	

$identifiant=$objPdo->prepare("SELECT idredacteur, pseudo, motdepasse FROM wang245u_blog.redacteur WHERE pseudo=? AND motdepasse=?");
$identifiant->bindValue(1,$_POST['pseudo'],PDO::PARAM_STR);
$identifiant->bindValue(2,$_POST['mdp'],PDO::PARAM_STR);
$identifiant->execute();
	if ($row=$identifiant->fetch()) {
		$_SESSION['id']=$row['idredacteur'];
		$_SESSION['pseudo']=$row['pseudo'];
		$_SESSION['mdp']=$row['motdepasse'];
	header("Location:accueil.php");}

	else{ echo "Echec de l'authentification";}


}


?>

<script type="text/javascript" language="javascript">
	<!--
	function verifier() {
		if(window.document.forms["f1"].pseudo.value==""){
			alert("Veuillez vous saisir votre pseudo");
			return false;

		}
		if (window.document.forms["f1"].mdp.value=="") {
			alert("Veuillez vous saisir votre mot de passe")
			return false;
		}
	}
	-->
</script>


<html>
<head>
	<title>connecter</title>
</head>
<body>
<form method="post" name="f1" onsubmit="return verifier();">
	Votre pseudo: <input type="text" name="pseudo" size="50"><br><br>
	Mot de passe: <input type="password" name="mdp" size="50"><br><br>
					<input type="submit" name="c" value="Connecter">
	
</form>
<form name="f2" method="post" action="inscrire.php">
	Vous n'avez pas de compte? <br><br>
	<input type="submit" name="i" value="S'inscrire">

</form>


</body>
</html>


