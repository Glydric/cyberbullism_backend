<?php
require('config.php');
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

// controlli generici di input
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");

if (!$password)
  die("empty-password");

// controlla che l'utente con quella email non esista già
$result = mysqli_query($conn, "SELECT * FROM utente WHERE email='$email'");
if (!$result)
  die(mysqli_error($conn));

if (mysqli_num_rows($result) != 0)
  die("email-already-in-use");

echo mysqli_num_rows($result);
$query = $conn->prepare("INSERT INTO utente(email,nome,cognome,password) VALUES(?, ?, ?, ?)");
$query->bind_param("ssss", $email, $_POST['nome'], $_POST['cognome'], $password);
$query->execute();

// inserisce l'utente in quanto non sono stati trovati problemi
if (!$query->get_result())
  die($conn->error);

$query->close();
$result->close();
$conn->close();
