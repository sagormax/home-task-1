<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4634fb59aab67e308cceb9e56c5a414d
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TrxCommission\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TrxCommission\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4634fb59aab67e308cceb9e56c5a414d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4634fb59aab67e308cceb9e56c5a414d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}