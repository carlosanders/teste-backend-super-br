<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Controller\Traits;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital as ComponenteDigitalDTO;
use SuppCore\AdministrativoBackend\Rest\ResponseHandlerInterface;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\Traits\DownloadTrait as DownloadTraitResource;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * Trait DownloadAsPdfTrait.
 *
 * @method                                    validateRestMethod($request, $allowedHttpMethods)
 * @method RestResource|DownloadTraitResource getResource()
 * @method ResponseHandlerInterface           getResponseHandler()
 * @method Throwable                          handleRestMethodException($exception)
 */
trait DownloadTrait
{
    /**
     * Endpoint action to download.
     *
     * @Route(
     *      "/{id}/download_as_pdf",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @param Request       $request
     * @param int           $id
     * @param string[]|null $allowedHttpMethods
     *
     * @return Response
     *
     * @throws Throwable
     */
    public function downloadAsPdfAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ) {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $transactionId = $this->transactionManager->begin();

            $componenteDigital = $this->getResource()->download($id, $transactionId, true);
            $this->getResource()->setDtoClass(ComponenteDigitalDTO::class);

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createPdfResponse($request, $componenteDigital);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to download.
     *
     * @Route(
     *      "/{id}/download_as_zip",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @param Request       $request
     * @param int           $id
     * @param string[]|null $allowedHttpMethods
     *
     * @return Response
     *
     * @throws Throwable
     */
    public function downloadAsZipAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ) {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $transactionId = $this->transactionManager->begin();

            $componenteDigital = $this->getResource()->download($id, $transactionId, false);
            $this->getResource()->setDtoClass(ComponenteDigitalDTO::class);

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createPdfResponse($request, $componenteDigital);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }
}
