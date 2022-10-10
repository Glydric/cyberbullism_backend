<?php
require('config.php');

// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  die("invalid-email");
checkExists("psyco", $conn, $email, $password);

// query segnalazioni
// $query = "select s.email, nome, cognome, testo, gravita, data from segnalazione s join utente u on u.email=s.email";
$query =
  "SELECT
    user_email,
    nome,
    cognome,
    testo,
    gravita,
    data
FROM
    messaggio
JOIN utente ON user_email = email
WHERE
    psyco_email IS NULL
    AND gravita IS NOT NULL
    AND send_by_user = 0
ORDER BY
    gravita
DESC
    ";

$result = mysqli_query($conn, $query);
if (!$result) {
  echo (mysqli_error($conn));
}

$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}

echo json_encode($rows);

mysqli_free_result($result);
mysqli_close($conn);
