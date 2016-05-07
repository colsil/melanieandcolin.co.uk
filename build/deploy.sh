#!/bin/bash
set -ev
# deploy to production if php version is 5.6 and branch is master, and it's not a pull request!
if [ "${TRAVIS_PULL_REQUEST}" = "false" && "${TRAVIS_PHP_VERSION}" = "5.6" && "${TRAVIS_BRANCH}" = "master" ]; then
    tar -czf site.tar.gz code/*
    'scp -i build/sshkeys/travis_key.rsa site.tar.gz ubuntu@melanieandcolin.uk:'
    ssh -i build/sshkeys/travis_key.rsa ubuntu@melanieandcolin.uk "tar -xzf site.tar.gz -C /var/www/melanieandcolin.co.uk"
fi
