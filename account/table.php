<?php

include 'header.php';
require_once('../php/bd.php');

if (isset($_SESSION['login_user'])) {

    $user_check = $_SESSION['login_user'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
    $rows = mysqli_fetch_array($query);
    $names = $rows['name'];
    $status = $rows['admin'];

} else {
    header('Location index.php');
}
?>
                <nav > 
                    <ul> 
                      <?php
                      $conn = mysqli_connect("localhost", "root", "", "modelagency");
                      $sql = "SHOW FULL TABLES FROM modelagency WHERE TABLE_TYPE != 'VIEW';";
                      $result = mysqli_query($conn, $sql);
                    
                      // output database names
                      if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                          if($row['Tables_in_modelagency'] == 'clients'){
                            $tables = 'Клиенты';
                            $href = 'Clients.php';
                          }if($row['Tables_in_modelagency'] == 'modelclient'){
                            $tables = 'Заказы';
                            $href = 'ModelClient.php';
                          }if(($row['Tables_in_modelagency'] == 'models')){
                            $tables = 'Модели';
                            $href = 'Models.php';
                          }if($row['Tables_in_modelagency'] == 'photoshoots'){
                            $tables = 'Фото';
                            $href = 'Photoshoots.php';
                          }if($row['Tables_in_modelagency'] == 'users'){
                            $tables = 'Админы';
                            $href = 'users.php';
                          }
                          echo '<li><a href="../tables/'.$href.'" class="">'.$tables ."</a></li><br>";
                        }
                      }

                      ?>
                     
                        
                    </ul>
                </nav>
    