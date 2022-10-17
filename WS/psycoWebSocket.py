import requests
import tornado.httpserver
import tornado.ioloop
import tornado.web
import tornado.websocket as WS


def getHeader(self, name: str):
    return self.request.headers.post(name)


def getSql(email: str, password: str, otherEmail: str):
    pass


class WebSocket(WS.WebSocketHandler):
    def getHeader(self, name: str):
        return self.request.headers.get(name)

    def open(self):
        # metodo eseguito all'apertura della connessione
        print("Nuova connessione")

    def on_message(self, message):
        # metodo eseguito alla ricezione di un messaggio
        # la stringa 'message' rappresenta il messaggio

        print(getHeader(self, "email"))
        self.write_message(r"Messaggio ricevuto: {message}")
        print("Messaggio ricevuto: %s" % message)

    def on_close(self):
        # metodo eseguito alla chiusura della connessione
        self.loop.stop()
        print("Connessione chiusa")


def makeApp():
    return tornado.web.Application(
        [
            (r"/", WebSocket),
        ]
    )


if __name__ == "__main__":
    server = makeApp()
    server.listen(8080)
    tornado.ioloop.IOLoop.instance().start()
