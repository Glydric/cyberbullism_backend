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

$query = $conn->prepare("INSERT INTO messaggio(user_email, testo, gravita) VALUES(?, ?, ?)");
$query->bind_param("ssi", $email, $testo, $gravita);
$query->execute();

if (!$query->get_result()) 
  die($conn->error);

$query->close();
$result->close();
$conn->close();