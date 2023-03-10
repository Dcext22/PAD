<?php
session_start();
ob_start();
include_once './conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(empty($id)){
    $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não encontrado !</p>";
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html> 

<html>
    <head>
        <meta charset="UTF-8">
        <title>PAD - Visualizar</title>
    </head>
    <body>
        <a href="index.html">Inicio</a><br>
        <a href="cadastro.php">Cadastrar</a><br>
        <h1>Visualizar</h1>

        <?php 

        $query_usuario = "SELECT id, nome, email FROM usuarios WHERE id = $id LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->execute();

        if(($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            extract($row_usuario);
            echo "ID: $id <br>";
            echo "Nome: $nome <br>";
            echo "E-mail: $email <br>";
        }
        else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não encontrado !</p>";
            header("Location: index.html");
        }
        ?>

    </body>
</html>