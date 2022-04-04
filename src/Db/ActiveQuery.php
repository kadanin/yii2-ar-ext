<?php

namespace Kadanin\Yii2ArExt\Db;

/**
 * @method ActiveRecord|null one($db = null)
 * @method ActiveRecord|null alone($db = null)
 * @method ActiveRecord[]    all($db = null)
 * @method ActiveRecord[]    each($batchSize = 100, $db = null) Fake for IDE. Real result is [[BatchQueryResult]]
 *
 * @see \yii\db\BatchQueryResult
 */
class ActiveQuery extends \yii\db\ActiveQuery
{
    use QueryTrait;
}
