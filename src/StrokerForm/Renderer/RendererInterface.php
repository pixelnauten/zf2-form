<?php
/**
 * Description
 *
 * @category  StrokerForm
 * @package   StrokerForm\Renderer
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerForm\Renderer;

use Laminas\Form\ElementInterface;
use Laminas\Form\FormInterface;
use Laminas\Mvc\Router\RouteInterface;
use Laminas\Stdlib\AbstractOptions;
use Laminas\View\Renderer\PhpRenderer as View;

interface RendererInterface
{
    /**
     * Excecuted before the ZF2 view helper renders the element
     *
     * @param string                   $formAlias
     * @param View                     $view
     * @param \Laminas\Form\FormInterface $form
     * @param array                    $options
     *
     * @return
     */
    public function preRenderForm($formAlias, View $view, FormInterface $form = null, array $options = []);

    /**
     * Excecuted before the ZF2 view helper renders the element
     *
     * @param ElementInterface $element
     */
    public function preRenderInputField(ElementInterface $element);

    /**
     * Set the route to use for serving assets
     *
     * @param  \Laminas\Mvc\Router\RouteInterface $route
     *
     * @return mixed
     */
    public function setHttpRouter(RouteInterface $route);

    /**
     * Set renderer options
     *
     * @param AbstractOptions $options
     */
    public function setDefaultOptions(AbstractOptions $options = null);
}
