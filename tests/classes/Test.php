<?php

namespace tests\classes;

use Kadanin\Yii2ArExt\Db\ActiveRecord;

/**
 * @property string $id   [INTEGER]
 * @property string $text [TEXT]
 *
 * @method static TestQuery hasOneMe($activeRecord, array $link)
 * @method static TestQuery hasManyMe($activeRecord, array $link)
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
