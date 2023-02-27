<?php
session_start();
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/autoload.php';

include_once 'conexao.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>PAD - Redefinir</title>
    </head>
    <body>
        <a href="login.php">Login</a><br>
        <a href="cadastro.php">Cadastrar</a><br>
        <h1>Redefinir senha</h1>
        <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($dados['Redefinir'])) {
            $query_usuario = "SELECT * FROM usuarios WHERE email=:email LIMIT 1";
            $result_usuario = $conn->prepare($query_usuario);
            $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
            $result_usuario->execute();

            if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['email'] = $row_usuario['email'];
                $email = $_SESSION['email'];
                
                $chave = bin2hex(random_bytes(16));
                
                $query_token = "UPDATE usuarios SET chave='$chave' WHERE email='$email'";
                $up_token = $conn->prepare($query_token);
                $up_token->execute();

                if($up_token->rowCount()) {

                    $mail = new PHPMailer(true);

                    try { //Server settings
                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        $mail->CharSet = "UTF-8";
                        $mail->isSMTP();
                        $mail->Host = 'smtp.mailtrap.io';
                        $mail->SMTPAuth = true;
                        $mail->Username = '34cc7164616599';
                        $mail->Password = 'b1ec6d8d5ffcc4';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 2525;

                        //Recipients
                        $mail->setFrom('teste@testando.com', 'testando');
                        $mail->addAddress($_SESSION['email'], $_SESSION['nome']);

                        //Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Redefinição de Senha';

                        $mail->Body = "caro(a) " . $_SESSION['nome'] . "<br><br> para que a redefinição de senha seja concluída por favor clique no link a seguir:  <br><br>
                        <br><br> <a href='http://localhost/PAD/redefinir.php?chave=$chave'>Clique aqui</a>";

                        $mail->AltBody = "caro(a) " . $_SESSION['nome'] . "\n\n para que a redefinição de senha seja concluída por favor clique no link a seguir: \n\n
                        \n\n http://localhost/PAD/redefinir.php?chave=$chave";

                        $mail->send();
                        echo $_SESSION['msg'] = "<p style='color: green;'>E-mail enviado, porfavor cheque seu email!</p>";
                        header("Location: index.php");
                        ;

                    } catch (Exception $e) {
                        echo "Redefinição não pôde ser concluída: {$mail->ErrorInfo}";
                    }

                    unset($dados);
                    $_SESSION['msg'] = "<p style='color: green;'>E-mail enviado, porfavor cheque seu email!</p>";
                    header("Location: index.php");
                } else {
                    echo "<p style='color: #f00; '>Erro: E-mail não encontrado !</p>";
                }
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Error: E-mail não encontrado!</p>";
            }

            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        }
        ?>
        <form method="POST" action="">
            <label>Digite seu email: </label>
            <input type="text" name="email"><br><br>

            <input type="submit" value="Confirmar" name="Redefinir">
        </form>
    </body>

</html>