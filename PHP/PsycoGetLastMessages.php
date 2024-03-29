<?php
require('config.php');
// get user
$email = $_POST['email'];

checkExists("psyco", $conn, $email, $_POST['password']);

// get users
$query = $conn->prepare(
"SELECT
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
      psyco_email = ?
");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if(!$result)
    die($conn->error);

$rows = array();

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode($rows);

$query->close();
$result->close();
$conn->close();
