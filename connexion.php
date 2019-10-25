<?php
try{
  $objPdo=new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbnames=wang245u_blog','wang245u_appli','31819065',
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
  echo "connexion ok<br/>\n";
}
catch(Exception $execption){
  die($execption->getMessage());
}


?>
