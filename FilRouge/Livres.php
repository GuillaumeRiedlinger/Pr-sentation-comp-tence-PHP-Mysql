<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Livres</title>
    <link rel="stylesheet" href="Auteurs.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php session_start();
    include('<header>.php');?>

    <main>

    <?php include('APIlivres.php') ?>
        
    <a id="remonter" href="#top"><img src="Photo/top.png" alt="Flèche vers le haut"></a>

    </main>

    <?php include('<footer>.php'); ?>

</body>