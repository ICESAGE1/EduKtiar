<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if the user exists
  $sql = "SELECT * FROM users WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify the password
    if (password_verify($password, $row['password'])) {
      echo "Login successful";
      // Redirect to the dashboard or set session variables here
      // header("Location: dashboard.php");
      // exit();
    } else {
      echo "Invalid password";
    }
  } else {
    echo "User not found";
  }

  $stmt->close();
}

$conn->close();
?>
