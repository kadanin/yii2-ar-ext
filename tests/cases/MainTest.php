<?php

namespace tests\cases;

use PHPUnit\Framework\TestCase;
use tests\classes\Test;

class MainTest extends TestCase
{
    public function testMain(): void
    {
        static::assertEquals(
            'SELECT * FROM `test` `t` GROUP BY `t`.`id` ORDER BY `t`.`text` DESC',
            Test::find()->alias('a')->order(['text' => \SORT_DESC])->group(['id'])->alias('t')->rawSql()
        );
        static::assertEquals(
            "SELECT * FROM `test` `a` WHERE `a`.`text` LIKE '%text%' ESCAPE '\'",
            Test::find()->alias('a')->likeText('text')->rawSql()
        );
        static::assertEquals(
            "SELECT * FROM `test` `a` WHERE `a`.`text` LIKE '%text' ESCAPE '\'",
            Test::find()->alias('a')->likeText('%text', false)->rawSql()
        );
        static::assertEquals(
            "SELECT * FROM `test` `a` WHERE `a`.`text` LIKE '%text1%' ESCAPE '\' OR `a`.`text` LIKE '%text2%' ESCAPE '\'",
            Test::find()->alias('a')->likeText(['text1', 'text2'])->rawSql()
        );
        static::assertEquals(
            'SELECT `t`.`text` AS `txt` FROM `test` `t` GROUP BY `t`.`text` ORDER BY `t`.`text` DESC',
            Test::find()->alias('a')->selectColumns(['txt' => 'text'])->order(['text' => \SORT_DESC])->group(['text'])->alias('t')->rawSql()
        );
        static::assertEquals(['id' => 1, 'text' => 'text1'], Test::find()->orderBy(['id' => \SORT_ASC])->asArray()->alone());
        static::assertEquals([['id' => 2, 'text' => 'text2']], Test::find()->likeText(2)->asArray()->all());
    }
}
