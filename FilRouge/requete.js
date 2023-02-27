document
  .getElementById("commentaire2")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    var data = new FormData(this);
    var xhr = new XMLHttpRequest();

    const form = document.getElementById("commentaires");

    form.value = "";

    xhr.open("POST", "AjoutCommentaire.php", true);
    console.log(data);

    xhr.responseType = "json";
    xhr.send(data);

    alert("Le commentaire a bien été ajouté");

    commentaire(data);
    return false;
  });

console.log(Utilisateur1);
function commentaire(data) {
  const sectionCom = document.getElementById("test");
  console.log(document);

  let div = sectionCom;
  i++;
  div.innerHTML +=
    "<section id='sec" +
    i +
    "' ><h3>" +
    data.getAll("id_Livre")[0] +
    "</h3><br/>Note :" +
    data.getAll("note")[0] +
    "<br/>Commentaire :" +
    data.getAll("commentaires")[0] +
    "<br/>Utilisateur :" +
    Utilisateur1 +
    " <br/><button id='btn" +
    i +
    "'>Supprimer le commentaire</button></section>";
}

function deleted(id) {
  const sectionCom = document.getElementById("sec" + id);
  sectionCom.innerHTML = "";

  var xhr = new XMLHttpRequest();

  let commentaire = {
    id_commentaire: id,
  };

  commentaire = JSON.stringify(commentaire);

  let url = "SupprimerCommentaire.php?id="+id;
  xhr.open("DELETE", url, true);
  xhr.responseType = "json";

  console.log(url);
  xhr.send(commentaire);
  alert("Le commentaire a bien été supprimé");
  return false;
}
