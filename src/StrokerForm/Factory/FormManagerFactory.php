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
use StrokerForm\FormManager;
use StrokerForm\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormManagerFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var $moduleOptions ModuleOptions */
        $moduleOptions = $container->get(ModuleOptions::class);

        // init FormManager
        $manager = new FormManager($container);
        $manager->configure($moduleOptions->getForms()->toArray());

        return $manager;
    }
}
