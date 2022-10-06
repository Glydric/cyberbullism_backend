<?php
require('config.php');
// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

checkExists("utente", $conn, $email, $password);

//send message
$testo = removeSQLDelimitersFrom($_POST['testo']);
$otherEmail = removeSQLDelimitersFrom($_POST['otherEmail']);

if (!mysqli_query($conn, "insert into messaggio(user_email, psyco_email, testo, sender) values('$email','$otherEmail', '$testo', 0)")) {
  echo (mysqli_error($conn));
}
mysqli_close($conn);
