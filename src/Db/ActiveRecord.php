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

    /**
     * Overriding this in PHPDoc helps IDE to detect resulting query
     * This will not be typehinted for now in case of cross-db relations
     *
     * @param \yii\db\BaseActiveRecord $activeRecord
     * @param array                    $link
     *
     * @return \yii\db\ActiveQueryInterface
     */
    public static function hasOneMe($activeRecord, array $link)
    {
        return $activeRecord->hasOne(static::class, $link);
    }

    /**
     * Overriding this in PHPDoc helps IDE to detect resulting query
     * This will not be typehinted for now in case of cross-db relations
     *
     * @param \yii\db\BaseActiveRecord $activeRecord
     * @param array                    $link
     *
     * @return \yii\db\ActiveQueryInterface
     */
    public static function hasManyMe($activeRecord, array $link)
    {
        return $activeRecord->hasMany(static::class, $link);
    }
}
