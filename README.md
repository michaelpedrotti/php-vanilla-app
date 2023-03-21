# 1- Vanilla PHP App

It is a simple server-client application with html views. It can be used with docker.

# 2 - Tech

Uses a number of open source projects to work properly:

- `docker` >= 23
- `docker-compose` >= v2.16
- `mysql` >= 5.7
- `php` - 7.2

# 3 - Development

With docker, just execute:

```sh
docker-compose up -d
```

There is not any migrator provider. So, you will need to connect with MySQL Workbench on mysql container and execute each sql file in `migrations` directory.

# 4 - Deploy

## 4.1 - Docker

There is no deploy. It's just a proof of concept.

# 5 - References

- [PHP](https://www.php.net/) - A popular general-purpose scripting language 
- [Docker](https://docs.docker.com/engine/)
- [Docker Compose](https://expressjs.com)
- [Composer](https://getcomposer.org/) - A Dependency Manager for PHP