<?php

use yii\console\Application;
use yii\db\Connection;

(new class {
    public function run(): void
    {
        $root = \dirname(__DIR__);

        require $root . '/vendor/autoload.php';
        require $root . '/vendor/yiisoft/yii2/Yii.php';

        new Application([
            'id'         => 'test-app',
            'basePath'   => $root,
            'aliases'    => [
                '@app' => __DIR__,
            ],
            'components' => [
                'db' => [
                    'class' => Connection::class,
                    'dsn'   => 'sqlite:@app/data/db.sqlite',
                ],
            ],
        ]);
    }
})->run();
