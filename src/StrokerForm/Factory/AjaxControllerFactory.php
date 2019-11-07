<?php
/**
 * Description
 *
 * @category  Acsi
 * @package   Acsi\
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerForm\Factory;

use Interop\Container\ContainerInterface;
use StrokerForm\Controller\AjaxController;
use StrokerForm\FormManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AjaxControllerFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get(FormManager::class);
        $controller = new AjaxController($formManager);

        return $controller;
    }
}
