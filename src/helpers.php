<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Get template engine
 *
 * @return Environment
 */
function getTwig(): Environment
{
    $loader = new FilesystemLoader(__DIR__ . '/Templates');
    $twig = new Environment($loader);
    $twig->addGlobal('isLoggedIn', isUserAuthenticated());
    return $twig;
}

/**
 * Load service container
 *
 * @return ContainerBuilder
 * @throws Exception
 */
function getContainer(): ContainerBuilder
{
    $containerBuilder = new ContainerBuilder();
    $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
    $loader->load(__DIR__ . '/../services.yaml');

    return $containerBuilder;
}

/***
 *
 * @return bool
 */
function isUserAuthenticated()
{
    return isset($_SESSION['user']);
}



