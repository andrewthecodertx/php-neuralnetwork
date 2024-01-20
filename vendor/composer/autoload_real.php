<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit2852bd2bf07429a26a71a8978551a95a
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit2852bd2bf07429a26a71a8978551a95a', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit2852bd2bf07429a26a71a8978551a95a', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit2852bd2bf07429a26a71a8978551a95a::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}