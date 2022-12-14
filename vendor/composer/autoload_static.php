<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite314b7f7594cb7bd09ab5d32ec229e88
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MF\\' => 3,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MF\\' => 
        array (
            0 => __DIR__ . '/../..' . '/MF',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite314b7f7594cb7bd09ab5d32ec229e88::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite314b7f7594cb7bd09ab5d32ec229e88::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite314b7f7594cb7bd09ab5d32ec229e88::$classMap;

        }, null, ClassLoader::class);
    }
}
