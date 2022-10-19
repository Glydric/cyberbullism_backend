import requests
import tornado.httpserver
import tornado.ioloop
import tornado.web
import tornado.websocket as WS

DbServer = "https://8000-glydric22-cyberbullismp-tqotjkpzd1a.ws-eu71.gitpod.io"

def getSql(email: str, password: str, otherEmail: str) -> str:
    arguments = {
        "email": email,
        "password": password,
        "otherEmail": otherEmail,
    }

    return requests.post(DbServer, json=arguments).text


class WebSocket(WS.WebSocketHandler):
    def getHeader(self, name: str):
        return self.request.headers.get(name)

    def open(self):
        # metodo eseguito all'apertura della connessione
        print("Nuova connessione")

    def on_message(self, message):
        # metodo eseguito alla ricezione di un messaggio
        # la stringa 'message' rappresenta il messaggio

        response = getSql(
            self.getHeader("email"),
            self.getHeader("password"),
            self.getHeader("psyco_email"),
        )

        print(f"Messaggio ricevuto: {message}")
        self.write_message(f"Risposta: {response}")

    def on_close(self):
        # metodo eseguito alla chiusura della connessione
        # tornado.ioloop.IOLoop.instance().stop()
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
