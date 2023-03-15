<?php

declare(strict_types=1);
/**
 * /src/Rest/ResponseHandlerInterface.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Interface ResponseHandlerInterface.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
interface ResponseHandlerInterface
{
    /**
     * Constants for response output formats.
     *
     * @var string
     */
    public const FORMAT_JSON = 'json';
    public const FORMAT_XML = 'xml';

    /**
     * ResponseHandler constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer);

    /**
     * Getter for serializer.
     *
     * @return SerializerInterface
     */
    public function getSerializer(): SerializerInterface;

    /**
     * Getter for current resource service.
     *
     * @return RestResourceInterface
     */
    public function getResource(): RestResourceInterface;

    /**
     * Setter for resource service.
     *
     * @param RestResourceInterface $resource
     *
     * @return ResponseHandlerInterface
     */
    public function setResource(RestResourceInterface $resource): self;

    /**
     * @param Request $request
     * @param $data
     * @param int|null    $httpStatus
     * @param string|null $format
     * @param array|null  $context
     *
     * @return Response
     */
    public function createResponse(
        Request $request,
        $data,
        ?int $httpStatus = null,
        ?string $format = null,
        ?array $context = null
    ): Response;

    /**
     * Method to handle form errors.
     *
     * @param FormInterface $form
     *
     * @throws HttpException
     */
    public function handleFormError(FormInterface $form): void;
}
