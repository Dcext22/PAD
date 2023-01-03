<?php
session_start();
ob_start();
include_once './conexao.php';
?>
<!DOCTYPE html> 

<html>
    <head>
        <meta charset="UTF-8">
        <title>PAD - Cadastro</title>
    </head>
    <body>
        <a href="index.php">Listar</a><br>
        <a href="cadastro.php">Cadastrar</a><br>
        <h1>Cadastrar</h1>
        <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($dados['cadusuario'])) {
            
            $empty_input = false;

            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "<p style='color: #f00; '>Error: Necessário preencher todos os campos !</p>";
            }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                $empty_input = true;
                echo "<p style='color: #f00; '>Error: Necessário preencher o campo com e-mail valido !</p>";
            }

            if (!$empty_input) {
                $query_usuario = "INSERT INTO usuarios (nome, email, senha) VALUES ('" . $dados['nome'] . "', '" . $dados['email'] . "', '" . $dados['senha'] . "')  ";
                $cad_usuario = $conn->prepare($query_usuario);
                $cad_usuario->execute();
                if ($cad_usuario->rowCount()) {
                    unset($dados);
                    $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                    header("Location: index.php");
                }
                else{
                    echo "<p style='color: #f00; '>Error: Usuário não cadastrado !</p>";
                }
            }
        }
        ?>
        <form name="cad-usuario" method="POST" action="">
            <label>Nome: </label>
            <input type="text" name="nome" id="nome" placeholder="" value="<?php if (isset($dados['nome'])) {
            echo $dados['nome'];
            }
            ?>"><br><br>

            <label>E-mail: </label>
            <input type="e-mail" name="email" id="email" placeholder="" value="<?php if (isset($dados['email'])) {
            echo $dados['email'];
            }
            ?>"><br><br>

            <label>Senha: </label>
            <input type="text" name="senha" id="senha" placeholder=""><br><br>

            <input type="submit" value="cadastrar" name="cadusuario">

        </form>
    </body>
</html>