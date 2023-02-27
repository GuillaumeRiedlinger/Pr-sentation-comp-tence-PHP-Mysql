<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Accueil</title>
    <link rel="stylesheet" href="Auteurs.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php  session_start();
     include('<header>.php');?>

    <main>
        <section>
             <h2>Bonjour et bienvenu sur Livre Pas Cher!</h2> <p>
            Sur ce site vous trouverez tous les livres qui vous feront envie parmi notre vaste choix de 14 livres sélectionés 
                par nos soins spécialement pour vous.<br/>
                Afin de pouvoir dépenser votre argent sur notre site n'hésitez pas à vous connecter ou à vous inscrire si cela n'est pas déjà fait!
            </p>
            <p><a href="Connexion/ConnexionClient.php">Se connecter.</a></p> 
            <p><a href="Connexion/Inscription.php">S'inscrire.</a></p>
        </section>    



    </main>

    <?php include('<footer>.php'); ?>

</body>