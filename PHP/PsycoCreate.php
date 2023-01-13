<?php
require('config.php');
require('PsycoCheckAlbo.php');
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

//controlli generici di input
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");

if (!$password)
  die("empty-password");

if (!$nome || !$cognome)
  die("empty-user-info");

checkPsyco($nome, $cognome, $email);

// controlla che l'utente con quella email non esista già
$result = mysqli_query($conn, "select * from psyco where email='$email'");

if (!$result) 
  die($conn->error);

if ($result->num_rows != 0)
  die("email-already-in-use");

$query = $conn->prepare("insert into psyco(nome,cognome,email,password) values(?, ?, ?, ?)");
$query->bind_param("ssss",$nome,$cognome,$email,$password);
$query->execute();

// inserisce l'utente in quanto non sono stati trovati problemi
if (!$query->get_result())
  die($conn->error);

$query->close();
$result->close();
$conn->close();