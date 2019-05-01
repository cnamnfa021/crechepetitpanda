<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'/>
    <title> journée type</title>
    <link rel='stylesheet' href='css/styleamina.css' />
  </head>
  <body>
   <div id="bloc_page">
	 <header>
	   <div id="logo">
         <img src="images/logo.png" alt="Logo de site" />
       </div>
	   <nav>
         <ul>
           <li> <a href="index.html"><img id="home" src="images/home.jpg" /></a></li>
		   <li><a href="conseils-informations.php">Conseils et informations</a></li>
           <li><a href="journee-type-de-lenfant.php"> Journée type de l'enfant</a></li>
		   <li><a href="pre-inscription.php"> Prè-inscription </a></li>
           <li><a href="contact.php">Contact</a></li>
	     </ul>
       </nav>
     </header>

     <div>
	   <img id="imgbaniere" src="images/bebe.jpg" />
	 </div>
	  
	 <div id="titre-principal1">
        <h1> <strong> Journée type de l'enfant </strong></a></h1> 
     </div>
     <section>
	    <div id="intro"> 
		  <p>La priorité étant donnée au bien-être de chaque enfant, cette journée type est bien sûr une base adaptée ensuite à chacun. Les enfants, notamment les plus jeunes, mangent et dorment lorsqu’ils en ont besoin. Le rythme des enfants est défini avec les parents lors de la période d’adaptation puis évolue en même temps que l’enfant. </p>
		</div>

        <?php 
		include "inc/connexion.inc.php"; /*connexion à la bdd "projetcnam"*/
        $requete='SELECT content_image,content_title,content_description FROM content WHERE content_nompage="journée type" ORDER BY content_id';//Il faut mettre ORDER BY id pour que les articles s'affichent du premier au dernier posté.
        $reponse=$con->query($requete);

       //affiche tout les titres et les descriptions associées.
	   
        while ($donnees = $reponse->fetch()) {?>
         <article><div><img id="image" src= <?php echo $donnees['content_image'] ?> /> </div>
		   <div class="paragraphe"> <h2> <?php echo $donnees['content_title'] ?> </h2> 
             <p> <?php echo $donnees['content_description'] ?></p>
		   </div>
		 </article>
        <?php
		}?>
     
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
		 
	 <p id="maj" onload="maj();"> <!-- affichage de la date de dernière modification du fichier avec javascript-->
	 </p>

	 <p id="largeur"> <!-- affichage de la largeur avec java script-->
	 </p>
	</div><!---fermeture blog page--->
    <input id="page" type="hidden" value="journee-type-de-lenfant.html" />
	<script src="js/fonction.js" type="text/javascript"> </script>
	
  </body>
  </html>