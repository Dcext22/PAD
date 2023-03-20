<?php 
session_start();
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/autoload.php';

include_once './conexao.php';

if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    header("Location: login.php");
}

$id = $_SESSION['id'];
$email_usuario = $_SESSION['email'];
$nome_usuario = $_SESSION['nome'];
$chave = bin2hex(random_bytes(16));

if($_SESSION['type'] == 'U'){
    $query_usuario = "SELECT id FROM usuarios WHERE id = $id LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->execute();

    if(($result_usuario) and ($result_usuario->rowCount() != 0)) {
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
                            $mail->addAddress($email_usuario, $nome_usuario);

                            //Content
                            $mail->isHTML(true);
                            $mail->Subject = 'Exclusão de Conta';
                            
                            $mail->Body    = "Caro(a) " . $nome_usuario . "<br><br> para excluir a sua conta em nosso site, por favor clique no link a seguir:
                            <br><br> <a href='http://localhost/PAD/apagar-u.php?chave=$chave'>Clique aqui</a>";
                            
                            $mail->AltBody = "Caro(a) " . $nome_usuario . "\n\n para excluir a sua conta em nosso site, por favor clique no link a seguir: 
                            \n\n http://localhost/PAD/apagar-u.php?chave=$chave";
                        
                            $mail->send();
                            echo $_SESSION['msg'] = "<p style='color: green;'>Processo de exclusão iniciando, por favor cheque o seu email !</p>";
                            header("Location: espera.php");;

                        }catch (Exception $e) {
                            echo "cadastro não pôde ser concluído: {$mail->ErrorInfo}";
                        }
    }
}

    if($_SESSION['type'] == 'I'){
        $query_usuario = "SELECT id FROM instituicao WHERE id = $id LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->execute();

        if(($result_usuario) and ($result_usuario->rowCount() != 0)) {
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
                                $mail->addAddress($email_usuario, $nome_usuario);

                                //Content
                                $mail->isHTML(true);
                                $mail->Subject = 'Exclusão de Conta';
                                
                                $mail->Body    = "Caro(a) " . $nome_usuario . "<br><br> para excluir a sua conta em nosso site, por favor clique no link a seguir:
                                <br><br> <a href='http://localhost/PAD/apagar-u.php?chave=$chave'>Clique aqui</a>";
                                
                                $mail->AltBody = "Caro(a) " . $nome_usuario . "\n\n para excluir a sua conta em nosso site, por favor clique no link a seguir: 
                                \n\n http://localhost/PAD/apagar-u.php?chave=$chave";
                            
                                $mail->send();
                                echo $_SESSION['msg'] = "<p style='color: green;'>Processo de exclusão iniciando, por favor cheque o seu email !</p>";
                                header("Location: espera.php");;

                            }catch (Exception $e) {
                                echo "cadastro não pôde ser concluído: {$mail->ErrorInfo}";
                            }
        }
    }
?>