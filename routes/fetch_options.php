<?php
header('Content-Type: application/json');
$servername = 'your_server_host';
$username = 'your_username';
$password = 'your_password';
$dbname = 'testdb';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM options ORDER BY name ASC";
$result = $conn->query($sql);

$options = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options[] = $row['name'];
    }
}

echo json_encode($options);
$conn->close();
?>
