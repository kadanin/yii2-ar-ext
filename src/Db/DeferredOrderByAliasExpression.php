<?php

namespace Kadanin\Yii2ArExt\Db;

use yii\db\Expression;

/**
 * Expression adds to column the latest alias in query
 */
final class DeferredOrderByAliasExpression extends Expression
{
    public ExtendedQueryInterface $extendedQuery;
    public string $column;
    public int $direction;

    /**
     * String magic method.
     * @return string the DB expression.
     */
    public function __toString()
    {
        $direction = (\SORT_DESC === $this->direction ? ' DESC' : '');

        return (DeferredColumnAliasExpression::make($this->extendedQuery, $this->column)) . $direction;
    }
}
