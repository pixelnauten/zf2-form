<?php
/**
 * Description
 *
 * @category  StrokerForm
 * @package   StrokerForm\Options
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerForm\Factory;

use Interop\Container\ContainerInterface;
use RuntimeException;
use StrokerForm\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $container->get('Config');
        $options = isset($options['stroker_form']) ? $options['stroker_form'] : null;

        if (null === $options) {
            throw new RuntimeException('Configuration with key stroker_form not found');
        }

        return new ModuleOptions($options);
    }

}
