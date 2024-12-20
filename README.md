# ddss-a2
Work related to assignment #2 of DDSS 2024

## Description
This project uses Docker to run three containers: one for a database which is shared by two web applications - the good and the bad. Both webapps shall be hosted locally. The good ('safe') version is in good/ and the other is in bad/.

All containers run linux but with focus on different services: db will run a postgres database demon while the web apps will each run an apache2 daemon. The source code for the backend of these apps is written in php.

docker-compose allows me to bundle these containers together to seamlessly boot them up.

The security analysis is provided in a more formal pdf format which will be included in this repository.

# Building and running
Please make sure you have Docker installed

Run ./reset.sh for a fresh build (or re-build) of the containers
