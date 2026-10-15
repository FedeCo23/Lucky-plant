<?php

// Fa lanciare un'eccezione a mysqli in caso di errore (da PHP 8.1 è già il comportamento di default, ma così è esplicito)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Parametri per il collegamento al DB
$db_host= 'localhost';
$db_user= 'root';
$db_pass= ''; 
$db_name= 'lucky_plant'; 
$db_port= 3306;

// connessione al DB
try {
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
 
    // impostazione del charset UTF-8
    mysqli_set_charset($conn, "utf8mb4");
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());  // il dettaglio dell'errore va nei log del server
    http_response_code(500);
    die("Servizio temporaneamente non disponibile."); // messaggio generico per l'utente
}


// impostazione del charset UTF-8
mysqli_set_charset($conn, "utf8mb4");



?>