const WebSocketServer = require("ws")

const dbUrl = 'ws://http://leonardomigliorelli.altervista.org'

const server = new WebSocketServer.Server({ port: 8080 });

server.on('connection', connection => {
    console.log('new connection')

    connection.on('message', msg => console.log(`Client send ${msg}`))

    connection.on('close', () => console.log(`Client disconnected`))

    connection.onerror = () => console.log("An error occurred")
})