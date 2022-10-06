<?php
$host = "database.cjjeevkacoc3.eu-south-1.rds.amazonaws.com";
$database = "cyberbullism";
$username = "admin";
$password = "AdminDB02"; //"CyberDb2022?";
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

  $query = "select * from $tab where email='$email' and password='$password'";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    echo (mysqli_error($conn));
  }
  if (mysqli_num_rows($result) == 0) {
    die("user-not-found");
  }
  mysqli_free_result($result);
}
