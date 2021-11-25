<?php
    // Connexion à la BDD :
    $database = new PDO('mysql:host=localhost;dbname=help_jason', 'root', '');  
    
    function verifyInput($var){ // cette fonction va nous permettre de protéger le formulaire contre les intrusions

        $var = trim($var); // la fonction trim enlève tout les espaces,les tabulations,retour à la ligne de nos champs de formulaire
        $var = stripslashes($var); // la fonction stripslashes enlève tous les "\"
        $var = htmlspecialchars($var);  // la fonction htmlspecialschars empêche les intrusions avec des codes HTML nuisibles (faille XSS)

        return $var;
    }
?>