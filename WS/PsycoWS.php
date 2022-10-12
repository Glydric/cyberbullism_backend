<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Socket;

require('PsycoWS.php');

// get user
$email = removeSQLDelimitersFrom($_POST['email']);
$password = removeSQLDelimitersFrom($_POST['password']);
$otherEmail = removeSQLDelimitersFrom($_POST['otherEmail']);

checkExists("psyco", $conn, $email, $password);

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new MySocket()
        )
    ),
    80
);

$server->run();