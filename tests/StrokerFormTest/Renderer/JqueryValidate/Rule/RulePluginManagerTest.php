<?php

/**
 * Description.
 *
 * @category  StrokerFormTest
 *
 * @copyright 2012 Bram Gerritsen
 *
 * @version   SVN: $Id$
 */

namespace StrokerFormTest\Renderer\JqueryValidate\Rule;

use stdClass;
use StrokerForm\Renderer\JqueryValidate\Rule\NotEmpty;
use StrokerForm\Renderer\JqueryValidate\Rule\RuleInterface;
use StrokerForm\Renderer\JqueryValidate\Rule\RulePluginManager;
use Laminas\I18n\Translator\Translator;
use Laminas\ServiceManager\ServiceManager;

class RulePluginManagerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var RulePluginManager
     */
    protected $pluginManager;

    public function setUp(): void
    {
        $this->pluginManager = new RulePluginManager();
        $serviceManager = new ServiceManager();
        $serviceManager->setService('MvcTranslator', new Translator());
        $this->pluginManager->setServiceLocator($serviceManager);
    }

    public function testInstancesCanBeCreated()
    {
        $services = $this->pluginManager->getRegisteredServices();
        $invokables = $services['invokableClasses'];
        foreach ($invokables as $alias) {
            $instance = $this->pluginManager->get($alias);
            $this->assertInstanceOf(
                RuleInterface::class,
                $instance
            );
        }
    }

    public function testTranslatorIsInjected()
    {
        $instance = $this->pluginManager->get('digits');
        $this->assertNotNull($instance->getTranslator());
    }

    public function testValidatePluginSuccess()
    {
        $rule = new NotEmpty();
        $this->pluginManager->validatePlugin($rule);
    }

    public function testValidatePluginFails()
    {
        $this->expectException(\InvalidArgumentException::class);

        $rule = new StdClass();
        $this->pluginManager->validatePlugin($rule);
    }
}
