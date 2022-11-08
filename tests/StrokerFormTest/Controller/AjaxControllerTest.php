<?php

/**
 * Description.
 *
 * @category  Acsi
 *
 * @copyright 2012 Bram Gerritsen
 *
 * @version   SVN: $Id$
 */

namespace StrokerFormTest\Controller;

use StrokerForm\Controller\AjaxController;
use StrokerForm\FormManager;
use Laminas\Http\Request;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\Mvc\MvcEvent;
use Laminas\Mvc\Router\RouteMatch;
use Laminas\Stdlib\RequestInterface;
use Laminas\Stdlib\ResponseInterface;

class AjaxControllerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AbstractController
     */
    protected $controller;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var RouteMatch
     */
    protected $routeMatch;

    /**
     * @var MvcEvent
     */
    protected $event;

    /**
     * @var FormManager
     */
    protected $formManager;

    /**
     * Setup.
     */
    public function setUp(): void
    {
        $this->setFormManager(new FormManager());
        $this->controller = new AjaxController($this->getFormManager());
        $this->request = new Request();
        $this->response = new Response();

        $controllerName = strtolower(
            str_replace('Controller', '', get_class($this->controller))
        );
        $this->routeMatch = new RouteMatch(
            ['controller' => $controllerName]
        );
        $this->event = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
    }

    /**
     * testExceptionWhenNoPostDataIsProvided.
     */
    public function testExceptionWhenNoPostDataIsProvided()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->dispatchAction('validate');
    }

    /**
     * @param string $actionName
     *
     * @return mixed|\Laminas\Stdlib\ResponseInterface
     */
    protected function dispatchAction($actionName)
    {
        $this->getRouteMatch()->setParam('action', $actionName);

        return $this->getController()->dispatch(
            $this->getRequest(), $this->getResponse()
        );
    }

    /**
     * Assert response code matches given responseCode.
     *
     * @param int $responseCode
     */
    protected function assertResponseCode($responseCode)
    {
        $this->assertEquals(
            $responseCode, $this->getResponse()->getStatusCode()
        );
    }

    /**
     * Assert certain header is found.
     *
     * @param string $expectedValue
     * @param string $headerType
     */
    protected function assertHeader($expectedValue, $headerType)
    {
        $header = $this->getResponse()->getHeaders()->get($headerType);
        if ($header === false) {
            $this->fail('No '.$headerType.' header found');
        }
        $this->assertEquals($expectedValue, $header->getFieldValue());
    }

    /**
     * @return \Laminas\Mvc\Controller\AbstractController
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param \Laminas\Mvc\Controller\AbstractController $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Laminas\Stdlib\ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param \Laminas\Stdlib\ResponseInterface $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return \Laminas\Mvc\Router\RouteMatch
     */
    public function getRouteMatch()
    {
        return $this->routeMatch;
    }

    /**
     * @param \Laminas\Mvc\Router\RouteMatch $routeMatch
     */
    public function setRouteMatch($routeMatch)
    {
        $this->routeMatch = $routeMatch;
    }

    /**
     * @return \Laminas\Mvc\MvcEvent
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param \Laminas\Mvc\MvcEvent $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return FormManager
     */
    public function getFormManager()
    {
        return $this->formManager;
    }

    /**
     * @param FormManager $formManager
     */
    public function setFormManager(FormManager $formManager)
    {
        $this->formManager = $formManager;
    }
}
