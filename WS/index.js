const ws = require("ws")

const url = 'ws://www.host.com/path'
const socket = new WebSocket(url, {
    perMessageDeflate: false
});
