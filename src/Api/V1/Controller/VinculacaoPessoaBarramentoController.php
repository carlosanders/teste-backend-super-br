<?php

declare(strict_types=1);
/**
 * /src/Controller/VinculacaoPessoaBarramentoController.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoPessoaBarramentoResource;
use SuppCore\AdministrativoBackend\Barramento\Service\BarramentoClient;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * @Route(path="/v1/administrativo/vinculacao_pessoa_barramento")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="VinculacaoPessoaBarramento")
 *
 * @method VinculacaoPessoaBarramentoResource getResource()
 */
class VinculacaoPessoaBarramentoController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\User\CreateAction;
    use Actions\User\UpdateAction;
    use Actions\User\PatchAction;
    use Actions\User\DeleteAction;
    use Actions\Colaborador\CountAction;

    private BarramentoClient $barramentoClient;

    private SerializerInterface $serializer;

    /**
     * VinculacaoPessoaBarramentoController constructor.
     */
    public function __construct(
        VinculacaoPessoaBarramentoResource $resource,
        ResponseHandler $responseHandler,
        BarramentoClient $barramentoClient,
        SerializerInterface $serializer
    ) {
        $this->init($resource, $responseHandler);
        $this->barramentoClient = $barramentoClient;
        $this->serializer = $serializer;
    }

    /**
     * Endpoint action para consultar repositorio no barramento.
     *
     * @Route(
     *      "/consulta_repositorio",
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function consultaRepositorio(
        Request $request,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            // Chama o client do barramento
            $consultarRepositoriosResponse = $this->barramentoClient->consultarRepositoriosDeEstruturas();

            $repositorio = [];
            if ($consultarRepositoriosResponse) {
                foreach ($consultarRepositoriosResponse->repositoriosEncontrados
                        ->repositorio as $k => $repositorioBarramento) {
                    $repositorio[$k]['id'] = $repositorioBarramento->id;
                    $repositorio[$k]['nome'] = $repositorioBarramento->nome;
                }
            }

            // Create new response
            $response = new Response();
            $response->setContent(
                $this->serializer->serialize(
                    $repositorio,
                    'json'
                )
            );
            $response->setStatusCode(200);

            return $response;
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action para consultar estruturas no barramento.
     *
     * @Route(
     *      "/consulta_estrutura",
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function consultaEstrutura(
        Request $request,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            $identificacaoRepositorio = $request->get('repositorio');
            $limit = $request->get('limit');
            $offset = $request->get('offset');

            $nomeDaEstrutura = null;
            if ($request->get('nome')) {
                $nomeDaEstrutura = $request->get('nome');
            }

            // Chama o client do barramento
            $consultarEstruturasResponse = $this->barramentoClient->consultarEstruturas(
                (int) $identificacaoRepositorio,
                (int) $identificacaoEstrutura = null,
                (string) $nomeDaEstrutura,
                (int) $limit,
                (int) $offset
            );

            $estruturas = [];
            $totalRegistros = 0;

            if ($consultarEstruturasResponse && isset($consultarEstruturasResponse->estruturasEncontradas->estrutura)) {
                $estruturaSearchBarramento = $consultarEstruturasResponse->estruturasEncontradas->estrutura ?: null;
                $totalRegistros = $consultarEstruturasResponse->estruturasEncontradas->totalDeRegistros ?: 0;

                if ($estruturaSearchBarramento &&
                    $totalRegistros > 0) {
                    if (is_array($estruturaSearchBarramento)) {
                        foreach ($estruturaSearchBarramento as $k => $estruturaBarramento) {
                            $estruturas[$k]['numeroDeIdentificacaoDaEstrutura'] =
                                $estruturaBarramento->numeroDeIdentificacaoDaEstrutura;
                            $estruturas[$k]['nome'] = $estruturaBarramento->nome;
                            $estruturas[$k]['sigla'] = $estruturaBarramento->sigla;
                            $estruturas[$k]['ativo'] = $estruturaBarramento->ativo;

                            if ($estruturaBarramento->hierarquia && $estruturaBarramento->hierarquia->nivel) {
                                foreach ($estruturaBarramento->hierarquia->nivel as $keyNivel => $hierarquia) {
                                    $estruturas[$k]['hierarquia'][$keyNivel]['nome'] = $hierarquia->nome;
                                    $estruturas[$k]['hierarquia'][$keyNivel]['sigla'] = $hierarquia->sigla;
                                    if (2 === $keyNivel) {
                                        break;
                                    }
                                }
                            }
                        }
                    } else {
                        $estruturas[0]['numeroDeIdentificacaoDaEstrutura'] =
                            $estruturaSearchBarramento->numeroDeIdentificacaoDaEstrutura;
                        $estruturas[0]['nome'] = $estruturaSearchBarramento->nome;
                        $estruturas[0]['sigla'] = $estruturaSearchBarramento->sigla;
                        $estruturas[0]['ativo'] = $estruturaSearchBarramento->ativo;

                        if ($estruturaSearchBarramento->hierarquia && $estruturaSearchBarramento->hierarquia->nivel) {
                            foreach ($estruturaSearchBarramento->hierarquia->nivel as $keyNivel => $hierarquia) {
                                $estruturas[0]['hierarquia'][$keyNivel]['nome'] = $hierarquia->nome;
                                $estruturas[0]['hierarquia'][$keyNivel]['sigla'] = $hierarquia->sigla;
                                if (2 === $keyNivel) {
                                    break;
                                }
                            }
                        }
                    }
                }
            }

            // Create new response
            $response = new Response();
            $response->setContent(
                $this->serializer->serialize(
                    ['entities' => $estruturas, 'total' => $totalRegistros],
                    'json'
                )
            );
            $response->setStatusCode(200);

            return $response;
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }
}
