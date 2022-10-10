import tornado.httpserver
import tornado.websocket
import tornado.ioloop
import tornado.web
import mysql.connector

connection = mysql.connector.connect(
    host="miglio.dev",
    user="leomi",
    password="DbAdmin",
    database="cyberbullism",
)


def getHeader(self, name: str):
    return self.request.headers.get(name)


class MyWS(tornado.websocket.WebSocketHandler):
    def open(self):
        # metodo eseguito all'apertura della connessione
        print("Nuova connessione")

    def on_message(self, message):
        # metodo eseguito alla ricezione di un messaggio
        # la stringa 'message' rappresenta il messaggio

        print(getHeader(self, "email"))
        self.write_message("Messaggio ricevuto: %s" % message)
        print("Messaggio ricevuto: %s" % message)

    def on_close(self):
        # metodo eseguito alla chiusura della connessione
        print("Connessione chiusa")

    def check_origin(self, origin):
        return True


def make_app():
    return tornado.httpserver.HTTPServer(
        tornado.web.Application(
            [
                (r"/", MyWS),
            ]
        )
    )


if __name__ == "__main__":
    query = """SELECT
                    user_email AS otherEmail,
                    nome,
                    cognome,
                    testo,
                    data,
                    gravita,
                    CASE WHEN send_by_user = 0 THEN 1 WHEN send_by_user = 1 THEN 0
                END AS send_by_user
                FROM
                    messaggio join utente on user_email=email
                WHERE
                    psyco_email = '$email' AND user_email = '$otherEmail'
                ORDER BY DATA
                DESC
                """

    cursor = connection.cursor()

    cursor.execute(query)

    for x in cursor.fetchall():
        print(x)

    server = make_app()
    server.listen(8000)
    tornado.ioloop.IOLoop.instance().start()
