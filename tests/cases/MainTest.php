<?php

namespace tests\cases;

use PHPUnit\Framework\TestCase;
use tests\classes\Test;
use yii\db\Connection;

class MainTest extends TestCase
{
    private ?Connection $db = null;

    public function testMain(): void
    {
        static::assertEquals('SELECT * FROM `test` `t` WHERE `t`.`id` = 1', Test::find()->byID(1)->alias('t')->rawSql($this->db()));
        static::assertEquals(['id' => 1, 'text' => 'text1'], Test::find()->orderBy(['id' => \SORT_ASC])->asArray()->alone());
        static::assertEquals([['id' => 2, 'text' => 'text2']], Test::find()->byID(2)->asArray()->all());
    }

    private function db(): Connection
    {
        $dir = \dirname(\realpath(__DIR__));
        echo "sqlite:$dir/data/db.sqlite\n";
        return $this->db ?? ($this->db = new Connection(['dsn' => 'sqlite:@app/tests/data/db.sqlite']));
    }
}
