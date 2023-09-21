    <?php
          require_once('../php/bd.php');
    ?>
  
           <h2>Клиенты</h2>
          
                <table border="1">
                    <tr>
                        <th>№</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Почта</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM Clients";
                        $result = mysqli_query($conn, $query);
                        $FirstName = mysqli_query($conn, "SELECT * FROM Clients" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr>";
                            echo "<td>" .  $supplier['ClientID'] . "</td>";
                            echo "<td>" .  $supplier['FirstName'] . "</td>";
                            echo "<td>" .  $supplier['LastName'] . "</td>";
                            echo "<td>" .  $supplier['ContactInfo'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['ClientID']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['ClientID']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['FirstName']) and !empty($_POST['LastName']) and !empty($_POST['ContactInfo']) )){
        $FirstName=$_POST['FirstName'];
        $LastName=$_POST['LastName'];
        $ContactInfo=$_POST['ContactInfo'];
       
        mysqli_query($conn, "INSERT INTO `Clients` (`ClientID`, `FirstName`, `LastName`, `ContactInfo`) VALUES (NULL, '$FirstName', '$LastName', '$ContactInfo')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Имя</p>
            <input  type="text" name="FirstName">
            <p>Фамилия</p>
            <input  type="text" name="LastName">
            <p>Почта</p>
            <input  type="text" name="ContactInfo"><br><br>
            <input type="submit" name="submit" value="Добавить">
        </form>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Clients where ClientID={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $FirstName = mysqli_query($conn, "SELECT * FROM Clients" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                   
                            <h2>Изменить данные</h2>
                            <p>Имя</p>
                            <input type='text' required name='FirstName' value='{$supplier['FirstName']}'/>
                            <p>Фамилия</p>
                            <input type='text' required name='LastName' value='{$supplier['LastName']}'/>
                            <p>Почта</p>
                            <input type='text' required name='ContactInfo' value='{$supplier['ContactInfo']}'/>
                         <br>";
                    }
                echo '<input  type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $FirstName=$_POST['FirstName'];
                    $LastName=$_POST['LastName'];
                    $ContactInfo=$_POST['ContactInfo'];
                    mysqli_query($conn, "UPDATE `Clients` SET `FirstName` = '$FirstName', `LastName` = '$LastName',  `ContactInfo` = '$ContactInfo' where ClientID = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Clients WHERE ClientID = {$_GET['del_id']}");        
                }   
            ?>
