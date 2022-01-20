<?php
    try {
        $db = new PDO('mysql:host=localhost;dbname=animalerieGOLAY',
        'root',
        '');
        //echo 'Database Connection Successful </br>';
    }
    catch (Exception $e) {
        die('Erreur Connection : ' . $e->getMessage(). '</br>');
    }
?>
