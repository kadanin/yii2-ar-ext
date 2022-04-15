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
class ActiveQuery extends \yii\db\ActiveQuery implements ExtendedQueryInterface
{
    use QueryTrait;

    protected function andOnWhere($condition, $params = []): self
    {
        return $this->andOnCondition($condition, $params);
    }

    /**
     * @inheritDoc
     */
    public function andOnCondition($condition, $params = []): self
    {
        if ($this->on === null) {
            $this->on = $condition;
        } elseif (\is_array($this->on) && \strcasecmp($this->on[0] ?? '', 'and') === 0) {
            $this->on[] = $condition;
        } else {
            $this->on = ['and', $this->on, $condition];
        }
        $this->addParams($params);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function orOnCondition($condition, $params = []): self
    {
        if ($this->on === null) {
            $this->on = $condition;
        } elseif (\is_array($this->on) && \strcasecmp($this->on[0] ?? '', 'or') === 0) {
            $this->on[] = $condition;
        } else {
            $this->on = ['or', $this->on, $condition];
        }
        $this->addParams($params);
        return $this;
    }
}
