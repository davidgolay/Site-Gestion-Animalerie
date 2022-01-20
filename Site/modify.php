<?php
    require_once ('Classes/AnimauxManager.php');
    require_once ('Database/connect.php');
    require_once ('Classes/VueAnimal.php');
    require_once ('Classes/Animal.php');

    $message = '';
    $title = "Modification de l'animal";
    $buttonText = "Modifier";

    $conditions = (!empty($_POST['nom']) 
        && !empty($_POST['espece'])
        && !empty($_POST['cri']) 
        && !empty($_POST['proprietaire']) 
        && !empty($_POST['age'])
    );

    if(isset($_GET['id']))
    {
        $id = intval($_GET['id']);
        $manager = new AnimauxManager($db);
        $animal  = $manager->get($id);

        $value_nom    = $animal->nom();
        $value_espece = $animal->espece();
        $value_cri    = $animal->cri();
        $value_prop   = $animal->proprietaire();
        $value_age    = $animal->age();

        if(isset($_POST['submit'])) {

            if($conditions){

                $value_nom    = htmlspecialchars($_POST['nom']);
                $value_espece = htmlspecialchars($_POST['espece']);
                $value_cri    = htmlspecialchars($_POST['cri']);
                $value_prop   = htmlspecialchars($_POST['proprietaire']);
                $value_age    = htmlspecialchars($_POST['age']);

                $ageIsValid = (intval($value_age > 0));

                if($ageIsValid){

                    $animal->setNom($value_nom);
                    $animal->setEspece($value_espece);
                    $animal->setCri($value_cri);
                    $animal->setProprietaire($value_prop);
                    $animal->setAge($value_age);
        
                    //mise à jour de la bdd;
                    try{
                        $manager->update($animal);
                        header('location: index.php');
                    } catch (Exception $ExceptionMAJ){
                        $message = 'Oups, la modifacation a échouée!';
                    } 
                }
                else {
                    $message = 'Veuillez indiquez un âge valide.';
                }
            
            } 
            else {
                $message = 'Veuillez renseigner tous les champs requis.';
            }
        }
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
    <title>Modification d'un Animal</title>
</head>
<body>
    <?php
        require_once ('formEditionAnimal.php');
    ?>
</body>
</html>