<!doctype html>

<html lang='fr'>
  
  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width" />

    <meta name = "description" content = "Page de réception du formulaire de contact (contact.php)."/>

    <link rel='stylesheet' href='css/styleamina.css' />

  </head>

  <body>
   <div id="bloc_page">
<!--Sécurité côté serveur (enlever la fonction verifform de contact.php pour tester ces lignes).-->

<!--Sécurité côté serveur pour le champ user (invalide si vide ou différent du format de la regex, le nombre de caractère est vérifié), 
 même format que dans le js côté client.-->
    <p>
<!-- $backoffice active la sécurité côté serveur si sa valeur est "ok" (passage par contact.php), et évite l'affichage d'erreurs sinon (par backoffice.php)-->
      <?php
	  session_start();

      if ($_GET['$backoffice']!="ok"){
        $formuser = "valide";
        $utilisateur = $_GET["user"];
        if ('' == $utilisateur) {
          global $formuser;
          $formuser = "vide";
          echo 'Le champ nom et prénom est : ' . $formuser;
        }else if ((preg_match("'<|>|{|}|'|%'", $utilisateur)) or (strlen($utilisateur) < 5)or (strlen($utilisateur) > 25)){
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
      if ($_GET['$backoffice']!="ok"){
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
      if ($_GET['$backoffice']!="ok"){
         $message = $_GET['message'];
        $formmessage = "valide";
        if ('' == $message) {
          global $formmessage;
          $formmessage = "vide";
          echo 'Le champ message est vide.';
         }else if ((preg_match("'<|>|{|}|'|%'", $message))or (strlen($message) < 10)or (strlen($message) > 150)){
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
      if ($_GET['$backoffice']!="ok"){
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
    if ($_GET['$backoffice']!="ok"){

/*la variable $formvalide permet de vérifier que tout les champs sont valides*/
      $formvalide = "invalide";
/*Si un des champs est invalide, sa variable le sera aussi, donc $formvalide le sera également*/
      if(($formuser=="valide")and($formmessage == "valide") and ($formmail =="valide")and ($formtel =="valide")){
        global $formvalide;
        $formvalide = "valide";
      }
    }

      try{ $bdd = new PDO('mysql:host=localhost;dbname=projetcnam-modif;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); }
      catch(Exception $e) { die('Erreur : '.$e->getMessage()); }

//Si un administrateur est connecté, la page affiche le contenu de la table message (liste des messages).
      if (! empty($_SESSION["login"]) and ! empty($_SESSION['password'])) {

        echo 'Bienvenue ' . $_SESSION["login"];

        $reponse = $bdd->query('SELECT message_id, message_user, message_message, message_telephone, message_mail, message_sujet, message_date FROM message ORDER BY message_id');

//Met en place le tableau html.
        echo '<table><caption><h1>liste des messages : </h1></caption>
          <tr>
            <th>id</th>
            <th>Utilisateur</th>
            <th>Message</th>
            <th>Téléphone</th>
            <th>Adresse mail</th>
            <th>Sujet</th>
            <th>Heure envoi</th>
          </tr>';

//Remplissage du tableau html à partir des données de la table content.
        while ($donnees = $reponse->fetch()) {
        echo '<tr><td>' . $donnees['message_id'] . '</td>' . '<td>' . $donnees['message_user'] . '</td>' . '<td>' . $donnees['message_message'] . '</td>' . 
            '<td>' . $donnees['message_telephone'] . '</td>' . '<td>' . $donnees['message_mail'] . '</td>' . '<td>' . $donnees['message_sujet'] . '</td>' . '<td>' . $donnees['message_date'] . '</td></tr>';
        }
       echo '</table>';
      }

/*Si un nouveau message a été enregistré depuis la page de contact, $_GET['user'] n'est pas vide, on affiche donc le message qui a été enregistré.*/
      if (! empty($_GET["user"])) {
        $reponse = $bdd->query('SELECT message_id, message_user, message_message, message_telephone, message_mail, message_sujet, message_date FROM message ORDER BY message_id');
        $st = $bdd->query("SELECT COUNT(*) FROM message WHERE message_user='".$_GET['user']."' AND message_message='".$_GET['message']."'")->fetch();

/*$st['COUNT(*)'] == 0 : Cette méthode évite les doublons, mais en tapant le signe ' une erreur s'affiche. -> solution interdire le caractère ' ?*/
/*Si $formvalide a pour valeur "valide", tout les champs sont valides et le message est enregistré.*/
 if (($st['COUNT(*)'] == 0) and ($formvalide == "valide")){
        $req = $bdd->prepare('INSERT INTO message(message_user, message_message, message_telephone, message_mail, message_sujet, message_date) 
        VALUES(:user, :message, :telephone, :mail, :sujet, :date)');
        $req->execute(array(
        'user' => $_GET['user'],
        'message' => $_GET['message'],
        'telephone' => $_GET['telephone'],
        'mail' => $_GET['mail'],
        'sujet' => $_GET['sujet'],
        'date' => $_GET['date'],
        ));

//Remplissage du tableau html à partir des données envoyées par le formulaire de contact.

        echo '<table><caption><h1>Les informations suivantes ont été envoyées : </h1></caption>
          <tr>
            <th>Utilisateur</th>
            <th>Message</th>
            <th>Téléphone</th>
            <th>Adresse mail</th>
            <th>Sujet</th>
            <th>Heure envoi</th>
          </tr>
          <tr>
            <td>' . $_GET['user'] . '</td>' . '<td>' . $_GET['message'] . '</td>' . 
        '<td>' . $_GET['telephone'] . '</td>' . '<td>' . $_GET['mail'] . '</td>' . '<td>' . $_GET['sujet'] . '</td>' . '<td>' . $_GET['date'] . '</td>
        </table>';

        echo '<p>' . 'Le message a bien été enregistré dans la bdd ! ' . '</p>';
      }

        echo $_GET['user'] . ' a écrit : ' . $_GET['message'];
        echo "<p>" . "L'enregistrement dans la bdd est : " . $formvalide . "</p>";
	  }

/*détruit la variable $backoffice (pour libérer de l'espace et prévenir d'éventuels conflits) ? */
    unset($backoffice);

    ?>

    <p><a href="contact.php">Revenir au formulaire de contact</a></p>

    </div>
  </body>

</html>
