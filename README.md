<h1 align="center">LAMPStackNGX</h1>

<!--<h1 align="center">
  <a href="https://mackinnonbowesapp.ddns.net/" target="_blank">
    <img src="public_html/img/logo.png" alt="Logo" width="125" height="125">
  </a>
</h1>-->

<div align="center">
  <b><a href="https://github.com/nicolasluckie/LAMPStackNGX/issues/new?assignees=&labels=bug&template=01_BUG_REPORT.md&title=bug%3A+">Report a Bug</a>
  |
  <a href="https://github.com/nicolasluckie/LAMPStackNGX/issues/new?assignees=&labels=enhancement&template=02_FEATURE_REQUEST.md&title=feat%3A+">Request a Feature</a>
  |
  <a href="https://github.com/nicolasluckie/LAMPStackNGX/discussions">Ask a Question</a></b>
</div>

<div align="center">
<br />

  [![license](https://img.shields.io/badge/Created%20by-Nic%20Luckie-ff1414?style=flat-square)](public_html/LICENSE.md)

</div>

<details open="open">
<summary>Table of Contents</summary>
<p>

- [Description](#description)
- [Technologies](#technologies)
- [Installation](#installation)
  - [1. Install docker and docker-compose](#1-install-docker-and-docker-compose)
  - [2. Create environment variable files](#2-create-environment-variable-files)
  - [3. Start the stack](#3-start-the-stack)
    - [Bonus: Health check](#bonus-health-check)
- [Support](#support)
- [License](#license)

</p>
</details>

## Description

LAMPStackNGX is a git repository that includes Nginx, PHP, MySQL, and phpMyAdmin to create a comprehensive web development environment. It is perfect for building high-performance websites and applications.

<!--<details closed>
<summary>Additional info</summary>
<br>

This is a placeholder for any additional information that may be required.

</details>-->

## Technologies

- Front-End: [nginx](https://hub.docker.com/_/nginx)
- Back-End: [php](https://hub.docker.com/_/php/)/[mariadb](https://hub.docker.com/_/mariadb)/[phpmyadmin](https://hub.docker.com/_/phpmyadmin)

## Installation

### 1. Install docker and docker-compose

Ensure you have **both** docker and docker-compose installed on your machine.

Clone this repo to your desired location.

### 2. Create environment variable files

We do this as not to include sensitive information in the `docker-compose.yml` file, but rather sourcing them from the `.env` and `db.ini` files. This way sensitive information is not committed to the version control system.

Create **two files**:

- `.env` - in the root directory, containing:

```
MYSQL_ROOT_PASSWORD=root # Change this
MYSQL_DATABASE=database
MYSQL_USER=user
MYSQL_PASSWORD=pass # Change this
TZ=YourTimezone # Leave blank for Etc/UTC
```

- `db.ini` - in the `/db/` directory, containing:

```
SERVER=mariadb
USER=user
PASS=pass
DATABASE=database
```

Note, the `SERVER` variable **must** match the **container name** in `docker-compose.yml`

### 3. Start the stack

Execute `docker compose up -d` from the containing folder.

This will create **1 stack with 4 containers**:

- lampstackngx
  - mariadb *(Port 3001)*
  - php
  - phpmyadmin *(Port 3002)*
  - nginx *(Port 3000)*

#### Bonus: Health check

The default NGINX server block includes a health check location block, as follows:

```
location /nginx-health {
    return 200 "healthy\n";
    add_header Content-Type text/plain;
}
```

Navigate to **`/nginx-health`** to return a **`200 OK - healthy`** plaintext response; or, modify the `Content-Type` to `applicaton/json` to return a JSON response.

## Support

Reach out to the maintainer at one of the following places:

- [GitHub discussions](https://github.com/nicolasluckie/LAMPStackNGX/discussions)
- Email: [nicolasluckie@gmail.com](mailto:nicolasluckie@gmail.com)

## [License](https://github.com/nicolasluckie/LAMPStackNGX/blob/main/LICENSE.md)
