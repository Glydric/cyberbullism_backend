from unittest import result
import requests
import tornado.httpserver
import tornado.ioloop
import tornado.web
import tornado.websocket as WS

DbServer = "http://leonardomigliorelli.altervista.org"


class WebSocket(WS.WebSocketHandler):
    email: str
    password: str
    otherEmail: str

    def getMessages(self) -> str:
        arguments = {
            "email": self.email,
            "password": self.password,
            "otherEmail": self.otherEmail,
        }

        result = requests.post(
            DbServer + "/PsycoGetMessages.php",
            data=arguments,
        )
        return result.text

    def sendMessage() -> str:
        pass

    def getHeader(self, name: str):
        return self.request.headers.get(name)

    def open(self):
        # metodo eseguito all'apertura della connessione

        self.email = self.getHeader("email")
        self.password = self.getHeader("password")
        self.otherEmail = self.getHeader("otherEmail")

        print(
            "Nuova connessione instanziata con i seguenti valori\n"
            + f"{self.email}, {self.password}, {self.otherEmail}"
        )

    def on_message(self, message):
        # metodo eseguito alla ricezione di un messaggio
        # la stringa 'message' rappresenta il messaggio

        print(f"Messaggio ricevuto: {message}")

        if message == "reload":

            response = self.getMessages()
        elif message == "send":
            response = self.sendMessage()
        else:
            response = "Request Error"

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
