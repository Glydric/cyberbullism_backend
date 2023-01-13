<?php
require('config.php');
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

// controlli generici di input
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");

if (!$password)
  die("empty-password");

// controlla che l'utente non esista già
$result = mysqli_query($conn, "select * from utente where email='$email' and password='$password'");
if (!$result)
  die(mysqli_error($conn));

if (mysqli_num_rows($result) != 0)
  die("email-already-in-use");

$query = $conn->prepare("INSERT INTO utente(email,nome,cognome,password) VALUES(?, ?, ?, ?)");
$query->prepare("ssss", $email, $_POST['nome'], $_POST['cognome'], $password);
$query->execute();

// inserisce l'utente in quanto non sono stati trovati problemi
if (!$query->get_result())
  die($conn->error);

$query->close();
$result->close();
$conn->close();
