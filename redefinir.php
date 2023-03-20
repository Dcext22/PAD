<?php
session_start();
ob_start();
include_once './conexao.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>PAD - Redefinir</title>
        <link rel="stylesheet" href="assets/css/redefinir1.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>        
    <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $chave = filter_input(INPUT_GET, "chave");

        if (!empty($dados['Redefinir'])) {
            $query_usuario = "SELECT id, senha FROM usuarios WHERE chave=:chave LIMIT 1";
            $result_usuario = $conn->prepare($query_usuario);
            $result_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
            $result_usuario->execute();

            if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                $id = $row_usuario['id'];
                $senha = $dados['senha'];
                
                if($senha != $row_usuario['senha']){
                    $query_up_senha = "UPDATE usuarios SET senha='$senha', chave=:chave WHERE id=$id";
                    $up_senha= $conn->prepare($query_up_senha);
                    $chave = NULL;
                    $up_senha->bindParam(':chave', $chave, PDO::PARAM_STR);
                    $up_senha->execute();

                    if($up_senha->rowCount()){
                        $_SESSION['msg'] = "<p style='color: green; '>Senha editada com sucesso !</p>";
                        header("Location: login.php");
                    }
                    else{
                        echo "<p style='color: #f00; '>Error: Senha não editada com sucesso !</p>";
                    }
                }
                else{
                    echo "<p style='color: #f00; '>Error: Digite uma senha diferente da anterior !</p>";
                }
            
            }
        }

        ?>
        <form class="login" name="cad-senha" method="POST" action="">
            <h2>Redefinir Senha<h2>
            <div class="box-user">
                <input type="text" name="senha">
                <label>Nova senha</label>
            </div>
        <div>
            <a href="index.php"><span class="material-symbols-outlined">home</a></span>
        </div>
            <input type="submit" name="Redefinir" class="botao">
        </form>
    </body>
</html>
        