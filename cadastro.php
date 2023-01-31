<?php
session_start();
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/autoload.php';

include_once './conexao.php';
?>
<!DOCTYPE html> 

<html>
    <head>
        <meta charset="UTF-8">
        <title>PAD - Cadastro</title>
    </head>
    <body>
        <a href="login.php">Login</a><br>
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
                echo "<p style='color: #f00; '>Erro: Necessário preencher todos os campos !</p>";
            }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                $empty_input = true;
                echo "<p style='color: #f00; '>Erro: Necessário preencher o campo com e-mail valido !</p>";
            }

            if (!$empty_input) {
                $query_usuario = "INSERT INTO usuarios (nome, email, senha, chave) VALUES (:nome, :email, :senha, :chave)" ;

                $cad_usuario = $conn->prepare($query_usuario);
                $cad_usuario ->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $cad_usuario ->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $senha_cript = $dados['senha'];
                $cad_usuario ->bindParam(':senha', $senha_cript, PDO::PARAM_STR);
                $chave = password_hash($dados['email'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
                $cad_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
                
                $cad_usuario->execute();
                if ($cad_usuario->rowCount()) {

                    $mail = new PHPMailer(true);
                    
                    try{    //Server settings
                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        $mail->CharSet = "UTF-8";
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.mailtrap.io';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = '34cc7164616599';
                        $mail->Password   = 'b1ec6d8d5ffcc4';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 2525;
                    
                        //Recipients
                        $mail->setFrom('teste@testando.com', 'testando');
                        $mail->addAddress($dados['email'], $dados['nome']);

                        //Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Confirmação de Email';
                        
                        $mail->Body    = "caro(a) " . $dados['nome'] . "<br><br> por favor confirme o email para cadastro em nosso site <br><br>
                        Para que o processo seja concluído por favor clique no link a seguir: <br><br> <a href='http://localhost/PAD/confirmar-email.php?chave=$chave'>Clique aqui</a>";
                        
                        $mail->AltBody = "caro(a) " . $dados['nome'] . "\n\n por favor confirme o email para cadastro em nosso site \n\n
                        Para que o processo seja concluído por favor clique no link a seguir: \n\n http://localhost/PAD/confirmar-email.php?chave=$chave";
                    
                        $mail->send();
                        echo $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado porfavor cheque seu email!</p>";
                        header("Location: index.php");;

                    }catch (Exception $e) {
                        echo "cadastro não pôde ser concluído: {$mail->ErrorInfo}";
                    }
                    
                    unset($dados);
                    $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado por favor cheque seu email!</p>";
                    header("Location: index.php");
                }
                else{
                    echo "<p style='color: #f00; '>Erro: Usuário não cadastrado !</p>";
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