<?php
    require_once ('Classes/Animal.php');
    require_once ('Classes/AnimauxManager.php');
    require_once ('listAnimals.php');

    $value_nom    = '';
    $value_espece = '';
    $value_cri    = '';
    $value_prop   = '';
    $value_age    = '';
    
    //Gestion des champs posté lors de la recherche
    if(isset($_POST['submit'])) {
        $value_nom    = htmlspecialchars($_POST['nom']);
        $value_espece = htmlspecialchars($_POST['espece']);
        $value_cri    = htmlspecialchars($_POST['cri']);
        $value_prop   = htmlspecialchars($_POST['proprietaire']);
        $value_age    = htmlspecialchars($_POST['age']);

        //affinage de la liste à afficher
        $vueAnimal = new VueAnimal($manager->getByFilters($_POST));
    }

    //Edition de l'url qui permet de supprimer les animaux repertoriés dans la liste
    $ids = '';
    $index = 0;
    $urlDelete = 'remove.php';

    //si il existe des animaux qui correspondent aux filtres de recherche
    if (!empty($manager->getByFilters($_POST)))
    {
        foreach ($manager->getByFilters($_POST) as $id) 
        {
            //concatènation des ID avec séparation par une virgule
            if($index > 0) { $ids .= ','; }
            $ids .= $id->id();
            $index++;
        }

        $urlDelete .= '?ids=' . $ids;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Style/table.css" rel="stylesheet">
    <link href="Style/general.css" rel="stylesheet">
    <link href="Style/form-animal.css" rel="stylesheet">
    <title>Page d'acceuil | Animalerie GOLAY</title>
</head>

<body>
    <div class="container">
        <div class="title">Rechercher un animal</div>
        <form method="post" action="index.php">
            <div class="animal-details">
                <div class="input-box">
                    <span class="details">Nom </span>
                    <input type="text" name="nom" value="<?php echo $value_nom; ?>" placeholder="Nom commençant par..."/>
                </div>
                <div class="input-box">
                    <span class="details">Espèce</span>
                    <input type="text" name="espece" value="<?php echo $value_espece; ?>" placeholder="Espèce commençant par..."/>
                </div>
                <div class="input-box">
                    <span class="details">Cri</span>
                    <input type="text" name="cri" value="<?php echo $value_cri; ?>" placeholder="Cri commençant par..."/>
                </div>

                <div class="input-box">
                    <span class="details">Propriétaire</span>
                    <input type="text" name="proprietaire" value="<?php echo $value_prop; ?>" placeholder="Propriétaire commençant par..."/>
                </div>

                <div class="input-box">
                    <span class="details">Age </span>
                    <input type="number" name="age" value="<?php echo $value_age; ?>" placeholder="Age strictement égal..."/>
                </div>
            </div>
            <div class="container-button">
                <div class="button">
                    <button name='submit' value='submit'>Rechercher</button>
                </div>
                <div class="button">
                    <button name='reset'  value='reset'>Effacer les filtres</button>
                </div>              
            </div>
        </form>
    </div>
    <div class="container" id="table-container">
        <div class="title">Affichage des animaux</div>
            <?php
                $vueAnimal->AnimalsTable(); //génération de la liste d'animaux à afficher       
            ?>
        <div class="button-link">
            <a href="add.php"> Ajouter un animal</a>
        </div>
        <div class="button-link">
            <a href="<?php echo $urlDelete; ?>"> Supprimer ces animaux</a>
        </div>
    </div>

</body>
</html>