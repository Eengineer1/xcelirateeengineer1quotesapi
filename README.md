# Tasos Derisiotis X Xcelirate - Team Lead PHP assignment

## Basic info

* [nginx](https://nginx.org/)
* [PHP-FPM](https://php-fpm.org/)
* [MySQL](https://www.mysql.com/)
* [Redis](https://redis.io/)
* [Elasticsearch](https://www.elastic.co/products/elasticsearch)
* [Logstash](https://www.elastic.co/products/logstash)
* [Kibana](https://www.elastic.co/products/kibana)
* [RabbitMQ](https://www.rabbitmq.com/)

## Showcase

[![steve-jobs.png](https://i.postimg.cc/rspf042P/steve-jobs.png)](https://postimg.cc/HcfwFVxw)

## Tests

PHPSpec
[![phpspec.png](https://i.postimg.cc/j5GdFHqp/phpspec.png)](https://postimg.cc/VrW8SbCg)

Behat
[![behat.png](https://i.postimg.cc/d0Y2zC3T/behat.png)](https://postimg.cc/qN16Kz8k)


## Installation

1. Everything is done by running `./make_dev` or by double clicking `make_dev` file in UNIX.

2. Unit test done with PHPSpec and integration test with Behat, each shown by running `vendor/bin/phpspec run` and `vendor/bin/behat` respectively.

## How does it work?

The basic workflow can be seen on the `quotes.feature` file from the integration test.
Message queueing is kept-alive with Supervisor.

The following built images are included:

* `nginx`: The Nginx webserver container in which the application volume is mounted.
* `php`: The PHP-FPM container in which the application volume is mounted too.
* `mysql`: The MySQL database container.
* `elk`: Container which uses Logstash to collect logs, send them into Elasticsearch and visualize them with Kibana.
* `redis`: The Redis server container.
* `rabbitmq`: The RabbitMQ server/administration container.

Running `docker-compose ps` should result in the following running containers:

```
           Name                          Command               State              Ports
--------------------------------------------------------------------------------------------------
container_mysql         /entrypoint.sh mysqld            Up      0.0.0.0:3306->3306/tcp
container_nginx         nginx                            Up      443/tcp, 0.0.0.0:80->80/tcp
container_phpfpm        php-fpm                          Up      0.0.0.0:9000->9000/tcp
container_redis         docker-entrypoint.sh redis ...   Up      6379/tcp
container_rabbit        rabbitmq:3-management            Up      4369/tcp, 5671/tcp, 0.0.0.0:5672->5672/tcp, 15671/tcp, 25672/tcp, 0.0.0.0:15672->15672
container_elk           /usr/bin/supervisord -n -c ...   Up      0.0.0.0:5044->5044/tcp, 0.0.0.0:5601->5601/tcp, 0.0.0.0:9200->9200/tcp, 9300/tcp
```

## Usage

Once all the containers are up, the services are available at:

* Symfony app: `http://symfony.dev:80` or just `http://symfony.dev`
* Mysql server: `symfony.dev:3306`
* Redis: `symfony.dev:6379`
* Elasticsearch: `symfony.dev:9200`
* Kibana: `http://symfony.dev:5601`
* RabbitMQ: `http://symfony.dev:15672`
* Log files location: *logs/nginx* and *logs/symfony*

---

Inspired by [eko/docker-symfony](https://github.com/eko/docker-symfony) and [maxpou/docker-symfony](https://github.com/maxpou/docker-symfony)
