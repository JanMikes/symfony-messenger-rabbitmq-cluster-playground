#!/bin/sh

# This is original entrypoint, decorated with running scripts in directory
# See: https://github.com/docker-library/php/blob/master/docker-php-entrypoint

set -e

composer install --no-interaction
bin/console doctrine:migrations:migrate --no-interaction

# continue with original entrypoint

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php "$@"
fi

exec "$@"
