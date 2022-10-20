<?php
require('config.php');
// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);

checkExists("utente", $conn, $email, $password);

// get users
$query = "SELECT
    psyco_email AS otherEmail,
    nome,
    cognome,
    testo,
	data,
    send_by_user,
    gravita
FROM
    messaggio
JOIN psyco ON psyco_email = email
WHERE
    psyco_email IS NOT NULL 
    AND DATA IN(
    SELECT
        MAX(data)
    FROM
        messaggio
    GROUP BY
        psyco_email
) AND user_email = '$email'
";
$result = mysqli_query($conn, $query);

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
