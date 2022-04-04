<?php

namespace Kadanin\Yii2ArExt\Db;

/**
 * @method array|null alone($db = null)
 */
class Query extends \yii\db\Query
{
    use QueryTrait;

    /**
     * @param $db
     *
     * @return array|null
     */
    public function one($db = null): ?array
    {
        return parent::one($db) ?: null;
    }

    protected function getTableNameAndAlias(): array
    {
        if (empty($this->from)) {
            throw new \BadMethodCallException('Can not detect alias with empty ' . static::class . '::$from');
        }

        $tableName = '';
        // if the first entry in "from" is an alias-table name-pair return it directly
        /** @noinspection LoopWhichDoesNotLoopInspection */
        foreach ($this->from as $alias => $tableName) {
            if (is_string($alias)) {
                return [$tableName, $alias];
            }
            break;
        }

        if (preg_match('/^(.*?)\s+({{\w+}}|\w+)$/', $tableName, $matches)) {
            $alias = $matches[2];
        } else {
            $alias = $tableName;
        }

        return [$tableName, $alias];
    }
}
