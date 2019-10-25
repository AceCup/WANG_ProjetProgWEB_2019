
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

	else{ echo '<script>alert("Echec de authentification");</script>';}


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

	function verins(){
		top.location="inscrire.php";
	}

	-->
</script>


<html>
<head>
	<title>connecter</title>
	<meta charset="UTF-8"/>
  <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css"/>
  <meta name="viewport" content="width=max-device-width, initial-scale=1"/>
</head>
<body id="icb">
	<div id="cdiv1">
<form method="post" name="f1" onsubmit="return verifier();">
	Votre pseudo: <input style="BACKGROUND-COLOR: transparent; color:white;" type="text" name="pseudo" size="35"><br><br>
	Mot de passe: <input style="BACKGROUND-COLOR: transparent; color:white;" type="password" name="mdp" size="35"><br><br>
					<input id="sub" type="submit" name="c" value="Connecter">
	
</form>

	Vous n'avez pas de compte? <br><br>
	<button onclick="verins();">S'inscrire</button>
	

</form>
</div>
<div id="idiv2">
	<h1 style="filter:alpha(opacity=50)">
		Bienvenu!<br>
		欢迎！
	</h1>
	
</div>
</body>
</html>


