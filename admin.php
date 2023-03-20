<?php
session_start();
ob_start();
include_once 'conexao.php';

?>

<!DOCTYPE html>

<head>
    
    <meta charset="UTF-8">
    <title>PAD - ADMIN</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <div class="head">
        <h1 class="text">ADMIN</h1>
    </div>

    <div class="box">
        <nav>
            <a href="listar.php">Usuarios</a>
            <a href="listar.php">Instituições</a>
            <a href="editar.php">Editar</a>
            <a href="apagar.php">Apagar</a>
        </nav>
    </div>
</body>