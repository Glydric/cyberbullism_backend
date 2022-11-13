const WebSocketServer = require("ws").Server
const url = require("url")
const unirest = require("unirest");

const config = { port: 80 }
const dbUrl = 'http://leonardomigliorelli.altervista.org'

const server = new WebSocketServer(config);

var jsonAuth

function setAuth(message) {
    jsonAuth = JSON.parse(message)
}

function serverConnection(conn, req) {
    conn.id
    const path = url.parse(req.url, true).path;
    var lastResponse;

    if (path != "/Psyco" && path != "/User")
        conn.close()

    console.log(`new connection in ${path}`)

    function sendMessage(message) {
        console.log("send ricevuto")
        jsonAuth["testo"] = message

        unirest.post(dbUrl + path + "SendMessage.php")
            .send(jsonAuth)
            .then(res => console.log(res.status))
    }

    function reload() {
        unirest.post(dbUrl + path + "GetMessages.php")
            .send(jsonAuth)
            .then(res => {
                if(lastResponse == res.body)
                    return
                
                lastResponse = res.body

                conn.send(
                    res.status == 200
                        ? lastResponse
                        : "WebSocket Connection Error"
                )
            })
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