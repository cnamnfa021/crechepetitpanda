<!DOCTYPE html>
<html lang='fr'>

  <head>

    <meta charset='utf-8'/>

    <meta name = "description" content = "Petitpanda, informations sur à propos de la creche, de son organisation. Conseils des nounous et spécialistes
      aux parents. Accompagnement, hygiene, promenades et horaires vous trouverez tout ici."/>

    <title>Conseils et informations, horaires, écoute, accompagnement, aide</title>

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
            <li> <a href="index.php" title="index"><img id="home" src="images/home.jpg" alt="icone accueil" title="accueil" /></a></li>
            <li><a href="conseils-informations.php" title="conseils">Conseils et informations</a></li>
            <li><a href="journee-type-de-lenfant.php" title="journee"> Journée type de l'enfant</a></li>
            <li><a href="pre-inscription.php" title="inscription"> Prè-inscription </a></li>
            <li><a href="contact.php" title="contact">Contact</a></li>
          </ul>
        </nav>

      </header>

    <div id="entete">
      <img id="imgbaniere" src="images/parent.jpg" alt="parents mains jointes" title ="banniere" />
    </div>

    <div id="titre-principal1">

      <h1>Conseils, aide et informations</h1>

    </div>

    <div id=" alerte" >
      <p id="labienvenue">Parents, bienvenue dans votre espace</p>
      <?php include "inc/connexion.inc.php"; /*connexion à la bdd "projetcnam"*/
       $requete='SELECT content_description FROM content WHERE content_title="information"';
       $reponse=$con->query($requete);
       while ($donnees = $reponse->fetch()) {?>
          <img id="img" src="images/alerte.jpg" alt="image de l'alerte" title="alerte" > <strong id="information"> <?php echo $donnees['content_description']?> </strong>
    </div>
    <?php } ?>

    <section>

      <article id="contenu">

        <?php
          include "inc/connexion.inc.php"; /*connexion à la bdd "projetcnam"*/
          $requete='SELECT * FROM content WHERE content_nompage="Conseils" ORDER BY content_id';//Il faut mettre ORDER BY id pour que les articles s'affichent du premier au dernier posté.
          $reponse=$con->query($requete);
        //affiche tout les titres et les descriptions associées.
          $i=1; //compteur pour incrémenter "id" de div (utilisé dans fichier css)
          while ($donnees = $reponse->fetch()) {
        ?>

      <div id="<?php echo "article".$i?>"> 
        <h2>  <?php echo $donnees['content_title'] ?> </h2>
        <p class="conseil">
          <?php echo $donnees['content_description'] ?>
        </p>
      </div>

		 <?php 
		 $i=$i+1; //incrémenter numéro d'article afin d'afficher la bonne image en fond d'écran
		 } ?>
		 </article>

   	    <footer>
	       <div>
	         <ul>
               <li> <a href="index.php" title="index" title="index">Accueil</a></li>
               <li><a href="mention-legales.php" title="loi">Mentions légales</a></li>
               <li><a href="contact.php" title="contact"><img id="icone-contact" src="images/icone.png" alt="icone contact" title="contact" /></a></li>
             </ul>
		   </div>
		   <div id="copy"> 
		   <?php 
		   /* récupération noms des créateures du site de la base de données======================*/ 
		      include "inc/connexion.inc.php";
			  $requete="SELECT user_login FROM user WHERE user_statut='createur'";
			  $resultat=$con->query($requete);?>
              <p><strong>
                <?php 
                echo 'Copyright $ ';
                while($donnees=$resultat->fetch()){ 
                  echo $donnees['user_login'];
                 echo ' $ ';
                } ?>
              </strong></p>

        </div>

      </footer>

    </div>

  </body>

</html>