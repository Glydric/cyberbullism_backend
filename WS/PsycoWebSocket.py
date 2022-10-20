import requests
from UserWebSocket import UserWebSocket


class PsycoWebSocket(UserWebSocket):
    # Consente di ottenere i messaggi
    def getMessages(self) -> str:
        result = requests.post(
            self.DbServer + "/PsycoGetMessages.php",
            data=self.arguments,
        )
        return result.text

    # Consente di inviare i messaggi
    def sendMessage(self, message: str) -> str:
        self.arguments["testo"] = message
        result = requests.post(
            self.DbServer + "/PsycoSendMessage.php",
            data=self.arguments,
        )
        self.arguments.pop("testo")
        return result.text
