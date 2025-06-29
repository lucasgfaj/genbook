<?php

namespace Core\Constants;

class Constants
{
    public static function rootPath(): StringPath
    {
        return new StringPath(realpath(__DIR__ . '/../../'));
    }

    public static function databasePath(): StringPath
    {
        return self::rootPath()->join('/database');
    }
}
