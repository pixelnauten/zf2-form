<?php

/**
 * FormElementTest.
 *
 * @category  StrokerFormTest
 *
 * @copyright 2016 Bram Gerritsen
 *
 * @version   SVN: $Id$
 */

namespace StrokerFormTest\Controller;

use Mockery as M;
use PHPUnit\Framework\TestCase;
use StrokerForm\Renderer\RendererInterface;
use StrokerForm\View\Helper\FormElement;
use Laminas\Form\ElementInterface;

class FormElementTest extends \PHPUnit\Framework\TestCase
{
    public function testRenderInput()
    {
        $elementMock = M::mock(ElementInterface::class);
        $rendererMock = M::mock(RendererInterface::class)
            ->shouldReceive('preRenderInputField')
            ->with($elementMock)
            ->once()
            ->getMock();

        $helper = new FormElement($rendererMock);
        $helper->__invoke($elementMock);
    }

    public function testHelperExtendsBaseZendHelper()
    {
        $helper = new FormElement(
            M::mock(RendererInterface::class)
        );
        $this->assertInstanceOf(FormElement::class, $helper);
    }
}
