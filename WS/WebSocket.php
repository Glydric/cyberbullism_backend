<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require('../config.php');

function getChats($conn, $email, $otherEmail)
{
    // get chats
    $psyco_query = "SELECT
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
      psyco_email = '$email' AND user_email = '$otherEmail'
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
};

class MySocket implements MessageComponentInterface {

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {

        // Store the new connection in $this->clients
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        foreach ( $this->clients as $client ) {

            if ( $from->resourceId == $client->resourceId ) {
                continue;
            }

            $client->send( "Client $from->resourceId said $msg" );
        }
    }

    public function onClose(ConnectionInterface $conn) {
        mysqli_close($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo $e;
    }
}

getChats($conn, $email, $otherEmail);
