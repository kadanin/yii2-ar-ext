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
     * @param string|string[]  $text
     * @param false|null|array $escapingReplacements
     *
     * @return $this
     */
    public function likeText($text, $escapingReplacements = null): self
    {
        return $this->like('text', $text, $escapingReplacements);
    }
}
