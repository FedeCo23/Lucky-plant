<?php


// Parametri per il collegamento al DB
$db_host= 'localhost';
$db_user= 'root';
$db_pass= ''; 
$db_name= 'lucky_plant'; 
$db_port= 3306;

// connessione al DB
$conn= mysqli_connect($db_host, $db_user,$db_pass, $db_name, $db_port);

// verifica errori
if(!$conn){
    die("Errore di connessione al database"); //cambiare 
}


// impostazione del charset UTF-8
mysqli_set_charset($conn, "utf8mb4");



?>