window.onload = function() {
    var $page = document.getElementById('page').value;
    if ($page =="contact.html") {
        initMap();questionaleatoire();
    }
   if ($page =="journee-type-de-lenfant.html") {
        maj(); larg();
    }
}
/******************************************************************************************* Partie dévelopée par Marc**********************************************************************************************************/


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

//Le fond du champ concerné sera rouge si la fonction est appelée (true).
function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}

//Les fonctions suivantes vérifie le contenu des champs.
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

//Cette fonction vérifie si l'ensemble du contenu des champs est valide (si une des fonctions vérif est fausse, elle empêche l'envoi du formulaire).
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

/**************************************************************** Partie dévelopée par Amina *******************************************************************************************************************/

/*fonction imprimer la page sans header et footer*/

function imprimer(divName) {
      var $printContents = document.getElementById(divName).innerHTML;    
   var $originalContents = document.body.innerHTML;      
   document.body.innerHTML = $printContents;     
   window.print();     
   document.body.innerHTML = $originalContents;
   }

/*code qui affiche les questions aléatoires de Captcha mathématique*/			
var $rand;
var $reponse;			
function questionaleatoire(){			
var $questions = ["3+5=", "6+9=", "5+6="];
 $rand = Math.floor(Math.random() * 3);
 $reponse=[8,15,11]
document.getElementById('question').innerHTML =$questions[$rand];}
		
/* Fonction d'initialisation de la carte map*/
			
			function initMap() {
				// On initialise la latitude et la longitude de Paris (centre de la carte)
			var $lat = 47.389769;
			var $lon = 0.688896;
			var map = null;
				// Créer l'objet "map" et l'insèrer dans l'élément HTML qui a l'ID "map"
				map = new google.maps.Map(document.getElementById("map"), {
					// Nous plaçons le centre de la carte avec les coordonnées ci-dessus
					center: new google.maps.LatLng($lat, $lon), 
					// Nous définissons le zoom par défaut
					zoom: 11, 
					// Nous définissons le type de carte (ici carte routière)
					mapTypeId: google.maps.MapTypeId.ROADMAP, 
					// Nous activons les options de contrôle de la carte (plan, satellite...)
					mapTypeControl: true,
					// Nous désactivons la roulette de souris
					scrollwheel: false, 
					mapTypeControlOptions: {
					// Cette option sert à définir comment les options se placent
						style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR 
					},
					// Activation des options de navigation dans la carte (zoom...)
					navigationControl: true, 
					navigationControlOptions: {
					// Comment ces options doivent-elles s'afficher
						style: google.maps.NavigationControlStyle.ZOOM_PAN 
					}
				});
				var marker = new google.maps.Marker({
	// Nous définissons sa position (syntaxe json)
	position: {lat: $lat, lng: $lon},
	// Nous définissons à quelle carte il est ajouté
	map: map
});
			} 

/* la fonction masquerafficher pour masquer/afficher le resumé des catégories dans la page d'accueil qui prend en param le lien et un id*/

function masquerafficher($lien, $id) { 
  var $div = document.getElementById($id); // On récupère le div ciblé grâce à l'id
  if($div.style.display=="none") { // Si le div est masqué
    $div.style.display = "block"; // on l'affiche
    $lien.innerHTML = "Masquer résumé"; //  on change le lien "afficher le résumé" par "masquer résumé"
  } else { // S'il est visible
    $div.style.display = "none"; // on le masque
    $lien.innerHTML = "Afficher résumé"; // on change le lien "masquer le résumé" par "afficher résumé"
  }
}

/*code qui récupère la largeur de la fenetre de l'internante*/
function larg(){
 if (document.body)
 {var $larg = (document.body.clientWidth);}
else
{var $larg = (window.innerWidth);}
document.getElementById("largeur").innerHTML ="largeur de la page:"+$larg +"px";}
 
 /*code qui affiche dernière mise à jour du fichier*/
function maj(){
 var $derniereModif=document.lastModified; 
        var $dateModif = new Date($derniereModif); 
        var $jour = $dateModif.getDate(); 
        var $mois=($dateModif.getMonth())+1; 
        var $annee=$dateModif.getFullYear(); 
        var $heures=$dateModif.getHours(); 
        var $minutes=$dateModif.getMinutes(); 
		if ($jour<10){$jour='0'+$jour;}
        if ($mois<10){$mois='0'+$mois;}
        if ($annee<10){$annee='0'+$annee;}
        if ($heures<10){$heures='0'+$heures;}
        if ($minutes<10){$minutes='0'+$minutes;}
        
document.getElementById("maj").innerHTML="MAJ "+$jour+"/"+$mois+"/"+$annee+" à "+$heures+"h"+$minutes;}


function captcha(champ){
var $sum =champ.value;
 if(Number.parseInt($sum) != $reponse[$rand]) {
	 document.getElementById('erreuranswer').innerHTML="Désolé , votre calcul est incorrect!!";
	 document.getElementById('erreuranswer').style.color="#FF0000";
	 document.getElementById('answer').style.background="#FFCCCC";

 return false;
  }
  
   else {document.getElementById('erreuranswer').innerHTML = "";
document.getElementById('answer').style.border="3px solid green"; }} /* effacer message erreur + bordure en vert si la saisie est ok*/
 






























