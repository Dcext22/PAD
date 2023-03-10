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

$query_usuario = "SELECT id, nome, email, senha FROM usuarios WHERE id = $id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->execute();

if(($result_usuario) and ($result_usuario->rowCount() != 0)){
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
}
else{
    $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não encontrado !</p>";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html> 

<html>
    <head>
        <meta charset="UTF-8">
        <title>PAD - Editar</title>
    </head>
    <body>
        <a href="login.php">Login</a><br>
        <a href="index.php">Listar</a><br>
        <a href="cadastro.php">Cadastrar</a><br>

        <h1>Editar</h1>

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
                $query_up_usuario = "UPDATE usuarios SET nome=:nome, email=:email, senha=:senha WHERE id=:id";
                $edit_usuario = $conn->prepare($query_up_usuario);
                $edit_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':id', $id, PDO::PARAM_INT);
                if($edit_usuario->execute()){
                    $_SESSION['msg'] = "<p style='color: green; '>Usuario editado com sucesso !</p>";
                    header("Location: index.php");
                }
                else{
                    echo "<p style='color: #f00; '>Error: Usuario não editado com sucesso !</p>";
                }
            }
        }

        ?>

        <form id="edit-usuario" method="POST" action="">
            <label>Nome</label>
            <input type="text" name="nome" id="nome" placeholder="" value="<?php 
                if (isset($dados['nome'])){
                echo $dados['nome'];
                }
                elseif(isset($row_usuario['nome'])){
                    echo $row_usuario['nome'];
                }?>"
                ><br><br>

            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="" value="<?php 
                if (isset($dados['email'])){
                echo $dados['email'];
                }

                elseif(isset($row_usuario['email'])){
                    echo $row_usuario['email'];
                }?>"
                ><br><br>

            <label>Senha</label>
            <input type="text" name="senha" id="senha" placeholder="" value="<?php 
                if (isset($dados['senha'])){
                    echo $dados['senha'];
                }
            
                elseif(isset($row_usuario['senha'])){
                    echo $row_usuario['senha'];
                }?>"
                ><br><br>

            <input type="submit" value="Atualizar" name="edit-usuario">
        </form>

    </body>
</html>