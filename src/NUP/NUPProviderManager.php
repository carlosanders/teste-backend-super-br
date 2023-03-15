<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\NUP;

use DateTime;
use RuntimeException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDto;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use function PHPUnit\Framework\stringContains;

/**
 * Class NUPProviderManager.
 */
class NUPProviderManager
{
    /**
     * @var array
     */
    private array $providers = [];

    /**
     * @param NumeroUnicoProtocoloInterface $provider
     */
    public function addProvider(NumeroUnicoProtocoloInterface $provider): void
    {
        $this->providers[$provider->getOrder()] = $provider;
    }

    /**
     * @param ProcessoEntity|ProcessoDto $processo
     *
     * @return NumeroUnicoProtocoloInterface
     */
    public function getNupProvider(ProcessoEntity|ProcessoDto $processo): NumeroUnicoProtocoloInterface
    {
        ksort($this->providers);

        if (!count($this->providers)) {
            throw new RuntimeException('Nenhum provider de NUP foi encontrado!');
        }

        if ($processo->getConfiguracaoNup()) {
            foreach ($this->getAllNupProviders() as $provider) {
                if ($provider->getNome() === $processo->getConfiguracaoNup()->getNome()) {
                    return $provider;
                }
            }
        }

        // caso o processo não tenha configuracaoNUP e tenha 15 digitos
        if ($processo->getNUP()) {
            $digitos = str_replace(['-', '.', '/', '\\', ' '], '', $processo->getNUP());
            $tamanho = strlen($digitos);
            if (!$processo->getConfiguracaoNup() && $tamanho === 15) {
                foreach ($this->getAllNupProviders() as $provider) {
                    if (str_contains($provider->getSigla(), (string)$tamanho)) {
                        return $provider;
                    }
                }
            }
        }

        $dataHoraAbertura = $processo->getDataHoraAbertura() ?? new DateTime();

        $providerVigente = null;
        foreach ($this->getAllNupProviders() as $provider) {
            if (!$provider->getDataHoraFimVigencia()) {
                $providerVigente = $provider;
            }
            if ($provider->getDataHoraInicioVigencia() <= $dataHoraAbertura &&
                (!$provider->getDataHoraFimVigencia() ||
                    ($provider->getDataHoraFimVigencia() > $dataHoraAbertura))) {
                return $provider;
            }
        }

        // caso o processo não se enquadra em nenhum retorna o vigente
        return $providerVigente;
    }

    /**
     * @return NumeroUnicoProtocoloInterface[]
     */
    public function getAllNupProviders(): array
    {
        return $this->providers;
    }
}
