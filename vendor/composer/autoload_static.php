<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita945b8e086c3ced411da9387a65738de
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita945b8e086c3ced411da9387a65738de::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita945b8e086c3ced411da9387a65738de::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
