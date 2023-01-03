<?php
  
$usuario = 'root';
$senha = 'saulinho1';
$database = 'login';
$host = 'localhost';
$port = '3306';

//Conexão com porta
$conn = new PDO("mysql:host=$host;dbname=".$database, $usuario, $senha);
?>