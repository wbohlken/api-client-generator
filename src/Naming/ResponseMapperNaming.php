<?php

namespace DoclerLabs\ApiClientGenerator\Naming;

use DoclerLabs\ApiClientGenerator\Entity\Field;

class ResponseMapperNaming
{
    private const FILE_SUFFIX = 'ResponseMapper';

    public static function getClassName(Field $field): string
    {
        return sprintf('%s%s', $field->getPhpClassName(), self::FILE_SUFFIX);
    }

    public static function getPropertyName(Field $field): string
    {
        return sprintf('%s%s', lcfirst($field->getPhpClassName()), self::FILE_SUFFIX);
    }
}