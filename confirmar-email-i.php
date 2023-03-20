<?php
session_start();
ob_start();
include_once './conexao.php';

//echo "email confirmado com sucesso";

$chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);

if(!empty($chave)){

    $query_usuario = "SELECT id FROM instituicao WHERE chave = :chave LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
    $result_usuario->execute();

    if(($result_usuario) and ($result_usuario->rowCount() != 0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        extract($row_usuario);

        $query_up_usuario = "UPDATE instituicao SET sits_instituicao_id = 1, chave=:chave WHERE id=$id";
        $up_usuario = $conn->prepare($query_up_usuario);
        $chave = NULL;
        $up_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);

        if($up_usuario->execute()){
            $_SESSION['msg'] = "<p style='color: green;'>Email confirmado !</p>";
            header("Location: login.php");
        
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Email não confirmado !</p>";
            header("Location: login.php");
        }
    
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Endereço inválido !</p>";
        header("Location: login.php");
    }

}else{
    $_SESSION['msg'] = "<p style='color: #f00; '>Ocorreu um erro !</p>";
    header("Location: login.php");
}
?>