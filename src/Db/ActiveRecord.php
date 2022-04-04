<?php

namespace Kadanin\Yii2ArExt\Db;

use Yii;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public static function find()
    {
        return Yii::createObject(ActiveQuery::class, [static::class]);
    }
}
