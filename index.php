<?php

    require_once 'init.php';
    
    $name = "";
    $message ="";


    if($_SERVER["REQUEST_METHOD"] == "POST") // On vérifie si des données ont été envoyées (submit) via le formulaire
    {
        $name = verifyInput($_POST["name"]); // protection contre les intrusions (voir dans init.php)
        if (empty($name)) // si la variable est vide
        {
            $message = '<div class="red">Tu vas avoir des soucis si ton nouveau compagnon n\'a pas de nom !</div>';
        }
        else {
            $results = $database->query("INSERT INTO argonautes(name) VALUES ('$_POST[name]')"); // avec la méthode query de l'objet $database, on entre en contact avec la BDD pour insérer (INSERT INTO) dans la table "argonautes la nouvelle valeur (VALUES) entrée dans le formulaire ($_POST[name])
            $message = '<div class="green">Bravo, tu as un compagnon de plus !</div>';
        }
    }

    $show_argonautes = $database->query('SELECT name FROM argonautes'); // avec la méthode query de l'objet $database, on sélectionne (SELECT) le champ name de la table argonautes (FROM argonautes)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> 

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <!-- Header section -->
    <header>
        <h1>
            <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
            Les Argonautes
        </h1>
    </header>

    <!-- Main section -->
    <main class="container-fluid">
    
    <!-- New member form -->
    <h2>Ajouter un(e) Argonaute</h2>
    <form class="new-member-form " method="post">
        <label for="name" style="color:white;">Nom de l&apos;Argonaute</label>
        <!-- <input id="name" name="name" type="text" placeholder="Le prochain moussaillon" />
        <input class="btn btn-dark" type="submit" value="Envoyer" /> -->

        <input id="name" name="name" type="text" class="form-control" placeholder="Le prochain moussaillon" >
        <div class="input-group-append">
            <input class="btn btn-dark  w-100" type="submit" value="Envoyer" />
        </div>
        <?php echo $message; ?>
    </form>
    
    <!-- Member list -->
    <h2>Membres de l'équipage</h2>
    <section class="member-list">
        
            <div class="row">
                <?php
                    while ($nakama = $show_argonautes->fetch()){ // fetch() va chercher la ligne de résultat suivante à chaque tour de while, et en fait un tableau associatif. Les indices de ce tableau correspondent aux noms des champs de notre requête SQL. La boucle while fait avancer le "curseur" dans $nakama à chaque tour, et s'arrête quand le curseur a atteint le dernier résultat. 
                        echo '<div class="member-item col-4" style="text-align:center; color:white;">' . $nakama['name'] . '</div>';
                    }
                
                ?>
            </div>
    </section>
    </main>

    <footer class="container-fluid">
        <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
    </footer>
</body>
</html>