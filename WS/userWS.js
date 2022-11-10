const WebSocketServer = require("ws")
const request = require("request");

const dbUrl = 'http://leonardomigliorelli.altervista.org'

const server = new WebSocketServer.Server({ port: 80 });

var jsonValue

function onMessage(msg) {
    console.log(`Client send ${msg}`)
    conn.send(`${msg}`)
}
function setJsonValue(message) {
    jsonValue = JSON.parse(message)
}

function sendMessage() {

}

server.on('connection', conn => {
    conn.id
    console.log('new connection')


    conn.on('message',
        (msg) => {
            const message = `${msg}`
            // console.log(`Client send ${message}`)

            if (message.startsWith("set")) {
                console.log("set ricevuto")
                setJsonValue(message.replace("set ", ""))
            }

            if (message.startsWith("send")) {
                console.log("send ricevuto")
                sendMessage()
            }

            request.post({
                url: dbUrl + "/UserGetMessages.php",
                body: jsonValue,
                json: true
            },
                (err, res, body) => {
                    conn.send(body)
                }
            )

        }
    )

    conn.onclose = () => console.log(`Client disconnected`)

    conn.onerror = () => console.log("An error occurred")
})
