import requests
from UserWebSocket import UserWebSocket


class PsycoWebSocket(UserWebSocket):
    def getMessages(self) -> str:
        arguments = {
            "email": self.email,
            "password": self.password,
            "otherEmail": self.otherEmail,
        }

        result = requests.post(
            self.DbServer + "/PsycoGetMessages.php",
            data=arguments,
        )
        return result.text

    def sendMessage(self) -> str:
        print("sendMessage Not Implemented")
        pass
