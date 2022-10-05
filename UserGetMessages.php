<?php
require('config.php');
// get user
$email = removeSQLDelimitersFrom($_GET['email']);
$password = removeSQLDelimitersFrom($_GET['password']);
checkExists("utente", $conn, $email, $password);
mysqli_free_result($result);


// get chats
$otherEmail = removeSQLDelimitersFrom($_GET['otherEmail']);
$psyco_query = "SELECT
    psyco_email AS otherEmail,
    testo,
    nome,
    cognome,
    data,
    sender,
    gravita
FROM
    messaggio
JOIN psyco ON psyco_email = email
WHERE
    user_email = '$email' AND psyco_email = '$otherEmail'
ORDER BY DATA
DESC
";
$result = mysqli_query($conn, $psyco_query);

if (!$result) {
  die(mysqli_error($conn));
}

$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}

echo json_encode($rows);

mysqli_free_result($result);
mysqli_close($conn);
