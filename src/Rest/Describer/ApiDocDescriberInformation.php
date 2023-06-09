<?php

declare(strict_types=1);
/**
 * /src/Rest/Describer/ApiDocDescriberInformation.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Describer;

use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use OpenApi\Annotations\Info;
use OpenApi\Annotations\License;
use OpenApi\Annotations\OpenApi;
use function file_get_contents;
use function implode;
use function is_array;
use LogicException;
use Nelmio\ApiDocBundle\Describer\DescriberInterface;
use SuppCore\AdministrativoBackend\Utils\JSON;

/**
 * Class ApiDocDescriberInformation.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ApiDocDescriberInformation implements DescriberInterface
{
    private string $rootDir;

    /**
     * ApiDocDescriberInformation constructor.
     *
     * @param string $rootDir
     */
    public function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }

    /**
     * @param OpenApi $api
     *
     * @throws LogicException
     */
    public function describe(OpenApi $api): void
    {
        // Read composer.json to an object
        $composer = JSON::decode((string) file_get_contents($this->rootDir.'/composer.json'));

        // Get API info
        $info = Util::getChild($api, Info::class);

        /** @var Info $info */
        $info->title = $composer->extra->projectTitle;
        $info->description = $composer->description;
        $info->version = $composer->version;
        $licence = Util::getChild($info, License::class);
        $licence->name = is_array($composer->license) ? implode(', ', $composer->license) : $composer->license;
        $info->license = $licence;
    }
}
