#!/bin/bash
IFS=$' \t\n'
set -x
set -e
git clean -fdx 'composer.*' vendor

./composer-install.sh --quiet --version=1.10.6 --filename="a-composer"
./a-composer --version

./composer-install.sh --quiet --version=2.0.14 --filename="b-composer"
./b-composer --version

<<EOD cat - | tee composer.json
{
  "require": {
    "composer-runtime-api": "^2"
  }
}
EOD

! ./a-composer install
./b-composer install
