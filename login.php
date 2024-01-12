<?php 
    include("db/connect.php");

    if (isset($_POST['submit'])) {
    
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $passwor =  sha1($_POST['passwor']); 
        $passwor = filter_var($passwor, FILTER_SANITIZE_STRING);

        $sql=$conn->prepare("SELECT * FROM `usuario` WHERE email =? AND password = ?");
        $sql->execute([$email, $passwor]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);


        if($sql->rowCount() > 0){
            setcookie('user_id', $row['id'], time() + 60*60*24, '/');
            header("location:home.php");
        }else{
            $message[] = 'Email ou Password incorreto!';
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
                            <label for="">Email</label>
                            <input type="email" name="email" maxlength="50" required>
                        </div>

                        <div class="input">
                            <label for="">Password</label>
                            <input type="password" name="passwor" maxlength="15" required>
                        </div>

                        <p><a href="recuperar.php">Esqueceu a senha?</a></p>

                        <input type="submit" name="submit" value="Enviar" class="btn">
                    </form>
                    <p>Nao tem uma conta? <a href="register.php">Registrar</a></p>
                </div>
            </div>

        </div>
    </section>
</body>
</html>