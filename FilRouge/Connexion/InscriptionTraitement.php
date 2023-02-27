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
$password2 = strip_tags($_POST['password2']);
$password = strip_tags($_POST['password']);
$email = strip_tags($_POST['email']);
$pseudo = strip_tags($_POST['pseudo']);

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("L'adresse email est incorrecte");
}

if (!empty($password) && !empty($password2) && !empty($email) && !empty($pseudo)) {
    if ($password === $password2) {

        $requete = $db->prepare("INSERT INTO Utilisateur (pseudo, mdp, email) VALUES (:pseudo, :mdp, :email)");
        $requete->execute([

            ':pseudo' => $pseudo,
            ':mdp' => $password,
            ':email' => $email,

        ]);

        session_start();
        unset($_SESSION['user']);
        $_SESSION["user"] = [
            "pseudo" => $pseudo,
            "email" => $email,
        ];


        header('location: ../Accueil.php');

    } else {

        die("Les mots de passes ne sont pas identiquent.");
    }
} else {

    die("Il manque des données pour finalisé l'inscrption");
}

?>