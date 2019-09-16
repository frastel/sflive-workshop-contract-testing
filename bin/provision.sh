#!/bin/bash

# Step 1: docker installation
# @see https://docs.docker.com/engine/installation/linux/ubuntu/#install-using-the-repository
apt-get update && apt-get install -yq \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common \
    joe \
    --no-install-recommends

curl -fsSL https://download.docker.com/linux/ubuntu/gpg | apt-key add -

add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"

apt-get update

apt-get install -yq docker-ce docker-ce-cli containerd.io

# Step 2: pre-installation steps for Docker on linux
groupadd docker
usermod -aG docker vagrant

# Step 3: docker-compose installation
curl -sL "https://github.com/docker/compose/releases/download/1.24.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose && chmod +x /usr/local/bin/docker-compose

echo "Provisioning done!"

echo '{"dns":["10.240.0.100"]}' >> /etc/docker/daemon.json
