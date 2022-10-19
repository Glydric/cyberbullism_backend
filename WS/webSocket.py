import requests
import tornado.httpserver
import tornado.ioloop
import tornado.web
import tornado.websocket as WS

from PsycoWebSocket import PsycoWebSocket

DbServer = "http://leonardomigliorelli.altervista.org"





def makeApp():
    return tornado.web.Application(
        [
            (r"/", PsycoWebSocket),
        ]
    )


if __name__ == "__main__":
    server = makeApp()
    server.listen(8080)
    tornado.ioloop.IOLoop.instance().start()
