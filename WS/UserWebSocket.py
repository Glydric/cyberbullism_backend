import requests
import tornado.websocket as WS


DbServer = "http://leonardomigliorelli.altervista.org"


class UserWebSocket(WS.WebSocketHandler):
    email: str
    password: str
    otherEmail: str

    def switch(self, message: str) -> str:
        if message == "reload":
            return self.getMessages()
        elif message == "send":
            return self.sendMessage()
        else:
            return "Request Error"

    def getMessages(self) -> str:
        arguments = {
            "email": self.email,
            "password": self.password,
            "otherEmail": self.otherEmail,
        }

        result = requests.post(
            DbServer + "/UserGetMessages.php",
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

        response = self.switch(message)

        self.write_message(f"Risposta: {response}")

    def on_close(self):
        # metodo eseguito alla chiusura della connessione
        # tornado.ioloop.IOLoop.instance().stop()
        print("Connessione chiusa")
