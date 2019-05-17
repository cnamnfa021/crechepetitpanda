<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Formulaire de contact de la creche Petitpanda, demande de contact, demande d'informations et suggestion d'amélioration.
    Nous sommes à votre écoute, prêts à répondre rapidement."/>

    <title>Contact, message, nounou, parents</title>

    <link rel='stylesheet' href='css/styleamina.css' />

  </head>
  
  <body onsubmit="Datevalid();">
   <div id="bloc_page">

      <div><!-- Gestion du bouton connexion/déconnexion-->

        <p id="cookie">
          <?php
// on définit une durée de vie de notre cookie (en secondes) pour le tester il est régler à 20 secondes (sinon 6 mois = 182*24*3600).
            $temps = 20;

// on envoie un cookie de nom firstcontact portant la valeur ""

          if(!isset($_COOKIE['firstcontact'])){
            setcookie ("firstcontact", "_", time() + $temps);
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
           <li> <a href="index.php"><img id="home" src="images/home.jpg" alt="icone accueil" title="accueil" /></a></li>
		   <li><a href="conseils-informations.php">Conseils et informations</a></li>
           <li><a href="pre-inscription.php">Pré-inscription</a></li>
		   <li><a href="journee-type-de-lenfant.php">Journée type de l'enfant</a></li>
           <li><a href="contact.php">Contact</a></li>
	     </ul>
       </nav>
     </header>
            
	
     <div id="entete">
	    <img id="imgbaniere" src="images/contact.jpg" />
	 </div>

     <div id="titre-principal">
	   <h1> Contact </h1> 
	 </div>
	 
	 <article id="adresse">
	 <div id="coordonee">
	   <p><strong> Crèche « PetitPanda » </strong></p>
	   <p><strong>Place Jean Jaurès 37000, Tours</strong></p>
       <p><strong> Téléphone: 06 64 71 78 30/ 07 83 25 39 58</strong></p>
       <p><strong>Email : contact@petitpanda.fr</strong></p>
	   </div>
	   <div id="map"><!-- l'image map-->
	   </div>
	 </article>

	 <form name="formulaire" action="message.php" method="GET" onsubmit="return verifForm(this)">

	     <fieldset id="formulaire-contact">
            <p>
            <label for="nom">Nom et Prénom <sup> * </sup></label>
			</p>
			<p>
            <input type="text" name="user" placeholder="Nom et prénom" required onblur="verifPseudo(this)" />
		    </p>
			<p id="name_error"> <!---champs message d'erreur--->
			</p>
    		<p>
		    <label for="tel">Téléphone </label>
		    </p>
		    <p>
            <input type="text" id="telephone" name="telephone" placeholder="0140578826" onblur="return veriftel(this)" />
		    </p>
			<p id="tel_error"> <!---champs message d'erreur--->
			</p>
		    <p>
   		    Sujet de message 
		   </p>

<!-- Le checked="checked" permet de donner une valeur par défaut à l'input radio (pas d'erreur champs vide sur message.php).-->

		   <p> 
	       <input type="radio" name="sujet" value="moins de 15h par semaine" id="moins de 15h par semaine" checked="checked" /> <label for="riche">Demande de contact </label>
		   </p>
		   <p>
           <input type="radio" name="sujet" value="entre 15h et 20h" id="entre 15h et 20h" /> <label for="entre 10h et 20h">Demande d'information</label>
		   </p>
		   <p>
           <input type="radio" name="sujet" value="entre 20h et 35h" id="entre 20h et 35h" /> <label for="entre 20h et 35h"> Suggestion d'amélioration</label>
		   </p>
		   <p>
	       <label for="email"> Email<sup> * </sup></label>
	       </p>
	       <p>
           <input type="text" id="mail" name="mail" placeholder="nathan@orange.fr"! size="30" required onblur="verifMail(this)" />
	       </p>
		   <p id="mail_error">
		   </p> 
           <p>
	       <label for="commentaire"> Message <sup> * </sup> </label> 
		   </p>
		   <p>
           <textarea name="message" id="message" cols="40" rows="10" placeholder="Pour taper votre message, c'est par ici." required onblur="verifMessage(this)"></textarea>
	       </P>
		   <p id="message_error">
		   </p>
		   <p>
		   <input type="hidden" name="date" value="" id='date'/> <!--  input type hidden pour stoquer la date de soumission du formulaire -->
		   </p>
		   <p>
		   <label for="answer"> Question mathématique <sup> * </sup> </label>
		   </p>
		   <span for="answer" id="question"> question</span>
           // <input id="answer" type="text" required onblur="return captcha(this);"/> <!-- captcha mathématique -->
		   <p id="erreuranswer">
		   </p>
		   <p id="indication-captcha">
		   Trouvez la solution de ce problème mathématique simple et saisissez le résultat. Par exemple, pour 1 + 1, saisissez 2.
		   </p>
		   <p> Les champs indiqués par une <sup> * </sup> sont obligatoires.</p>

<!--$backoffice permet d'activer la sécurité côté serveur (message.php), lors de l'envoi d'un nouveau message (ou d'une modification).-->
		   <input type="hidden" name="$backoffice" value="ok"/>

      	   <p> 
	       <input type="submit" value="Envoyer" /> 
	       <input type="reset" value="Annuler" />
	       </p>
		   
	     </fieldset>
	</form>
	
	     <footer>
	       <div>
	         <ul>
               <li><a href="index.php">Accueil</a></li>
               <li><a href="mention-legales.php">Mentions légales</a></li>
               <li><a href="contact.php"><img id="icone-contact" src="images/icone.png" alt="icone contact" title="contact"/></a></li>
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
    <input id="page" type="hidden" value="contact.html" />
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyB1aJKL68_gpKem4NfRnm4ymFwDSkCu33s" type="text/javascript"></script>
    <script src="js/fonction.js" type="text/javascript"></script>
  </body>
 </html>)
