const WebSocketServer = require("ws")//.Server
// const http = require('http');

const user = require("./userWS")
const psyco = require("./psycoWS")

// var webServer = http.createServer();
// webServer.listen(80);


const psycoServer = new WebSocketServer.Server({
    port: 80,
    // server: webServer,
    path: "/psyco"
});

const userServer = new WebSocketServer.Server({
    port: 81,
    // server: webServer,
    path: "/user"
});

// userServer.on('request', user.userServerConnection)
userServer.on('connection', user.userServerConnection)
psycoServer.on('connection', psyco.psycoServerConnection)