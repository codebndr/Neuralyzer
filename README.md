[![Build Status](https://travis-ci.org/codebendercc/Neuralyzer.svg?branch=master)](https://travis-ci.org/codebendercc/Neuralyzer) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/9f967040-04c6-49ba-9952-4a9997413c5f/mini.png)](https://insight.sensiolabs.com/projects/9f967040-04c6-49ba-9952-4a9997413c5f)

### Installation Instructions

#### 1. Run the Vagrant file

This tutorial assumes that you have Vagrant installed

* Clone the project
* Go to the project's directory
* Run ```vagrant up```

This will create a new VM instance with Ubuntu Trusty (14.04 LTS), install all dependencies, and initialize the Symfony installation

#### 2. Connect to the VM

* Run ```vagrant ssh```

This will ssh you into the VM that you just created, so that you can run Symfony's PHP Web Server

#### 3. Run the Symfony Web Server

* Run ```cd /vagrant/Symfony``` to go to the Symfony folder
* Run ```php bin/console server:run``` to run the Symfony Web Server


#### 4. Connect to the website from your Host computer

* Open your browser of choice
* Open ```localhost:8889/app.php```
* Enjoy


Note: The Symfony Web server runs locally on port 8000. However, we have an nginx server running as a reverse proxy on port 8080, that forward the requests to the Symfony Web Server. On top of that, Vagrant is set up to forward port 8080 of the Guest VM to port 8889 of the Host machine, so for all intents and purposes, that's what you should use

Note #2: You should also be able to use ```localhost:8889/app_dev.php/``` that uses a dev environment. This will (mostly) not use cache, and it will give you a good error output that helps with development

##### 5. Make Changes and Commit

Using this setup, you are supposed to make changes on your host machine, and use the VM just to look at the end results. So all development and commits should be done at the host
