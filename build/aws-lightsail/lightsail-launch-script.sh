#!/bin/bash

# install latest version of docker the lazy way
curl -sSL https://get.docker.com | sh

# make it so you don't need to sudo to run docker commands
usermod -aG docker ubuntu

# install docker-compose
curl -L https://github.com/docker/compose/releases/download/1.21.2/docker-compose-$(uname -s)-$(uname -m) -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose

# copy in systemd unit file and register it so our compose file runs
# on system restart
cp /home/ubuntu/pirate-app/docker-composer-app.service /etc/systemd/system/docker-compose-app.service
systemctl enable docker-compose-app
