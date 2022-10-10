#!/bin/sh
scp -i ~/Downloads/key.pem /Users/leonardomigliorelli/Desktop/Unicam/Anno\ 3\ 2022-2023/Modulo\ Project/php\ sql\ files/*.php ubuntu@ec2-15-160-141-119.eu-south-1.compute.amazonaws.com:/var/www/html 
