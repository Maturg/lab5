<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>MATURG</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Montserrat:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <header class = "header">
        <div class="leftmenu">
            <a href="index.php" class="maturgzagolovok"><h1>MATURG</h1><br>МОДЕЛЬНОЕ АГЕНТСТВО</a>
            <a href="nabor.php" class="sp">Набор моделей</a>
            <a href="modeli.php" class="sp">Модели</a>
            <a href="onas.php" class="sp">О нас</a>
            <?php 
        session_start();
        error_reporting(0);
        require_once('php/bd.php');
                   if (isset($_SESSION['login_user'] )) {
                    $user_check = $_SESSION['login_user'];
                    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
                    $rows = mysqli_fetch_array($query);
                    $status = $rows['admin'];
                    $id_user = $rows['id_user'];
                    if($status ==1){
                        // header("Location: ../account/admin.php");
                        $admin = '<a href="account/admin.php">Войти</a>';
                    }else{
                        $admin = '<a href="php/account.php">Войти</a>';
                    }
                    echo  $admin;
                }  else{
                    echo '<a href="#" id="myBtn">Войти</a>';
                }
                   ?>

           
        </div>
        <div class="rightmenu">
           <div class="zapisnakasting"> Запись на кастинг<br>
            +7 999 999 99 99
            </div>
            <div class="zapicmenu">
            <a href="nabor.php" class="sp">ЗАПИСАТЬСЯ
            </a></div>
        </div>
          <div class="logoMaturg">
            <img src="/img/logo.png" alt="">
            </div>
    </header>

<!-- auth -->
<div class="modal-container" id="myModal">
        <div class="modal-wrapper">
            <div class="modal">
                <form action="php/login.php" method="POST">
                <label for="email">Email</label><br>
                <input type="text" required name="email"><br>
                <label for="password">Пароль</label><br>
                <input type="password" required name="password"><br>
                <button name="login">Войти</button><br><br>
                <div class="register-auth" id="myBtn2"><p>Зарегистрироваться</p></div>
                </form>
            </div>
        </div>
    </div>
    
    
    <!-- register -->
    <div class="modal-container2" id="myModal2">
        <div class="modal-wrapper2">
            <div class="modal2">
                <form action="php/register.php" method="POST">
                <label for="name">ФИО</label><br>
                <input type="text" required id="name" name="name"><br>
                <label for="tel">Номер телефона</label><br>
                <input type="text" required id="tel" name="number"><br>
                <label for="email">Email</label><br>
                <input type="text" required id="email" name="email"><br>
                <label for="password">Пароль</label><br>
                <input type="password" required id="password" name="password"><br><br>
                <button name="registration">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/register.js"></script>
    <script src="js/auth.js"></script>