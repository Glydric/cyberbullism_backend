<?php
require('config.php');
// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

checkExists("utente", $conn, $email, $password);

//send message
$testo = removeSQLDelimitersFrom($_POST['testo']);
$otherEmail = removeSQLDelimitersFrom($_POST['otherEmail']);

$query=$conn->prepare("INSERT INTO messaggio(user_email, psyco_email, testo, send_by_user) VALUES(?, ?, ?, 0)");
$query->bind_param("sss", $email, $otherEmail, $testo);
$query->execute();


if (!$query->get_result())
  die($conn->error);

$query->close();
$result->close();
$conn->close();