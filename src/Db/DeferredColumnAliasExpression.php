<?php

namespace Kadanin\Yii2ArExt\Db;

use yii\db\Expression;

/**
 * Expression adds to column the latest alias in query
 */
final class DeferredColumnAliasExpression extends Expression
{
    public ExtendedQueryInterface $extendedQuery;
    public string $column;

    /**
     * String magic method.
     * @return string the DB expression.
     */
    public function __toString()
    {
        return ($alias = $this->extendedQuery->getAlias()) ? "[[$alias.{$this->column}]]" : $this->column;
    }
}
