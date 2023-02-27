<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <title>Panier</title>
    <link rel="stylesheet" href="Auteurs.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php session_start();
    include('<header>.php'); 
    $i = 0 ;
    ?>

    <main>
        <?php include('IdentifiantDB.php');

        $db = new PDO("mysql:host=$hote; dbname=$nomdb;charset=utf8", $user, $password);
        $livres = $db->query('SELECT * FROM Livre');

        echo '<section>';

        if (!empty($_SESSION['user']['pseudo'])){
        if ($_SESSION['user']['pseudo'] === 'Admin') {

            echo '<a href="resetBDD.php"> <button> Reset de la base de donnée </button></a>';
        }}

        if (!empty($_SESSION['user']['pseudo'])) {
            echo '<form method="POST" id="commentaire2">'; //action="AjoutCommentaire.php">';
            echo  '<p>';

            echo '<label for="id_Livre">Choix du Livre </label>';
            echo '<select name="id_Livre" id="id_Livre">';
            foreach ($livres as $livre) {
                echo '<option value="' . $livre['titre'] . '">' . $livre['titre'] . '</option>';
            };
            echo '</select></br>';
            echo '<label for="note">Note du Livre sur 5 </label>';
            echo '<select id="note" name="note">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                   </select><br/>';
            echo '<label for="commentaires">Commentaire </label>';
            echo "<input type='text' name='commentaires' id='commentaires' /></br>";
            echo '<input type="submit" type="reset" name="submit" value="Envoyer les données">';
            echo '</form>';
        } else {
            echo "Vous devez vous connecter pour pouvoir laisser un commentaires sur un livre.";
        }
        ?>
        </section>
                
        <section id='test'>
                 <?php 
                  
                     
                     $commentaire3 = $db->query('SELECT * FROM Commentaire');
                        foreach($commentaire3 as $commentaire4)
                        {   
                            $i ++;
                            echo '<div id="sec'.$commentaire4['id_commentaire'].'"><section>';
                            echo '<h3 >'.strip_tags($commentaire4['titre_Livre']).'</h3>';
                            echo '<br/>Note :'.strip_tags($commentaire4['note']);
                            echo '<br/>Commentaire :'.strip_tags($commentaire4['commentaire']);
                            echo '<br/>Utilisateur :'.strip_tags($commentaire4['utilisateur']);
                            echo '<br/><button id="btn'.$commentaire4['id_commentaire'].'"onclick=deleted(' . $commentaire4['id_commentaire'] . ')> Supprimer le commentaire </button>';
                    
                    
                            echo '</section></div>';
                        }
                    
              
                    
                ?>
        </section>

        <a id="remonter" href="#top"><img src="Photo/top.png" alt="Flèche vers le haut"></a>

    </main>

    <?php include('<footer>.php'); ?>

    <script>
    var Utilisateur1 = "<?php echo $_SESSION['user']['pseudo']; ?>";
    var i = "<?php echo $i; ?>";
    </script>

    <script src=requete.js></script>
</body>