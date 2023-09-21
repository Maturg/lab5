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
 <link rel='stylesheet' href='../css/style.css'> 

<section class="sql-zaprosi-section">

<div class="sql-zaprosi">
<h2>SQL - Запросы</h2>
<p>1. Получить список всех моделей с определенными физическими параметрами (рост, вес, цвет волос и т.д.).</p>

<?php
require_once('../php/bd.php');
$sql = "SELECT * FROM Models WHERE Height = 170 AND Weight = 55 AND HairColor = 'Блонд';";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table border='1'><tr><th>ModelID</th><th>FirstName</th><th>LastName</th><th>Height</th><th>Weight</th><th>HairColor</th><th>Age</th><th>Gender</th><th>Experience</th><th>Skills</th><th>ContractDate</th></tr>";
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["ModelID"]. "</td><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td><td>" . $row["Height"]. "</td><td>" . $row["Weight"]. "</td><td>" . $row["HairColor"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Gender"]. "</td><td>" . $row["Experience"]. "</td><td>" . $row["Skills"]. "</td><td>" . $row["ContractDate"]. "</td></tr>";
}
echo "</table>";
} else {
echo "0 результатов";
}
?>
<br><br>
<p>2. Получить список моделей по определенному полу и возрасту</p>

<?php
$query = "SELECT * FROM Models WHERE Gender = 'Женский' AND Age > 25;";
$results = mysqli_query($conn, $query);
echo "<table border='1'><tr><th>ModelID</th><th>FirstName</th><th>LastName</th><th>Height</th><th>Weight</th><th>HairColor</th><th>Age</th><th>Gender</th><th>Experience</th><th>Skills</th><th>ContractDate</th></tr>";
if ($results) {
while ($row = mysqli_fetch_assoc($results)) {
  echo "<tr><td>" . $row["ModelID"]. "</td><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td><td>" . $row["Height"]. "</td><td>" . $row["Weight"]. "</td><td>" . $row["HairColor"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Gender"]. "</td><td>" . $row["Experience"]. "</td><td>" . $row["Skills"]. "</td><td>" . $row["ContractDate"]. "</td></tr>";
}
echo '</table>';
}
?>

<br><br>
<p>3. Получить список всех клиентов, сотрудничающих с модельным агентством</p>

<?php

$query = "SELECT * FROM Clients;";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'><tr><th>ClientID</th><th>FirstName</th><th>LastName</th><th>ContactInfo</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["ClientID"]."</td><td>".$row["FirstName"]."</td><td>".$row["LastName"]."</td><td>".$row["ContactInfo"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 результатов";
}

?>
<br><br>
<p>4. Получить список всех фотосессий, проведенных с участием определенной модели</p>
<?php

$sql = "SELECT Photoshoots.PhotoshootID, Photoshoots.PhotoshootDate
FROM Photoshoots
INNER JOIN Models ON Photoshoots.ModelID = Models.ModelID
WHERE Models.FirstName = 'Анна' AND Models.LastName = 'Иванова';";
echo "
<table border='1'>
    <tr>
        <th>PhotoshootID</th>
        <th>PhotoshootDate</th>
    </tr>";
echo "";
foreach ($conn->query($sql) as $row) {
  echo "<tr>";
  echo "<td>" . $row['PhotoshootID'] . "</td>";
  echo "<td>" . $row['PhotoshootDate'] . "</td>";
  echo "</tr>";
}
echo "</table>";

?>
<br><br>
<p>5. Получить список всех моделей, у которых определенные навыки (например, каталог или показ мод)</p>

<?php

$sql = "SELECT * FROM Models WHERE Skills LIKE '%каталог%' OR Skills LIKE '%показ мод%';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border='1'><tr><th>ModelID</th><th>FirstName</th><th>LastName</th><th>Height</th><th>Weight</th><th>HairColor</th><th>Age</th><th>Gender</th><th>Experience</th><th>Skills</th><th>ContractDate</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["ModelID"]. "</td><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td><td>" . $row["Height"]. "</td><td>" . $row["Weight"]. "</td><td>" . $row["HairColor"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Gender"]. "</td><td>" . $row["Experience"]. "</td><td>" . $row["Skills"]. "</td><td>" . $row["ContractDate"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
?>

<br><br>
<p>6. Получить список общего количества моделей в каждой категории</p>

<?php

$sql = "SELECT Experience, COUNT(*) AS TotalModels FROM Models GROUP BY Experience;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border='1'><tr><th>Experience</th><th>TotalModels</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["Experience"]."</td><td>".$row["TotalModels"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

?>
<br><br>
<p>7. Получить список всех моделей, сотрудничающих с определенным клиентом</p>

<?php

$sql = "SELECT Models.FirstName, Models.LastName
FROM Models
INNER JOIN ModelClient ON Models.ModelID = ModelClient.ModelID
INNER JOIN Clients ON ModelClient.ClientID = Clients.ClientID
WHERE Clients.FirstName = 'Елена' AND Clients.LastName = 'Козлова';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border='1'><tr><th>FirstName</th><th>LastName</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

?>
<br><br>

<p>8. Получить список всех моделей, у которых определенный уровень опыта (новичок, опытный и т.д.)</p>

<?php

$sql = "SELECT * FROM Models WHERE Experience = 'Опытный';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border='1'><tr><th>ModelID</th><th>FirstName</th><th>LastName</th><th>Height</th><th>Weight</th><th>HairColor</th><th>Age</th><th>Gender</th><th>Experience</th><th>Skills</th><th>ContractDate</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["ModelID"]. "</td><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td><td>" . $row["Height"]. "</td><td>" . $row["Weight"]. "</td><td>" . $row["HairColor"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Gender"]. "</td><td>" . $row["Experience"]. "</td><td>" . $row["Skills"]. "</td><td>" . $row["ContractDate"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

?>

<br><br>
<p>9. Получить список всех фотосъёмок, связанных с определенной моделью</p>

<?php

    $sql = "SELECT Photoshoots.PhotoshootID, Photoshoots.PhotoshootDate
    FROM Photoshoots
    INNER JOIN Models ON Photoshoots.ModelID = Models.ModelID
    WHERE Models.FirstName = 'Мария' AND Models.LastName = 'Смирнова';";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      echo "<table border='1'><tr><th>PhotoshootID</th><th>PhotoshootDate</th></tr>";
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["PhotoshootID"]."</td><td>".$row["PhotoshootDate"]."</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }

?>
<br><br>

<p>10. Получить список всех моделей, у которых активен контракт на определенную дату</p>

<?php

$sql = "SELECT * FROM Models WHERE ContractDate = '2021-10-30';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border='1'><tr><th>ModelID</th><th>FirstName</th><th>LastName</th><th>Height</th><th>Weight</th><th>HairColor</th><th>Age</th><th>Gender</th><th>Experience</th><th>Skills</th><th>ContractDate</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["ModelID"]. "</td><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td><td>" . $row["Height"]. "</td><td>" . $row["Weight"]. "</td><td>" . $row["HairColor"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Gender"]. "</td><td>" . $row["Experience"]. "</td><td>" . $row["Skills"]. "</td><td>" . $row["ContractDate"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

?>