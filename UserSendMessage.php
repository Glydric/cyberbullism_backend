<?php
require('config.php');
// get user
$email = removeSQLDelimitersFrom($_GET['email']);
$password = removeSQLDelimitersFrom($_GET['password']);

checkExists("utente", $conn, $email, $password);

//send message
$testo = removeSQLDelimitersFrom($_GET['testo']);
$otherEmail = removeSQLDelimitersFrom($_GET['otherEmail']);

if (!mysqli_query($conn, "insert into messaggio(user_email, psyco_email, testo, sender) values('$email','$otherEmail', '$testo', 0)")) {
  echo (mysqli_error($conn));
}
mysqli_close($conn);
