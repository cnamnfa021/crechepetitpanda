!doctype html>

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
	 <header>
	   <div id="logo">
         <img src="images/logo.png" alt="Logo de site" />
       </div>
     </header>

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
