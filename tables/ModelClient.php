<?php
          require_once('../php/bd.php');
    ?>
  
           <h2>Заказы</h2>
          
                <table border="1"> 
                    <tr>
                        <th>№</th>
                        <th>Модель</th>
                        <th>Клиент</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM ModelClient";
                        $result = mysqli_query($conn, $query);
                        $FirstName = mysqli_query($conn, "SELECT * FROM ModelClient" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $supplier['ModelID'] . "</td>";
                            echo "<td>" .  $supplier['ClientID'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['ModelID']) and !empty($_POST['ClientID']) )){
        $ModelID=$_POST['ModelID'];
        $ClientID=$_POST['ClientID'];
       
        mysqli_query($conn, "INSERT INTO `ModelClient` (`id`,`ModelID`, `ClientID`) VALUES (NULL, '$ModelID', '$ClientID')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Модель ID</p>
            <input  type="text" name="ModelID">
            <p>Клиент ID</p>
            <input  type="text" name="ClientID">
           
            <input type="submit" name="submit" value="Добавить">
        </form>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM ModelClient where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $FirstName = mysqli_query($conn, "SELECT * FROM ModelClient" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                            <h2>Изменить данные</h2>
                            <p>Модель ID</p>
                            <input type='text' required name='ModelID' value='{$supplier['ModelID']}'/>
                            <p>Клиент ID</p>
                            <input type='text' required name='ClientID' value='{$supplier['ClientID']}'/>
                           
                       <br>";
                    }
                echo '<input  type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $ModelID=$_POST['ModelID'];
                    $ClientID=$_POST['ClientID'];
                    
                    mysqli_query($conn, "UPDATE `ModelClient` SET `ModelID` = '$ModelID', `ClientID` = '$ClientID' where id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM ModelClient WHERE id = {$_GET['del_id']}");        
                }   
            ?>
