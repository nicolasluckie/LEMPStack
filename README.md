<h1 align="center">LEMPStack</h1>

<div align="center">
<br />

  [![license](https://img.shields.io/badge/Created%20by-Nic%20Luckie-ff1414?style=flat-square)](public_html/LICENSE.md)

</div>

<div align="center">
  <b><a href="https://github.com/nicolasluckie/LAMPStackNGX/issues/new?assignees=&labels=bug&template=01_BUG_REPORT.md&title=bug%3A+">Report a Bug</a></b>
</div>

<details open="open">
<summary>Table of Contents</summary>
<p>

- [Description](#description)
- [Technologies](#technologies)
- [Installation](#installation)
- [Environment Variables](#environment-variables)
  - [.env](#env)
  - [db.ini](#dbini)
- [Deployment](#deployment)
- [Health Check](#health-check)
- [Changing Ports](#changing-ports)
- [MIT License](#mit-license)

</p>
</details>

## Description

This repository is used to create a comprehensive web development environment suitable for building high-performance websites and applications.

**LEMPStack** stands for **Linux**, **Nginx**, **MySQL** and **PHP**, and includes **phpMyAdmin** for database administration.

<!--<details closed>
<summary>Additional info</summary>
<br>

This is a placeholder for any additional information that may be required.

</details>-->

## Technologies

This project leverages images from [LinuxServer.io](https://docs.linuxserver.io/); a trusted fleet of ready-to-use, well-maintained Docker containers.

- Front-End: [nginx](https://docs.linuxserver.io/images/docker-nginx) *(includes PHP)*
- Back-End: [mariadb](https://docs.linuxserver.io/images/docker-mariadb) and [phpmyadmin](https://docs.linuxserver.io/images/docker-phpmyadmin)

## Installation

Install docker and docker-compose. This has only been tested on Ubuntu 22.04.6 LTS.

```
sudo apt update -y
sudo apt install docker
sudo apt install docker-compose
```

Clone this repository:

```
git clone https://github.com/nicolasluckie/LEMPStack.git
```

## Environment Variables

We do not want to include sensitive information in the `docker-compose.yml` file. Instead, we source environment variables from the `.env` file, and use the `db.ini` file for storing database connection info. This way sensitive information is not committed to version control.

### .env

**Rename `.env.example` to `.env` and change the values within.**

This file securely passes environment variables to the mariadb container without hard-coding them in your `docker-compose.yml` file. This way you can move it outside the root folder for security purposes.

### db.ini

**Rename `/app/db/db.ini.example` to `db.ini` and change the values within.**

This file is used by the `/app/db/db.inc.php` to establish a connection to the database without hard-coding the connection string. This way you can move it outside the `/db/` folder for security purposes.

**NOTE:** The **`SERVER`** variable must match the **service name** in `docker-compose.yml`. In this case the service name is **`mariadb`**, whereas the container name is `lempstack_mariadb`.

## Deployment

Run the following command from the folder containing the `docker-compose.yml` file:

```bash
sudo docker-compose up -d
```

This will create 1 stack with 3 containers:

- lempstack
  - **nginx** on ports 80 (HTTP) and 443 (HTTPS)
  - **mariadb** on port 3306
  - **phpmyadmin** on port 8080

The `/app/` folder will be mounted to `/config/nginx/www` for web hosting. Edit files in `/app/` to see live changes.

Modify `nginx-default.conf` as needed. It will overwrite the existing `/config/nginx/site-confs/default.conf` file.

If you left the default ports, you can access the site by visiting `http://localhost/` from a web browser; replacing `localhost` with your host IP.

The homepage should read **"It worked!"** if the deployment was successful and the database is online.

## Health Check

A health check is included in the `nginx-default.conf` file. Test it by visiting `http://localhost/nginx-health` from a web browser. The page should return **"healthy"** in plain text.

This can be useful for monitoring services like [Uptime-Kuma](https://github.com/louislam/uptime-kuma) which validates case-sensitive keywords when determining if a website is accessible or not.

To return different response or format, edit the `nginx-default.conf` file and change the `text/plain` to `application/json`, or any other acceptable format.

## Changing Ports

You can change the ports as needed by editing the `docker-compose.yml` file.

For example, if you want to access phpmyadmin from port 8080, change the number **left** of the colon like so:

```yml
ports:
  - 8080:80
```

## [MIT License](https://github.com/nicolasluckie/LAMPStackNGX/blob/main/LICENSE.md)
