<!doctype html>

<html lang='fr'>
  
  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Page pour créer ou modifier des articles, stockés dans la bdd du site."/>
    <title>Article</title>

    <link rel='stylesheet' href='css/styleamina.css' />

  </head>

  <body onsubmit="Datevalid();">

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
           <li> <a href="index.html"><img id="home" src="images/home.jpg" /></a></li>
		   <div id="menu-categorie">
             <li><a href="parent.html">Espace parent</a></li>
               <div id="sous-liste">
			     <ul>
                   <li><a href="pre-inscription.html">Prè-inscription</a></li>
			     </ul>                                                                          
			     <ul>
                   <li><a href="journee_type.php">Journée type de l'enfant </a></li>
                 </ul>
			   </div>
		  </div>
		  <div id="menu-categorie">
            <li><a href="#">Espace professionnel</a></li>
		      <div id="sous-liste">
			    <ul>
                  <li><a href="#">Informations équipier</a></li>
			    </ul>
			    <ul>
                  <li><a href="#">Démo espace professionnel </a></li>
                </ul>
			  </div>
		  </div>
          <li><a href="contact.php">Contact</a></li>
	     </ul>
       </nav>
     </header>
	  
	  <div>
        <nav id="titre"> <!-------composé du titre de l'article et du catégorie parent------>
          <ul>
            <li><h1>Article</h1></li>
          </ul>
        </nav>    
      </div>

      <section>

  <!-- connexion à la bdd "projetcnam" avec try et catch pour envoyer un message d'erreur si il y en a besoin (évite de montrer les données
  cachées qui s'affichent avec le message par défaut !). -->

      <?php
        try{ $bdd = new PDO('mysql:host=localhost;dbname=projetcnam-modif;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); }
        catch(Exception $e) { die('Erreur : '.$e->getMessage()); }
//ces variables remplissent les champs du formulaire (elles sont vides par défaut)
        $id = "";
        $user = "";
        $title = "";
        $description = "";
        $image = "";
        $nom_page = "";

//isset vérifie l'existence de l'id (si il n'y en a pas -> pas de remplissage).
        if(isset($_GET["id"])){
          $req = $bdd->prepare('SELECT content_id, content_title, content_description, content_user, content_date, content_image, content_nompage FROM content WHERE content_id= :id');
          $req->execute(array('id' => $_GET['id']));
          echo 'modification du message numéro : ' . $_GET['id'] . '</br>';

//la boucle permet de donner les valeurs correspondant à l'id, aux variables, si un id a été transmis.
          while ($donnees = $req->fetch()){
            echo $donnees['content_user'] . ' auteur de cet article : ' . $donnees['content_title'] . ', contenant : ' . $donnees['content_description'];
            $user = $donnees['content_user'];
            $description = $donnees['content_description'];
            $title = $donnees['content_title'];
            $id = $donnees['content_id'];
            $image = $donnees['content_image'];
            $nom_page = $donnees['content_nompage'];
          }
        }
      ?>

    <form name="formulaire" action="confirmation.php" method="GET" onsubmit="return verifForm(this)">

<!--C'est sur la page confirmation.php que vont s'effectuer la création (si id est vide), ou la modifiaction (selon l'id) d'une ligne.-->

      <fieldset id="formulaire-contact">

      <input type="hidden" name="id" value="<?php echo $id ?>" >

      <h1>Formulaire de création/modification d'article</h1>

      <p>
        <label for="user"> Utilisateur:</label>
        <input type="text" name="user" value="<?php echo $user ?>" required onblur="verifPseudo(this)"/>
      </p>
      <p id="name_error"></p>

      <p>
        <label for="title"> Titre:</label>
        <input type="text" name="title" value="<?php echo $title ?>" required />
      </p>

      <h2>Description :</h2>
      <p>
        <textarea name="description" id="description" cols="40" rows="10" required  onblur="verifMessage(this)"><?php echo $description ?></textarea>
      </p>
      <p id="message_error"></p>

      <p>
        <label for="image"> Image:</label>
        <input type="text" name="image" value="<?php echo $image ?>" >
      </p>
      <p>
        <label for="page"> Nom de la page :</label>
        <input type="text" name="nom_page" value="<?php echo $nom_page ?>" required>
      </p>

<!--Champ invisible, il stocke la valeur de la date obtenue avec Datevalid().-->
      <p>
        <input type="hidden" name="date" value="" id='date'/>
      </p>

      <input type="submit" value="Valider">

      </fieldset>

    </form>

      </section>

	  <footer>
	   <div>
	     <ul>
           <li> <a href="index.html">Accueil</a></li>
           <li><a href="mentions_légales.php">Mentions légales</a></li>
           <li><a href="contact.php">Envoyer un message<img id="icone-contact" src="images/icone.png" /></a></li>
         </ul>
	   </div>
	   <div id="copy"> 
	     <p> <strong>Copyright A.ARBANE et M.Harel </strong></p>
	   </div>
	 </footer>

    </div>

  </body>

  <script src="js/fonction.js"></script>

</html>