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
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class FormElementFactory implements \Laminas\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $renderer = $container->get('stroker_form.renderer');

        return new FormElement($renderer);
    }
}
