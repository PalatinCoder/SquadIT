[![Build Status](https://travis-ci.org/PalatinCoder/SquadIT.WebApp.svg?branch=master)](https://travis-ci.org/PalatinCoder/SquadIT.WebApp)
[![Coverage Status](https://coveralls.io/repos/github/PalatinCoder/SquadIT.WebApp/badge.svg?branch=master)](https://coveralls.io/github/PalatinCoder/SquadIT.WebApp?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PalatinCoder/SquadIT.WebApp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/PalatinCoder/SquadIT.WebApp/?branch=master)
# SquadIT
SquadIT is a web application that makes managing your sports squad easy!

+ Read all about it [here](http://squadit.jan-sl.de/)
+ Follow the process in our [Blog](http://squadit.jan-sl.de/blog/)

---

This repository contains the package for the WebApp, based on the [Flow Framework](https://flow.neos.io).
If you want to use SquadIT, you can use our [hosted service](https://squadit-service.jan-sl.de/) or you can install it on your own server.

---

## Installation

### Environment setup
Make sure to read the following instructions carefully (also the linked ones), as most difficulties are related to an improperly setup environment.
* As SquadIT is built on the foundation of Flow you need to setup your server to match it's [requirements](http://flowframework.readthedocs.io/en/stable/TheDefinitiveGuide/PartII/Requirements.html). In addition to the instructions in this document, consider the [Flow Framework installation instructions](http://flowframework.readthedocs.io/en/stable/TheDefinitiveGuide/PartII/Installation.html). Furthermore, SquadIT needs imagick to do image processing, so make sure this is installed on your system.

* Package management is done by composer. To install it, follow the [installation instructions](https://getcomposer.org/download/). If you're on a linux system (which you should be), in most cases the installation of composer is as simple as `~$ curl -s https://getcomposer.org/installer | php`

### Application

To install the application execute the following commands:

* Get the framework's base distribution <br>
`~$ composer create-project --no-install neos/flow-base-distribution:~4.1.0 <INSTALL_DIR>` <br>
`~$ cd <INSTALL_DIR>`

* Add the Github repo for SquadIT <br>
`~$ composer config repositories.squadit vcs https://github.com/PalatinCoder/SquadIT.WebApp.git`

* Add the SquadIT package <br>
`~$ composer require --no-update squadit/webapp:dev-master`

* Remove the flow welcome package <br>
`~$ composer remove --no-update neos/welcome`

* Now install all the packages <br>
`~$ composer install --no-dev`

### Checking the installation

You can do a quick test of your installation by doing `~$ ./flow` and see if the CLI comes up without any errors. <br>
Commonly there are problems with file permissions. You can fix them by executing <br> `~$ sudo flow core:setfilepermissions <cli-user> <webserver-user> <webserver-group>` <br>

### Setting up the database

You need to tell Flow how it can connect to the database. Put the following configuration into `Configuration/Settings.yaml`: (assuming you're using mysql, otherwise adjust accordingly)<br>
```
Neos:
  Flow:
    persistence:
      backendOptions:
        driver: pdo_mysql
        host: 127.0.0.1
        user: <db_user>
        password: <db_password>
        dbname: <db_name>
```

### Setting up the webserver
Now that Flow works fine you need to set up the web server. Set up a vhost in the directory `<INSTALL_DIR>/Web/`. Make sure you allow url rewriting and symlinks. For apache, a vhost could look like this:
```
<VirtualHost *:80>
    ServerName squadit.example.com
    ServerAdmin admin@squadit.example.com
    DocumentRoot /var/www/squadit/Web
    <Directory /var/www/squadit/Web>
        AllowOverride FileInfo Options
        Options +FollowSymlinks
    </Directory>
</VirtualHost>
```
### Go!

Now SquadIT should by fully setup and ready for use on your server. Have fun!
