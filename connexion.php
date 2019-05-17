<!doctype html>

<html lang='fr'>
  
  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Page de connexion au backoffice du site."/>

    <title>Connexion backoffice</title>

    <link rel='stylesheet' href='css/styleamina.css' />

  </head>

  <body>

    <div id="bloc_page">

      <div><!-- Gestion du bouton connexion/déconnexion-->

        <p id="cookie">
          <?php
// on définit une durée de vie de notre cookie (en secondes) pour le tester il est régler à 20 secondes (sinon 6 mois = 182*24*3600).
            $temps = 20;

// on envoie un cookie de nom firstconnexion portant la valeur ""

          if(!isset($_COOKIE['firstconnexion'])){
            setcookie ("firstconnexion", "_", time() + $temps);
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
		   <li><a href="pre-inscription.php"> Pré-inscription </a></li>
           <li><a href="contact.php">Contact</a></li>
	     </ul>
       </nav>



     </header>

	 <div id="titre-principal1">
        <h1> <strong> Connexion au backoffice </strong></a></h1> 
     </div>

      <section>

        <?php
        include "inc/connexion.inc.php";

        if ((isset ($_GET["login"]))||(isset ($_GET["password"]))){
        $_SESSION["login"]=$_GET["login"];
        $_SESSION["password"]=$_GET["password"];}

        if (empty($_SESSION["login"]) or empty($_SESSION['password'])) {
        echo "veuillez saisir un login et un mot de passe";
//si aucun login ou aucun (la variable n'existe pas -> empty) password n'a été entré (même faux), le message est affiché.
        }
        else {
        $st = $con->query("SELECT COUNT(*) FROM user WHERE user_login='".$_SESSION["login"]."' AND user_password='".$_SESSION["password"]."'")->fetch();
//si les identifiants sont entrés on cherche dans la bdd si ils sont dans la même ligne.
//La fonction COUNT() retourne le nombre de lignes qui correspondent à un critère specifié. l'* signifie que la fonction cherche dans toutes les colonnes.
        if ($st['COUNT(*)'] == 1){
//Si COUNT retourne 1, c'est qu'une ligne correspondant aux deux critères existe.
        header("Location: backoffice.php");
        }
		else{
		echo "Invalide !";}
		}
      ?>

<!--Début du formulaire de connexion au backoffice, il est soumis à la page backoffice.php-->

    <form name="formulaire" action="" method="GET" onsubmit="return verifForm(this)">

      <fieldset id="formulaire-contact">

      <h1>Formulaire de connexion au backoffice</h1>

      <p>
        <label for="login"> login <sup> * </sup>:</label>
        <input type="text" name="login" placeholder="login" required onblur="verifPseudo(this)" />
      </p>
      <p id="name_error"></p>

      <p>
        <label for="password"> mot de passe <sup> * </sup>:</label>
        <input type="text" name="password" placeholder="mot de passe" required />
      </p>
      <p id="password_error"></p>

      <p><input type="submit" value="Valider" /></p>

      <p>
        <input type="reset" name="effacer" value=" effacer ">
      </p>

      </fieldset>

    </form>

      </section>

	  <footer>
	       <div>
	         <ul>
               <li> <a href="index.php">Accueil</a></li>
               <li><a href="mention-legales.php">Mentions légales</a></li>
               <li><a href="contact.php"><img id="icone-contact" src="images/icone.png" /></a></li>
             </ul>
		   </div>
		   <div id="copy"> 
		   <?php 
		   /* récupération noms des créateures du site de la base de données======================*/ 
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

  <?php exit(); ?>

</html>
