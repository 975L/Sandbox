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
composer install --no-dev;
composer dump-autoload --optimize --no-dev --classmap-authoritative;

echo "****** Clear Doctrine cache";
php bin/console doctrine:cache:clear-metadata --env=prod;
php bin/console doctrine:cache:clear-query --env=prod;
php bin/console doctrine:cache:clear-result --env=prod;

echo "****** Clear Symfony cache";
php bin/console cache:clear --no-warmup --env=prod;
php bin/console cache:warmup --env=prod;

echo "****** Clear APCU cache";
service php-7.2-fpm reload;

echo "****** Deleting unneeded files";
Files="\
$SiteFolder/app/config/config_dev.yml \
$SiteFolder/app/config/config_test.yml \
$SiteFolder/app/config/routing_dev.yml \
$SiteFolder/web/app_dev.php \
$SiteFolder/web/config.php\
$SiteFolder/web/bundles/framework \
$SiteFolder/web/css/styles.css \
";
for File in $Files; do
    rm -f $File;
done

echo "****** chown files";
chown -R apache:apache $SiteFolder;

echo "------ End execution GitHookPostUpdate";

exit 0
