<?php
session_start();
include("connexion.php");




?>
<script type="text/javascript" language="javascript">
	<!--
	function deconnecter(){

		if (confirm("Vous allez deconnecter")) {
			top.location="deconnecter.php";
			
		}
		return false;
	}


	function connecter(){
		top.location="connecter.php";
	}
function vtext(){
		if(window.document.forms["f1"].reponse.value==""){
			alert("Veuillez vous saisir la contenu de la réponse");
			return false;
		}
	}
	function retourner(){
		top.location="accueil.php";
	}
	function annuler(){
		top.location="repondre.php";
	}
		
		-->
</script>
<html>
<head>
	<title>Reponses</title>
	<meta charset="UTF-8"/>
  <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css"/>
  <meta name="viewport" content="width=max-device-width, initial-scale=1"/>
</head>
<header id="aheader">
	<nav>
	 <?php

if (isset($_SESSION['pseudo'])) {
	echo "Bonjour, ",$_SESSION['pseudo']."!"."&nbsp";
	echo "<button onclick='deconnecter()'>Se deconnecter</button>". "<br>";
}else{
	echo "Veuillez vous connecter " . "&nbsp" ." <button  onclick='connecter()'>Se connecter</button>". "<br>" ;
}

?>
	
</nav>
</header>

<body id="rb">


	

	<div style="border:1px solid black; margin-top: 50px; margin-bottom: 50px;" >
<?php
//afficher l'article sélectionné
$afficher=$objPdo->query("SELECT * FROM wang245u_blog.sujet, wang245u_blog.redacteur WHERE wang245u_blog.sujet.idredacteur=wang245u_blog.redacteur.idredacteur AND wang245u_blog.sujet.idsujet={$_GET['idsujet']} " );
while ($row=$afficher->fetch()) {
	
	$ids=$row['idsujet'];
	echo "<article>";
	echo "<h1>". $row ['titresujet'] ."</h1>" ;
	echo "Blog N°".$row['idsujet']." ".$row['datesujet']." by ".$row['pseudo'];
	echo "<p>".$row['textesujet']."</p>";
	echo "</article>";
	
	

	 
}
$afficher->closeCursor();


?>
</div>
<div style="border:1px solid black; margin-top: 50px; margin-bottom: 50px;" >
<?php
if (isset($_POST['reponse'])) {
	$rep=$objPdo->prepare("INSERT INTO wang245u_blog.reponse(idsujet, idredacteur,  textereponse, daterep) VALUES (?,?,?,now())");
	$rep->bindValue(1,$_GET['idsujet'],PDO::PARAM_STR);
	$rep->bindValue(2,$_SESSION['id'],PDO::PARAM_STR);
	$rep->bindValue(3,$_POST['reponse'],PDO::PARAM_STR);
	$rep->execute();
	header("Location:repondre.php?idsujet=".$_GET['idsujet']);

}



//echo $_GET['idsujet']."qrqfqf";

//afficher des réponses


$afficher=$objPdo->query("SELECT * FROM wang245u_blog.reponse, wang245u_blog.redacteur, wang245u_blog.sujet WHERE wang245u_blog.reponse.idredacteur=wang245u_blog.redacteur.idredacteur AND wang245u_blog.sujet.idsujet=wang245u_blog.reponse.idsujet AND wang245u_blog.reponse.idsujet={$_GET['idsujet']} ORDER BY daterep desc");//xxxxx
while ($row=$afficher->fetch()) {
	
	echo "<article>";
	echo "La réponse du Blog N°".$row['idsujet']." ".$row['daterep']." by ".$row['pseudo']."<br>";
	echo $row ['textereponse']."<br>"."<br>";
	
	echo "</article>";
	
}
$afficher->closeCursor();


?>
</div>





<form name="f1" method="post" onsubmit="return vtext();">
	Votre réponse:<br><br> <textarea name="reponse" rows="10" cols="100"  style="resize:none;"></textarea> <br><br>
							<input id="sub" type="submit" name="v" value="Valider"    
									<?php echo isset($_SESSION['pseudo'])?"":"disabled"; ?> ><br><br>
							
			
		
															
	
</form>


<button onclick="retourner();">Returner</button>
</body>
</html>