<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9ed34a9dfb7bc6c4ebafad952ac477a0
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'Anizen\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Anizen\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit9ed34a9dfb7bc6c4ebafad952ac477a0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9ed34a9dfb7bc6c4ebafad952ac477a0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9ed34a9dfb7bc6c4ebafad952ac477a0::$classMap;

        }, null, ClassLoader::class);
    }
}