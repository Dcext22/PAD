<?php
session_start();
ob_start();
include_once 'conexao.php';

if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login.php");
}

$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>PAD - Conta</title>
    <link rel="stylesheet" href="assets/css/ed.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body style="background-image:url('img/background2.jpg')">

<?php

        //RECEBER OS DADOS DO FORMULARIO
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        //VERIFICAR SE USUARIO CLICOU NO BOTAO
        
        if(!empty($dados['edit-usuario'])){
            $empty_input = false;
            $dados = array_map('trim', $dados);
            if(in_array("", $dados)){
                $empty_input = true;
                echo "<p style='color: #f00; '>Error: Necessário preencher todos os campos !</p>";
            }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                $empty_input = true;
                echo "<p style='color: #f00; '>Error: Necessário preencher o campo com e-mail valido !</p>";
            }

            if(!$empty_input){
                if($_SESSION['type'] == 'U'){
                $query_up_usuario = "UPDATE usuarios SET nome=:nome, email=:email, cpf=:cpf, endereco=:endereco, anotacoes=:anotacoes WHERE id=:id";
                $edit_usuario = $conn->prepare($query_up_usuario);
                $edit_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':cpf', $dados['cpf/cnpj'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':endereco', $dados['endereco'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':anotacoes', $dados['anotacoes'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':id', $id, PDO::PARAM_INT);
                
                if($edit_usuario->execute()){
                    $_SESSION['msg'] = "<p style='color: green; '>Usuario editado com sucesso !</p>";
                    header("Location: dashboard.php");
                }
                else{
                    echo "<p style='color: #f00; '>Error: Usuario não editado com sucesso !</p>";
                }
            }

                if($_SESSION['type'] == 'I'){
                    $query_up_usuario = "UPDATE instituicao SET nome=:nome, email=:email, cnpj=:cnpj, endereco=:endereco, anotacoes=:anotacoes WHERE id=:id";
                    $edit_usuario = $conn->prepare($query_up_usuario);
                    $edit_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                    $edit_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                    $edit_usuario->bindParam(':cnpj', $dados['cpf/cnpj'], PDO::PARAM_STR);
                    $edit_usuario->bindParam(':endereco', $dados['endereco'], PDO::PARAM_STR);
                    $edit_usuario->bindParam(':anotacoes', $dados['anotacoes'], PDO::PARAM_STR);
                    $edit_usuario->bindParam(':id', $id, PDO::PARAM_INT);
                    
                    if($edit_usuario->execute()){
                        $_SESSION['msg'] = "<p style='color: green; '>Usuario editado com sucesso !</p>";
                        header("Location: dashboard-i.php");
                    }
                    else{
                        echo "<p style='color: #f00; '>Error: Usuario não editado com sucesso !</p>";
                    }
                }
        }
    }
    ?>

    <form class="box" method="POST" action="">
        <div class="foto">
            <img src="img/Devs/MaxCaulfield.png">
        </div>
        <div class="Saudacao">
            <p>Bem vindo!</p>
        </div>
        <div class="logo">
            <img src="img/logoperfetita.png">
        </div>
        <form class="texts" method="POST">
            <div class="box-user">
                <label>Nome:</label>
                <div class="linha1"><input type="text" name="nome" value="<?php 
                if (isset($_SESSION['nome'])){
                echo $_SESSION['nome'];
                }?>"
                ></div>
            </div>

            <div class="box-user">
                <label>Email:</label>
                <div class="linha2"><input type="text" name="email" value="<?php 
                if (isset($_SESSION['email'])){
                echo $_SESSION['email'];
                }?>"
                ></div>
            </div>

            <div class="box-user">
                <label>CPF/CNPJ:</label>
                <div class="linha3"><input type="text" name="cpf/cnpj" value="<?php 
                if (isset($_SESSION['cpf'])){
                echo $_SESSION['cpf'];
                }else{
                echo $_SESSION['cnpj'];
                }
                ?>"
                ></div>
            </div>
            
            <div class="box-user">
                <label>Endereço:</label>
                <div class="linha4"><input type="text" name="endereco" value="<?php 
                if (isset($_SESSION['endereco'])){
                echo $_SESSION['endereco'];
                }?>"
                ></div>
            </div>
            
            <div class="box-user">
                <label class="titulo">Anotações</label>
                <div class="linha5"><input type="text" wrap="hard" name="anotacoes" value="<?php 
                if (isset($_SESSION['anotacoes'])){
                echo $_SESSION['anotacoes'];
                }?>"
                ></div>
            </div>
            
            <a href="index.php"><span class="material-symbols-outlined">home</a></span>
            <input type="submit" name="edit-usuario" class="botao">
    </form>

</body>

</html>