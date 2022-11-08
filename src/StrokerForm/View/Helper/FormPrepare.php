<?php
/**
 * This view helper makes the view and form available in the renderers
 *
 * @category  StrokerForm
 * @package   StrokerForm\View
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerForm\View\Helper;

use StrokerForm\Renderer\RendererInterface;
use Laminas\Form\FormInterface;
use Laminas\Form\View\Helper\AbstractHelper;

class FormPrepare extends AbstractHelper
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
     * @param string                   $formAlias
     * @param \Laminas\Form\FormInterface $form
     * @param array                    $options
     */
    public function __invoke($formAlias, FormInterface $form = null, array $options = [])
    {
        $this->renderer->preRenderForm($formAlias, $this->getView(), $form, $options);
    }
}
