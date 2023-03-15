<?php

declare(strict_types=1);
/**
 * /src/Diagnostics/MessageHandler/TestHandler.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Diagnostics\MessageHandler;

use SuppCore\AdministrativoBackend\Diagnostics\Message\Test;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * Class TestHandler.
 */
#[AsMessageHandler]
class TestHandler
{
    public function __invoke(Test $message)
    {
        $object = unserialize($message->getContent());
        $fp = fopen('/tmp/'.$object->hash.'.txt', 'w');
        fwrite($fp, $object->hash);
        fclose($fp);
    }
}
