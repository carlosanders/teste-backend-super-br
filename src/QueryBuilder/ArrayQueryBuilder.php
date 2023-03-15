<?php

declare(strict_types=1);
/**
 * /src/QueryBuilder/ArrayQueryBuilder.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\QueryBuilder;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Mapping\MappingException;
use Doctrine\ORM\QueryBuilder;

/**
 * Class ArrayQueryBuilder.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ArrayQueryBuilder
{
    private EntityManagerInterface $em;
    private QueryBuilder $qb;
    private array $alias = [];
    private array $parameters = [];
    private string $rootAliasControl = 'abcdefghijklmnopqrstuvwxyz';
    private array $rootAliasAllocated = [];
    private string $rootAlias = 'a';
    private ClassMetadata $meta;
    private bool $hasLike = false;
    private bool $hasToMany = false;

    /**
     * ArrayQueryBuilderService constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $params
     * @param bool  $isSubquery
     *
     * @return QueryBuilder
     *
     * @throws MappingException
     */
    public function buildQueryBuilder(array $params, $isSubquery = false): QueryBuilder
    {
        $this->qb = $this->em->createQueryBuilder();
        if (!$isSubquery) {
            $this->rootAlias = 'a';
            $this->rootAliasAllocated = [$this->rootAlias];
            $this->hasLike = false;
            $this->hasToMany = false;
        } else {
            for ($i = 0; $i < 27; ++$i) {
                if (!in_array($this->rootAliasControl[$i], $this->rootAliasAllocated)) {
                    $this->rootAlias = $this->rootAliasControl[$i];
                    $this->rootAliasAllocated[] = $this->rootAlias;
                    break;
                }
            }
        }
        $this->alias = [
            'rootEntity' => [
                'parentAlias' => null,
                'alias' => $this->rootAlias.'0',
            ],
        ];
        $this->parameters = [];
        $this->meta = $this->em->getClassMetadata($params['object']);

        if (!isset($params['select'])) {
            $this->qb->select($this->rootAlias.'0');
        } else {
            asort($params['select']);
            foreach ($params['select'] as $property) {
                $alias = $this->alocateAlias($property, true);
                $bits = explode('.', $property);
                $this->qb->addSelect(
                    $alias['alias'].'.'.array_pop($bits)
                );
            }
        }

        $this->qb->from($params['object'], $this->rootAlias.'0');

        if (!isset($params['fetch'])) {
            $params['fetch'] = [];
        }

        asort($params['fetch']);

        foreach ($params['fetch'] as $join) {
            $this->alocateAlias($join);
            $this->verifyHasToMany($join, $this->meta);
        }

        if (!isset($params['sort'])) {
            $params['sort'] = [];
        }

        ksort($params['sort']);

        foreach ($params['sort'] as $property => $direction) {
            $alias = $this->alocateAlias($property, true);
            $bits = explode('.', $property);
            $this->qb->addOrderBy(
                $alias['alias'].'.'.array_pop($bits),
                $direction
            );
        }

        if (isset($params['filter']) && is_array($params['filter']) && count($params['filter'])) {
            $a = $this->where($params['filter']);

            $this->qb->where(
                $a
            );
        }

        if (isset($params['groupBy'])) {
            asort($params['groupBy']);
            foreach ($params['groupBy'] as $property) {
                $alias = $this->alocateAlias($property, true);
                $bits = explode('.', $property);
                $this->qb->addGroupBy(
                    $alias['alias'].'.'.array_pop($bits)
                );
            }
        }

        foreach ($this->parameters as $index => $parameter) {
            $this->qb->setParameter($index + 1, $parameter);
        }

        $this->qb->setMaxResults($params['limit'] ?? 100);
        $this->qb->setFirstResult($params['offset'] ?? 0);

        return $this->qb;
    }

    /**
     * @param array $fetch
     *
     * @return void
     */
    public function verifyHasToMany(string $fetch, $meta): void
    {
        $bits = explode('.', $fetch);
        foreach ($bits as $i => $bit) {
            // association
            if ($meta->isCollectionValuedAssociation($bit)) {
                $this->hasToMany = true;
            }
            $mapping = $meta->getAssociationMapping($bit);
            $meta = $this->em->getClassMetadata($mapping['targetEntity']);
        }
    }

    /**
     * @param $filter
     *
     * @throws MappingException
     */
    private function where($filter)
    {
        $andX = $this->qb->expr()->andX();
        foreach ($filter as $key => $value) {
            if ('exists' === $key) {
                $exists = $this->qb->expr()->exists(
                    $this->buildQueryBuilder($value, true)->getDQL()
                );
                $andX->add($exists);
            }
            if ('orX' === $key) {
                $orX = $this->qb->expr()->orX();
                foreach ($value as $orValue) {
                    $orX->add($this->where($orValue));
                }
                $andX->add($orX);
                continue;
            }
            if ('andX' === $key) {
                foreach ($value as $andValue) {
                    foreach ($andValue as $andKey => $andFilter) {
                        $exp = $this->getExpression($andKey, $andFilter);
                        $andX->add($exp);
                    }
                }
                continue;
            }
            $exp = $this->getExpression($key, $value);
            $andX->add($exp);
        }

        return $andX;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return array
     *
     * @throws MappingException
     */
    private function getExpression($key, $value)
    {
        $alias = $this->alocateAlias($key, true);
        $bitsKey = explode('.', $key);
        $exp = [$alias['alias'].'.'.array_pop($bitsKey)];

        if ('isNull' === $value || 'isNotNull' === $value) {
            return $this->qb->expr()->$value(
                ...$exp
            );
        }

        $bits = explode(':', $value);
        $operator = array_shift($bits);
        $value = implode(':', $bits);

        if (isset($value)) {
            if ('in' === $operator || 'notIn' === $operator) {
                $exp[] = $this->alocateParameter(explode(',', $value), $key);
            } else {
                $exp[] = $this->alocateParameter($value, $key);
            }
        }

        if ('like' === $operator) {
            $this->hasLike = true;
        }

        return $this->qb->expr()->$operator(
            ...$exp
        );
    }

    /**
     * @param $item
     * @param false $hasProperty
     *
     * @return array
     *
     * @throws MappingException
     */
    private function alocateAlias($item, $hasProperty = false): array
    {
        $bits = explode('.', $item);

        if ($hasProperty) {
            array_pop($bits);
        }

        if (!count($bits)) {
            return $this->alias['rootEntity'];
        }

        $target = implode('.', $bits);
        $lastBit = array_pop($bits);
        $parentBit = null;
        if (count($bits)) {
            $parentBit = implode('.', $bits);
            if (!isset($this->alias[$parentBit])) {
                $this->alocateAlias($parentBit);
            }
        }

        if (!isset($this->alias[$target])) {
            $alias = $this->rootAlias.(string) (count($this->alias));
            $parentAlias = $parentBit ? $this->resolveAlias($parentBit)['alias'] : $this->rootAlias.'0';
            $this->alias[$target] = [
                'parentAlias' => $parentAlias,
                'alias' => $alias,
            ];
            $bits = explode('.', $target);
            $this->qb->leftJoin(
                $parentAlias.'.'.$lastBit,
                $alias
            );
        }

        return $this->resolveAlias($item, $hasProperty);
    }

    /**
     * @param $item
     * @param false $hasProperty
     *
     * @return array
     */
    private function resolveAlias($item, $hasProperty = false): array
    {
        $bits = explode('.', $item);

        if ($hasProperty) {
            array_pop($bits);
        }

        if (!count($bits)) {
            return $this->alias['rootEntity'];
        }

        $target = implode('.', $bits);

        return $this->alias[$target];
    }

    /**
     * @param $item
     * @param $key
     *
     * @return string
     *
     * @throws MappingException
     */
    private function alocateParameter($item, $key): string
    {
        $meta = $this->meta;
        $bits = explode('.', $key);
        $mapping = [];
        foreach ($bits as $i => $bit) {
            if ($i === count($bits) - 1) {
                // property
                $mapping = $meta->getFieldMapping($bit);
            } else {
                // association
                if ($meta->isCollectionValuedAssociation($bit)) {
                    $this->hasToMany = true;
                }
                $mapping = $meta->getAssociationMapping($bit);
                $meta = $this->em->getClassMetadata($mapping['targetEntity']);
            }
        }
        if ('datetime' === $mapping['type']) {
            $item = DateTime::createFromFormat('Y-m-d\TH:i:s', $item);
        }
        if ('date' === $mapping['type']) {
            $data = DateTime::createFromFormat('Y-m-d', $item);
            $item = $data->format('Y-m-d');
        }
        if ('boolean' === $mapping['type'] && 'true' === $item) {
            $item = true;
        }
        if ('boolean' === $mapping['type'] && 'false' === $item) {
            $item = false;
        }
        if ('item' === $mapping['type']) {
            $item = (int) $item;
        }
        $this->parameters[] = $item;

        return '?'.(string) count($this->parameters);
    }

    /**
     * @return bool
     */
    public function hashLike(): bool
    {
        return $this->hasLike;
    }

    /**
     * @return bool
     */
    public function hashToMany(): bool
    {
        return $this->hasToMany;
    }
}
