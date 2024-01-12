<?php 
    include("db/connect.php");

    setcookie('user_id', '', time() -1, '/');

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
                <div class="content">
                    <div class="box">
                        <h3>Logout efetuado</h3>
                        <div class="flex_btn">
                            <a href="login.php" class="btn">Login</a>
                            <a href="register.php" class="btn">Register</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</body>
</html>