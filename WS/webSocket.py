import tornado.httpserver
import tornado.ioloop
import tornado.web

from PsycoWebSocket import PsycoWebSocket
from UserWebSocket import UserWebSocket


def makeApp():
    return tornado.web.Application(
        [
            (r"/psyco", PsycoWebSocket),
            (r"/user", UserWebSocket),
        ]
    )


if __name__ == "__main__":
    server = makeApp()
    server.listen(8080)
    tornado.ioloop.IOLoop.instance().start()
