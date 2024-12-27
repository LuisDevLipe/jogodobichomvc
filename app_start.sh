#! /usr/bin/bash

# stop and remove existing containers
sudo docker stop jogodobichomvc
sudo docker stop mariadb
sudo docker rm jogodobichomvc
sudo docker rm mariadb

# remove the network
sudo docker network rm jogodobichomvc_bridge

# run the container
sudo docker run -d -p 80:80 --rm -v /var/www/html/jogodobichomvc:/var/www/html --name jogodobichomvc luisdevlipe/jogodobichomvc

# run the container with the database
sudo docker run -d --rm --name mariadb mariadb

# create a network
sudo docker network create jogodobichomvc_bridge

# add the container to the network
sudo docker network connect jogodobichomvc_bridge mariadb
sudo docker network connect jogodobichomvc_bridge jogodobichomvc
