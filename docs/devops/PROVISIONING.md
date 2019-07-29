# Provisioning of an AWS Lightsail machine for PirateApplication

## Instance creation
Create an “ubuntu” instance, if you want, with your own machine’s ssh key.

## Instance Configuration checklist

### - Install Docker and configure systemd
- Create the following folder `/home/ubuntu/pirate-app`
- Copy `build/aws-lightsail/lightsail-launch-script.sh` and `build/aws-lightsail/docker-composer-app.service`
to the newly created folder's root.
- Run the installation script `build/aws-lightsail/lightsail-launch-script.sh`
> This script is to:
> - Install `docker` and `docker-compose`
> - Ensure that even if a reboot happens, the docker-compose is called again to get the application up again.

### - Install and configure AWS-CLI
For this you will need CLI credentials
`https://docs.aws.amazon.com/cli/latest/userguide/cli-chap-install.html`
`https://docs.aws.amazon.com/cli/latest/userguide/cli-chap-configure.html`

### - SSH Configuration
- Add Jenkins public keys to be allowed to SSH into Lightsail.

### - Jenkins configuration
- Create your jenkins build task and point the script to `build/jenkins/jenkins-build` 
- Create your jenkins deploy task and point the script to `build/jenkins/jenkins-deploy`
- On your jenkins `deploy` task, under `Properties Content` add the following environment variable `LIGHTSAIL_INSTANCE_SSH` with the value of your lightsail instance ssh's user and ip (e.g.: ubuntu@52.59.46.5)
- Also under `Properties Content` add the project's environment variables

## Conclusion
After following all these steps, you should be good to build and deploy from Jenkins.
