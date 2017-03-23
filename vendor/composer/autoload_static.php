<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit52f4e406c481a474074173a1b085839c
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Naux\\IpLocation\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Naux\\IpLocation\\' => 
        array (
            0 => __DIR__ . '/..' . '/naux/iplocation',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit52f4e406c481a474074173a1b085839c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit52f4e406c481a474074173a1b085839c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
