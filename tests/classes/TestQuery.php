<?php

namespace tests\classes;

use Kadanin\Yii2ArExt\Db\ActiveQuery;

/**
 * @method Test|null one($db = null)
 * @method Test|null alone($db = null)
 * @method Test[]    all($db = null)
 *
 * @see \tests\classes\Test
 */
class TestQuery extends ActiveQuery
{
    /**
     * @param int $id
     *
     * @return $this
     */
    public function byID(int $id): self
    {
        return $this->eq('id', $id);
    }
}
