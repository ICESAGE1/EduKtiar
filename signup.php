<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Check if the username already exists
  $sql = "SELECT * FROM users WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo "Username already exists";
  } else {
    // Insert new user into the database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
      echo "User created successfully";
    } else {
      echo "Error creating user";
    }
  }

  $stmt->close();
}

$conn->close();
?>
