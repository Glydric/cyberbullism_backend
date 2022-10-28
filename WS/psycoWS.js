const WebSocketServer = require("ws")
const UserWebSocket = require("./userWS")
const url = require("url")

const dbUrl = 'ws://leonardomigliorelli.altervista.org'

const server = new WebSocketServer.Server({ port: 8080 });

class PsycoWebSocket extends UserWebSocket {

}


server.on('connection', connection => {
    connection.id
    console.log('new connection')
    user = new UserWebSocket()

    connection.on('message', user.onMessage)

    connection.on('close', () => console.log(`Client disconnected`))

    connection.onerror = () => console.log("An error occurred")
})