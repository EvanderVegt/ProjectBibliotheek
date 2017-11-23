<?php include 'General.php';
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <header>Bibliotheek</header>
        <link rel = "stylesheet" type = "text/css" href="bibliotheek.css"> 
        <meta charset="UTF-8">
        <title>Bibliotheek</title>
    <nav>
        <div class="topnav" id="myTopnav">
            <a href="index.php" class="active">Home</a>
            <a href="toevoegen.php"> Toevoegen </a>
            <a href="bibliotheek.php"> Bibliotheek </a>
            <a href="#notities">Notities </a>
        </div>
    </nav>


        <form id="table">
        <?php
        $conn = connectionDB();
        echo createtable($conn);
        ?> 
        </form>

<body>
    <?php
    // put your code here
    ?>
</body>
</html>
