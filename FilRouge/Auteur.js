let div = "d";
let idAuteur = 8;
function visibleDiv(id) {

  const divtest = document.getElementById('hidden' + id);



  divtest.classList.toggle('hidden');
  idAuteur = id;
  div = divtest;
  div.innerHTML = "<p></p>"
  var url = "http://localhost/FilRouge/CreationAPILivre.php"

  $.get(url, callBackGetSuccess).done(function () {
    //alert( "second success" );
  })
    .fail(function () {
      alert("error");
    })
    .always(function () {
      //alert( "finished" );
    });
}
var callBackGetSuccess = function (data) {
  let livreEnStock = 0;

  data.forEach(Livre => {

    if (Livre.auteur == idAuteur) {
      div.innerHTML += "<section><h2 id='B" + Livre.id + "'>" + Livre.titre +
        "</h2><p>Date de sortie: " + Livre.sorti + "<br/><br/></p><aside class='bio'>" + Livre.synopsis +
        "</aside>Nombre de pages: " + Livre.pages + "<br/><br/>Prix du livre: " + Livre.prix + "€ </p></section>";
      livreEnStock = 1;
    }

  });

  if (livreEnStock == 0) { div.innerHTML += "<section><p>Pas de livres de cet auteur disponible.</p></section>"; }

};


