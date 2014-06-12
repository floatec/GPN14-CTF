# build image in cwd
sudo docker build -t <challenge> .

# create new instance, this forwards all EXPOSEd ports to all interfaces
sudo docker run -d -P --name ctf-<challenge> <challenge>
# get port assignment
sudo docker port ctf-<challenge> <port>

# view lgos
sudo docker logs ctf-<challenge>

# run fresh instance and look into it
sudo docker run --rm -i -t -P --name ctf-<challenge>-test <challenge> /sbin/my_init -- /bin/bash

# upload ready image to docker
sudo docker tag <challenge> shadex.net:5000/<challenge>
sudo docker push shadex.net:5000/<challenge>

# download
sudo docker pull shadex.net:5000/<challenge>
