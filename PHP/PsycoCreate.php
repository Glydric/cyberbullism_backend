<?php
require('config.php');
require('PsycoCheckAlbo.php');
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$password = $_POST['password'];

//controlli generici di input
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");

if (!$password)
  die("empty-password");

if (!$nome || !$cognome)
  die("empty-user-info");

// innanzitutto controlla che l'utente non esista già
$query = $conn->prepare("select * from psyco where email= ? and password= ?");
$query->bind_param("ss",$email,$password);
$query->execute();
$result=$query->get_result();

if (!$result) 
  die($conn->error);

if ($result->num_rows != 0)
  die("email-already-in-use");
$query->close();
$result->close();

$query = $conn->prepare("insert into psyco(nome,cognome,email,password) values(?, ?, ?, ?)");
$query->bind_param("ssss",$nome,$cognome,$email,$password);
$query->execute();

// Se l'utente non è già presente controlliamo i suoi dati
// checkPsyco($nome, $cognome, $email);

// inserisce l'utente in quanto non sono stati trovati problemi
if (!$query->get_result()) {
  die($conn->error);
}
$query->close();
$result->close();
$conn->close();