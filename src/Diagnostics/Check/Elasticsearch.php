<?php

declare(strict_types=1);
/**
 * /src/Diagnostics/Check/Elasticsearch.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Diagnostics\Check;

use Laminas\Diagnostics\Check\CheckInterface;
use Laminas\Diagnostics\Result\Failure;
use Laminas\Diagnostics\Result\Success;
use Laminas\Diagnostics\Result\Warning;

/**
 * Check ElasticSearch.
 */
class Elasticsearch implements CheckInterface
{
    public function check(): Failure|Success|Warning
    {
        try {
            $connection = curl_init();
            curl_setopt_array($connection, [
                CURLOPT_URL => $_SERVER['ELASTIC_URL'].'/_cluster/health?pretty=true',
                CURLOPT_RETURNTRANSFER => true,
            ]);

            $response = curl_exec($connection);
            curl_close($connection);

            if (strpos($response, 'green') > 0) {
                return new Success('Cluster status: green');
            }
            if (strpos($response, 'yellow') > 0) {
                return new Warning('Cluster status: yellow');
            }

            return new Failure($response);
        } catch (\Throwable $e) {
            return new Failure($e->getMessage());
        }
    }

    public function getLabel(): string
    {
        return 'ElasticSearch';
    }
}
