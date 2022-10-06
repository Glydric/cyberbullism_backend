<?php
require('config.php');
require('GetGravity.php');

// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

checkExists("utente", $conn, $email, $password);

$testo = removeSQLDelimitersFrom($_POST['testo']);
$gravita = removeSQLDelimitersFrom($_POST['gravita']);

if ($gravita == '3')
  $gravita = calcGravity($testo);

$query = "insert into messaggio(user_email, testo, gravita) values('$email', '$testo', $gravita)";
if (!mysqli_query($conn, $query)) {
  echo (mysqli_error($conn));
}
mysqli_close($conn);
