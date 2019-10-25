<?php
session_start();
include("connexion.php");




?>


<html>
<head>
	<title>Reponses</title>
</head>
<body>
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


$afficher=$objPdo->query("SELECT * FROM wang245u_blog.reponse, wang245u_blog.redacteur, wang245u_blog.sujet WHERE wang245u_blog.reponse.idredacteur=wang245u_blog.redacteur.idredacteur AND wang245u_blog.sujet.idsujet=wang245u_blog.reponse.idsujet AND wang245u_blog.reponse.idsujet={$_GET['idsujet']}");//xxxxx
while ($row=$afficher->fetch()) {
	
	echo "<article>";
	echo "Blog N°".$row['idsujet']." ".$row['daterep']." by ".$row['pseudo']."<br>";
	echo $row ['textereponse']."<br>"."<br>";
	
	echo "</article>";
	
}
$afficher->closeCursor();


?>
</div>





<form method="post" >
	Votre réponse:<br><br> <textarea name="reponse" rows="10" cols="100"  style="resize:none;"></textarea> <br><br>
							<input type="submit" name="v" value="Valider"    
									<?php echo isset($_SESSION['pseudo'])?"":"disabled"; ?> ><br><br>
							
			
		
															
	
</form>

<form name="f2" method="post" action="accueil.php">
	<input type="submit" name="retourner" value="Retourner">

</form>

</body>
</html>