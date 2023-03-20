<?php
session_start();
ob_start();
include_once 'conexao.php';

if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login.php");
}

if($_SESSION['nome'] == 'admin'){
    header("Location: admin.php");
}

$id = $_SESSION['id'];

$_SESSION['type'] = 'I';

        $query_usuario = "SELECT id, nome, email, cnpj, endereco, anotacoes FROM instituicao WHERE id = $id LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->execute();

        if(($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $_SESSION['nome'] = $row_usuario['nome'];
            $_SESSION['email'] = $row_usuario['email'];
            $_SESSION['cnpj'] = $row_usuario['cnpj'];
            $_SESSION['endereco'] = $row_usuario['endereco'];
            $_SESSION['anotacoes'] = $row_usuario['anotacoes'];
        }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>PAD - Conta</title>
    <link rel="stylesheet" href="assets/css/dash-i.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body style="background-image:url('img/background2.jpg')">
    <div class="box">
        <div class="foto">
            <img src="img/pdo.png">
        </div>
        <div class="Saudacao">
            <p>Bem vindo!</p>
        </div>
        <div class="logo">
            <img src="img/logoperfetita.png">
        </div>
        <div class="texts">
            <div class="nome">
                <p>Instituição: <div class="texto"> <?php echo $_SESSION['nome']; ?></div></p>
            </div>
            <div class="email">
                <p>Email: <div class="texto"> <?php echo $_SESSION['email']; ?></div></p>
            </div>
            <div class="CNPJ">
                <p>CNPJ: <div class="texto"> <?php echo $_SESSION['cnpj']; ?></div></p>
            </div>
            <div class="Endereco">
                <p>Endereço: <div class="texto"> <?php echo $_SESSION['endereco']; ?></div></p>
            </div>
            <div class="Anotacoes">
                <p>Anotações <div class="texto"> <?php echo $_SESSION['anotacoes']; ?></div>
            </div>
        </div>

        <a href="apagar-msg-u"><span class="apagar"><img class="lixeira" src="img/Lixeira.png"></a></span>
        <a href="editar.php"><span class="editar"><img class="lapis" src="img/lapis.png"></a></span>
        <a href="index.php"><span class="material-symbols-outlined">home</a></span>
        <a href="sair.php"><span class="sair"><img class="sair" src="img/sair.png"></a></span>
    </div>

</body>

</html>