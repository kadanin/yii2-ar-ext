<?php

namespace Kadanin\Yii2ArExt\Debug;

use yii\console\Controller;
use yii\helpers\Console;

class TestController extends Controller
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        Console::output(\PHP_VERSION);

        return true;
    }

    public function actionTest(): void
    {
        $q = Test::find();
        $q
            ->alias('a')
            ->eq('name', 'Peps')
            ->alias('b')
        ;
        Console::output($q->rawSql());
        Console::output('TEST');
    }

    public function actionAnon(): void
    {
        Console::output('BEGIN');
        foreach ([1, 2] as $item) {
            Console::output((new class { public function name(): string { return static::class; } })->name());
        }
        Console::output((new class { public function name(): string { return static::class; } })->name());
        Console::output('END');
    }
}
