<?php

namespace ContainerFjPPtya;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getProductControllereditService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.MFPVaGP.App\Controller\ProductController::edit()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        $a = ($container->privates['.service_locator.MFPVaGP'] ?? $container->load('get_ServiceLocator_MFPVaGPService'));

        if (isset($container->privates['.service_locator.MFPVaGP.App\\Controller\\ProductController::edit()'])) {
            return $container->privates['.service_locator.MFPVaGP.App\\Controller\\ProductController::edit()'];
        }

        return $container->privates['.service_locator.MFPVaGP.App\\Controller\\ProductController::edit()'] = $a->withContext('App\\Controller\\ProductController::edit()', $container);
    }
}