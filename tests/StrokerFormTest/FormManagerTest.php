<?php

/**
 * FormManagerTest.
 *
 * @category  StrokerFormTest
 *
 * @copyright 2014 ACSI Holding bv (http://www.acsi.eu)
 *
 * @version   SVN: $Id$
 */

namespace StrokerFormTest;

use StrokerForm\FormManager;
use Laminas\Form\FormElementManagerFactory;
use Laminas\Form\FormInterface;
use Laminas\ServiceManager\ServiceManager;

class FormManagerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var FormManager
     */
    protected $manager;

    public function setUp(): void
    {
        $this->manager = new FormManager();
    }

    public function testIfValidatePluginValidatesCorrect()
    {
        $plugin = \Mockery::mock(FormInterface::class);
        $this->assertNull($this->manager->validatePlugin($plugin));
    }

    public function testIsValidatePluginValidatesIncorrect()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Form of type stdClass is invalid; must implement FormInterface');

        $plugin = new \StdClass();
        $this->manager->validatePlugin($plugin);
    }

    public function testIfFormElementManagerUsed()
    {
        $formMock = \Mockery::mock(FormInterface::class);

        $formElementManagerMock = \Mockery::mock(
            FormElementManagerFactory::class
        );
        $formElementManagerMock->shouldReceive('has')->with('Foobar')
            ->andReturn(true);
        $formElementManagerMock->shouldReceive('get')->with('Foobar')
            ->andReturn($formMock);

        $serviceManagerMock = \Mockery::mock(
            ServiceManager::class
        );
        $serviceManagerMock->shouldReceive('has')->with('FormElementManager')
            ->andReturn(true);
        $serviceManagerMock->shouldReceive('get')->with('FormElementManager')
            ->andReturn($formElementManagerMock);
        $this->manager->setServiceLocator($serviceManagerMock);

        $this->manager->get('Foobar');
    }

    public function testIfFormElementManagerNotUsed()
    {
        $formMock = \Mockery::mock(FormInterface::class);

        $formElementManagerMock = \Mockery::mock(
            FormElementManagerFactory::class
        );
        $formElementManagerMock->shouldReceive('has')->with('Foobar')
            ->andReturn(false);

        $serviceManagerMock = \Mockery::mock(
            ServiceManager::class
        );
        $serviceManagerMock->shouldReceive('has')->with('FormElementManager')
            ->andReturn(true);
        $serviceManagerMock->shouldReceive('get')->with('FormElementManager')
            ->andReturn($formElementManagerMock);
        $this->manager->setServiceLocator($serviceManagerMock);

        $this->manager->setService('Foobar', $formMock);

        $this->manager->get('Foobar');
    }
}
