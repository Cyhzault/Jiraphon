
$(document).ready(function() {
    $('#nom_u').autocomplete({
       source: function(request, response) {
       $.getJSON("req_equipe.php", { equipe: true, term: request.term }, 
              response);
        },
       messages: {
        noResults: '',
        results: function() {}
      }
    });

    document.getElementsByName('liste_membre').value='';
});

function ValidUti()
{

  $.ajax({
    url : 'req_equipe.php',
    data: { "nom": $('#nom_u').val(),
            "prenom": $('#prenom_u').val()},         
     
    success : function(data)
    {
      var tab=JSON.parse(data);
      console.log(tab);
      if(tab['html']!='')
      {

        if(document.getElementById('membres').style.display='none')
            document.getElementById('membres').style.display='block';

        //Affichage membre
        Div = document.createElement("div");
        Div.setAttribute("name","crea_users");
        Div.innerHTML = tab['html'];
        document.getElementById('membres').appendChild(Div);

        //Stockage membre
        var elements= document.getElementsByName('liste_membre');
        var old_value=elements[0].value;
        elements[0].value=old_value+tab['id_utilisateur']+",";

      }
    },
    error: function(data) {console.log(data);}
  });

  document.getElementById('nom_u').value='';
  document.getElementById('prenom_u').value='';
  document.getElementById('utilisateur_form').style.display='none';

}

function ValidationNom()
{
  oSelect = document.getElementById('prenom_u'),
  opts = oSelect.getElementsByTagName('option');
  while(opts[1]) {
    oSelect.removeChild(opts[1]);
  }
  //Récupération des données
  $.ajax({
    url : 'req_equipe.php',
    data: {term: $('#nom_u').val()},
    dataType : "json", 
    success : function(data)
    {
      for(var i in data)
      {
        var select = document.getElementById("prenom_u");
        select.options[select.options.length] = new Option (data[i], data[i]);
      } 
    }
  });
}

function AjoutUtilisateur()
{
    document.getElementById('utilisateur_form').style.display='block';
}

function Showinformations(id) 
{
    document.getElementById("image"+id).style.opacity = "0.2"; 
    document.getElementById(id).style.visibility= "visible";
}

function Hideinformations(id)
{
  document.getElementById("image"+id).style.opacity =  "1";
  document.getElementById(id).style.visibility= "hidden";
  
}
