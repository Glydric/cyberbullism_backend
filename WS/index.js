const ws = require("ws")

const dbUrl = 'ws://http://leonardomigliorelli.altervista.org'

const server = new WebSocket.server({
    port: 8080
});

let sockets = []