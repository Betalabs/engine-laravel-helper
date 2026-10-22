<?php

namespace Betalabs\LaravelHelper\Models\Enums;

use MyCLabs\Enum\Enum;

class ExtraFieldType extends Enum
{
    public const TEXT = 'text';
    public const SELECT = 'select';
    public const RADIO = 'radio';
    public const CHECKBOX = 'checkbox';
    public const NUMBER = 'number';
    public const ENTITY_REFERENCE = 'entity_reference';
    public const MULTIPLE_ENTITY_REFERENCE = 'multiple_entity_reference';
    public const TEXTAREA = 'textarea';
    public const WYSIWYG = 'wysiwyg';
    public const FILE = 'file';

    /**
     * Return if extra field is text
     *
     * @param $type
     *
     * @return bool
     */
    public static function isText(string $type)
    {
        return $type == self::TEXT;
    }

    /**
     * Return if extra field is 'select'
     *
     * @param $type
     *
     * @return bool
     */
    public static function isSelect(string $type)
    {
        return $type == self::SELECT;
    }

    /**
     * Return if extra field is 'radio'
     *
     * @param $type
     *
     * @return bool
     */
    public static function isRadio(string $type)
    {
        return $type == self::RADIO;
    }

    /**
     * Return if extra field is 'checkbox'
     *
     * @param $type
     *
     * @return bool
     */
    public static function isCheckbox(string $type)
    {
        return $type == self::CHECKBOX;
    }

    /**
     * Return if extra field is 'number'
     *
     * @param $type
     *
     * @return bool
     */
    public static function isNumber(string $type)
    {
        return $type == self::NUMBER;
    }

    /**
     * Return if extra field is 'textarea'
     *
     * @param $type
     *
     * @return bool
     */
    public static function isTextarea(string $type)
    {
        return $type == self::TEXTAREA;
    }

    /**
     * Return if extra field is 'model_reference'
     *
     * @param $type
     *
     * @return bool
     */
    public static function isEntityReference(string $type)
    {
        return $type == self::ENTITY_REFERENCE;
    }

    /**
     * Return if extra field is 'multiple_model_reference'
     *
     * @param $type
     *
     * @return bool
     */
    public static function isMultipleEntityReference(string $type)
    {
        return $type == self::MULTIPLE_ENTITY_REFERENCE;
    }

    /**
     * Return if extra field is 'wysiwyg'
     *
     * @param $type
     *
     * @return bool
     */
    public static function isWysiwyg(string $type)
    {
        return $type == self::WYSIWYG;
    }

    /**
     * Return if field is 'file'
     *
     * @param $type
     *
     * @return bool
     */
    public static function isFile(string $type): bool
    {
        return $type == self::FILE;
    }

    /**
     * Return if is inputtable based type
     *
     * @param string $type
     *
     * @return bool
     */
    public static function isInputtable(string $type): bool
    {
        return (
            self::isText($type)
            || self::isNumber($type)
            || self::isTextarea($type)
            || self::isWysiwyg($type)
        );
    }

    /**
     * Return if is selectable based type
     *
     * @param string $type
     *
     * @return bool
     */
    public static function isSelectable(string $type): bool
    {
        return (
            self::isSelect($type)
            || self::isRadio($type)
            || self::isCheckbox($type)
        );
    }
}
