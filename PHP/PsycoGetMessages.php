<?php
require('config.php');
// get user
$email = $_POST['email'];
$password = $_POST['password'];
$otherEmail = $_POST['otherEmail'];

checkExists("psyco", $conn, $email, $password);

// get chats
$query = $conn->prepare( "SELECT
  user_email AS otherEmail,
  nome,
  cognome,
  testo,
  data,
  gravita,
  CASE WHEN send_by_user = 0 THEN 1 WHEN send_by_user = 1 THEN 0
END AS send_by_user
FROM
    messaggio join utente on user_email=email
WHERE
    psyco_email = ? AND user_email = ?
ORDER BY DATA
DESC
");
$query->bind_param("ss", $email, $otherEmail);
$query->execute();
$result = $query->get_result();

if (!$result)
  die($conn->error);

$rows = array();
while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}

echo json_encode($rows);

$query->close();
$result->close();
$conn->close();
