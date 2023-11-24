<?php
if(isset($_POST["firstname"])){
    require_once "database.php"; 
    $db=new DB(); 
    
    
    $db->insert_registration($firstname, $lastname, $food, $dessert); 
    header ("Location: index.php"); 
}
require_once "header.php"; 
$foodoptions=["Fleisch","Fisch","Vegetarisch","Vegan"]; 
$dessertoptions=["Torte","Obstsalat","Eisbecher","keine Nachspeise"]; 
?>
<div class="main">
    <form method="post">
        <div class="card">
        <h3>Persönliche Daten</h3>
        <input type="text" placeholder="Vorname" name="firstname" required="required"/><br/>
        <input type="text" placeholder="Nachname" name="lastname" required="required"/><br/>
        </div>
        <div class="card">
            <h3>Speiseauswahl</h3>
            <?php
                foreach($foodoptions as $option){
                    echo "<div class=\"optiondiv\"><input type=\"radio\" value=\"$option\" name=\"food\" required/> " .  $option . "</div>"; 
                }
            ?>
        </div> 
        <div class="card">
            <h3>Nachspeiseauswahl</h3>
            <?php 
            foreach($dessertoptions as $option){
                echo "<div class=\"optiondiv\"><input type=\"radio\" value=\"$option\" name=\"dessert\" required/> " . $option . "</div>"; 
            }
            ?>
        </div>
        
        <input type="submit" class="btn btn-primary" value="anmelden"/>
    </form>
</div>