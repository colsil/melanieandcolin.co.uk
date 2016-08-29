#!/bin/bash
set -ev
# deploy to production if php version is 5.6 and branch is master, and it's not a pull request!
if [ "${TRAVIS_PULL_REQUEST}" = "false" ] &&  [ "${TRAVIS_PHP_VERSION}" = "7.0" ]  && [ "${TRAVIS_BRANCH}" = "master" ]; then
    tar -czf site.tar.gz code/*
    scp -i build/sshkeys/travis_key.rsa site.tar.gz ubuntu@melanieandcolin.uk:
    ssh -i build/sshkeys/travis_key.rsa ubuntu@melanieandcolin.uk "rm -rf /tmp/melanieandcolin.co.uk &&
    mkdir /tmp/melanieandcolin.co.uk &&
    tar -xzf site.tar.gz -C /tmp/melanieandcolin.co.uk &&
    rsync -azv --exclude "parameters.yml" --exclude "cache" --exclude "sessions" --delete /tmp/melanieandcolin.co.uk/ /var/www/melanieandcolin.co.uk/ &&
    php /var/www/melanieandcolin.co.uk/code/bin/console doctrine:migrations:migrate --no-interaction &&
    php /var/www/melanieandcolin.co.uk/code/bin/console cache:clear --env=prod"
fi
