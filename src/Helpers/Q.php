<?php

namespace Kadanin\Yii2ArExt\Helpers;

use yii\db\Expression;

/**
 * Класс-квотатор для полей, используемых в выражениях с полями.
 * Возвращает квотированную строку, либо @see Expression с таковой.
 * При необходимости кэширует экземпляры выражений в рамках времени выполнения скрипта
 */
class Q
{
    /**
     * Кэшированные экземпляры выражений
     *
     * @see Expression
     *
     * @var array<string,Expression>
     */
    private static array $_e = [];

    /**
     * Возвращает имя связи с прикреплённым алиасом
     *
     * @param string      $relationName - Имя связи
     * @param string|null $alias        - Алиас
     *
     * @return string
     */
    public static function ar(string $relationName, ?string $alias = null): string
    {
        return $relationName . (empty($alias = \trim($alias)) ? '' : " $alias");
    }

    /**
     * Возвращает объект-выражение имени столбца с прикреплённым псевдонимом
     *
     * @param string      $column Имя столбца
     * @param string|null $alias  Алиас
     *
     * @return Expression
     */
    public static function eaf(string $column, ?string $alias = null): Expression
    {
        return static::e('[[' . static::af($column, $alias) . ']]');
    }

    /**
     * Кэширует инстансы выражений по их тексту
     *
     * @param string $string
     *
     * @return Expression
     */
    public static function e(string $string): Expression
    {
        return self::$_e[$string] ?? (self::$_e[$string] = new Expression($string));
    }

    /**
     * Возвращает имя столбца с прикреплённым алиасом
     *
     * @param string      $fieldName Имя столбца
     * @param string|null $alias     Алиас
     *
     * @return string
     */
    public static function af(string $fieldName, ?string $alias = null): string
    {
        return (empty($alias = \trim($alias)) ? '' : "$alias.") . $fieldName;
    }
}
