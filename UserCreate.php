<?php
require('config.php');
$email = removeSQLDelimitersFrom($_GET['email']);
$nome = removeSQLDelimitersFrom($_GET['nome']);
$cognome = removeSQLDelimitersFrom($_GET['cognome']);
$password = removeSQLDelimitersFrom($_GET['password']);

// controlli generici di input
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");

if (!$password)
  die("empty-password");

// controlla che l'utente non esista già
$result = mysqli_query($conn, "select * from utente where email='$email' and password='$password'");
if (!$result) {
  echo (mysqli_error($conn));
}
if (mysqli_num_rows($result) != 0)
  die("email-already-in-use");

// inserisce l'utente in quanto non sono stati trovati problemi
if (!mysqli_query($conn, "insert into utente(email,nome,cognome,password) values('$email', '$nome', '$cognome', '$password')")) {
  echo (mysqli_error($conn));
}
mysqli_close($conn);
