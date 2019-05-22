<!doctype html>

<html lang='fr'>
  
  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Page de réception du formulaire de contact de la creche Petitpanda."/>

    <title>Message, reception, validation, enregistrement, bdd</title>

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
	    <h1><strong> Messages </strong></h1>
      </div>

<!--Sécurité côté serveur (enlever la fonction verifform de contact.php pour tester ces lignes).-->

<!--Sécurité côté serveur pour le champ user (invalide si vide ou différent du format de la regex, le nombre de caractère est vérifié), 
 même format que dans le js côté client.-->
    <p>
<!-- $backoffice active la sécurité côté serveur si sa valeur est "not" (passage par contact.php), et évite l'affichage d'erreurs sinon (par backoffice.php)-->
      <?php
        if ($_GET['$backoffice']!="not"){
          $formuser = "valide";
          $utilisateur = $_GET["user"];
          if ('' == $utilisateur) {
            global $formuser;
            $formuser = "vide";
            echo 'Le champ nom et prénom est : ' . $formuser;
          }else if ((preg_match("'[^a-zA-Z0-9 ]'", $utilisateur)) or (strlen($utilisateur) < 5)or (strlen($utilisateur) > 25)){
            global $formuser;
            $formuser = "invalide";
            echo 'Le champ nom et prénom est : ' . $formuser;
          }
        }
      ?>
    </p>
<!--Sécurité côté serveur pour le champ téléphone (invalide si différent du format de la regex), même format que dans le js côté client.-->
    <p>
      <?php
        if ($_GET['$backoffice']!="not"){
          $telephone = $_GET['telephone'];
          $formtel = "valide";
          global $formtel;

          if ('' == $telephone) {
            echo 'Le champ téléphone est vide.';
          }else if (!preg_match("'^[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}$'", $telephone)){
            global $formtel;
            $formtel = "invalide";
            echo 'Le champ téléphone est : ' . $formtel;
          }
        }
      ?>
    </p>
<!--Sécurité côté serveur pour le champ message (invalide si vide ou différent du format de la regex, le nombre de caractère est vérifié), 
 même format que dans le js côté client.-->
    <p>
      <?php
      if ($_GET['$backoffice']!="not"){
         $message = $_GET['message'];
        $formmessage = "valide";
        if ('' == $message) {
          global $formmessage;
          $formmessage = "vide";
          echo 'Le champ message est vide.';
         }else if ((preg_match("'[^a-zA-Z0-9 ]'", $message))or (strlen($message) < 10)or (strlen($message) > 150)){
          global $formmessage;
          $formmessage = "invalide";
          echo 'Le champ message est : ' . $formmessage;
        }
      }
      ?>
    </p>
<!--Sécurité côté serveur pour le champ mail (si vide ou différent du format de la regex), même format que dans le js côté client.-->
    <p>
      <?php
      if ($_GET['$backoffice']!="not"){
        $mail = $_GET['mail'];
        $formmail = "valide";
        if ('' == $mail) {
          global $formmail;
          $formmail = "vide";
          echo 'Le champ mail est vide.';
        }else if (!preg_match("'^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$'", $mail)){
          global $formmail;
          $formmail = "invalide";
          echo 'Le champ mail est : ' . $formmail;
        }
      }
      ?>
    </p>

<!--Les champs concernés par F264 : Securiser le formulaire de contact cote serveur, sont les champs tel, nom et message.
Ici le champs mail est aussi sécurisé, mais le captcha ne l'est pas (il n'est pas demandé et il y dépend de js pour fonctionner).-->

    <?php
    include "inc/connexion.inc.php";
    $reponse = $con->query('SELECT message_id, message_user, message_message, message_telephone, message_mail, message_sujet, message_date FROM message ORDER BY message_id');

/*la variable $formvalide permet de vérifier que tout les champs sont valides*/
    $formvalide = "invalide";

    if ($_GET['$backoffice']!="not"){

/*Si un des champs est invalide, sa variable le sera aussi, donc $formvalide le sera également*/
      if(($formuser=="valide")and($formmessage == "valide") and ($formmail =="valide")and ($formtel =="valide")){
        global $formvalide;
        $formvalide = "valide";
      }
    }

