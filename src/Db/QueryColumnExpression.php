<?php

namespace Kadanin\Yii2ArExt\Db;

use yii\db\Expression;

final class QueryColumnExpression extends Expression
{
    public ExtendedQueryInterface $extendedQuery;
    public string $column;

    /**
     * String magic method.
     * @return string the DB expression.
     */
    public function __toString()
    {
        return ($alias = $this->extendedQuery->getAlias()) ? "$alias.{$this->column}" : $this->column;
    }
}
