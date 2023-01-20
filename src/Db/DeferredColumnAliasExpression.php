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

    public static function make(ExtendedQueryInterface $extendedQuery, string $column): self
    {
        return new self('', [], \compact('extendedQuery', 'column'));
    }

    /**
     * String magic method.
     * @return string the DB expression.
     */
    public function __toString()
    {
        return ($alias = $this->extendedQuery->getAlias()) ? "[[$alias.{$this->column}]]" : $this->column;
    }
}
