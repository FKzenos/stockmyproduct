<?php

namespace ContainerFjPPtya;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getStockMovementControllereditService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.lFy6oZR.App\Controller\StockMovementController::edit()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        $a = ($container->privates['.service_locator.lFy6oZR'] ?? $container->load('get_ServiceLocator_LFy6oZRService'));

        if (isset($container->privates['.service_locator.lFy6oZR.App\\Controller\\StockMovementController::edit()'])) {
            return $container->privates['.service_locator.lFy6oZR.App\\Controller\\StockMovementController::edit()'];
        }

        return $container->privates['.service_locator.lFy6oZR.App\\Controller\\StockMovementController::edit()'] = $a->withContext('App\\Controller\\StockMovementController::edit()', $container);
    }
}
