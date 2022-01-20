<?php
    require_once ('Database/connect.php');
    require_once ('Classes/VueAnimal.php');
 
    $manager = new AnimauxManager($db);
    $manager->createNotExistingAnimalTable();
    $vueAnimal = new VueAnimal($manager->getList());
    
?>