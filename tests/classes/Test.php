<?php

namespace tests\classes;

use Kadanin\Yii2ArExt\Db\ActiveRecord;

/**
 * @property string $id   [INTEGER]
 * @property string $text [TEXT]
 */
class Test extends ActiveRecord
{
    public static function find(): TestQuery
    {
        return new TestQuery(static::class);
    }

    public static function tableName(): string
    {
        return 'test';
    }
}
