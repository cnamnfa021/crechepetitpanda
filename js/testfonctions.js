function test() {
// Controle la validité des chaînes de caractères entrés dans les champs du formulaire
  var caractere_name = document.getElementById("nom_prenom").value;
  var caractere_message = document.getElementById("message").value;
  var caractere_tel = document.getElementById("telephone").value;
  var adresse_mail = document.getElementById("mail").value;

//Les variables suivantes auront une valeur de -1 si les caractères indiqués sont absents des champs concernés.
  var m = caractere_name.search( "<|>|{|}|%" );
  var n = caractere_message.search( "<|>|{|}|%" );
  var o = adresse_mail.search( "<|>|{|}|%" );
  var p = caractere_tel.search( "<|>|{|}|%" );

  var boolname = false;
  var boolmessage = false;

//si les variables m, n, o, p...ne sont pas = -1, alors les caractères interdits sont présents (et le résultat est false).
  if(m != "-1"){
    boolname = false;
    return boolname;
  }
  else{
    boolname = true;
    return boolname;
  }

  if(n != "-1"){
    boolmessage = false;
    return boolmessage;
  }
  else{
    boolmessage = true;
    return boolmessage;
  }

  if(boolmessage && boolname){
    alert("Veuillez remplir correctement tous les champs");
  else{
    alert("ok");
  }

}