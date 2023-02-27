<?php
session_start();
 include('IdentifiantDB.php');

try {
    $db = new PDO("mysql:host=$hote;charset=utf8", $user, $password);

    $sql = "DROP DATABASE IF EXISTS $nomdb";
    $query = $db->prepare($sql);
    $query->execute();
    


    $sql = "CREATE DATABASE IF NOT EXISTS $nomdb";
    $query = $db->prepare($sql);
    $query->execute();

} catch (PDOException $e) {
    $db = new PDO("mysql:host=$hote;charset=utf8", $user, $password);


    $sql = "CREATE DATABASE IF NOT EXISTS $nomdb";
    $query = $db->prepare($sql);
    $query->execute();

    // print "Erreur !: " . $e->getMessage() . "<br/>";
    // die();
}





$curl = curl_init('https://filrouge.uha4point0.fr/V2/livres/auteurs');

curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

$auteurs = curl_exec($curl); 

if($auteurs === false){
    var_dump(curl_errno($curl));
}
else{
 $auteurs= json_decode($auteurs,true);
 curl_close($curl);

 try {

    $db = new PDO("mysql:host=$hote; dbname=$nomdb;charset=utf8", $user, $password);

    // Création de la base de données



    $sql = "CREATE TABLE Auteur (
        id int NOT NULL AUTO_INCREMENT,
        nom varchar(255) NOT NULL,
        prenom varchar(255) NOT NULL,
        naissance varchar(255) NOT NULL,
        mort varchar(255) NOT NULL, 
        biographie text NOT NULL, 
        photo varchar(255) NOT NULL,
        PRIMARY KEY (id))";
    $query = $db->prepare($sql);
    $query->execute();


    $sql = "CREATE TABLE Genre (
        id_genre int  NOT NULL AUTO_INCREMENT,
        genre varchar(255) NOT NULL UNIQUE,
        PRIMARY KEY (id_genre))";
    $query = $db->prepare($sql);
    $query->execute();

    $sql = "CREATE TABLE Auteur_Genre (
        id_Auteur int NOT NULL ,
        id_Genre int NOT NULL,
        PRIMARY KEY (id_Genre,id_Auteur),
        FOREIGN KEY(id_Auteur) REFERENCES Auteur (id),
        FOREIGN KEY(id_Genre) REFERENCES Genre (id_genre))";
    $query = $db->prepare($sql);
    $query->execute();



    $genre_tab = array();


    foreach ($auteurs as $auteur) {
        $nom = strip_tags($auteur['nom']);
        $prenom = strip_tags($auteur['prenom']);
        $naissance = strip_tags($auteur['naissance']);
        $mort = strip_tags($auteur['mort']);
        $biographie = strip_tags($auteur['biographie']);
        $photo = strip_tags($auteur['photo']);
        $genres = ($auteur['genres']);

        //écriture de la requête
        $sqlQuery = "INSERT INTO Auteur(nom, prenom, naissance, mort, biographie, photo) VALUES(:nom, :prenom, :naissance, :mort, :biographie, :photo)";

        //préparation
        $livresStatement = $db->prepare($sqlQuery);
        $livresStatement->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'naissance' => $naissance,
            'mort' => $mort,
            'biographie' => $biographie,
            'photo' => $photo,
        ]);

        
        foreach($genres as $genre){

            $genre = strip_tags($genre);

            if (!in_array($genre,$genre_tab)){
                array_push($genre_tab,$genre);
                $sqlQuery = "INSERT INTO Genre(genre) VALUES(:genre)";

                
                //préparation
                $livresStatement = $db->prepare($sqlQuery);
                $livresStatement->execute([
                'genre' => $genre,]);
            }

            $insert_genre = $db -> prepare ("SELECT id_genre FROM Genre WHERE genre = :genre");
            $insert_genre ->execute([
              ':genre'=> $genre
            ]);
            $insert = $db ->prepare("INSERT INTO Auteur_Genre (id_Auteur, id_Genre) VALUES (:id_Auteur,:id_Genre) ");
            $insert -> execute([
             ':id_Auteur' => $auteur['id'],
             ':id_Genre' => $insert_genre ->fetch()['id_genre']
            ]);
            $insert -> closeCursor();
         }
        
       

       
    }
    
} catch (PDOException $e) {
     print "Erreur !: " . $e->getMessage() . "<br/>";
     die();
 }

$curl = curl_init('https://filrouge.uha4point0.fr/V2/livres/livres');

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$Livres = curl_exec($curl);
if ($Livres === false) {
    var_dump(curl_error($curl));
} else {
    $Livres = json_decode($Livres, true);


    try {

        $db = new PDO("mysql:host=$hote; dbname=$nomdb;charset=utf8", $user, $password);

        // Création de la base de données



        $sql = "CREATE TABLE Livre (
            id int NOT NULL AUTO_INCREMENT,
            titre varchar(255) NOT NULL UNIQUE,
            sorti int(11) NOT NULL,
            synopsis text NOT NULL, 
            auteur int(11) NOT NULL, 
            pages int(11) NOT NULL,
            prix int(11) NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (auteur) REFERENCES Auteur (id))";
        $query = $db->prepare($sql);
        $query->execute();


        foreach ($Livres as $Livre) {
            $titre = strip_tags($Livre['titre']);
            $sorti = strip_tags($Livre['sorti']);
            $synopsis = strip_tags($Livre['synopsis']);
            $auteurL = strip_tags($Livre['auteur']);
            $pages = strip_tags($Livre['pages']);
            $prix = strip_tags($Livre['prix']);


            //écriture de la requête
            $sqlQuery = "INSERT INTO Livre(titre, sorti, synopsis, auteur, pages, prix) VALUES(:titre, :sorti, :synopsis, :auteur, :pages, :prix)";

            //préparation
            $livresStatement = $db->prepare($sqlQuery);
            $livresStatement->execute([
                'titre' => $titre,
                'sorti' => $sorti,
                'synopsis' => $synopsis,
                'auteur' => $auteurL,
                'pages' => $pages,
                'prix' => $prix,


            ]);

            /*$livres = $livresStatement->fetchAll();*/
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
curl_close($curl);

$sql = "CREATE TABLE `FilRouge`.`Utilisateur` 
    (`id` INT(11) NOT NULL AUTO_INCREMENT , 
    `pseudo` VARCHAR(255) NOT NULL , 
    `mdp` VARCHAR(255) NOT NULL , 
    `email` VARCHAR(255) NOT NULL , 
    PRIMARY KEY (`id`, `email`), 
    UNIQUE (`pseudo`)) ENGINE = InnoDB;";
$query = $db->prepare($sql);
$query->execute();

$sql = "CREATE TABLE Commentaire (
    titre_Livre varchar(255) NOT NULL ,
    note INT(11) NOT NULL ,
    commentaire TEXT NOT NULL ,
    utilisateur varchar(255) NOT NULL ,
    id_commentaire INT(11) NOT NULL AUTO_INCREMENT ,
    PRIMARY KEY (id_commentaire))";
$query = $db->prepare($sql);
$query->execute();

$sql = "ALTER TABLE `Commentaire` ADD FOREIGN KEY (`titre_Livre`) REFERENCES `Livre`(`titre`) ON DELETE RESTRICT ON UPDATE RESTRICT";
$query = $db->prepare($sql);
$query->execute();

$requete = $db->prepare("INSERT INTO Utilisateur (pseudo, mdp, email) VALUES ('Admin','Admin', 'Admin@Admin.fr')");
$requete->execute();
unset($_SESSION['user']);
}
header("location: Panier.php");
?>