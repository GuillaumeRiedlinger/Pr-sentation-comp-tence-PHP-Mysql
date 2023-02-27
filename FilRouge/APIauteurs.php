<?php
//première API 


include('IdentifiantDB.php');

if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int)strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}


$db = new PDO("mysql:host=$hote; dbname=$nomdb;charset=utf8", $user, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$array = $db->query('SELECT * FROM Auteur');
$genre = $db->prepare('SELECT * FROM Genre INNER JOIN Auteur_Genre ON Auteur_Genre.id_Genre = Genre.id_genre INNER JOIN Auteur ON id_Auteur = Auteur.id WHERE Auteur.id = :id');
$auteursListe = $array->fetchAll();


//On détermine le nombre d'&rticle total
$sql = 'SELECT COUNT(*) AS nb_auteurs FROM Auteur';

$query =$db->prepare($sql);
$query->execute();

//On récupère le nombre d'article
$result = $query->fetch();

$nbAuteurs = (int) $result['nb_auteurs'];

//Nombre d'aricle par Page
$parPage = 3;

//Calcul du nombre de page total, ceil func pour arrrondir au supp
$pages = ceil($nbAuteurs / $parPage);

//Calcul du premoère article de la page
$premier = ($currentPage * $parPage) - $parPage;

$array = 'SELECT * FROM Auteur ORDER BY id  LIMIT :premier, :parpage';
$query = $db->prepare($array);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$query->execute(); 
$auteurs = $query->fetchAll();


echo '<nav> 
<ul class="pagination">';
for($page = 1; $page <= $pages; $page++):
echo '<li class="page-item" ($currentPage =$page) ? "active":><a class="page-link" href="http://localhost/FilRouge/Auteurs.php?page='.$page.'" >'.$page.'</a></li>';
endfor;
//              <li class="page-item"><a class="page-link" href="http://localhost/FilsRouge/Auteurs.php?page=2">2</a></li>
//              <li class="page-item"><a class="page-link" href="http://localhost/FilsRouge/Auteurs.php?page=3">3</a></li>
echo'      </ul> 
</nav>';

// echo '<div class="tous">

//         <div class="menu">
//             <h2>Liste des Auteurs</h2>
//             <nav class="menu2">
//                 <ul classe="menu2">';

// foreach ($auteursListe as $auteurListe) {
//     echo '<li><a href="#A' . $auteurListe['id'] . '">' . $auteurListe['nom'] . ' ' . $auteurListe['prenom'] . '</a></li>';
// }
// echo '   
//                 </ul>
//             </nav>
//         </div> ';
echo '<article><h1>Les Auteurs</h1>';

foreach ($auteurs as $auteur) {
    echo '<section>';
    echo '<h2 id="A' . strip_tags($auteur['id']) . '">' . strip_tags($auteur['nom']) . '</h1>';
    echo '<figure class="photo">
            <img src="' . strip_tags($auteur['photo']) . '" alt="Honoré de Balzac" />
                </figure>';
    echo '<p>Nom: ' . strip_tags($auteur['nom']) . '<br/><br/>';
    echo 'Prenom: ' . strip_tags($auteur['prenom']) . '<br/><br/>';
    echo 'Date de Naissance: ' . strip_tags($auteur['naissance']) . '<br/><br/>';
    echo 'Date de Mort: ' . strip_tags($auteur['mort']) . '<br/><br/>Biographie ';
    echo '<aside class="bio">' . strip_tags($auteur['biographie']) . '</aside>';

    
    echo '<aside>Genre:</Aside><ul>';
   
    $genre->execute([
        'id' => $auteur['id']
    ]);


    foreach ($genre as $genres) {
        echo '<li>' . strip_tags($genres['genre']) . '</li>';
    }

    echo '</ul>';

    echo '<div id="hidden' . strip_tags($auteur['id']) . '" class="hidden"><p>Pas de livre de cette auteur disponible dans notre boutique.</p></div>';


    echo '<button id="btn' . strip_tags($auteur['id']) . '" onclick=visibleDiv(' . $auteur['id'] . ') >Livre de l\'auteur</button>';
    echo '</section>';
}
echo '<nav> 
        <ul class="pagination">';
for($page = 1; $page <= $pages; $page++):
    echo '<li class="page-item" ($currentPage =$page) ? "active":><a class="page-link" href="http://localhost/FilRouge/Auteurs.php?page='.$page.'" >'.$page.'</a></li>';
endfor;
//              <li class="page-item"><a class="page-link" href="http://localhost/FilsRouge/Auteurs.php?page=2">2</a></li>
//              <li class="page-item"><a class="page-link" href="http://localhost/FilsRouge/Auteurs.php?page=3">3</a></li>
  echo'      </ul> 
    </nav>';
echo '</article></div>';

?>
