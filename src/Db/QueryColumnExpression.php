<?php

namespace Kadanin\Yii2ArExt\Db;

use yii\db\ExpressionInterface;

class QueryColumnExpression implements ExpressionInterface
{

    private ExtendedQueryInterface $extendedQuery;
    private string                 $column;

    /**
     * @param ExtendedQueryInterface $extendedQuery
     * @param string                 $column
     */
    public function __construct(ExtendedQueryInterface $extendedQuery, string $column)
    {
        $this->extendedQuery = $extendedQuery;
        $this->column        = $column;
    }

    /**
     * String magic method.
     * @return string the DB expression.
     */
    public function __toString()
    {
        return ($alias = $this->extendedQuery->gainAlias()) ? "$alias.{$this->column}" : $this->column;
    }
}
