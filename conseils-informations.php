<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'/>
    <title> conseils et informations </title>
    <link rel='stylesheet' href='css/styleamina.css' />
  </head>
  <body>
    <div id="bloc_page">
	  <div><!-- Gestion du bouton connexion/déconnexion-->
		<?php
		  session_start();
		  include "inc/connexion.inc.php"; /*connexion à la bdd "projetcnam"*/
		
		  if(isset($_SESSION['login'])) {
		?>
		  <p id="bienvenu"><!-- affichage du nom de la personne connectée -->
			<?php echo 'Bienvenue ' . $_SESSION["login"];?>
		  </p>
			<!-- Création du bouton déconnexion qui redirige vers la pge déconnexion -->
			<button class="conex" onClick="location.href='deconnexion.php';">Déconnexion</button>
			
		   <?php
			  }else {
			?>
		   <!-- Création du bouton connexion qui redirige vers la page connexion-->
			 <button class="conex" onClick="location.href='connexion.php';">Connexion</button>
		
		   <?php 
			  }
		  ?>
	   </div>
	
	  <header>
		 <div id="logo">
	       <img src="images/logo.png" alt="Logo de site" />
		 </div>
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
            
	
	   <div id="entete">
		<img id="imgbaniere" src="images/parent.jpg" />
	   </div>
		  
	   <div id="titre-principal1">
			 
		 <h1> Conseils et informations </h1>    
		
	   </div>
   
	  
      <div id=" alerte" >
	  <p id="labienvenue"> Bienvenue dans votre espace </p>
	  <?php include "inc/connexion.inc.php"; /*connexion à la bdd "projetcnam"*/
       $requete='SELECT content_description FROM content WHERE content_title="information"';
       $reponse=$con->query($requete);
	   while ($donnees = $reponse->fetch()) {?>
          <img id="img" src="images/alerte.jpg" alt="image de l'alerte" > <strong id="information"> <?php echo $donnees['content_description']?> </strong>
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
	
	</body>
	
</html>