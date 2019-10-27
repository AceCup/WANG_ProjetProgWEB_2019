<script type="text/javascript" language="javascript">

<!--

function verifier(){
	if (window.document.forms["f1"].nom.value=="") {
		alert("Veuiilez vous saisir le nom");
		return false;
	}
	if (window.document.forms["f1"].prenom.value=="") {
		alert("Veuiilez vous saisir le prénom");
		return false;
	}
	if (window.document.forms["f1"].email.value=="") {
		alert("Veuiilez vous saisir l'Email");
		return false;
	}else if(window.document.forms["f1"].email.value.indexOf("@")==-1){
		alert("Veuiilez vous vérifier le format de votre Email");
		return false;
	}
	if (window.document.forms["f1"].mdp.value=="") {
		alert("Veuiilez vous saisir le mot de passe");
		return false;
	}
	if (window.document.forms["f1"].pseudo.value=="") {
		alert("Veuiilez vous saisir le pseudo");
		return false;
	}
}



function connecter(){
	top.location="connecter.php";
}
function sansconnecter(){
	top.location="accueil.php";
}






-->
</script>












<html>
<head>
	<title>Inscription</title>
<meta charset="UTF-8"/>
  <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css"/>
  <meta name="viewport" content="width=max-device-width, initial-scale=1"/>
</head>
<body id="icb">
	<section>
	<div id="idiv1">

<form method="post" name="f1" onsubmit="return verifier();">
	Nom:<br> <input style="BACKGROUND-COLOR: transparent; color:white;" type="text" size="20" name="nom"><br><br>
	Prenom:<br> <input style="BACKGROUND-COLOR: transparent; color:white;"  type="text" size="20" name="prenom"><br><br>
	Email:<br> <input style="BACKGROUND-COLOR: transparent; color:white;"  type="text" size="20" name="email"  placeholder="exemple@mail.com"><br><br>
	Mot de passe:<br> <input style="BACKGROUND-COLOR: transparent; color:white;"  type="password" size="20" name="mdp"><br><br>
	Pseudo:<br> <input style="BACKGROUND-COLOR: transparent; color:white;"  type="text" size="20" name="pseudo"><br><br>
	<input id="sub" type="submit" name="v" value="Valider"><br><br>
</form>
Vous avez déjà un compte?<br><br>
<button onclick="connecter();">Se connecter</button><br><br>
Visiter le blog sans connexion<br><br>
<button onclick="sansconnecter();">Accueil</button><br><br>
<?php
include("connexion.php");
try{
 if (isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['email'])&&isset($_POST['mdp'])&&isset($_POST['pseudo'])){
$verifierE=$objPdo->prepare("SELECT idredacteur FROM wang245u_blog.redacteur WHERE adressemail=?");
$verifierE->bindValue(1,$_POST['email'], PDO::PARAM_STR);
$verifierE->execute();
$verifierP=$objPdo->prepare("SELECT idredacteur FROM wang245u_blog.redacteur WHERE pseudo=?");
$verifierP->bindValue(1,$_POST['pseudo'], PDO::PARAM_STR);
$verifierP->execute();
if ($rowE=$verifierE->fetch()) {
	echo "L'email est utilisé"."<br>";

}
if ($rowP=$verifierP->fetch()) {
	echo "Le pseudo est utilisé";
}

else{
	$inscrire=$objPdo->prepare("INSERT INTO wang245u_blog.redacteur(nom, prenom, adressemail, motdepasse, pseudo) VALUES (?,?,?,?,?)");
	$inscrire->bindValue(1,$_POST['nom'], PDO::PARAM_STR);
	$inscrire->bindValue(2,$_POST['prenom'], PDO::PARAM_STR);
	$inscrire->bindValue(3,$_POST['email'], PDO::PARAM_STR);
	$inscrire->bindValue(4,$_POST['mdp'], PDO::PARAM_STR);
	$inscrire->bindValue(5,$_POST['pseudo'], PDO::PARAM_STR);
	$inscrire->execute();
	header("Location:connecter.php");
}





}
}catch(Exception $e){
	echo $e->getMessage();
}


?>
</div>
</section>

	<h1 id="ich">
		Bienvenu!<br>
		欢迎！
	</h1>



</body>
</html>
