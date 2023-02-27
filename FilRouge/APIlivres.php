<?php 

$curl = curl_init('https://filrouge.uha4point0.fr/V2/livres/livres');

curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

$data =curl_exec($curl); 


if($data === false){
    var_dump(curl_error($curl));
}
else{
 $data= json_decode($data,true);


        echo '<div class="tous">

        <div class="menu">
            <h2>Liste des Livres</h2>
            <nav class="menu2">
                <ul classe="menu2">';

             foreach($data as $valeur){
                  echo '<li><a href="#B'.strip_tags($valeur['id']).'">'.strip_tags($valeur['titre']).'</a></li>';
                }
                echo '   
                </ul>
            </nav>
        </div> ';
     
    echo '<article><h1>Les Livres</h1>';

    foreach($data as $valeur)
    {   

        echo '<section>';
        echo '<h2 id="B'.strip_tags($valeur['id']).'">'.strip_tags($valeur['titre']).'</h1>';
        echo '<p>Date de sortie: '.strip_tags($valeur['sorti']).'<br/><br/></p>';
        echo '<aside class=\'bio\'>'.strip_tags($valeur['synopsis']).'</aside>';
        echo '<p>Auteur: '.strip_tags($valeur['auteur']).'<br/><br/>';
        echo 'Nombre de pages: '.strip_tags($valeur['pages']).'<br/><br/>';
        echo 'Prix du livre: '.strip_tags($valeur['prix']).' €</p>';



        echo '</section>';
    }

     echo '</article></div>';
}
curl_close($curl);
?>