<?php
    if(!isset($value_nom))    $value_nom = '';
    if(!isset($value_espece)) $value_espece = '';
    if(!isset($value_cri))    $value_cri = '';
    if(!isset($value_prop))   $value_prop = '';
    if(!isset($value_age))    $value_age = '';
?>

<div class="super-container">
    <div class="container">
        <div class="title"><?php echo $title; ?> </div>
        <form method="POST" class="form">
            <div class="animal-details">
                <div class="input-box">
                    <span class="details">Nom</span>
                    <input type="text" name="nom" value="<?php echo $value_nom; ?>" placeholder="Saisissez un nom"/>
                </div>
                <div class="input-box">
                    <span class="details">Espèce</span>
                    <input type="text" name="espece" value="<?php echo $value_espece; ?>" placeholder="Saisissez une espèce"/>
                </div>          
                <div class="input-box">
                    <span class="details">Cri</span>
                    <input type="text" name="cri" value="<?php echo $value_cri; ?>" placeholder="Saisissez un cri"/>
                </div>            
                <div class="input-box">
                    <span class="details">Propriétaire</span>
                    <input type="text" name="proprietaire" value="<?php echo $value_prop; ?>" placeholder="Saisissez un propriétaire"/>
                </div>           
                <div class="input-box">
                    <span class="details">Âge</span>
                    <input type="number" name="age" value="<?php echo $value_age; ?>" placeholder="Saisissez un age"/>
                </div>          
                <div>
                    <p><?php echo '<font color="red">'.$message . ' </font>'; ?></p>
                </div>
                <div class="button">
                    <button type="submit" name="submit"><?php echo $buttonText;?></button>
                </div>
                <div>
                    <a href="index.php">retournez à l'acceuil</a>
                </div>
            </div>   
        </form>
    </div>
</div>