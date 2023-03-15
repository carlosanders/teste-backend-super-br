<?php

declare(strict_types=1);
/**
 * /src/Fields/RendererManager.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Fields;

use SuppCore\AdministrativoBackend\Api\V1\Resource\ComponenteDigitalResource;
use SuppCore\AdministrativoBackend\Entity\ComponenteDigital as ComponenteDigitalEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Utils\lib\simple_html_dom;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

use function explode;
use function trim;

/**
 * Class RendererManager.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class RendererManager
{
    private null|string $templateWrapper;

    /**
     * RendererManager constructor.
     */
    public function __construct(
        private readonly Environment $twig,
        private readonly TokenStorageInterface $tokenStorage,
        private readonly FieldsManager $fieldsManager,
        private readonly ParameterBagInterface $parameterBag,
        private readonly ComponenteDigitalResource $componenteDigitalResource,
        private readonly StylesManager $stylesManager,
    ) {
        $this->templateWrapper = null;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function renderModelo(
        EntityInterface|ComponenteDigitalEntity $componenteDigital,
        string $transactionId,
        array $contextoEspecifico = [],
        ?string $conteudoReprocessado = null
    ): string {
        $documento = $componenteDigital->getDocumento();

        $processo = $documento->getProcessoOrigem();
        $tarefa = $documento->getTarefaOrigem();

        $parser = new simple_html_dom();

        if (!$conteudoReprocessado) {
            $conteudoHTMLTemplate = $this->componenteDigitalResource->download(
                $componenteDigital->getModelo()->getTemplate()->getDocumento()->getComponentesDigitais()[0]->getId(),
                $transactionId
            )->getConteudo();
            $conteudoHTMLModelo = $this->componenteDigitalResource->download(
                $componenteDigital->getModelo()->getDocumento()->getComponentesDigitais()[0]->getId(),
                $transactionId
            )->getConteudo();

            $parser->load($conteudoHTMLTemplate);

            foreach ($parser->find('div') as $div) {
                if ('conteudoModelo' === $div->id) {
                    $div->outertext = $conteudoHTMLModelo;
                    break;
                }
            }
        } else {
            $parser->load($conteudoReprocessado);
        }

        /* @noinspection PhpUndefinedFieldInspection */
        $parser->load($parser->innertext);

        $usuario = $this->tokenStorage->getToken()->getUser();

        // na soma de arrays se uma chava se repete prevalece a chave do primeiro array
        // no caso abaixo, do array referente ao contexto "generico" em detrimento do especifico
        $contexto = [
            'processo' => $processo,
            'documento' => $documento,
            'tarefa' => $tarefa,
            'usuario' => $usuario,
            'componenteDigital' => $componenteDigital,
        ] + $contextoEspecifico;

        foreach ($parser->find('span') as $span) {
            $options = [];
            if (isset($span->{'data-method'})) {
                $name = $span->{'data-method'};
                $options = explode(', ', $span->{'data-options'});
                $field = $this->fieldsManager->getField($name);
                if ($field && !isset($span->{'data-static'})) {
                    $span->innertext = $field->render($transactionId, $contexto, $options);
                    continue;
                }
                $field = $this->fieldsManager->getField($this->getNomeCampo($span->innertext));
                if ($field && !isset($span->{'data-static'})) {
                    $span->innertext = str_replace(
                        '*'.$this->getNomeCampo($span->innertext).'*',
                        $field->render($transactionId, $contexto, $options),
                        $span->innertext
                    );
                }
                $span->outertext = '';
            }
        }

        /* @noinspection PhpUndefinedFieldInspection */
        return $this->renderCkeditorWithContext($componenteDigital, $parser->innertext);
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function renderCkeditor(string $conteudo): string
    {
        // verifica se há template específico para o modelo.
        $template = $this->getTemplateWrapper() ?:
                    $this->parameterBag->get('supp_core.administrativo_backend.template_ckeditor_administrativo_comum');

        // reseta o template
        $this->setTemplateWrapper(null);

        return $this->twig->render(
            $template,
            [
                'conteudo' => $conteudo,
            ]
        );
    }

    public function renderCkeditorWithContext(
        EntityInterface|ComponenteDigitalEntity $componenteDigital,
        string $conteudo
    ): string {
        $css = $this->stylesManager->select($componenteDigital);

        // verifica se há template específico para o modelo.
        $template = $this->getTemplateWrapper() ?:
            $css['comum'];

        // reseta o template
        $this->setTemplateWrapper(null);

        return $this->twig->render(
            $template,
            [
                'conteudo' => $conteudo,
            ]
        );
    }

    private function getNomeCampo($text): bool|string
    {
        $strings = explode('*', $text);

        if (count($strings) > 1) {
            return trim($strings[1]);
        } else {
            return false;
        }
    }

    public function getTemplateWrapper(): null|string
    {
        return $this->templateWrapper;
    }

    public function setTemplateWrapper(string|null $templateWrapper): RendererManager
    {
        $this->templateWrapper = $templateWrapper;

        return $this;
    }
}
