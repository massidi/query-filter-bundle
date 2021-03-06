<?php declare(strict_types=1);

namespace Artprima\QueryFilterBundle\Query\Condition;

use Artprima\QueryFilterBundle\Query\Filter;
use Doctrine\ORM\QueryBuilder;

/**
 * Class NotIn
 *
 * @author Denis Voytyuk <ask@artprima.cz>
 *
 * @package Artprima\QueryFilterBundle\Query\Condition
 */
class NotIn implements ConditionInterface
{
    public function getExpr(QueryBuilder $qb, int $index, Filter $filter)
    {
        $values = explode(',', $filter->getX() ?? '');
        $values = array_map('trim', $values);
        $expr = $qb->expr()->notIn($filter->getField(), '?'.$index);
        $qb->setParameter($index, $values);

        return $expr;
    }
}