const WebSocketServer = require("ws")
const url = require("url")
const superagent = require("superagent")

const dbUrl = 'http://leonardomigliorelli.altervista.org'

const server = new WebSocketServer.Server({ port: 80 });

var jsonValue

function onMessage(msg) {
    console.log(`Client send ${msg}`)
    conn.send(`${msg}`)
}

function sendRequest(){

}

function reload(){

}

server.on('connection', conn => {
    conn.id
    console.log('new connection')


    conn.on('message',
        (msg) => {
            const message = `${msg}`
            console.log(`Client send ${message}`)
            conn.send(message)

            if (message.startsWith("set"))
                jsonValue = message.replace("set ", "")
            else if (message.startsWith("send"))
                sendRequest()
            else reload()
        }
    )

    conn.onclose = () => console.log(`Client disconnected`)

    conn.onerror = () => console.log("An error occurred")
})
