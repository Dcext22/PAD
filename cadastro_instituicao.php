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
        <link rel="stylesheet" href="assets/css/cadastro_instituicao.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($dados['cadinstituicao'])) {
            
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
                $query_usuario = "INSERT INTO instituicao (nome, cnpj, email, senha, chave) VALUES (:nome, :cnpj, :email, :senha, :chave)" ;

                $cad_usuario = $conn->prepare($query_usuario);
                $cad_usuario ->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $cad_usuario ->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $cad_usuario ->bindParam(':cnpj', $dados['cnpj'], PDO::PARAM_STR);
                $senha_cript = $dados['senha'];
                $cad_usuario ->bindParam(':senha', $senha_cript, PDO::PARAM_STR);
                $chave = bin2hex(random_bytes(16));
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
                        Para que o processo seja concluído por favor clique no link a seguir: <br><br> <a href='http://localhost/PAD/confirmar-email-i.php?chave=$chave'>Clique aqui</a>";
                        
                        $mail->AltBody = "caro(a) " . $dados['nome'] . "\n\n por favor confirme o email para cadastro em nosso site \n\n
                        Para que o processo seja concluído por favor clique no link a seguir: \n\n http://localhost/PAD/confirmar-email-i.php?chave=$chave";
                    
                        $mail->send();
                        echo $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso! Por favor, confira seu e-mail !</p>";
                        header("Location: confirmar-email-i.php");;

                    }catch (Exception $e) {
                        echo "cadastro não pôde ser concluído: {$mail->ErrorInfo}";
                    }
                    
                    unset($dados);
                    $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado por favor cheque seu email!</p>";
                    header("Location: confirmar-email-i.php");
                }
                else{
                    echo "<p style='color: #f00; '>Erro: Usuário não cadastrado !</p>";
                }
            }
        }
        ?>
        <form class="login" name="cad-usuario" method="POST" action="">
            <h2>Cadastro</h2>
            <div class="box-user">
                <input type="text" name="nome">
                <label>Nome da Instituição</label>
            </div>

            <div class="box-user">
                <input type="text" name="cnpj">
                <label>CNPJ</label>
            </div>

            <div class="box-user">
                <input type="text" name="email">
                <label>E-mail</label>
            </div>

            <div class="box-user">
                <input type="password" name="senha">
                <label>Senha</label>
            </div>
        <div>
            <a href="login.php" class="cadastro">Já possui cadastro ?</a>
            <a href="index.php"><span class="material-symbols-outlined">home</a></span>
        </div>
        <input type="submit" name="cadinstituicao" class="botao">
    </form>
    </body>
</html>