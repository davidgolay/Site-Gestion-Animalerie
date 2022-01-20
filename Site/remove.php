<?php

    require_once ('Classes/AnimauxManager.php');
    require_once ('Database/connect.php');
    require_once ('Classes/VueAnimal.php');
    require_once ('Classes/Animal.php');

    $message = '';

    //si des ids sont passés dans l'url
    if(isset($_GET['ids']))
    {
        $ids = explode(",", $_GET['ids']); //séparation des ids passés en paramètre
        
        //Gestion du texte à afficher
        if(count($ids) > 1){
            $message = 'Etes-vous sûr de vouloir supprimer ces animaux ?';
        } else {
            $message = 'Etes-vous sûr de vouloir supprimer cet animal ?';
        }

        //pour tout les ID récupérés, on récupère les animaux pour pouvoir les afficher,
        foreach($ids as $id){

            $manager = new AnimauxManager($db);
            $animal  = $manager->get($id);
            $listAnimals[] = $animal;
            $conditions = (isset($_POST['submit']));
    
            // si les conditions sont réunis (bouton cliqué), on les supprime
            if($conditions){
                //mise à jour de la bdd;
                try{
                    $manager->delete($animal);
                    header('location: index.php');
                } catch (Exception $ExceptionMAJ){
                    $message = 'Oups, la suppression a échouée!';
                }       
            }
        }

    } else {
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Style/general.css" rel="stylesheet">
    <link href="Style/form-animal.css" rel="stylesheet">
    <link href="Style/table.css" rel="stylesheet">
    <title>Modification d'un Animal</title>
</head>
<body>
    <div class="super-container">
        <div class="container">
            <div class="title">Suppression</div>
            <div class="message"> <?php echo $message; ?> </div>
                <?php
                    $vueAnimal = new VueAnimal($listAnimals);
                    $vueAnimal->setEditable(false);
                    echo $vueAnimal->AnimalsTable();
                ?>
            <form method="post" action="#">
                <div class="left-button">
                    <button type="submit" name="submit">Supprimer</button>
                </div>
            </form>
            <div>
                <a href="index.php">retournez à l'acceuil</a>
            </div>
        </div>
    </div>
</body>
</html>