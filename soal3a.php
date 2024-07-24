<?php
$host = 'localhost';
$db = 'testdb';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT p.nama AS name, p.alamat AS address, GROUP_CONCAT(h.hobi SEPARATOR ', ') AS hobbies 
          FROM person p 
          LEFT JOIN hobi h ON p.id = h.person_id 
          GROUP BY p.id";

$result = $conn->query($query);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listing Person dan Hobi</title>
</head>
<body>
    <h2>Daftar Person dan Hobi</h2>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Hobi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                echo "<td>" . htmlspecialchars($row['hobbies']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }
        ?>
    </table>

    <h2>Search</h2>
    <form method="post" action="soal3b.php">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="address">Alamat:</label>
        <input type="text" id="address" name="address"><br><br>
        <input type="submit" value="Search">
    </form>
</body>
</html>
<?php
$conn->close();
?>
