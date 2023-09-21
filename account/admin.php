<?php

include 'header.php';
require_once('../php/bd.php');

if (isset($_SESSION['login_user'])) {

    $user_check = $_SESSION['login_user'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
    $rows = mysqli_fetch_array($query);
    $surname = $rows['surname'];
    $names = $rows['name'];
    $status = $rows['admin'];
    $number = $rows['number'];
    $email = $rows['email'];
    $date_birth = $rows['date_birth'];

    if($status ==1){
        $admin = 'Администратор';
    }else{
        $admin = 'Покупатель';
    }
} else {
    header('Location index.php');
}
?>
<p><?=$surname;?> <?=$names;?> - <?=$admin;?></p>
<p>Номер телефона: <?=$number;?></p>
<p>Почта: <?=$email;?></p>
<p>Дата рождения: <?=$date_birth;?></p>
                

