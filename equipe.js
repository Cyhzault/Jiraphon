
$(document).ready(function() {
    $('input[name=nom_u]').autocomplete({
       source: function(request, response) {
       $.getJSON("req_equipe.php", { equipe: true, nom_uti: request.term }, 
              response);
        },
       messages: {
        noResults: '',
        results: function() {}
      }
    });
    
});

function ValidUti(id_p)
{
  $.ajax({
    url : 'req_equipe.php',
    data: { "nom_valid": $('#nom_u'+id_p).val(),
            "prenom_valid": $('#prenom_u'+id_p).val()},         
     
    success : function(data)
    {

      var tab=JSON.parse(data);
      if(tab != '')
      {
        if(document.getElementById('membres'+id_p).style.display='none')
            document.getElementById('membres'+id_p).style.display='block';

        //Affichage membre
        Div = document.createElement("div");
        Div.setAttribute("name","crea_users");
        Div.innerHTML = tab['html'];
        document.getElementById('membres'+id_p).appendChild(Div);

        //Stockage membre
        var elements= document.getElementsByName('liste_membre'+id_p);
        var old_value=elements[0].value;
        elements[0].value=old_value+tab['id_utilisateur']+",";

        document.getElementById('utilisateur_form'+id_p).style.display='none';
        document.getElementById('erreur_uti'+id_p).style.display='none';
        
      }
      else
          document.getElementById('erreur_uti'+id_p).style.display='block';
    },
    error: function(data) {console.log("err"+data);}
  });

  document.getElementById('nom_u'+id_p).value='';
  document.getElementById('prenom_u'+id_p).value='';
  

}

function ValidEquipe(id_p)
{
  if(document.getElementById('equipes'+id_p).style.display='none')
      document.getElementById('equipes'+id_p).style.display='block';

  //Affichage equipes
  Div = document.createElement("div");
  Div.setAttribute("name","crea_equ");
  Div.innerHTML = $('#equipe_addm'+id_p).val();
  document.getElementById('equipes'+id_p).appendChild(Div);

  //Stockage equipe
  var elements= document.getElementsByName('liste_equipe'+id_p);
  var old_value=elements[0].value;
  elements[0].value=old_value+$('#equipe_addm'+id_p).val()+",";

}

function AddMembre(id_p)
{
   $.ajax({
    url : 'req_equipe.php',
    data: { "projet_id": $('#projet_addm'+id_p).val(),
            "liste_membre": $('#liste_membre'+id_p).val(),
            "liste_equipe": $('#liste_equipe'+id_p).val()},         
     
    success : function(data)
    {
      $('#modalCrea'+id_p).hide();
    },
     error: function(data) {console.log(data);}
  });
}

function ValidationNom(id_p)
{
  oSelect = document.getElementById('prenom_u'+id_p),
  opts = oSelect.getElementsByTagName('option');
  while(opts[1]) {
    oSelect.removeChild(opts[1]);
  }

  //Récupération des données
  $.ajax({
    url : 'req_equipe.php',
    data: {nom_u: $('#nom_u'+id_p).val()},
    dataType : "json", 
    success : function(data)
    {
      for(var i in data)
      {
        var select = document.getElementById("prenom_u"+id_p);
        select.options[select.options.length] = new Option (data[i], data[i]);
      } 
    }
  });
}

function AjoutUtilisateur(id_p)
{
    form=document.getElementById('utilisateur_form'+id_p);
    if(form.style.display=='none')
      form.style.display='block';
    else
      form.style.display='none';
}

function AjoutEquipe(id_p)
{
  form=document.getElementById('form_equipeadd'+id_p);
    if(form.style.display=='none')
      form.style.display='block';
    else
      form.style.display='none';
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
