<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
        <link href="style.css" rel="stylesheet" />
    </head>

    <body>    
        
        <form id=formulaire action="minichat_post.php" method="post">
            <p>
                <label for="pseudo">Pseudo</label><br />
                <input type="text" name="pseudo" id="pseudo" /><br />
                <label for="message">Message</label><br />
                <input type="text" name="message" id="message" /><br />
                <input type="submit" value="Envoyer" />
            </p>
        </form>
        

        <?php

            // Connexion à la base de données

            try{
                $bdd = new PDO('mysql:host=localhost;dbname=base_chat;charset=utf8', 'root', '');
            }

            catch(Exception $e){
                    die('Erreur : '.$e->getMessage());
            }


            // Récupération des 10 derniers messages

            $reponse = $bdd->query('SELECT pseudo, message FROM chat ORDER BY ID DESC LIMIT 0, 10');


            // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)

            while ($donnees = $reponse->fetch()){
                echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
            }


            $reponse->closeCursor();


        ?>

    </body>

</html>