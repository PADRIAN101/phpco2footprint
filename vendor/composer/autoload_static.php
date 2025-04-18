<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit15a2838681f154bc4d8319e159a2f1f7
{
    public static $files = array (
        '2d1c84652d79cc07736f31def571d7aa' => __DIR__ . '/../..' . '/src/App/Config/Routes.php',
        '555f67a8cff8babd58e6646330a839d4' => __DIR__ . '/../..' . '/src/App/Config/Middleware.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Framework\\' => 10,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Framework',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit15a2838681f154bc4d8319e159a2f1f7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit15a2838681f154bc4d8319e159a2f1f7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit15a2838681f154bc4d8319e159a2f1f7::$classMap;

        }, null, ClassLoader::class);
    }
}
