<?php
require('config.php');
$email = removeSQLDelimitersFrom($_POST['email']);
$newPassword = removeSQLDelimitersFrom($_POST['newPassword']);
$password = removeSQLDelimitersFrom($_POST['password']);

if (!$email) {
  die("empty-email");
}
if (!$password) {
  die("empty-password");
}
if (!$newPassword) {
  die("empty-password");
}
$result = mysqli_query($conn, "select * from utente WHERE email = '$email' and password = '$password'");

if (!$result) {
  echo (mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
  if (!mysqli_query($conn, "UPDATE utente set password = '$newPassword' WHERE email = '$email' and password = '$password'")) {
    echo (mysqli_error($conn));
  }
} else {
  die("wrong-password");
}
mysqli_free_result($result);
mysqli_close($conn);
