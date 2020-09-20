<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1d80fcf0c0a150c41289d296aa2c7d70
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Grav\\Plugin\\FlexDirectory\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Grav\\Plugin\\FlexDirectory\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1d80fcf0c0a150c41289d296aa2c7d70::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1d80fcf0c0a150c41289d296aa2c7d70::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}