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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <div class="foto">
    </div>
<?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['SendLogin'])) {
        $query_usuario = "SELECT id, nome, email, senha, sits_usuario_id
                            FROM usuarios 
                            WHERE email =:usuario
                            LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':usuario', $dados['email'], PDO::PARAM_STR);
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
    <form class="login" method= "POST" action="">
        <h2>Login</h2>
        <div class="box-user">
                <input type="text" name="email">
                <label>E-mail</label>
        </div>
        <div class="box-user">
                <input type="password" name="senha_usuario">
                <label>Senha</label>
        </div>
        <div>
            <a href="redefinir-senha.php" class="forgot">Esqueceu a senha ?</a>
            <a href="cadastro.php" class="cadastro">Não possui cadastro ? Crie uma conta</a>
            <a href="index.html"><span class="material-symbols-outlined">home</a></span>
        </div>
        <input type="submit" name="SendLogin" class="botao">
    </form>
    
</body>

</html>