<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['username'];

// Check if the user has logged in before
$sql = "SELECT COUNT(*) as login_count FROM logins WHERE username='$user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$login_count = $row['login_count'];

if ($login_count > 0) {
    echo "2nd time user found";
} else {
    // Insert new login record
    $sql = "INSERT INTO logins (username) VALUES ('$user')";
    if ($conn->query($sql) === TRUE) {
        echo "First time login recorded";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
