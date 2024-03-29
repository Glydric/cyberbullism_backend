<?php
require('config.php');

// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);
checkExists("utente", $conn, $email, $password);

// get chats
$otherEmail = removeSQLDelimitersFrom($_POST['otherEmail']);
$psyco_query = "SELECT
    psyco_email AS otherEmail,
    testo,
    nome,
    cognome,
    data,
    send_by_user,
    gravita
FROM
    messaggio
JOIN psyco ON psyco_email = email
WHERE
    user_email = '$email' AND psyco_email = '$otherEmail'
ORDER BY DATA
DESC
";
// bind param not needed as using email
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
