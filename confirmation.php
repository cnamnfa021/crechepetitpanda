<!doctype html>

<html lang='fr'>
  
  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Page de confirmation de création/modification des articles stockés dans la bdd du site."/>

    <link rel='stylesheet' href='css/styleamina.css' />

  </head>

  <body>

    <div id="bloc_page">

      <div id="session"><!-- Gestion du bouton connexion/déconnexion-->

        <a href="index.php" id="logo"><img src="images/logo.png" alt="Logo de site" title="Petitpanda" /></a>

        <p id="cookie">
          <?php
// on définit une durée de vie de notre cookie (en secondes) pour le tester il est régler à 20 secondes (sinon 6 mois = 182*24*3600).
            $temps = 20;

// on envoie un cookie de nom firstday portant la valeur ""

          if(!isset($_COOKIE['firstday'])){
            setcookie ("firstday", "_", time() + $temps);
            echo "Bienvenue";
          }

          ?>
          </p>

          <?php
            session_start();
            include "inc/connexion.inc.php"; /*connexion à la bdd "projetcnam"*/

            if(isset($_SESSION['login'])) {
          ?>
          <p id="bienvenu"><!-- affichage du nom de la personne connectée -->
            <?php echo 'Bienvenue ' . $_SESSION["login"];?>
          </p>
<!-- Création du bouton déconnexion qui redirige vers la pge déconnexion -->
          <p class="boutonco">
            <button class="conex" onClick="location.href='deconnexion.php';">Déconnexion</button>
          </p>

          <?php
            }else {
          ?>
<!-- Création du bouton connexion qui redirige vers la page connexion-->
          <p class="boutonco">
            <button class="conex" onClick="location.href='connexion.php';">Connexion</button>
          </p>

            <?php } ?>
      </div>
  <!-- connexion à la bdd "projetcnam" avec try et catch pour envoyer un message d'erreur si il y en a besoin (évite de montrer les données
  cachées qui s'affichent avec le message par défaut !). -->

      <?php
        try{ $bdd = new PDO('mysql:host=localhost;dbname=projetcnam-modif;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); }
        catch(Exception $e) { die('Erreur : '.$e->getMessage()); }
      ?>

    <?php

//isset vérifie l'id, si le champ est vide -> pas d'update (article modif renvoi un champ vide, mais la variable existe, isset ne fonctionne donc pas ici).
        if($_GET["id"] != ""){
        $req = $bdd->prepare('UPDATE content SET content_title = :title, content_user = :user, content_date = :date, content_description = :description, content_image = :image, content_nompage = :nom_page WHERE content_id = :id');
        $req->execute(array(
        'id' => $_GET['id'],
        'title' => $_GET['title'],
        'user' => $_GET['user'],
        'date' => $_GET['date'],
        'description' => $_GET['description'],
        'image' => $_GET['image'],
        'nom_page' => $_GET['nom_page']
        ));

        echo ' Article numéro : ' . $_GET['id'] . ' ; titre : ' . $_GET['title'] . ' ; user : ' . $_GET['user'] . ' ; a été modifé. ' . 
        $_GET['date'];
        }else{
//le champ id est vide, c'est donc un nouveau message -> ajout du message.
      $req = $bdd->prepare('INSERT INTO content(content_title, content_description, content_user, content_date, content_image, content_nompage) 
      VALUES(:title, :description, :user, :date, :image, :nom_page)');
      $req->execute(array(
      'title' => $_GET['title'],
      'description' => $_GET['description'],
      'user' => $_GET['user'],
      'date' => $_GET['date'],
      'image' => $_GET['image'],
      'nom_page' => $_GET['nom_page'],
      ));

      echo 'Cet article a bien été ajouté ! ';

		echo $_GET['user'] . ' a écrit : ' . $_GET['description'] . ' à : ' . $_GET['date']; }

      $req->closeCursor();
    ?>

      <p><strong><a href="backoffice.php">Retour à la page backoffice</a></strong></p>

    </div>

  </body>

</html>