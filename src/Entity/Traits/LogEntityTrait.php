<?php

declare(strict_types=1);
/**
 * /src/Entity/Traits/LogEntityTrait.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity\Traits;

use DateTime;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use SuppCore\AdministrativoBackend\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;

/**
 * Trait LogEntityTrait.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @property Usuario|null $usuario
 */
trait LogEntityTrait
{
    /**
     * @ORM\Column(
     *     name="log_time",
     *     type="datetime",
     *     nullable=false
     * )
     */
    protected DateTime $time;

    /**
     * @ORM\Column(
     *     name="log_date",
     *     type="date",
     *     nullable=false
     * )
     */
    protected DateTime $date;

    /**
     * @ORM\Column(
     *     name="agent",
     *     type="text",
     *     nullable=false
     * )
     */
    protected string $agent;

    /**
     * @ORM\Column(
     *     name="http_host",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected string $httpHost;

    /**
     * @ORM\Column(
     *     name="client_ip",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected string $clientIp;

    /**
     * @return DateTime
     */
    public function getTime(): DateTime
    {
        return $this->time;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

    /**
     * @return string
     */
    public function getHttpHost(): string
    {
        return $this->httpHost;
    }

    /**
     * @return string
     */
    public function getClientIp(): string
    {
        return $this->clientIp;
    }

    /**
     * @ORM\PrePersist()
     */
    protected function processTimeAndDate(): void
    {
        $now = new DateTime('NOW', new DateTimeZone('UTC'));

        $this->time ??= $now;
        $this->date = $this->time ?? $now;
    }

    /**
     * @param Request $request
     */
    protected function processRequestData(Request $request): void
    {
        /** @var string $userAgent */
        $userAgent = $request->headers->get('User-Agent') ?? '';

        $this->clientIp = (string) $request->getClientIp();
        $this->httpHost = $request->getHttpHost();
        $this->agent = $userAgent;
    }
}
