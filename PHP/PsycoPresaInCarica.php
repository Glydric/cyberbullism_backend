<?php
require('config.php');
// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    die("invalid-email");

checkExists("psyco", $conn, $email, $password);

// send message
$otherEmail = removeSQLDelimitersFrom($_POST['otherEmail']);
$data = removeSQLDelimitersFrom($_POST['data']);

// $query = "update segnalazione set inCarica='$email' where email='$otherEmail' and data='$data' and inCarica is null";
$query = "UPDATE
    messaggio
SET
    psyco_email = '$email'
WHERE
    user_email = '$otherEmail'
    AND data = '$data'
    AND psyco_email IS NULL";
if (!mysqli_query($conn, $query)) {
    echo (mysqli_error($conn));
}
mysqli_close($conn);
