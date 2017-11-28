<?php include 'General.php';
?>
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
                                <a href="notities.php">Notities </a>
                            </div>
                        </nav>
    </head> 
    
    <form id="table">
<?php

    $conn = connectionDB(); 
    echo createtable($conn);
    
?> 
     
    </form>

</html>
