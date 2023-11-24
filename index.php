<?php
require_once "database.php"; 
$db=new DB(); 
$data=$db->get_registrations(); 

require_once "header.php"; 
?>
<div class="main">
<table class="table">
    <thead><tr>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>Speiseauswahl</th>
        <th>Nachspeiseauswahl</th>
    </tr></thead>
    <?php 
        foreach($data as $row){
            echo "<tr>";
            echo "<td>" . $row['firstname'] . "</td>"; 
            echo "<td>" . $row['lastname'] . "</td>"; 
            echo "<td>" . $row['food'] . "</td>"; 
            echo "<td>" . $row['dessert'] . "</td>";  
            echo "</tr>";               
        }

    ?>
</table>
</div>
<div class="card header">
    <a href="register.php">neue Anmeldung</a>
</div>