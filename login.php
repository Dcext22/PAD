<?php
session_start();
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>PAD - Login</title>
</head>

<body>
    <a href="index.php">Listar</a><br>
    <a href="cadastro.php">Cadastrar</a><br>
    <h1>Login</h1>

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['SendLogin'])) {
        $query_usuario = "SELECT id, nome, email, senha, sits_usuario_id
                        FROM usuarios 
                        WHERE email =:usuario  
                        LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
        $result_usuario->execute();

        if(($result_usuario) and ($result_usuario->rowCount() != 0)){
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

            if($row_usuario['sits_usuario_id'] != 1){
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário confirmar o E-mail!</p>";
            }
            elseif(password_verify($dados['senha_usuario'], $senha = password_hash($row_usuario['senha'], PASSWORD_DEFAULT))){
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                header("Location: dashboard.php");
            }else{
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
            }
        }else{
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
        }

        
    }

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <form method="POST" action="">
        <label>Usuário</label>
        <input type="text" name="usuario" placeholder="" value="<?php if(isset($dados['usuario'])){ echo $dados['usuario']; } ?>"><br><br>

        <label>Senha</label>
        <input type="password" name="senha_usuario" placeholder="" value="<?php if(isset($dados['senha_usuario'])){ echo $dados['senha_usuario']; } ?>"><br><br>

        <input type="submit" value="Acessar" name="SendLogin">
    </form>

    <br><br>
</body>

</html>