    <?php
          require_once('../php/bd.php');
    ?>
  <h2>Модели</h2>
           
                <table border="1">
                    <tr >
                        <th>№</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Рост</th>
                        <th>Вес</th>
                        <th>Цвет волос</th>
                        <th>Возраст</th>
                        <th>Пол</th>
                        <th>Опыт</th>
                        <th>Умения</th>
                        <th>Дата составления контракта</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM Models";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM Models" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr>";
                            echo "<td>" .  $supplier['ModelID'] . "</td>";
                            echo "<td>" .  $supplier['FirstName'] . "</td>";
                            echo "<td>" .  $supplier['LastName'] . "</td>";
                            echo "<td>" .  $supplier['Height'] . "</td>";
                            echo "<td>" .  $supplier['Weight'] . "</td>";
                            echo "<td>" .  $supplier['HairColor'] . "</td>";
                            echo "<td>" .  $supplier['Age'] . "</td>";
                            echo "<td>" .  $supplier['Gender'] . "</td>";
                            echo "<td>" .  $supplier['Experience'] . "</td>";
                            echo "<td>" .  $supplier['Skills'] . "</td>";
                            echo "<td>" .  $supplier['ContractDate'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['ModelID']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['ModelID']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
        
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['FirstName'])) and !empty($_POST['LastName']) and !empty($_POST['Height']) and !empty($_POST['Weight']) and !empty($_POST['HairColor']) and !empty($_POST['Age'])  and !empty($_POST['Gender'])  and !empty($_POST['Experience'])  and !empty($_POST['Skills'])  and !empty($_POST['ContractDate'])){
        $FirstName=$_POST['FirstName'];
        $LastName=$_POST['LastName'];
        $Weight=$_POST['Weight'];
        $HairColor=$_POST['HairColor'];
        $Age=$_POST['Age'];
        $Gender=$_POST['Gender'];
        $Experience=$_POST['Experience'];
        $Skills=$_POST['Skills'];
        $ContractDate=$_POST['ContractDate'];
        mysqli_query($conn, "INSERT INTO `Models` (`ModelID`, `FirstName`,  `LastName`, `Height`, `Weight`, `HairColor`,`Age`, `Gender`,`Experience`,`Skills`,`ContractDate`) VALUES (NULL, '$FirstName', '$LastName','$Weight','$HairColor', '$Age', '$Gender','$Experience','$Skills','$ContractDate')");
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
            <p>Рост</p>
            <input type="text"  name="Height">
            <p>Вес</p>
            <input type="text"  name="Weight"> 
            <p>Цвет волос</p>
            <input type="text"  name="HairColor">
            <p>Возраст</p>
            <input type="text"  name="Age"> 
            <p>Пол</p>
            <input type="text"  name="Gender">
            <p>Опыт</p>
            <input type="text"  name="Experience">
            <p>Умения</p>
            <input type="text"  name="Skills">
            <p>Дата составления контракта</p>
            <input type="date"  name="ContractDate"> <br> <br>
            <input type="submit" name="submit" value="Добавить">
        </form>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Models where ModelID={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM Models" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Имя</p>
                            <input type='text' required name='FirstName' value='{$supplier['FirstName']}'/>
                            <p>Фамилия</p>
                            <input  type='text' required name='LastName' value='{$supplier['LastName']}'/>
                            <p>Рост</p>
                            <input  type='text' required name='Height' value='{$supplier['Height']}'/>
                            <p>Вес</p>
                            <input  type='text' required name='Weight' value='{$supplier['Weight']}'/>
                            <p>Цвет волос</p>
                            <input  type='text' required name='HairColor' value='{$supplier['HairColor']}'/>
                            <p>Возраст</p>
                            <input  type='text' required name='Age' value='{$supplier['Age']}'/>
                            <p>Пол</p>
                            <input  type='text' required name='Gender' value='{$supplier['Gender']}'/>
                            <p>Опыт</p>
                            <input  type='text' required name='Experience' value='{$supplier['Experience']}'/>
                            <p>Умения</p>
                            <input  type='text' required name='Skills' value='{$supplier['Skills']}'/>
                            <p>Дата составления контракта</p>
                            <input  type='text' required name='ContractDate' value='{$supplier['ContractDate']}'/>
                        ";
                    }
                echo '<br><br><input type="submit" name="update" value="Изменить">';
                echo'</form>
                </div>';
                
                if (!empty($_POST['update'])){
                    $FirstName=$_POST['FirstName'];
                    $LastName=$_POST['LastName'];
                    $Height=$_POST['Height'];
                    $Weight=$_POST['Weight'];
                    $HairColor=$_POST['HairColor'];
                    $Age=$_POST['Age'];
                    $Gender=$_POST['Gender'];
                    $Experience=$_POST['Experience'];
                    $Skills=$_POST['Skills'];
                    $ContractDate=$_POST['ContractDate'];
                    mysqli_query($conn, "UPDATE `models` SET `FirstName` = '$FirstName', `LastName` = '$LastName', `Height` = '$Height',  `Weight` = '$Weight', `HairColor` = '$HairColor', `Age` = '$Age', `Gender` = '$Gender', `Experience` = '$Experience', `Skills` = '$Skills', `ContractDate` = '$ContractDate' where ModelID = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Models WHERE ModelID = {$_GET['del_id']}");        
                }   
            ?>