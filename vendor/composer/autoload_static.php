<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite04d20b0ff9192b2c06aa8e9b57c8423
{
    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 
            array (
                0 => __DIR__ . '/..' . '/composer/installers/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInite04d20b0ff9192b2c06aa8e9b57c8423::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
