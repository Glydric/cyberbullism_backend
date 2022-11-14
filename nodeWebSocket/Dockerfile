FROM node
WORKDIR /usr/app

# copying files 
COPY main.js /usr/app
COPY package.json /usr/app

# install dependencies
RUN npm i --production

EXPOSE 80

# RUN
CMD ["node","main.js"]