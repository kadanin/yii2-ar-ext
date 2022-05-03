<?php

namespace Kadanin\Yii2ArExt\Db;

use yii\db\Connection;

/**
 * The trait allows you to use operators
 * that will be automatically supplemented with an alias.
 * Example, when `Test` is Active Record with table `test`:
 * expression `(new Test)->eq('column', 42)->alias('t')`
 * will build <code>SELECT * FROM `test` `t` WHERE `t.column` = 42</code> query
 */
trait QueryTrait
{
    /**
     * Method allows to take current query main table alias (if there is)
     *
     * @return string|null
     */
    public function getAlias(): ?string
    {
        $tableNameAndAlias = $this->getTableNameAndAlias();
        return ($tableNameAndAlias[0] === $tableNameAndAlias[1]) ? null : $tableNameAndAlias[1];
    }

    /**
     * Methods limits query to 1 record before calling `one()`
     *
     * @return ActiveRecord|array|null
     */
    public function alone()
    {
        return $this->limit(1)->one();
    }

    /**
     * Method "equal" builds `IS NULL`, `IN` or `=` condition,
     * depends on the value(`null`, array, or else)
     *
     * @param string $column
     * @param mixed  $value
     *
     * @return $this
     */
    public function eq(string $column, $value): self
    {
        if (null === $value) {
            $operator = 'is';
        } elseif (\is_array($value)) {
            $operator = 'in';
        } else {
            $operator = '=';
        }

        return $this->op($operator, $column, $value);
    }

    /**
     * Method "not equal" builds `IS NOT NULL`, `NOT IN` or `<>` condition,
     * depends on the value(`null`, array, or else)
     *
     * @param string $column
     * @param mixed  $value
     *
     * @return $this
     */
    public function neq(string $column, $value): self
    {
        if (null === $value) {
            $operator = 'is not';
        } elseif (\is_array($value)) {
            $operator = 'not in';
        } else {
            $operator = '<>';
        }

        return $this->op($operator, $column, $value);
    }

    /**
     * Method "greater than" builds `>` condition
     *
     * @param string $column
     * @param mixed  $value
     *
     * @return $this
     */
    public function gt(string $column, $value): self
    {
        return $this->op('>', $column, $value);
    }

    /**
     * Method "greater than or equal" builds `>=` condition
     *
     * @param string $column
     * @param mixed  $value
     *
     * @return $this
     */
    public function gte(string $column, $value): self
    {
        return $this->op('>=', $column, $value);
    }

    /**
     * Method "lesser than" builds `<` condition
     *
     * @param string $column
     * @param mixed  $value
     *
     * @return $this
     */
    public function lt(string $column, $value): self
    {
        return $this->op('<', $column, $value);
    }

    /**
     * Method "lesser than or equal" builds `<=` condition
     *
     * @param string $column
     * @param mixed  $value
     *
     * @return $this
     */
    public function lte(string $column, $value): self
    {
        return $this->op('<=', $column, $value);
    }

    /**
     * Method "between" obviously builds `between` condition
     *
     * @param string $column
     * @param mixed  $valueBegin
     * @param mixed  $valueEnd
     *
     * @return $this
     */
    public function between(string $column, $valueBegin, $valueEnd): self
    {
        return $this->op('between', $column, $valueBegin, $valueEnd);
    }

    /**
     * This "operator" method builds standard Yii2 binary operators.
     * Multiple values used to pass additional parameters,
     * for example in Yii2 query `like` operator: `['like', 'column', '%value%', false]`
     *
     * @param string $operator
     * @param string $column
     * @param mixed  ...$values
     *
     * @return $this
     */
    public function op(string $operator, string $column, ...$values): self
    {
        $args = \func_get_args();
        $args[1] = $this->columnAlias($args[1]);
        return $this->andOnWhere($args);
    }


    /**
     * Skipping `createCommand()`
     *
     * @param \yii\db\Connection|string|null $db the DB connection used to create the DB command.
     *
     * @return string
     */
    public function rawSql($db = null): string
    {
        return $this->createCommand($db)->rawSql;
    }

    /**
     * Like normal `count()`, only with conversion
     *
     * @param string                 $q
     * @param Connection|string|null $db
     * @return int
     *
     * @see count()
     */
    public function countInt(string $q = '*', $db = null): int
    {
        return (int)$this->count($q, $db);
    }

    /**
     * Wrapping column with alias expression
     *
     * @param string $column
     *
     * @return DeferredColumnAliasExpression
     */
    public function columnAlias(string $column): DeferredColumnAliasExpression
    {
        return new DeferredColumnAliasExpression('', [], ['extendedQuery' => $this, 'column' => $column]);
    }

    /**
     * Method uses `andWhere()` or `andOnCondition()` depends on query class
     *
     * @param       $condition
     * @param array $params
     *
     * @return $this
     */
    abstract protected function andOnWhere($condition, array $params = []): self;

    /**
     * Obviously get table name and alias, if exists
     *
     * @return mixed
     */
    abstract protected function getTableNameAndAlias();
}
