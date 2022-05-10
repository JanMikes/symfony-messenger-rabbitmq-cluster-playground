# symfony/messenger RabbitMQ  cluster playground

This repo is for testing purposes of RabbitMQ cluster capabilities - failover, retry etc.

**Adminer, for a database access is available on port `8000`**  
Host: `postgres`  
User: `user`  
Password: `pass`  
Database: `test`

## Usage

1. Start services (db and rabbitmq cluster) in background: `docker-compose up -d` 
2. Publish messages `docker-compose run --rm php bin/console app:publish 100`

For customizations, use `docker-compose.override.yml`.

## How it works

There is publish console command that dispatches message to messenger. In handler there is RNG:

- There is 10% chance of temporary fail (will move to temporary retry queue in rabbitmq)
- There is 10% chance of permanent fail (will move to failed queue - persisted in database)

If succeeded (80% chance), it will persist the message into database table `persistent_message`.

### Retrying
```bash
$ bin/console messenger:failed:show

# see details about a specific failure
$ bin/console messenger:failed:show 20 -vv

# view and retry messages one-by-one
$ bin/console messenger:failed:retry -vv

# retry specific messages
$ bin/console messenger:failed:retry 20 30 --force

# remove a message without retrying it
$ bin/console messenger:failed:remove 20

# remove messages without retrying them and show each message before removing it
$ bin/console messenger:failed:remove 20 30 --show-messages
```
