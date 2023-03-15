#!/bin/bash
set -e

# No OSX, é necessário ajustar na GUI Docker os recursos de disco para 32GB (preferences/resources/advanced)

# comando de voltar para a raiz necessário para simplificar o docker-compose.yaml
echo "voltando para raiz do projeto para iniciar a execução do script docker-entrypoint.sh"
cd /app

echo "docker-entrypoint.sh: Aguardando por 15s as dependências subirem"
sleep 15

service memcached start

phpdismod xdebug

echo "info mkdir: durante a primeira execução, pastas var e filesystem serão criadas no dir do projeto. Caso trave, ajustar grupo/permissoes e executar novamente: sudo docker-compose up php-dev"
rm -rf /app/var/cache
rm -rf /app/var/log

mkdir -p /app/var/cache
mkdir -p /app/var/log
mkdir -p /app/filesystem

make generate-jwt-keys
chmod 644 /app/config/jwt/private.pem

# rm -rf composer.lock
# mkdir -p ~/.ssh

# #echo "info known_hosts: Caso trave, comentar a linha e executar novamente: sudo docker-compose up php-dev"
# #ssh-keyscan github.com >> ~/.ssh/known_hosts

# echo "info composer: Caso trave, ajustar grupo/permissoes na pasta do projeto"
# composer -V
# composer install --ansi --no-interaction

# # Step 8
# echo "Dando permissões recursivo na pasta do projeto..."
# export PATH="/app/vendor/bin:$PATH"

# chmod -R o+s+w /app

# echo "Criando database com doctrine..."
# php /app/bin/console doctrine:database:drop --connection default --force --no-interaction
# php /app/bin/console doctrine:database:create --connection default --no-interaction
# php /app/bin/console doctrine:schema:update --em default  --force --no-interaction
# php /app/bin/console doctrine:fixtures:load --em default --append --group dev --no-interaction

# php /app/bin/console ongr:es:index:create --index=pessoa --if-not-exists --no-interaction -vvv
# php /app/bin/console ongr:es:index:create --index=modelo --if-not-exists --no-interaction
# php /app/bin/console ongr:es:index:create --index=repositorio --if-not-exists --no-interaction
# php /app/bin/console ongr:es:index:create --index=processo --if-not-exists --no-interaction

# php /app/bin/console ongr:es:template:create --index=componente_digital --if-not-exists --no-interaction

# php /app/bin/console ongr:es:pipeline:create --index=componente_digital --no-interaction

# php /app/bin/console ongr:es:densevector:create --index=modelo --no-interaction
# php /app/bin/console ongr:es:densevector:create --index=repositorio --no-interaction

# php /app/bin/console ongr:es:index:populate --message="SuppCore\AdministrativoBackend\Command\Elastic\Messages\PopulatePessoaMessage" --startId=1 --endId=30 --batch=5 --no-interaction
# php /app/bin/console ongr:es:index:populate --message="SuppCore\AdministrativoBackend\Command\Elastic\Messages\PopulateModeloMessage" --startId=1 --endId=30 --batch=5 --no-interaction
# php /app/bin/console ongr:es:index:populate --message="SuppCore\AdministrativoBackend\Command\Elastic\Messages\PopulateProcessoMessage" --startId=1 --endId=30 --batch=5 --no-interaction

# crontab /etc/crontab.txt

# cron

# date

# echo "info xdebug: vide config em docker-compose.yml"
# phpenmod xdebug

# sed -i -e "s/newrelic.license.*/newrelic.license=\"${NEWRELIC_LICENSE_KEY}\"/" \
#      -e "s/newrelic.appname.*/newrelic.appname=\"${NEWRELIC_APP_NAME}\"/" \
#      -e "s/;newrelic.framework.*/newrelic.framework=\"symfony4\"/" \
#      -e "s/;newrelic.transaction_tracer.internal_functions_enabled.*/newrelic.transaction_tracer.internal_functions_enabled=true/" \
#      /etc/php/8.1/mods-available/newrelic.ini

phpdismod newrelic

service supervisor start

# Step 10
php -v
php -S 0.0.0.0:8000 -t public/

#service php8.1-fpm start
#caddy run --config=/etc/caddy/Caddyfile

exec "$@"
