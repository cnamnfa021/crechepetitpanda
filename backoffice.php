<!doctype html>

<html lang='fr'>
  
  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Page backoffice Petitpanda, espace reserve aux administrateurs."/>

    <title>Backoffice</title>

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
		   <li><a href="pre-inscription.php"> Prè-inscription </a></li>
           <li><a href="contact.php">Contact</a></li>
	     </ul>
       </nav>
     </header>

	  <div id="titre-principal1">
	    <h1><strong> Backoffice </strong></h1>
      </div>

      <section>

<!-- Début du tableau html -->
    <table>

      <caption><strong>Liste des articles</strong></caption>

      <tr>
        <th>id</th>
        <th>Utilisateur</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Dernière modification</th>
        <th>Image</th>
        <th>Nom de la page</th>
        <th>Lien de modification</th>
        <th>Lien de suppression</th>
      </tr>

<!-- connexion à la bdd "projetcnam" avec try et catch pour envoyer un message d'erreur si il y en a besoin (évite de montrer les données
cachées qui s'affichent avec le message par défaut !). -->
     <?php 
		include "inc/connexion.inc.php"; /*connexion à la bdd "projetcnam"*/
        $requete='SELECT content_id, content_title, content_description, content_user, content_date, content_image, content_nompage FROM content ORDER BY content_id';//Il faut mettre ORDER BY id pour que les articles s'affichent du premier au dernier posté.
        $reponse=$con->query($requete);

		while ($donnees = $reponse->fetch()) {?>
        <tr>
	     <td><?php echo $donnees['content_id'] ?></td>
		 <td><?php echo $donnees['content_user'] ?></td>
		 <td><?php echo $donnees['content_title'] ?></td>
         <td><?php echo $donnees['content_description'] ?> </td> 
		 <td><?php echo $donnees['content_date'] ?></td>
		 <td><?php echo $donnees['content_image'] ?></td>
		 <td><?php echo $donnees['content_nompage'] ?></td>
	     <td> <?php echo '<a href="articlemodif.php?id='.$donnees['content_id']. '">'.'modifier'.'</a>'?></td>
		 <td> <?php echo '<a href="deletearticle.php?id='.$donnees['content_id']. '">'.'supprimer'.'</a>'?></td>
	   </tr>
	  <?php  } ?>
	</table>
	
	<!--Lien vers la page articlemodif.php, sans id envoyée (insère une nouvelle ligne dans la table content).-->
    <p><strong><a href="articlemodif.php">Créer un nouvel article</a></strong></p>

	<!--Lien vers la page message.php, sans id envoyée (insère une nouvelle ligne dans la table content).-->
    <p><strong><a href="message.php?$backoffice=not">Consulter les messages</a></strong></p>
<!--$backoffice="not"; évite l'itération des instruction de sécurité sur message.php (renvoi d'erreurs = variables de formulaires vides)-->
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

  </body>

</html>