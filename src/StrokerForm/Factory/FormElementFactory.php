<?php
/**
 * Description
 *
 * @category  StrokerForm
 * @package   StrokerForm\Service
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerForm\Factory;

use Interop\Container\ContainerInterface;
use StrokerForm\View\Helper\FormElement;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormElementFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $renderer = $container->get('stroker_form.renderer');

        return new FormElement($renderer);
    }
}
