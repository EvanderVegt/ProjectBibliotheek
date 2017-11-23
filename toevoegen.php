<?php include 'General.php';
?>
<html>
    <head>
        <header>Bewerken</header>
        <link rel = "stylesheet" type = "text/css" href="bibliotheek.css">
        <meta charset="UTF-8">
        <title>Toevoegen</title>
    <nav>
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
    $conn = connectionDB();

    if ($conn->connect_error)
        die($conn->connect_error);

    if (isset($_POST['delete']) && isset($_POST['ISBN'])) {
        $isbn = get_post($conn, 'ISBN');
        $query = "DELETE FROM `bibliotheek` WHERE ISBN='$isbn'";
        $result = $conn->query($query);
        if (!$result)
            echo "DELETE failed: $query<br>" .
            $conn->error . "<br><br>";
    }

    if (isset($_POST['Invoerdatum']) &&
            isset($_POST['Titel']) &&
            isset($_POST['Auteur']) &&
            isset($_POST['ISBN']) &&
            isset($_POST['Uitgever']) &&
            isset($_POST['Categorie']) &&
            isset($_POST['Ranking']) &&
            isset($_POST['Notities'])) {
        $invoerdatum = get_post($conn, 'Invoerdatum');
        $titel = get_post($conn, 'Titel');
        $auteur = get_post($conn, 'Auteur');
        $isbn = get_post($conn, 'ISBN');
        $uitgever = get_post($conn, 'Uitgever');
        $categorie = get_post($conn, 'Categorie');
        $ranking = get_post($conn, 'Ranking');
        $notities = get_post($conn, 'Notities');
        $query = "INSERT INTO `bibliotheek`"
                . "(`Invoerdatum`, `Titel`, `Auteur`, `ISBN`, `Uitgever`, `Categorie`, `Ranking`, `Notities`)"
                . " VALUES ('" . $invoerdatum . "','" . $titel . "','" . $auteur . "','"
                . $isbn . "','" . $uitgever . "','" . $categorie . "','" . $ranking . "','" . $notities . "')";
        $result = $conn->query($query);



        if (!$result)
            echo "INSERT failed: $query<br>" .
            $conn->error . "<br><br>";
    }

    echo <<<_END
  <form action="toevoegen.php" method="post"><pre>
 Invoerdatum <input type="text" name="Invoerdatum" required>
       Titel <input type="text" name="Titel" required>
      Auteur <input type="text" name="Auteur" required>
         ISBN<input type="text" name="ISBN" required>
     Uitgever<input type="text" name="Uitgever" required>
    Categorie<input type="text" name="Categorie" required>
      Ranking<input type="text" name="Ranking" required>
     Notities<input type="text" name="Notities" required>
           <input type="submit" value="ADD RECORD">
  </pre></form>
_END;

    $query = "SELECT * FROM `bibliotheek`";
    $result = $conn->query($query);
    if (!$result)
        die("Database access failed: " . $conn->error);

    $rows = $result->num_rows;

    for ($j = 0; $j < $rows; ++$j) {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_NUM);

        echo <<<_END
  <pre>
         id $row[0]
Invoerdatum $row[1]
      Titel $row[2]
     Auteur $row[3]
       ISBN $row[4]
   Uitgever $row[5]
  Categorie $row[6]
    Ranking $row[7]
   Notities $row[8]
  </pre>
  <form action="toevoegen.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="ISBN" value="$row[4]">
  <input type="submit" value="DELETE RECORD"></form>
_END;
    }

    $result->close();
    $conn->close();

    function get_post($conn, $var) {
        return $conn->real_escape_string($_POST[$var]);
    }
    ?>
</body>
</html>
