<?php

global $pdo;
try {
    $pdo = new PDO('mysql:host=localhost; port=3306; dbname=counsellingdb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    // echo $ex->getMessage();
    echo "We are sorry for this, but our server has signalled to us some errors. Please try again in a few minutes time.";
    return false;
}
