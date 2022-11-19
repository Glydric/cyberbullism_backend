<?php
require('config.php');

$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");

$query = $conn->prepare("SELECT * FROM psyco where email=? and password=?");
$query->bind_param("ss", $email, $_POST['password']);
$query->execute();

$result = $query->get_result();

if($result->num_rows == 0)
    die("user-not-found");

if(!$result)
    die($conn->error);

echo json_encode($result->fetch_assoc());

$query->close();
$result->close();
$conn->close();
