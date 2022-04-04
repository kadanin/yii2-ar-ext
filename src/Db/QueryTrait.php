<?php

namespace Kadanin\Yii2ArExt\Db;

trait QueryTrait
{
    public function gainAlias(): ?string
    {
        $tableNameAndAlias = $this->getTableNameAndAlias();

        return ($tableNameAndAlias[0] === $tableNameAndAlias[1]) ? null : $tableNameAndAlias[1];
    }

    abstract protected function getTableNameAndAlias(): array;

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
     * @return mixed
     */
    public function eq(string $column, $value)
    {
        return $this->andOnWhere([$this->columnAlias($column) => $value]);
    }

    abstract protected function andOnWhere($condition, $params = []);

    public function columnAlias(string $column): string
    {
        return ($alias = $this->gainAlias()) ? "$alias.$column" : $column;
    }
}
