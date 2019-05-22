<!doctype html>

<html lang='fr'>
  
  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Page de confirmation de création/modification des articles stockés dans la bdd du site."/>

    <title>Delete</title>

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

	 <header>

      <section>

  <!-- connexion à la bdd "projetcnam" avec try et catch pour envoyer un message d'erreur si il y en a besoin (évite de montrer les données
  cachées qui s'affichent avec le message par défaut !). -->

      <?php
        try{ $bdd = new PDO('mysql:host=localhost;dbname=projetcnam-modif;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); }
        catch(Exception $e) { die('Erreur : '.$e->getMessage()); }

        $req = $bdd->prepare('DELETE FROM content WHERE content_id= :id');
        $req->execute(array(
        'id' => $_GET['id'],
        ));

      echo ' Le message ' . $_GET['id'] . ' a été supprimé.';

      $req->closeCursor();

      ?>

    <p><strong><a href="backoffice.php">Retour à la page backoffice</a></strong></p>

      </section>

	  <footer>
	   <div>
	     <ul>
           <li> <a href="index.html">Accueil</a></li>
           <li><a href="mentions_légales.php">Mentions légales</a></li>
           <li><a href="contact.php">Envoyer un message<img id="icone-contact" src="images/icone.png" /></a></li>
         </ul>
	   </div>
	   <div id="copy"> 
	     <p> <strong>Copyright A.ARBANE et M.Harel </strong></p>
	   </div>
	 </footer>

    </div>

  </body>

</html>