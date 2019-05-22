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

		 <nav>
		   <ul>
			  <li> <a href="index.php"><img id="home" src="images/home.jpg" /></a></li>
			  <li><a href="conseils-informations.php">Conseils et informations</a></li>
			  <li><a href="journee-type-de-lenfant.php"> Journée type de l'enfant</a></li>
			  <li><a href="pre-inscription.php"> Pré-inscription </a></li>
			  <li><a href="contact.php">Contact</a></li>
		   </ul>
		 </nav>
	    </header>
		
		<div id="titre-principal1">
			 
		 <h1> Delete </h1>    
		
	   </div>
	  
      <section>

      <?php
       include "inc/connexion.inc.php"; /*connexion à la bdd "projetcnam"*/

        $req = $con->prepare('DELETE FROM content WHERE content_id= :id');
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
               <li><a href="mention-legales.php">Mentions légales</a></li>
               <li><a href="contact.php"><img id="icone-contact" src="images/icone.png" /></a></li>
             </ul>
		   </div>
		   <div id="copy"> 
		   <?php 
		   /* récupération noms des créateures du site de la base de données======================*/ 
		      include "inc/connexion.inc.php";
			  $requete="SELECT user_login FROM user WHERE user_statut='createur'";
			  $resultat=$con->query($requete);?>
		      <p> <strong> <?php 
			  echo 'Copyright $ ';
			  while($donnees=$resultat->fetch()){ 
			    echo $donnees['user_login'];
			    echo ' $ ';
			  } ?>
			  </strong></p>	 
		   </div>
		 </footer>
   </div>
    </div>

  </body>

</html>
