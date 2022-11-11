<?php
require('config.php');
// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

checkExists("psyco", $conn, $email, $password);

// get users
$psyco_query = "SELECT
    user_email AS otherEmail,
    nome,
    cognome,
    testo,
    data,
    send_by_user,
    gravita
FROM
    messaggio
JOIN utente ON user_email = email
WHERE
    data IN(
    SELECT
        MAX(data)
    FROM
        messaggio
    GROUP BY
        psyco_email
    )
    AND
      psyco_email = '$email'
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
