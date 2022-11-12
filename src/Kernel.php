<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    private const COMMON_PATH = 'vendor/jefero/bot_common';

    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../' . self::COMMON_PATH . '/config/{packages}/*.yaml');
        $container->import('../' . self::COMMON_PATH . '/config/{packages}/' . (string)$this->environment . '/*.yaml');
        $container->import('../' . self::COMMON_PATH . '/config/services.yaml');
        $container->import('../' . self::COMMON_PATH . '/config/{services}_' . (string)$this->environment . '.yaml');

        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/services.yaml')) {
            $container->import('../config/services.yaml');
            $container->import('../config/{services}_'.$this->environment.'.yaml');
        } else {
            $container->import('../config/{services}.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {

        $routes->import('../' . self::COMMON_PATH . '/config/{routes}/' . (string)$this->environment . '/*.yaml');
        $routes->import('../' . self::COMMON_PATH . '/config/{routes}/*.yaml');

        $routes->import('../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/routes.yaml')) {
            $routes->import('../config/routes.yaml');
        } else {
            $routes->import('../config/{routes}.php');
        }
    }

    public function registerBundles(): iterable
    {
        /** @psalm-suppress UnresolvableInclude */
        $commonBundles = require $this->getProjectDir() . '/' . self::COMMON_PATH . '/config/bundles.php';
        /** @psalm-suppress UnresolvableInclude */
        $currentBundles = require $this->getProjectDir() . '/config/bundles.php';
        $bundles = array_merge($commonBundles, $currentBundles);

        foreach ($bundles as $class => $envs) {
            /** @psalm-suppress UndefinedClass */
            yield new $class();
        }
    }
}
