<?php

function connectionDB() {

    $hostname = 'localhost';            // the credentials of the connection
    $databasenaam = 'projectbibliotheek';
    $username = 'root';
    $password = '';

    $conn = new mysqli($hostname, $username, $password, $databasenaam); // the instantiation of the mysqli object, on object TOTALLY specialised in DATABAS MANAGEMENT
    return $conn;  // THAT object and connection is given back so that it can be catched at the call.
}
