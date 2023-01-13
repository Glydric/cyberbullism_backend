<?php
require('config.php');
$email = $_POST['email'];
$newPassword = $_POST['newPassword'];
$password = $_POST['password'];

if (!$email) {
  die("empty-email");
}
if (!$password || !$newPassword) {
  die("empty-password");
}
checkExists("psyco", $conn, $email, $password);

$query = $conn->prepare("UPDATE psyco SET password = ? WHERE email = ? AND password = ?");
$query->bind_param("sss", $newPassword,$email,$password);
$query->execute();

if (!$query->get_result()) {
  die($conn->error);
}

$result->close();
$conn->close();
