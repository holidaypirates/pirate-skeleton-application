# Deploying process

## Building

- Go to Jenkins > PirateApplication > pirate-app-build
- Click in `Build with Parameters`
- Under `BRANCH` input the name of the branch or tag you want to be deployed
- Click in `Build`
- Write down the number of the Jenkins task of your build.

## Deploying  

- Go to Jenkins > PirateApplication > pirate-app-deploy
- Click in `Build with Parameters`
- Under `APPLICATION_VERSION_TAG` input the Jenkins task number of the build you just did
- Under `BRANCH` input the name of the branch or tag you want the `docker-compose-production.yml` file to be read from.
- Click in `Build`


