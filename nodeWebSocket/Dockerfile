FROM node
WORKDIR /usr/app

COPY main.js /usr/app
COPY package.json /usr/app

RUN npm i --production

EXPOSE 80

CMD ["node","main.js"]