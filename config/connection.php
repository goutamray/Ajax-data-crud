<?php

/**
 * 
 * mysql database conection
 */

function connect (){
    try {
       return $connection = new PDO("mysql:host=localhost;dbname=devops", "goutam", "asdfghjkl");
    } catch (PDOException $error) {
        die("Connection failed: " . $error->getMessage());
    }
    
}














?>