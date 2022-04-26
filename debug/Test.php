<?php

namespace Kadanin\Yii2ArExt\Debug;

use Kadanin\Yii2ArExt\Db\ActiveRecord;
use Yii;

class Test extends ActiveRecord
{
    public static function find(): TestQuery
    {
        return Yii::createObject(TestQuery::class, [static::class]);
    }

    public static function tableName(): string
    {
        return 'test';
    }
}
