<?php

namespace Kadanin\Yii2ArExt\Db;

use Yii;

class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @return ActiveQuery
     */
    public static function find(): ActiveQuery
    {
        return Yii::createObject(ActiveQuery::class, [static::class]);
    }
}
