const WebSocketServer = require("ws").Server
const unirest = require("unirest");

const config = { port: 80 }
const dbUrl = 'http://leonardomigliorelli.altervista.org'

const server = new WebSocketServer(config);


function serverConnection(conn, req) {
    const path = `${req.url}`
    var lastResponse
    var auth

    if (path in ["/Psyco", "/User"])
        conn.close()

    console.log(`Accepted new connection in ${path}`)

    function setAuth(message) {
        auth = JSON.parse(message)
    }

    function sendMessage(message) {
        console.log("send ricevuto")
        auth["testo"] = message

        unirest.post(dbUrl + path + "SendMessage.php")
            .send(auth)
            .then(res => console.log(res.status))
    }

    function responseCheck(res) {
        if (res.status != 200) {
            conn.send(`WebSocket-Error ${res.status}`);
            return
        }

        if (lastResponse != res.body) {
            lastResponse = res.body
            conn.send(lastResponse)
        }
    }

    function reload() {
        unirest.post(dbUrl + path + "GetMessages.php")
            .send(auth)
            .then(responseCheck)
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

server.on('connection', serverConnection)