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
use StrokerForm\Renderer\RendererCollection;
use StrokerForm\Renderer\RendererInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RendererFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var $options ModuleOptions */
        $options = $container->get(ModuleOptions::class);
        $rendererCollection = new RendererCollection();

        foreach ($options->getActiveRenderers() as $rendererAlias) {
            /** @var $renderer RendererInterface */
            $renderer = $container->get($rendererAlias);
            $renderer->setDefaultOptions($options->getRendererOptions($rendererAlias));
            $renderer->setFormManager($container->get(FormManager::class));
            if ($container->has('translator')) {
                $renderer->setTranslator($container->get('translator'));
            }
            $renderer->setHttpRouter($container->get('HttpRouter'));
            $rendererCollection->addRenderer($renderer);
        }

        return $rendererCollection;
    }
}
