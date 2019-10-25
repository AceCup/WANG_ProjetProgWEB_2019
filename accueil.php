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


	-->





</script>



<html>
<?php

if (isset($_SESSION['pseudo'])) {
	echo "Bonjour, ",$_SESSION['pseudo']."!"."<br>";
	echo "<button onclick='deconnecter()'>Se deconnecter</button>". "<br>";
}else{
	echo "Veuillez vous connecter " . "<br>" ." <button  onclick='connecter()'>Se connecter</button>". "<br>" ;

	

}




?>


<head>
	<title>Accueil</title>
</head>
<body>


<?php
if (isset($_POST['titre'])&&isset($_POST['textes'])) {
	$sujet=$objPdo->prepare("INSERT INTO wang245u_blog.sujet(idredacteur,titresujet, textesujet, datesujet) VALUES (?,?,?,now())");
	$sujet->bindValue(1,$_SESSION['id'],PDO::PARAM_STR);
	$sujet->bindValue(2,$_POST['titre'],PDO::PARAM_STR);
	$sujet->bindValue(3,$_POST['textes'],PDO::PARAM_STR);
	$sujet->execute();
	header("Location:accueil.php");
}
?>
<div style="border:1px solid black; margin-top: 50px; margin-bottom: 50px;" >

<?php
//afficher des articles
$afficher=$objPdo->query('SELECT * FROM wang245u_blog.sujet, wang245u_blog.redacteur WHERE wang245u_blog.sujet.idredacteur=wang245u_blog.redacteur.idredacteur');
while ($row=$afficher->fetch()) {
	//$_SESSION['ids']=$row['idsujet'];
	$ids=$row['idsujet'];
	echo "<article>";
	echo "<h1>". $row ['titresujet'] ."</h1>" ;
	echo "Blog N°".$row['idsujet']." ".$row['datesujet']." by ".$row['pseudo'];
	echo "<p>".$row['textesujet']."</p>";
	echo "</article>";
	
	echo" <a name='r' style='cursor:pointer; color:blue;' href=' repondre.php?idsujet=$ids' >repondre</a>"."</br>";

	 
}
$afficher->closeCursor();


?>

</div>

 
<form name="f1" method="post" onsubmit="return vtext();">
	titre de sujet:<br><br> <input type="text" name="titre" size="50" ><br><br>
	la contenu de sujet:<br><br> <textarea name="textes" rows="10" cols="100"  style="resize:none;" ></textarea> <br><br>
	<input type="submit" name="v" value="Valider"    
		<?php echo isset($_SESSION['pseudo'])?"":"disabled";
		/*if (isset($_POST['titre'])&&isset($_POST['textes'])) {
		 	if (isempty($_POST['titre'])||isempty($_POST['textes'])) {
		 		v.disabled;
		 	}}*/
		 	/*echo empty($_POST['titre'])||empty($_POST['textes'])?"disabled":"enabled";*/
		 ?> ><br><br>

			
		
	
	

	
</form>

</body>
</html>