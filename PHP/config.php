<?php
$host = "localhost";
$database = "cyberbullism";
$username = "cyber"; #"admin";
$password = "";
$conn = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno())
  die("Connection failed: " . mysqli_connect_error());

// Function to remove the spacial
function removeSQLDelimitersFrom($string)
{
  // Viene usato preg_replace() per rimuovere i caratteri
  return preg_replace('/[\'";]+/s', ' ', $string);
};
function checkExists($tab, $conn, $email, $password)
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    die("invalid-email");

  $query = $conn->prepare("SELECT * FROM $tab WHERE email=? AND password=?");
  $query->bind_param("ss", $email, $password);
  $query->execute();

  $result = $query->get_result();

  if (!$result) 
    echo $conn->error;
  
  if ($result->num_rows == 0)
    die("user-not-found");
  
  $query->close();
  $result->close();
}
