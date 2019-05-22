<!doctype html>

<html lang='fr'>

  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Journee de l'enfant à la creche Petitpanda. Le deroulement des temps de repos, sieste et repas
    est decrit avec des exemples de jeux. Des activites pour l'eveil des nourrissons et petits enfants sont au programme. Nous y mettons l'acent
    sur le lien avec la nature."/>

    <meta name="keywords" content="creche, activite, jeux, petits, garde, maternelle, premiers pas, enfants, parents, nounou">

    <meta name="author" content="Marc Harel et Amina Arbane">

    <meta name="publisher" content="Marc Harel et Amina Arbane" />

    <title>Journee dans la creche, jeux et conseils</title>

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
            <li> <a href="index.php"><img id="home" src="images/home.jpg" alt="icone accueil" title="accueil" /></a></li>
            <li><a href="conseils-informations.php">Conseils et informations</a></li>
            <li><a href="journee-type-de-lenfant.php"> Journée type de l'enfant</a></li>
            <li><a href="pre-inscription.php"> Pré-inscription </a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </nav>

      </header>

      <div>
        <img id="imgbaniere" src="images/bebe.jpg" alt="nourrisson sourire" title="banniere" />
      </div>

      <div id="titre-principal1">
        <h1>Journée type de l'enfant</h1> 
      </div>

      <div id="intro">
        <p>La priorité étant donnée au <strong>bien-être</strong> de chaque <strong>enfant</strong>, cette journée type est bien sûr 
        une base adaptée ensuite à chacun. Les enfants, notamment les plus jeunes, mangent et dorment lorsqu’ils en ont besoin. Le 
        rythme des enfants est défini avec les <strong>parents</strong> lors de la période d’adaptation puis évolue en même temps que l’enfant.</p>
      </div>

      <?php 
        include "inc/connexion.inc.php"; /*connexion à la bdd "projetcnam"*/
        $requete='SELECT content_image,content_title,content_description FROM content WHERE content_nompage="journée type" ORDER BY content_id';//Il faut mettre ORDER BY id pour que les articles s'affichent du premier au dernier posté.
        $reponse=$con->query($requete);

       //affiche tout les titres et les descriptions associées.

        while ($donnees = $reponse->fetch()) {?>

      <article>
        <div><img id="image" src= <?php echo $donnees['content_image'] ?> alt=<?php echo $donnees['content_title'] ?> title=<?php echo $donnees['content_title'] ?> /></div>
        <div class="paragraphe">
          <h2> <?php echo $donnees['content_title'] ?> </h2>
          <p> <?php echo $donnees['content_description'] ?></p>
        </div>
      </article>
      <?php } ?>

      <footer>

        <div>
          <ul>
            <li> <a href="index.php">Accueil</a></li>
            <li><a href="mention-legales.php">Mentions légales</a></li>
            <li><a href="contact.php"><img id="icone-contact" src="images/icone.png" alt="icone contact" title="contact" /></a></li>
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
              }
            ?>
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