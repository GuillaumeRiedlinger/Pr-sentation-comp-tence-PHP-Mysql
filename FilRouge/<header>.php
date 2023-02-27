<header>
        
        <figure>    <img src="Photo/livre.webp" alt="logo"/></figure>
        <div class='header'>
        <h1>Livre pas cher</h1>
        <nav class="menu1">
            <ul>
                <li><a href="Accueil.php">Accueil</a></li>
                <li><a href="Auteurs.php?page=1">Auteurs</a></li>   
                <li><a href="Livres.php">Livres</a></li>
                <li><a href="Commentaire.php">Commentaire</a></li>
            </ul>
        </nav>
        </div>
        <section class="headersection">

            <?php 
                if (!empty($_SESSION['user']['pseudo'])) {
                    echo "Bonjour: {$_SESSION['user']['pseudo']} ";
                    echo'<p><a href="Connexion/Déconnexion.php">Se déconnecter.</a></p> ';
                }else{
                    echo"Vous n'êtes pas connecté.";
                    echo'<p><a href="Connexion/ConnexionClient.php">Se connecter.</a></p> ';
                    echo'<p><a href="Connexion/Inscription.php">S\'inscrire.</a></p>';
                }
            ?>
   
        </section>
 </header>

 