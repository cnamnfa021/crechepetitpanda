<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'/>
    <title>pre-inscription </title>
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

      <div>
	  <img id="imgbaniere" src="images/pre-inscription.jpg" />
	  </div>
	
      <div id="titre-principal1">
        <h1> <strong>Pré-inscription </strong></a></h1> 
      </div>

     <div id="mapage"> <!-- début de zone  à imprimer -->
	   <div id="introduction">
         <p> <strong> Ce document est une demande d’inscription, merci de le compléter et de le remettre à la <strong>microcrèche</strong> le plus rapidement possible : </strong> </p>
         <ul> <strong>
          <li> par email : contact@PetitPenda.fr </li>
	      <li> par courrier : Micro-crèche PetitPanda – Place INGRES– 37000 TOURS </li>
	     </strong> </ul>
	     <p><strong>Nous vous contacterons dans les meilleurs délais pour confirmer ou non votre inscription (suivant les places disponibles).</strong> </p>
	   </div>
       <form method="post" action="traitement.php">
         <fieldset id="demande"> 
           <legend> Votre demande : </legend>
	         <fieldset>
               <legend> Le père de l'enfant </legend> <!-- Titre du 1er fieldset -->
                 <p>
                 <label for="nom">Nom :</label>
                 <input type="text" name="nom" id="nom"  size="30" maxlength="10" required />
		         </p>
		         <p>
		         <label for="Prènom"> Prènom :</label>
                 <input type="text" name="Prènom" id="Prènom" size="30" maxlength="10" required />
                 </p>		 
		         <p>
		         <label for="Profession">Profession  :</label>
                 <input type="text" name="Profession" id="Profession" size="30" maxlength="10" required />
		         </p>
		         <p>
		         <label for="Adresse">Adresse :</label>
                 <input type="text" name="Adresse" id="Adresse" size="30" maxlength="30" required />
		         </p>
		         <p>
		         <label for="Tel">Tel :</label>
                 <input type="text" name="Tel" id="Tel" placeholder="0123456789" size="30" maxlength="10" required />
		         </p>
	         </fieldset>
	
	         <fieldset>
               <legend> Le mère  de l'enfant </legend> <!-- Titre du 2ème fieldset -->
                 <p>
                 <label for="nom">Nom :</label>
                 <input type="text" name="nom" id="nom" size="30" maxlength="10" required />
		         </p>
                 <p>	   
                 <label for="Prènom"> Prènom :</label>
                 <input type="text" name="Prènom" id="Prènom" size="30" maxlength="10" required />
		         </p>
                 <p>		   
                 <label for="Profession">Profession  :</label>
                 <input type="text" name="Profession" id="Profession" size="30" maxlength="10" required  />
		         </p>
                 <p>		  
                 <label for="Adresse">Adresse :</label>
                 <input type="text" name="Adresse" id="Adresse" size="30" maxlength="10" required />
		         </p>
                 <p>		   
                 <label for="Tel">Tel :</label>
                 <input type="text" name="Tel" id="Tel" placeholder="0123456789" size="30" maxlength="10" required />
                 </p>
	         </fieldset>
	
	         <fieldset>
               <legend> Le résponsable légal <sup>*</sup>	   </legend> <!-- Titre du 3ème fieldset -->
                 <p>
                 <label for="nom">Nom :</label>
                 <input type="text" name="nom" id="nom" size="30" maxlength="10" required />
		         </p>
		         <p>
		         <label for="Prènom"> Prènom :</label>
                 <input type="text" name="Prènom" id="Prènom"  size="30" maxlength="10" />
		         </p>
		         <p>
		         <label for="Profession">Profession  :</label>
                 <input type="text" name="Profession" id="Profession" size="30" maxlength="10" />
		         </p>
		         <p>
		         <label for="Adresse">Adresse :</label>
                 <input type="text" name="Adresse" id="Adresse" size="30" maxlength="10" />
		         </p>
		         <p>
		         <label for="Tel">Tel :</label>
                 <input type="text" name="Tel" id="Tel" size="30" maxlength="10" />
		         </p>
		         <p> 
		         <sup>*</sup>(si père ou mère, n’indiquez que le nom et le prénom)
		         </p>
	         </fieldset>
	
	         <fieldset>
               <legend> L'enfant </legend> <!-- Titre du 4ème fieldset -->
                 <p>
                 <label for="nom">Nom :</label>
                 <input type="text" name="nom" id="nom" size="30" maxlength="10" required />
		         </p>
		         <p>
		         <label for="Prènom"> Prènom :</label>
                 <input type="text" name="Prènom" id="Prènom" size="30" maxlength="10" required />
		         </p>
		         <p>
		         <label for="Adresse">Adresse :</label>
                 <input type="text" name="Adresse" id="Adresse"  size="30" maxlength="10" required />
		         <p>
		         <label for="Date naissance">Date naissance  :</label>
                 <input type="date" name="Date naissance" id="Date naissance" placeholder="Format: JJ/MM/AA" size="30" maxlength="10" />
		         </p>
		         <p>
		         <strong>Si vous êtes enceinte (à partir du 6ème mois) : </strong>
		         </p>
                 <p>
	             <label for="accouchement">Date prévue de l'accouchement :</label>
                 <input type="date" name="accouchement" id="accouchement" placeholder="Format: JJ/MM/AA" size="30" maxlength="10" />
		         </p>
		         <p>
		         <strong>Dès la naissance, merci de contacter la microcrèche pour confirmer la demande d’inscription et donner la date de naissance ainsi que le prénom de votre enfant.</strong>
		         </p>
		         <p>
	             <label for="entrée">Date prévue d’entrée à la microcrèche :</label>
                 <input type="date" name="entrée" id="entrée" placeholder="Format: JJ/MM/AA" size="30" maxlength="10" />
		         </P>
	             <p> 
		         Jours souhaités(cochez les cases) : 
		         </p>
		         <p> 
                 <input type="checkbox" name="Lundi" id="Lundi" /> <label for="Lundi"> Lundi </label>
		         </p>
		         <p>
                 <input type="checkbox" name="Mardi" id="Mardi" /> <label for="Mardi">Mardi</label>
		         </p>
		         <p>
                 <input type="checkbox" name="Mercredi" id="Mercredi" /> <label for="Mercredi">Mercredi</label>
                 </p>
		         <p>
		         <input type="checkbox" name="Jeudi" id="Jeudi" /> <label for="Jeudi">Jeudi</label>
		         </p>
		         <p>
	             <input type="checkbox" name="Vendredi" id="Vendredi" /> <label for="Vendredi">Vendredi</label>
                 </p>
	             <p>
   		         Nombres d'heures souhaités ( par semaine): 
		         </p>
		         <p> 
	             <input type="radio" name="heures" value="moins de 15h par semaine" id="riche" /> <label for="riche">moins de 10h </label>
		         </p>
		         <p>
                 <input type="radio" name="heures" value="entre 15h et 20h" id="celebre" /> <label for="entre 10h et 20h">entre 10h et 20h</label>
		         </p>
		         <p>
                 <input type="radio" name="heures" value="entre 20h et 35h" id="entre 20h et 35h" /> <label for="entre 20h et 35h"> entre 20h et 35h</label>
		         </p>
		         <p>
                 <input type="radio" name="heures" value="plus de 35h" id="plus de 35h" /> <label for="plus de 35h">plus de 35h</label>
		         </p>
             </fieldset>
	       </fieldset>
		   
	         <p>
	         <label for="email"> Email :</label>
             <input type="email" name="email" id="email" size="30" maxlength="10" /> 
	         </p>
             <p>
	         <label for="commentaire"> Commentaires eventuels :</label>
			 </p>
			 <p>
             <textarea name="commentaire" id="commentaire" rows="10" cols="50"/></textarea>
	         </p>
	         <p> 
	         <input type="submit" value="Envoyer" /> 
	         </p>
	   </form>
     </div> <!-- fin de zone zone à imprimer -->
	 
	 <button onClick="imprimer('mapage')">Imprimer</button>  <!--bouton imprimer de la zone définie -->

     <footer>
	   <div>
	     <ul>
           <li> <a href="index.php">Accueil</a></li>
           <li><a href="mentions-legales.php">Mentions légales</a></li>
           <li><a href="contact.php"><img id="icone-contact" src="images/icone.png" /></a></li>
         </ul>
	   </div>
	   <div id="copy"> 
	     <p> <strong>Copyright A.ARBANE et S.HASSAN SAID </strong></p>
	   </div>
	 </footer>
	 
  </div> <!-----fin blog de page---->
  <script src="js/fonctionamina.js" type="text/javascript"> </script>
 </body>
</html>