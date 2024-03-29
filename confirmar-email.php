<?php
session_start();
ob_start();
include_once './conexao.php';

//echo "email confirmado com sucesso";

$chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);
$imagem_pdo = "/img/pdo.png";

if(!empty($chave)){

    $query_usuario = "SELECT id FROM usuarios WHERE chave = :chave LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
    $result_usuario->execute();

    if(($result_usuario) and ($result_usuario->rowCount() != 0)){
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        extract($row_usuario);

        $query_up_usuario = "UPDATE usuarios SET sits_usuario_id = 1, chave=:chave WHERE id=$id";
        $up_usuario = $conn->prepare($query_up_usuario);
        $chave = NULL;
        $up_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);

        if($up_usuario->execute()){
            $_SESSION['msg'] = "<p style='color: green;'>Email confirmado !</p>";
            header("Location: login.php");
        
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Email não confirmado !</p>";
            header("Location: cadastro.php");
        }
    
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Endereço inválido !</p>";
        header("Location: cadastro.php");
    }

}else{
    $_SESSION['msg'] = "<p style='color: #f00; '>Ocorreu um erro !</p>";
    header("Location: cadastro.php");
}
?>