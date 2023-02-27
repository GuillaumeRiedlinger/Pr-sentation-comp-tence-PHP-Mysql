<?php



include('../IdentifiantDB.php');

try {
    $db = new PDO("mysql:host=$hote; dbname=$nomdb; charset=utf8", $user, $password);
    $retour["success"] = true;
    $retour["message"] = "Connexion à la base de donnée réussi";
} catch (PDOException $e) {
    $retour["success"] = false;
    $retour["message"] = "Connexion à la base de donnée impossible";
}

$password = strip_tags($_POST['password']);
$pseudo = strip_tags($_POST['pseudo']);


if (!empty($password) && !empty($pseudo)) {

    $requete = $db->prepare("SELECT * FROM Utilisateur WHERE pseudo = :pseudo");
    $requete->bindValue(":pseudo", $pseudo);
    $requete-> execute();

    $utilisateur = $requete->fetch();

    if($password === $utilisateur['mdp']){

        session_start();

        $_SESSION["user"] = [
            "pseudo" => $utilisateur['pseudo'],
            "email" => $utilisateur['email']
        ];


        header('location: ../Accueil.php');
    }else{
        die("L'utilisateur et ou le mot de passe est incorecte");
    }
    
} else {

    die("Les données de connexions sont erronées");
}

?>