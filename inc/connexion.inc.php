
<?php
	$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
	$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND]='SET NAMES utf8';

	$serveur="";
	$loginserveur="root";
	$mdpserveur="";
	$bddname="projetcnam";

	$con=new PDO("mysql:host=".$serveur.";dbname=".$bddname,$loginserveur,$mdpserveur,$pdo_options);?>
