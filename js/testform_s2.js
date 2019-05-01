function Datevalid()
  {
// cette fonction permet de créer une variable contenant l'heure de validation du formulaire
  var dateE = new Date();

  var heures=dateE.getHours();
  var minutes=dateE.getMinutes();
  if (heures<10){heures='0'+heures;}
  if (minutes<10){minutes='0'+minutes;}

  var madata="Envoyé à : "+heures+" heure "+minutes+" minutes.";
  // Vu que ma variable est locale, je l'utilise ici-même
  document.getElementById("date").value = madata;
  }

function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}

function verifPseudo(champ)
{

  var $champname = champ.value;
  var regexname = $champname.search( "<|>|{|}|%" );

   if((champ.value.length < 5 || champ.value.length > 25) ||(regexname != "-1"))
   {
      surligne(champ, true);
      document.getElementById("name_error").innerHTML  = "Entre cinq et vingt-cinq caractères, les caractères { }, < > et % sont interdits.";
      return false;
   }
   else
   {
      document.getElementById("name_error").innerHTML  = "";
      surligne(champ, false);
      return true;
   }
}

function verifMail(champ) {

  var $champmail = champ.value;
  var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
  var regex2 = $champmail.search( "<|>|{|}|%" );
  
  if((!regex.test(champ.value))||(regex2 != "-1")||(champ.value.length < 7 || champ.value.length > 25)){
      document.getElementById("mail_error").innerHTML  = "Veuillez entrer une adresse valide, les caractères { }, < > et % sont interdits.";
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      document.getElementById("mail_error").innerHTML  = "";
      return true;
   }
}

function veriftel(champ) {

  var $champtel = champ.value;
  var regextel = /^[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}$/;

  if((!regextel.test($champtel)) && ($champtel != "")) {
      surligne(champ, true);
      document.getElementById("tel_error").innerHTML  = "Veuillez respecter le format.";
      return false;
  }
   else
   {
      surligne(champ, false);
      document.getElementById("tel_error").innerHTML  = "";
      return true;
   }
}

function verifMessage(champ) {
  var $champmessage = champ.value;
   var regex = $champmessage.search( "<|>|{|}|%" );
   if((regex != "-1")||($champmessage == "")||(champ.value.length < 10 || champ.value.length > 150)) {
      surligne(champ, true);
      document.getElementById("message_error").innerHTML  = "Votre message ne doit pas faire plus de 150 caractères. Les caractères { }, < > et % sont interdits.";
      return false;
   }
   else
   {
      surligne(champ, false);
      document.getElementById("message_error").innerHTML  = "";
      return true;
   }
}

function verifForm(f)
{
  var pseudoOk = verifPseudo(f.user);
  var mailOk = verifMail(f.mail);
  var telOk = veriftel(f.telephone);
  var messageok = verifMessage (f.message);
  var telpseudo = pseudoOk && telOk;
   
   if(telpseudo && mailOk && messageok) {
      return true;
   }
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}