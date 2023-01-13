<?php
require('config.php');
// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");

$result = mysqli_query($conn, "select * from psyco where email='$email' and password='$password'");
if (!$result)
  die(mysqli_error($conn));

if (mysqli_num_rows($result) == 0)
  die("user-not-found");


// send message
$testo = removeSQLDelimitersFrom($_POST['testo']);
$otherEmail = removeSQLDelimitersFrom($_POST['otherEmail']);


$query = $conn->prepare("INSERT INTO messaggio(psyco_email, user_email, testo, send_by_user) VALUES(?,?, ?, 1)");
$query->bind_param("sss", $email, $otherEmail, $testo);
$query->execute();

if (!$query->get_result())
  die($conn->error);

$query->close();
$result->close();
$conn->close();