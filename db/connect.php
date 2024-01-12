<?php
$dbname = 'mysql:host=localhost; dbname=login';
// $server = 'localhost';
$user = 'root';
$password = '';
// $dbname = 'login';

// try {
//     $conn = new PDO("mysql:host=$server; dbname=$dbname", $user, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Conectado";
// } catch (ErrorException $e) {
//     echo "Error".$e->getMessage();
// }

$conn = new PDO($dbname, $user, $password);

// if ($conn) {
//     echo "Conectado";
// }


?>