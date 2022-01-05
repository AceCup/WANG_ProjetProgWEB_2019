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
		if(window.document.forms["f1"].titre.value==""){
			alert("Veuillez vous saisir le titre du blog");
			return false;
		}
		if (window.document.forms["f1"].textes.value=="") {
			alert("Veuillez vous saisir la contenu du blog");
			return false;
		}
		
	}
	function repondre(){
		top.location="repondre.php";
		
	}
//456416
//testgit2022
	function annuler(){
		top.location="accueil.php";
	}

	function creer(){
		top.location="creerblog.php";
	}

	-->





</script>



<html>



<head >
	<title>Accueil</title>
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
<body id="ab">






<div id="adiv1" style="border:1px solid black; margin-top: 50px; margin-bottom: 10px;" >

<?php
//afficher des articles
$afficher=$objPdo->query('SELECT * FROM wang245u_blog.sujet, wang245u_blog.redacteur WHERE wang245u_blog.sujet.idredacteur=wang245u_blog.redacteur.idredacteur ORDER BY datesujet desc' );
while ($row=$afficher->fetch()) {
	//$_SESSION['ids']=$row['idsujet'];
	$ids=$row['idsujet'];
	echo "<article>";
	echo "<h1>". $row ['titresujet'] ."</h1>" ;
	echo "Blog N°".$row['idsujet']." ".$row['datesujet']." by ".$row['pseudo'];
	echo "<p>".$row['textesujet']."</p>";
	echo "</article>";
	
	echo" <a name='r' style='cursor:pointer; text-decoration:none; color:white;' href=' repondre.php?idsujet=$ids' >repondre</a>"."</br>";

	 
}
$afficher->closeCursor();


?>

</div>

 


</body>
<div id="adiv2">

<button onclick="creer();"    <?php echo isset($_SESSION['pseudo'])?"":"disabled";?>>Créer un blog</button>
</div>
</html>