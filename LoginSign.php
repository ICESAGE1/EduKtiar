<?php
// db_connection.php
$servername = "localhost";
$username = "root";
$password = "Prawin123##";
$dbname = "g";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// login.php

include 'db_connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo json_encode(array('message' => 'Login successful'));
    } else {
        echo json_encode(array('message' => 'Invalid password'));
    }
} else {
    echo json_encode(array('message' => 'User not found'));
}

$conn->close();
?>

<?php
// signup.php

include 'db_connection.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(array('message' => 'Username already exists'));
} else {
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'User created successfully'));
    } else {
        echo json_encode(array('message' => 'Error creating user'));
    }
}

$conn->close();
?>
