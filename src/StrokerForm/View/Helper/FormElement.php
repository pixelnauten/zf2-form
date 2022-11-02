<?php
/**
 * Extends the default zf2 forminput view helper
 *
 * @category  StrokerForm
 * @package   StrokerForm\View
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerForm\View\Helper;

use StrokerForm\Renderer\RendererInterface;
use Laminas\Form\ElementInterface;
use Laminas\Form\Exception;
use Laminas\Form\View\Helper\FormElement as BaseHelper;

class FormElement extends BaseHelper
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Render a form <input> element from the provided $element
     *
     * @param  ElementInterface $element
     *
     * @throws Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $this->renderer->preRenderInputField($element);

        return parent::render($element);
    }
}
