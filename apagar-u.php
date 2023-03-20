<?php

session_start();
ob_start();
include_once './conexao.php';

if($_SESSION['nome'] == 'admin'){
    header("Location: index.php");
}

if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    header("Location: login.php");
}

$id = $_SESSION['id'];


if($_SESSION['type'] == 'U'){
    $query_usuario = "SELECT id FROM usuarios WHERE id = $id LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->execute();
    
    if(($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $query_del_usurario = "DELETE FROM usuarios WHERE id = $id";
        $del_usuario = $conn->prepare($query_del_usurario);
        $del_usuario->execute();
    
        if($del_usuario->execute()){
            $_SESSION['msg'] = "<p style='color: green;'>Usuário deletado com sucesso !</p>";
            header("Location: sair.php");
        }
        else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não deletado com sucesso !</p>";
            header("Location: dashboard.php");
        }
    }
    else{
        $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não encontrado !</p>";
        header("Location: dashboard.php");
    }
}

if($_SESSION['type'] == 'I'){
    $query_usuario = "SELECT id FROM instituicao WHERE id = $id LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->execute();
    
    if(($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $query_del_usurario = "DELETE FROM instituicao WHERE id = $id";
        $del_usuario = $conn->prepare($query_del_usurario);
        $del_usuario->execute();
    
        if($del_usuario->execute()){
            $_SESSION['msg'] = "<p style='color: green;'>Usuário deletado com sucesso !</p>";
            header("Location: sair.php");
        }
        else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não deletado com sucesso !</p>";
            header("Location: dashboard-i.php");
        }
    }
    else{
        $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não encontrado !</p>";
        header("Location: dashboard-i.php");
    }
}

?>