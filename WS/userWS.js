const WebSocketServer = require("ws")
const request = require("request");

const dbUrl = 'http://leonardomigliorelli.altervista.org'

const server = new WebSocketServer.Server({ port: 80 });

var jsonAuth

function setAuth(message) {
    console.log("set ricevuto")
    jsonAuth = JSON.parse(message)
}

function sendMessage(message) {
    console.log("send ricevuto")

}

server.on('connection', conn => {
    conn.id
    console.log('new connection')

    function reload() {
        request.post({
            url: dbUrl + "/UserGetMessages.php",
            json: true,
            body: jsonAuth,
        }, (err, res, body) => {
            if (!err && res.statusCode == 200)
                conn.send(body)
            else
                conn.send("Unknown Error")
        })
    }

    conn.onmessage = msg => {
        const message = `${msg}`
        // console.log(`Client send ${message}`)

        if (message.startsWith("set"))
            setAuth(message.replace("set ", ""))

        if (message.startsWith("send"))
            sendMessage(message.replace("send  ", ""))


        reload()
    }

    conn.onclose = () => console.log(`Client disconnected`)

    conn.onerror = () => console.log("An error occurred")
})