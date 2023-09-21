<?php
          require_once('../php/bd.php');
    ?>
  
           <h2>Заказы</h2>
          
                <table border="1"> 
                    <tr>
                        <th>№</th>
                        <th>Модель</th>
                        <th>Дата</th>
                    </tr>

                    <?php  
                        $query = "SELECT * FROM Photoshoots";
                        $result = mysqli_query($conn, $query);
                        $FirstName = mysqli_query($conn, "SELECT * FROM Photoshoots" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr>";
                            echo "<td>" .  $supplier['PhotoshootID'] . "</td>";
                            echo "<td>" .  $supplier['ModelID'] . "</td>";
                            echo "<td>" .  $supplier['PhotoshootDate'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['PhotoshootID']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['PhotoshootID']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['ModelID']) and !empty($_POST['PhotoshootDate']) )){
        $ModelID=$_POST['ModelID'];
        $PhotoshootDate=$_POST['PhotoshootDate'];
       
        mysqli_query($conn, "INSERT INTO `Photoshoots` (`PhotoshootID`,`ModelID`, `PhotoshootDate`) VALUES (NULL, '$ModelID', '$PhotoshootDate')");
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
            <p>Дата</p>
            <input  type="date" name="PhotoshootDate">
           
            <input type="submit" name="submit" value="Добавить">
        </form>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Photoshoots where PhotoshootID={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $FirstName = mysqli_query($conn, "SELECT * FROM Photoshoots" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                            <h2>Изменить данные</h2>
                            <p>Модель ID</p>
                            <input type='text' required name='ModelID' value='{$supplier['ModelID']}'/>
                            <p>Дата</p>
                            <input type='date' required name='PhotoshootDate' value='{$supplier['PhotoshootDate']}'/>
                           
                       <br>";
                    }
                echo '<input  type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $ModelID=$_POST['ModelID'];
                    $PhotoshootDate=$_POST['PhotoshootDate'];
                    
                    mysqli_query($conn, "UPDATE `Photoshoots` SET `ModelID` = '$ModelID', `PhotoshootDate` = '$PhotoshootDate' where PhotoshootID = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Photoshoots WHERE PhotoshootID = {$_GET['del_id']}");        
                }   
            ?>
