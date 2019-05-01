window.onload = function() {
    var $page = document.getElementById('page').value;
    if ($page =="contact.html") {
        initMap();questionaleatoire();
    }
   if ($page =="journee-type-de-lenfant.html") {
        maj(); larg();
    }
}
/*fonction qui controle les champs de formulaire*/

function controle(){

 var $maregex1 =/[0-9]/;
 var $maregex2=/[a-zA-Z]/;
 var $maregex4=/[{}%]/;
 var $maregex5=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
 
 if(document.formulaire.nom.value.match($maregex1)){
  document.getElementById('majuscule').innerHTML="pas de chiffre svp";
  document.formulaire.tel.focus();
  document.getElementById('majuscule').style.color="#FF0000";
  document.getElementById('nom').style.background="#FFCCCC";
 return false;
 }
 else {document.getElementById('majuscule').innerHTML = "";
 document.getElementById('nom').style.border="3px solid green";
 } /* effacer message erreur + bordure en vert si la saisie est ok*/
 
 if(document.formulaire.tel.value.match($maregex2)){
  document.getElementById('numero').innerHTML="pas de lettre svp";
  document.formulaire.tel.focus();
  document.getElementById('numero').style.color="#FF0000";
  document.getElementById('tel').style.background="#FFCCCC";

 return false;
 }
  else {document.getElementById('numero').innerHTML = "";
 document.getElementById('tel').style.border="3px solid green";
 } /* effacer message erreur + bordure en vert si la saisie est ok*/
 
   
 if(!document.formulaire.email.value.match($maregex5)){
	
  document.getElementById('mail').innerHTML="synthaxe incorrecte";
  document.formulaire.tel.focus();
  document.getElementById('mail').style.color="#FF0000";
  document.getElementById('email').style.background="#FFCCCC";
 return false;
 }
  else {document.getElementById('mail').innerHTML = "";
 document.getElementById('email').style.border="3px solid green";
 } /* effacer message erreur + bordure en vert si la saisie est ok*/
 
 
 if(document.formulaire.commentaire.value.match($maregex4)){
  document.getElementById('msg').innerHTML="pas de symboles suivant:{}% svp ";
  document.formulaire.commentaire.focus();
  document.getElementById('msg').style.color="#FF0000";
  document.getElementById('commentaire').style.background="#FFCCCC";

 return false;
 }
  else {document.getElementById('msg').innerHTML = "";
 document.getElementById('commentaire').style.border="3px solid green";
 } /* effacer message erreur + bordure en vert si la saisie est ok*/
 
 
 var $sum = document.getElementById('answer').value;
 if(Number.parseInt($sum) != $reponse[$rand]) {
	 document.getElementById('erreuranswer').innerHTML="Désolé , votre calcul est incorrect!!";
	 document.getElementById('erreuranswer').style.color="#FF0000";
	 document.getElementById('answer').style.background="#FFCCCC";

 return false;
  }
  
   else {document.getElementById('erreuranswer').innerHTML = "";
 document.getElementById('answer').style.border="3px solid green";
 } /* effacer message erreur + bordure en vert si la saisie est ok*/
 
}
 
 


/* fonction qui transformr le nom et prénom en majuscule*/

function modifier($saisie) {$saisie.value=$saisie.value.toUpperCase();}

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
   
/*fonction date soumission du formulaire affiché dans page de reception */
function soumission(){
 
        var $dateModif = new Date(); 
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
        
document.getElementById("soumi").value="Date et heure de la soumission du formulaire:"+$jour+"/"+$mois+"/"+$annee+" à "+$heures+"h"+$minutes;}

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
			








