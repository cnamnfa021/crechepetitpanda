<!DOCTYPE html>
<html lang='fr'>
  <head>

    <link href='css/style2.css' rel='stylesheet'>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Petitpanda, est une garderie pour les tout petits, avant la maternelle. Une creche, ou chaque nounou
      vous informe et offre ses conseils. Pour le bien-etre des tout petits."/>

    <meta charset='utf-8'>

    <meta name="keywords" content="accueil, nounou, petits, garde, maternelle, enfants, parents, famille, garderie">

    <meta name="author" content="Marc Harel et Amina Arbane">

    <meta name="publisher" content="Marc Harel et Amina Arbane" />

     <title>Accueil de Petitpanda, garderie des petits</title>

  </head>
    
  <body>

    <div id="bloc-page">

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
           <li> <a href="index.php"><img id="home" src="images/home.jpg" alt="icone accueil" title="accueil"/></a></li>
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
             <img src="images/diapo1.png" class="diapo" alt= "banniere" title="enfants jeux">
           </div>
         </div>
              
         <section id="History"><!-- fond ne fonction pas a vérifier -->
           <h2>histoire de la garderie PetitPanda</h2>
           <article id="histoire"><!-- faute à vérifier-->
             <p>
		     Bonjour cher visiteur, je voudrais vous introduire l'histoire de notre <strong>crèche</strong>.
             Son nom "PetitPanda" vient du panda roux qui est le <strong>petit</strong> panda de la nature,
             mais également de notre fils, qui <strong>nourrisson</strong> était tout potelé avec des joues et bien roux.
		     </p>

             <p>
			 PetitPanda a été créé en 2016 par mon mari et moi-même. Cette <strong>garderie</strong> fut le rêve d'une <strong>vie</strong>.
			 </p>

            <h2>Au service de la petite enfance</h2>
		     <p>
             Nos avons voulu apporter aux jeunes <strong>parents</strong> actifs, un <strong>service</strong> offrant la meilleure <strong>structure</strong> et
			 <strong>organisation</strong> pour le <em>bien-être</em> de leurs <strong>enfants</strong>.
             Elle a une capacité d’<strong>accueil</strong> de 12 <strong>enfants</strong> à <strong>temps</strong> 
			 plein ou à <strong>temps</strong> partiel, répartis en deux groupes : 
			 </p>
             <p>- «MicroPanda» pour le <strong>nourrisson</strong> de 2 à 18 mois.
			 </p>
             <p>- «MiniPanda» pour le <strong>nourrisson</strong> et l'<strong>enfant</strong> de 18 mois à 3 ans.
			 </p>
             <p>
			 Elle est composée d'une équipe de 5 à 6 professionnels spécialisés dans la <strong>petite enfance</strong>
            (responsable, éducateur de jeunes enfants, <strong>nounou</strong> <strong>auxiliaire</strong> de puériculture, accompagnatrices, et personnel chargé de l’entretien des locaux).
			Tous et toutes ont à <strong>coeur</strong> de créer et d'entretenir le meilleur environnement possible. Où les plus <strong>petits</strong> peuvent s'épanouir et s'éveiller,
			au travers de leurs <strong>jeux</strong> et de l'attention que nous leur donnons. Cela que ce soit à l'heure du <em>repas</em> ou à l'heure de la <em>sieste</em>.
			Chaque aspect de la <strong>vie</strong> des petits est importante, il s'agit souvent de leur premier contact avec le <strong>monde</strong> extérieur. La première séparation avant
			leurs premiers pas à l'<strong>école</strong> <strong>maternelle</strong>. Le jardin d'enfants est aussi l'occasion de les aider à être prêt pour cette étape importante
			de leur <strong>enfance</strong>.
			</p>
           </article>
         </section>
            
	     <section id="selection">
           <div id ="ici" class="selBox1">
             
		     <article>
			   <h3> Conseils et informations </h3>
			   <article id="resume-conseils"> 
			     <p>
			    Dans cette page vous trouverez des informations vous concernant ainsi des conseils pratiques qui peuvent vous aider à mieux comprendre votre enfant!
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
			     Tout simplement il vous facilite la vie en un clic!
   			     </p>
			   </article>
			   <a id="masquer" href="#ici" onClick="masquerafficher(this,'resume-formulaire')">Masquer le résumé</a> <!--appel à la fonction masquerafficher() pour afficher/masquer le résumé des articles-->
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
               <li><a href="contact.php"><img id="icone-contact" src="images/icone.png" alt="icone contact" title="contact"/></a></li>
             </ul>
		   </div>

		 </footer>
	
      
	  <script src="js/fonction.js"></script>
	   </div>
    </body>
    
</html>