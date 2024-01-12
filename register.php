<?php 
    include("db/connect.php");

    if (isset($_POST['submit'])) {
        $nome = $_POST['nome'];
        $nome = filter_var($nome, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $passwor =  sha1($_POST['passwor']); 
        $passwor = filter_var($passwor, FILTER_SANITIZE_STRING);

        $cpassword =  sha1($_POST['cpassword']);
        $cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);

        $sql=$conn->prepare("SELECT * FROM `usuario` WHERE email =?");
        $sql->execute([$email]);


        if($sql->rowCount() > 0){
            $message[] = 'O email ja existe!';
        }elseif($passwor != $cpassword){
            $message[] = 'Confirmacao de password incorreta!';
        }else{
            $inserir_usuario = $conn->prepare("INSERT INTO `usuario`(nome, email, password) VALUES(?,?,?)");
            $inserir_usuario->execute([$nome, $email, $cpassword]);

            if($inserir_usuario){
                $fetch_usuario = $conn->prepare("SELECT * FROM `usuario` WHERE email = ? AND password = ?");
                $fetch_usuario->execute([$email, $cpassword]);
                $row = $fetch_usuario->fetch(PDO::FETCH_ASSOC);
                if($fetch_usuario->rowCount() > 0){
                    setcookie('user_id', $row['id'], time() + 60*60*24, '/');
                    header('location:home.php');
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="box">
            <?php

                if (isset($message)) {
                    foreach($message as $message){
                        echo  '
                        <div class="message">
                        <span>$message</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                    </div>
                        ';
                    }
                }
            ?>

            <div class="square" style="--i:0;"></div>
            <div class="square" style="--i:1;"></div>
            <div class="square" style="--i:2;"></div>
            <div class="square" style="--i:3;"></div>
            <div class="square" style="--i:4;"></div>
            <div class="square" style="--i:5;"></div>

            <div class="container">
                <div class="form">
                    <h2>Register now</h2>
                    <form action="" method="post">
                        <div class="input">
                            <label for="">Nome</label>
                            <input type="text" name="nome" maxlength="50" required>
                        </div>

                        <div class="input">
                            <label for="">Email</label>
                            <input type="email" name="email" maxlength="50" required>
                        </div>

                        <div class="input">
                            <label for="">Password</label>
                            <input type="password" name="passwor" maxlength="15" required>
                        </div>

                        <div class="input">
                            <label for="">Confirmar Password</label>
                            <input type="password" name="cpassword" maxlength="15" required>
                        </div>

                        <input type="submit" name="submit" value="Enviar" class="btn">
                    </form>
                    <p>Ja tem uma conta? <a href="login.php">Login Agora</a></p>
                </div>
            </div>

        </div>
    </section>
</body>
</html>