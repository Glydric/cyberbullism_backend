from json import JSONDecoder, JSONEncoder
import requests, re, json
import tornado.websocket as WS

connectionText = "Nuova connessione instanziata con i seguenti valori\n{}, {}, {}\n"


class UserWebSocket(WS.WebSocketHandler):
    DbServer = "http://leonardomigliorelli.altervista.org"
    arguments: dict

    # metodo eseguito all'apertura della connessione
    def open(self):
        self.setArguments(
            self.getHeader("email"),
            self.getHeader("password"),
            self.getHeader("otherEmail"),
        )

        print(
            connectionText.format(
                self.arguments["email"],
                self.arguments["password"],
                self.arguments["otherEmail"],
            )
        )

    def setArguments(self, email: str, password: str, otherEmail: str):
        self.arguments = {
            "email": email,
            "password": password,
            "otherEmail": otherEmail,
        }

    # esegue uno switch in base al messaggio ricevuto ed esegue i relativi metodi
    def switch(self, message: str) -> str:
        if message == "reload":
            return self.getMessages()
        elif re.sub("send +", "", message, 1) != message:  # re.match
            # remove first send and successives spaces
            m = re.sub("send +", "", message, 1)
            # send message
            return self.sendMessage(m)
        elif re.sub("set +", "", message, 1) != message:
            m = re.sub("set +", "", message, 1)
            self.arguments = json.loads(m)
            return "setted"
        return "Request Error"

    # Consente di ottenere i messaggi
    def getMessages(self) -> str:
        result = requests.post(
            self.DbServer + "/UserGetMessages.php",
            data=self.arguments,
        )
        return result.text

    # Consente di inviare i messaggi
    def sendMessage(self, message: str) -> str:
        self.arguments["testo"] = message
        result = requests.post(
            self.DbServer + "/UserSendMessage.php",
            data=self.arguments,
        )
        self.arguments.pop("testo")
        return result.text

    # Metodo di comodo che ci permette di ottenere i valori post passati
    def getHeader(self, name: str):
        return self.request.headers.get(name)

    # metodo eseguito alla ricezione di un messaggio
    def on_message(self, message):
        print(f"Messaggio ricevuto: {message}")
        result = self.switch(message)

        if result != "":
            self.write_message(result)

    # metodo eseguito alla chiusura della connessione
    def on_close(self):
        # tornado.ioloop.IOLoop.instance().stop()
        print("Connessione chiusa")
