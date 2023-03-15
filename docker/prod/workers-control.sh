#!/bin/bash

# shellcheck disable=SC2235
if [ "$1" == "push_count" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "push_count" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume push_count --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "push_mercure" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "push_mercure" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume push_mercure --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "relatorio_create" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "relatorio_create" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume relatorio_create --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "populate_componente_digital" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "populate_componente_digital" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume populate_componente_digital --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "indexacao_componente_digital" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "indexacao_componente_digital" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume indexacao_componente_digital --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "populate_pessoa" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "populate_pessoa" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume populate_pessoa --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "indexacao_pessoa" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "indexacao_pessoa" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume indexacao_pessoa --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "populate_modelo" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "populate_modelo" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume populate_modelo --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "indexacao_modelo" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "indexacao_modelo" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume indexacao_modelo --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "dense_vector" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "dense_vector" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume dense_vector --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "populate_repositorio" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "populate_repositorio" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume populate_repositorio --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "indexacao_repositorio" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "indexacao_repositorio" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume indexacao_repositorio --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "indexacao_processo" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "indexacao_processo" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume indexacao_processo --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "populate_processo" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "populate_processo" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume populate_processo --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "push_resource" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "push_resource" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume push_resource --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "regras_etiqueta" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "regras_etiqueta" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume regras_etiqueta --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "process_favorito" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "process_favorito" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume process_favorito --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "download_processo" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "download_processo" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume download_processo --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "integracao_gerar_dossie" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "integracao_gerar_dossie" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume integracao_gerar_dossie --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "integracao_gerar_dossie_tarefa" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "integracao_gerar_dossie_tarefa" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume integracao_gerar_dossie_tarefa --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "envia_ciencia" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "envia_ciencia" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume envia_ciencia --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "envia_documento_avulso" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "envia_documento_avulso" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume envia_documento_avulso --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "envia_processo" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "envia_processo" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume envia_processo --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "envia_componentes_digitais" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "envia_componentes_digitais" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume envia_componentes_digitais --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "recebe_recibo_de_tramite" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "recebe_recibo_de_tramite" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume recebe_recibo_de_tramite --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "recebe_componentes_digitais" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "recebe_componentes_digitais" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume recebe_componentes_digitais --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "recebe_tramite" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "recebe_tramite" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume recebe_tramite --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "sincroniza_barramento" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "sincroniza_barramento" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume sincroniza_barramento --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "tarefa_barramento" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "tarefa_barramento" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume tarefa_barramento --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "resposta_oficio_barramento" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "resposta_oficio_barramento" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume resposta_oficio_barramento --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "chat" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "chat" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume chat --time-limit=3600 --limit=1 --env=prod --no-debug
fi

if [ "$1" == "verificacao_virus" ] && ([ "$ALL_JOBS" == "true" ] || [ "$CURRENT_JOB" == "verificacao_virus" ])
then
    exec /usr/bin/php /var/www/html/bin/console messenger:consume verificacao_virus --time-limit=3600 --limit=1 --env=prod --no-debug
fi
exit 1
