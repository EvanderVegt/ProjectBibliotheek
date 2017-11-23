<?php include 'General.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bibliotheek info</title>
        <link rel = "stylesheet" type = "text/css" href="bibliotheek.css">
    <nav>
        <header>Bibliotheek info Pagina</header>
        <div class="topnav" id="myTopnav">
            <a href="index.php" class="active">Home</a>
            <a href="toevoegen.php"> Toevoegen </a>
            <a href="bibliotheek.php"> Bibliotheek </a>
            <a href="#notities">Notities </a>
        </div>
    </nav>
</head>

<body>

    <?php
    $conn = connectionDB();    // Call for a PHP function // We can not find it on this page SO it must be on the shared page generalfunctions.php
    echo createTagSelect($conn, "Titel"); // THE FUNCTION is being Echoed VERY important because the string is in the function returned NOT echoed // 
    ?>


    <div id="notities">
        <form>
            <textarea  name="<?php echo $notie; ?>" cols="50" rows="3" style="width: 300px; height: 50px;" required></textarea><br><br>
            <input type="submit" value="Verzenden" id="button">
        </form>
    </div>


    <?php
    if (isset($_POST['$notie'])) {
        echo 'iets';
    }


    $query = "UPDATE `bibliotheek` SET `Notities`='" . $notie . "' WHERE `Titel`";

    $result = $conn->query($query);
    $conn->close();
    ?>
</body>
</html>
