<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert new user into the database
  $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $hashed_password);

  if ($stmt->execute()) {
    // Signup successful
    echo "User created successfully";
  } else {
    // Error creating user
    echo "Error creating user";
  }

  $stmt->close();
}

$conn->close();
?>
