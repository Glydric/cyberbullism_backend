const WebSocketServer = require("ws")
const unirest = require("unirest");

const dbUrl = 'http://leonardomigliorelli.altervista.org'

const server = new WebSocketServer.Server({ port: 80, path: "/user" });

var jsonAuth

function setAuth(message) {
    console.log("set ricevuto")
    jsonAuth = JSON.parse(message)
}

function sendMessage(message) {
    console.log("send ricevuto")
    jsonAuth["testo"] = message

    unirest.post(dbUrl + "/UserSendMessage.php")
        .send(jsonAuth)
        .then(res => console.log(res.status))
}

function userServerConnection(conn) {
    conn.id
    console.log('new connection')

    function reload() {
        unirest.post(dbUrl + "/UserGetMessages.php")
            .send(jsonAuth)
            .then(
                res => conn.send(
                    res.status == 200
                        ? res.body
                        : "WebSocket Connection Error"
                )
            )
    }

    conn.onmessage = msg => {
        const message = `${msg.data}`

        if (message.startsWith("set"))
            setAuth(message.replace("set ", ""))

        if (message.startsWith("send"))
            sendMessage(message.replace("send ", ""))

        reload()
    }

    conn.onclose = () => console.log(`Client disconnected`)

    conn.onerror = () => console.log("An error occurred")
}

server.on('connection', userServerConnection)
module.exports = { userServerConnection }