//Si un administrateur est connecté, la page affiche le contenu de la table message (liste des messages).
      if (! empty($_SESSION["login"]) and ! empty($_SESSION['password'])) {
    ?>

<!--Met en place le tableau html.-->
    <table><caption><h1>liste des messages : </h1></caption>
          <tr>
            <th>id</th>
            <th>Utilisateur</th>
            <th>Message</th>
            <th>Téléphone</th>
            <th>Adresse mail</th>
            <th>Sujet</th>
            <th>Heure envoi</th>
          </tr>

<!--Remplissage du tableau html à partir des données de la table content.-->
    <?php
        while ($donnees = $reponse->fetch()) { ?>

    <tr>
      <td><?php echo $donnees['message_id']?></td>
      <td><?php echo $donnees['message_user']?></td>
      <td><?php echo $donnees['message_message']?></td>
      <td><?php echo $donnees['message_telephone']?></td>
      <td><?php echo $donnees['message_mail']?></td>
      <td><?php echo $donnees['message_sujet']?></td>
	  <td><?php echo $donnees['message_date']?></td>
	  </tr>
      <?php } ?>
      </table>

<!--Lien pour télécharger le fichier message.csv-->
      <a href="inc/telechargement.php"><button type="button">Télécharger</button></a>


      <?php } ?>

      <?php
        echo "<p>" . "L'enregistrement dans la bdd est : " . $formvalide . "</p>";
/*Si un nouveau message a été enregistré depuis la page de contact, $_GET['user'] n'est pas vide, on affiche donc le message qui a été enregistré.*/
      if ((! empty($_GET["user"]))and ($formvalide == "valide")) {
        $reponse = $con->query('SELECT message_id, message_user, message_message, message_telephone, message_mail, message_sujet, message_date FROM message ORDER BY message_id');
/*Les ' continues à générer des erreurs à partir de la ligne 190 (sans js), solution possible neutraliser $_Get['...'] en les transformant et en les stockan,t dans des variables ?*/
        $st = $con->query("SELECT COUNT(*) FROM message WHERE message_user='".$_GET['user']."' AND message_message='".$_GET['message']."'")->fetch();
/*solution possible pour ' modification du if (!empty...) avec "and ($formvalide == "valide")" */

/*$st['COUNT(*)'] == 0 : Cette méthode évite les doublons, mais en tapant le signe ' une erreur s'affiche. -> solution interdire le caractère ' (ne fonctionne appartemment pas pour la regex php)?*/
/*Si $formvalide a pour valeur "valide", tout les champs sont valides et le message est enregistré.*/
 if (($st['COUNT(*)'] == 0) and ($formvalide == "valide")){
        $req = $con->prepare('INSERT INTO message(message_user, message_message, message_telephone, message_mail, message_sujet, message_date) 
        VALUES(:user, :message, :telephone, :mail, :sujet, :date)');
        $req->execute(array(
        'user' => $_GET['user'],
        'message' => $_GET['message'],
        'telephone' => $_GET['telephone'],
        'mail' => $_GET['mail'],
        'sujet' => $_GET['sujet'],
        'date' => $_GET['date'],
        ));
  ?>

<!--Remplissage du tableau html à partir des données envoyées par le formulaire de contact.-->

      <table><caption><h1>Les informations suivantes ont été envoyées : </h1></caption>
        <tr>
          <th>Utilisateur</th>
          <th>Message</th>
          <th>Téléphone</th>
          <th>Adresse mail</th>
          <th>Sujet</th>
          <th>Heure envoi</th>
        </tr>
        <tr>
          <td><?php echo $_GET['user']?></td>
          <td><?php echo $_GET['message']?></td>
          <td><?php echo $_GET['telephone']?></td>
          <td><?php echo $_GET['mail']?></td>
          <td><?php echo $_GET['sujet']?></td>
          <td><?php echo $_GET['date']?></td>
        </tr>
      </table>

      <?php
          echo '<p>' . 'Le message a bien été enregistré dans la bdd ! ' . '</p>';
        }

        echo $_GET['user'] . ' a écrit : ' . $_GET['message'];
    }

/*détruit la variable $backoffice (pour libérer de l'espace et prévenir d'éventuels conflits) ? */
        unset($backoffice);

      ?>

      <p><a href="contact.php">Revenir au formulaire de contact</a></p>

    </div>

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
          $resultat=$con->query($requete);
        ?>
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

  </body>

</html>