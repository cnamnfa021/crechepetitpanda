<!DOCTYPE html>
<html>
  <head>
        <link href='css/style2.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset='utf-8'>
        <title>Accueil</title>
  </head>
    
  <body>

    <div id="bloc-page">

      <div><!-- Gestion du bouton connexion/déconnexion-->

        <p id="cookie">
          <?php
// on définit une durée de vie de notre cookie (en secondes) pour le tester il est régler à 20 secondes (sinon 6 mois = 182*24*3600).
            $temps = 20;

// on envoie un cookie de nom firstcoming portant la valeur ""

          if(!isset($_COOKIE['firstcoming'])){
            setcookie ("firstcoming", "_", time() + $temps);
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
          <p>
            <button class="conex" onClick="location.href='deconnexion.php';">Déconnexion</button>
          </p>

          <?php
            }else {
          ?>
<!-- Création du bouton connexion qui redirige vers la page connexion-->
          <p>
            <button class="conex" onClick="location.href='connexion.php';">Connexion</button>
          </p>

            <?php } ?>
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
		   <li><a href="pre-inscription.php"> Prè-inscription </a></li>
           <li><a href="contact.php">Contact</a></li>
	     </ul>
       </nav>

     </header>
            
     <main>
       <h1>Accueil</h1>
         <div class="DiaporamaBox">
           <div class="Diaporama">
             <img src="images/diapo1.png" class="diapo">
           </div>
         </div>
              
         <section id="History"><!-- fond ne fonction pas a vérifier -->
           <h2>histoire de PetitPanda</h2>
           <article id="histoire"><!-- faute à vérifier-->
             <p>
		     Bonjour cher visiteur, je veux vous introduire l'histoire de notre crèche.
             Son nom "PetitPanda" vient du panda roux qui est le petit panda de la nature,
             mais également de notre fils, qui enfant était tout potelé avec des joues bien roux.
		     </p>
             <p>
			 PetitPanda était créé en 2016 par mon mari et moi-même. Cette crèche fut le rêve d'une vie.
			 </p>
		     <p>
             Nos avons voulu apporté aux  jeunes parents actifs la meilleur structure et organisation pour le bien-être de leurs enfants.
             Elle a comme capacité d’accueillir  12 enfants à temps plein ou à temps partiel, répartis en deux groupes : 
			 </p>
             <p>- «MicroPanda» pour les enfant de 2 à 18 mois.
			 </p>
             <p>- «MiniPanda» pour les enfant de 18 mois à 3 ans.
			 </p>
             <p>
			 Elle est composée d'une équipe de 5 à 6 professionnels spécialisés dans la petite enfance
            (responsable, éducateur de jeunes enfants, auxiliaires de puériculture, accompagnatrices, et personnel chargé de l’entretien des locaux).
			</p>
           </article>
         </section>
            
	     <section id="selection">
           <div id ="ici" class="selBox1">
             
		     <article>
			   <h3> Conseils et informations </h3>
			   <article id="resume-conseils"> 
			     <p>
			    Dans cette page vous trouverez des informations vous concernant ainsi des conseils pratiques qui peuvant vous aider à mieux comprendre votre enfant!
                 </p>	
                
			   </article>
			   <a id="masquer" href="#ici" onClick="masquerafficher(this,'resume-conseils')">Masquer le résumé</a> <!--appel à la fonction masquerafficher() pour afficher/masquer le résumé des articles-->
			 </article>
           </div>
                
           <div id ="ici" class="selBox2">
             <article>
		       <h3> Journée type de l'enfant </h3>
			   <article id="resume-journee"> 
			     <p>
			    Cette page décrit le déroulement d'une journée type de votre enfant , elle détaille les moments les plus important!
                 </p>	
               </article>
			   <a id="masquer" href="#ici" onClick="masquerafficher(this,'resume-journee')">Masquer le résumé</a> <!--appel à la fonction masquerafficher() pour afficher/masquer le résumé des articles-->
			 </article>
			 </article>
		</div>
		
		 <div id ="ici" class="selBox2">
             <article>
		       <h3> Prè-inscription </h3>
			   <article id="resume-formulaire"> 
			     <p>
			     Vous trouvez le formulaire qui vous permettra de faire une pré-inscription en ligne, comme vous pouvez aussi l'imprimer, le remplir et l'envoyer!
			     Tout simplemment il vous facilte la vie en un clic!
   			     </p>
			   </article>
			   <a id="masquer" href="#ici" onClick="masquerafficher(this,'formulaire')">Masquer le résumé</a> <!--appel à la fonction masquerafficher() pour afficher/masquer le résumé des articles-->
			 </article>
			 </article>
		</div>
		
		
		
         </section >
      </main> 
	  
       <footer>
	       <div>
	         <ul>
               <li> <a href="index.html">Accueil</a></li>
               <li><a href="mention-legales.php">Mentions légales</a></li>
               <li><a href="contact.php"><img id="icone-contact" src="images/icone.png" /></a></li>
             </ul>
		   </div>

		 </footer>
	
      
	  <script src="js/fonction.js"></script>
	   </div>
    </body>
    
</html>
