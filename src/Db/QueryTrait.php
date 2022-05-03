<?php

namespace Kadanin\Yii2ArExt\Db;

use yii\db\Connection;

trait QueryTrait
{
    public function getAlias(): ?string
    {
        $tableNameAndAlias = $this->getTableNameAndAlias();

        return ($tableNameAndAlias[0] === $tableNameAndAlias[1]) ? null : $tableNameAndAlias[1];
    }

    /**
     * @return array|null|ActiveRecord
     */
    public function alone()
    {
        return $this->limit(1)->one();
    }

    /**
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
     * Пропускаем `createCommand()`
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
     * Как обычный `count()`, только с конверсией и типизацией
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
     * @param string $column
     *
     * @return QueryColumnExpression
     */
    public function columnAlias(string $column): QueryColumnExpression
    {
        return new QueryColumnExpression('', [], ['extendedQuery' => $this, 'column' => $column]);
    }

    abstract protected function andOnWhere($condition, array $params = []): self;

    abstract protected function getTableNameAndAlias();
}
