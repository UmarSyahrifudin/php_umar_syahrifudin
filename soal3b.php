<?php
$host = 'localhost';
$db = 'testdb';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = isset($_POST['name']) ? $_POST['name'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';

$query = "SELECT p.nama AS name, p.alamat AS address, GROUP_CONCAT(h.hobi SEPARATOR ', ') AS hobbies 
          FROM person p 
          LEFT JOIN hobi h ON p.id = h.person_id 
          WHERE p.nama LIKE ? AND p.alamat LIKE ?
          GROUP BY p.id";

$stmt = $conn->prepare($query);
$searchName = "%" . $name . "%";
$searchAddress = "%" . $address . "%";
$stmt->bind_param('ss', $searchName, $searchAddress);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Result</title>
</head>
<body>
    <h2>Hasil Pencarian</h2>
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
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
