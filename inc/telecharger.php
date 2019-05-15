<!doctype html>

<html lang='fr'>
  
  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Page test pour 'journée type de l'enfant' du site."/>

    <link rel='stylesheet' href='../css/styleamina.css' />

  </head>

  <body>
    <div id="bloc_page">

<?php
  include "connexion.inc.php";

  $sth = $con->prepare("SELECT 
    message_id AS message_id, message_user AS message_user, message_message AS message_message, message_telephone AS message_telephone,
    message_mail AS message_mail, message_sujet AS message_sujet, message_date AS message_date FROM message ORDER BY message_id");

  $sth->execute();

/* Récupération de toutes les lignes d'un jeu de résultats */
  print("<p> Récupération de la liste des messages :</p>");

/*Avec fetch_num, le tableau retourné contient les résultats indexés par le numéro de la colonne (sinon chaque élément est enregistré 2 fois).*/
  $list = $sth->fetchAll(PDO::FETCH_NUM);

/*Avec cette variable, on dit d'ouvrir message.csv*/
  $fp = fopen("files/message.csv", "a+");

 /*On enregistre les lignes du tableau dans le fichier csv (représenté par $fp)*/
  foreach($list as $fields){
    fputcsv($fp, $fields);
  }

  $fichier = 'files/message.csv';

/*LA classe classe php nommée SplFileObject qui va nous permettre de lire des fichiers CSV grâce à très peu de lignes de code.*/
  $csv = new SplFileObject($fichier);

/*La méthode setFlags() utilisée avec l'attribut READ_CSV permet d'indiquer que nous voulons que le fichier soit lu comme un fichier CSV.*/
  $csv->setFlags(SplFileObject::READ_CSV);

/*La méthode setCsvControl() permet d'indiquer quel est le caractère délimiteur utilisé dans le fichier CSV.*/
  $csv->setCsvControl(',');

  foreach($csv as $ligne){
/* la fonction implode() concatène automatiquement toutes les colonnes du fichier CSV.*/
    echo '<p>|'.implode('|', $ligne).'|' . '</p>';
  }

// fermeture du fichier csv
  fclose($fp);

?>

<p><a href="../backoffice.php">Retour au backoffice</a></p>

</div>

  </body>

</html>
