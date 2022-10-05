<?php
require('config.php');
// get user
$email = removeSQLDelimitersFrom($_GET['email']);
$password = removeSQLDelimitersFrom($_GET['password']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");

$result = mysqli_query($conn, "select * from psyco where email='$email' and password='$password'");
if (!$result) {
  echo (mysqli_error($conn));
}
if (mysqli_num_rows($result) == 0) {
  die("user-not-found");
}

// send message
$testo = removeSQLDelimitersFrom($_GET['testo']);
$otherEmail = removeSQLDelimitersFrom($_GET['otherEmail']);

if (!mysqli_query($conn, "insert into messaggio(psyco_email, user_email, testo, sender) values('$email','$otherEmail', '$testo', 1)")) {
  echo (mysqli_error($conn));
}
mysqli_close($conn);
