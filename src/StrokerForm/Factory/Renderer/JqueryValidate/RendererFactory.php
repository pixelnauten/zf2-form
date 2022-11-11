<?php
/**
 * RendererFactory
 *
 * @category  StrokerForm\Factory\Renderer\JqueryValidate
 * @package   StrokerForm\Factory\Renderer\JqueryValidate
 * @copyright 2013 ACSI Holding bv (http://www.acsi.eu)
 * @version   SVN: $Id$
 */

namespace StrokerForm\Factory\Renderer\JqueryValidate;

use Interop\Container\ContainerInterface;
use StrokerForm\Renderer\JqueryValidate\Renderer;
use StrokerForm\Renderer\JqueryValidate\Rule\RulePluginManager;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class RendererFactory implements \Laminas\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $renderer = new Renderer();
        $pluginManager = new RulePluginManager($container);
        $renderer->setRulePluginManager($pluginManager);
        return $renderer;
    }
}
