<?php
require('config.php');
require('GetGravity.php');

// get user
$email = removeSQLDelimitersFrom($_GET['email']);
$password = removeSQLDelimitersFrom($_GET['password']);

checkExists("utente", $conn, $email, $password);

$testo = removeSQLDelimitersFrom($_GET['testo']);
$gravita = removeSQLDelimitersFrom($_GET['gravita']);

if ($gravita == '3')
  $gravita = calcGravity($testo);

$query = "insert into messaggio(user_email, testo, gravita) values('$email', '$testo', $gravita)";
if (!mysqli_query($conn, $query)) {
  echo (mysqli_error($conn));
}
mysqli_close($conn);
