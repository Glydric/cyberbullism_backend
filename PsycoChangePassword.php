<?php
require('config.php');
$email = removeSQLDelimitersFrom($_GET['email']);
$newPassword = removeSQLDelimitersFrom($_GET['newPassword']);
$password = removeSQLDelimitersFrom($_GET['password']);

if (!$email) {
  die("empty-email");
}
if (!$password) {
  die("empty-password");
}
if (!$newPassword) {
  die("empty-password");
}
$result = mysqli_query($conn, "select * from psyco WHERE email = '$email' and password = '$password'");

if (!$result) {
  echo (mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
  if (!mysqli_query($conn, "UPDATE psyco set password = '$newPassword' WHERE email = '$email' and password = '$password'")) {
    echo (mysqli_error($conn));
  }
} else {
  die("wrong-password");
}
mysqli_free_result($result);
mysqli_close($conn);
