<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit120e2d801fa5da61efb25068f2d81646
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Park\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Park\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit120e2d801fa5da61efb25068f2d81646::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit120e2d801fa5da61efb25068f2d81646::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit120e2d801fa5da61efb25068f2d81646::$classMap;

        }, null, ClassLoader::class);
    }
}
