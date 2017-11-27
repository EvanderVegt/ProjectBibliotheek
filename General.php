<?php

function connectionDB() {

    $hostname = 'localhost';            // the credentials of the connection
    $databasenaam = 'projectbibliotheek';
    $username = 'root';
    $password = '';

    $conn = new mysqli($hostname, $username, $password, $databasenaam); // the instantiation of the mysqli object, on object TOTALLY specialised in DATABAS MANAGEMENT
    return $conn;  // THAT object and connection is given back so that it can be catched at the call.
}

function createtable($conn) {


    $sql = "SELECT boek.Boek_id, boek.Invoerdatum, boek.Titel, boek.Auteur,
        boek.Isbn, boek.Uitgever, boek.Categorie, boek.Ranking, notitie.Notitie
FROM boek
LEFT JOIN notitie ON boek.Boek_id = notitie.boek_id;";
    $result = $conn->query($sql);
    echo "<table id=customers>";
    $TR = "<tr>";
    for ($x = 0; $x < 1; $x++) {
        echo"<th>";
        echo"Boek_id";
        echo"</th>";
        echo"<th>";
        echo"Invoerdatum";
        echo"</th>";
        echo"<th>";
        echo"Titel";
        echo"</th>";
        echo"<th>";
        echo"Auteur";
        echo"</th>";
        echo"<th>";
        echo"ISBN";
        echo"</th>";
        echo"<th>";
        echo"Uitgever";
        echo"</th>";
        echo"<th>";
        echo"Categorie";
        echo"</th>";
        echo"<th>";
        echo"Ranking";
        echo"</th>";
        echo"<th>";
        echo"Notitie";
        echo"</th>";
    }
    for ($x = 0; $x < $result->num_rows; $x++) {
        $row = $result->fetch_assoc();
        echo "<tr>";
        echo "<td>";
        echo $row['Boek_id'];
        echo "</td>";
        echo "<td>";
        echo $row['Invoerdatum'];
        echo "</td>";
        echo "<td>";
        echo $row['Titel'];
        echo "</td>";
        echo "<td>";
        echo $row['Auteur'];
        echo "</td>";
        echo "<td>";
        echo $row['Isbn'];
        echo "</td>";
        echo "<td>";
        echo $row['Uitgever'];
        echo "</td>";
        echo "<td>";
        echo $row['Categorie'];
        echo "</td>";
        echo "<td>";
        echo $row['Ranking'];
        echo "</td>";
        echo "<td>";
        echo $row['Notitie'];
        echo "</td>";
        echo "</tr>";
    }
    echo"</tr>";
    echo "<table id=customers>";
    return$TR;
}

function createTagSelect($ParamConn) {
    $sql = "SELECT * FROM `boek`;";   // Make a query for the DATABASE



    $erinResultSet = $ParamConn->query($sql); // THe execution of the SQL statement with ->query() on the mysql-object-parameter returns the RECORDSET in the variable ResultSet.

    $eruit = "<select id=eriksselectboek onchange=letsgaan() name=boek >";  // assign the <select> openings tag with id and event=functioncall as string  
    for ($x = 0; $x < $erinResultSet->num_rows; $x++) {// count the number of records in the recordset and make sure that the for loops that amount of times
        $row = $erinResultSet->fetch_assoc();  // Get the next record AS an array into the variable row
        $eruit .= "<option value=" . $row['Boek_id'] . ">";   // append new string information with .=
        $eruit .= $row['Titel']; // make the option with only the naam out of the record set
        $eruit .= "</option>";
    }
    $eruit .= "</select>"; // <select closing tag

    return $eruit; // return the result
}


?> 
