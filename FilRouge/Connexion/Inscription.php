<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <title>Accueil</title>
    <link rel="stylesheet" href="../Auteurs.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <header>

        <figure> <img src="../Photo/livre.webp" alt="logo" /></figure>
        
        <div class="header">
        <h1>Livre pas cher</h1>
        <nav class="menu1">
            <ul>
                <li><a href="../Accueil.php">Accueil</a></li>
                <li><a href="../Auteurs.php">Auteurs</a></li>
                <li><a href="../Livres.php">Livres</a></li>
                <li><a href="../Commentaire.php">Commentaire</a></li>
            </ul>
            
        </nav>
        </div>
        <section class="headersection">
        <?php session_start();
                if (!empty($_SESSION['user']['pseudo'])) {
                    echo "Bonjour: {$_SESSION['user']['pseudo']} ";
                    echo'<p><a href="ConnexionClient.php">Se déconnecter.<a></p> ';
                }else{
                    echo"Vous n'êtes pas connecté.";
                    echo'<p><a href="ConnexionClient.php">Se connecter.<a></p> ';
                    echo'<p><a href="Inscription.php">S\'inscrire.<a></p>';
                }
            ?>
   
        </section>


    </header>

    <main>
       

        <section>

            <h1> Inscription </h1>
            <form method="post" action="InscriptionTraitement.php">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo"> </br>

                <label for="email">Email</label>
                <input type="text" name="email"> </br>

                <label for="password">Mot de Passe</label>
                <input type="password" name="password"> </br>

                <label for="password2">Répéter Mot de Passe</label>
                <input type="password" name="password2"> </br>

                <button type="submit">M'inscrire</button>


            </form>

        </section>
        <main>
            <?php include('../<footer>.php'); ?>

</body>