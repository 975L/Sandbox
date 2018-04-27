#!/bin/bash
#Executes after the git push
#Creation (08/06/2017)

echo "------ Begin execution of GitHookPostUpdate";
SiteFolder="$( cd "$(dirname "${BASH_SOURCE[0]}")"; pwd -P )/../../";
cd $SiteFolder;
unset GIT_DIR;

echo "****** Pull changes from master";
git pull origin master;

echo "****** Composer update";
export SYMFONY_ENV=prod;
php-7.1 -d allow_url_fopen=On -d memory_limit=2G ~/composer.phar install --no-dev;
php-7.1 -d allow_url_fopen=On -d memory_limit=2G ~/composer.phar dump-autoload --optimize --no-dev --classmap-authoritative;

echo "****** Clear Doctrine cache";
php-7.1 bin/console doctrine:cache:clear-metadata --env=prod;
php-7.1 bin/console doctrine:cache:clear-query --env=prod;
php-7.1 bin/console doctrine:cache:clear-result --env=prod;

echo "****** Clear Symfony cache";
php-7.1 bin/console cache:clear --no-warmup --env=prod;
php-7.1 bin/console cache:warmup --env=prod;

echo "****** Deleting unneeded files";
Files="\
$SiteFolder/app/config/config_dev.yml \
$SiteFolder/app/config/config_test.yml \
$SiteFolder/app/config/routing_dev.yml \
$SiteFolder/web/app_dev.php \
$SiteFolder/web/config.php \
$SiteFolder/web/css/styles.css \
$SiteFolder/web/js/functions.js \
";
for File in $Files; do
    rm -f $File;
done

echo "------ End execution GitHookPostUpdate";

exit 0