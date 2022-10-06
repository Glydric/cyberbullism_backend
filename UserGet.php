<?php
require('config.php');
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");

$result = mysqli_query($conn, "select * from utente where email='$email' and password='$password'");
if (!$result) {
  echo (mysqli_error($conn));
}
if (mysqli_num_rows($result) == 0)
  die("user-not-found");
$row[] = mysqli_fetch_assoc($result);
echo json_encode($row[0]);


mysqli_free_result($result);
mysqli_close($conn);
