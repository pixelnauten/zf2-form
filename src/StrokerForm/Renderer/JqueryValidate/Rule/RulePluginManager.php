<?php
/**
 * RulePluginManager
 *
 * @category  StrokerForm\Renderer\JqueryValidate\Rule
 * @package   StrokerForm\Renderer\JqueryValidate\Rule
 * @copyright 2013 ACSI Holding bv (http://www.acsi.eu)
 * @version   SVN: $Id$
 */

namespace StrokerForm\Renderer\JqueryValidate\Rule;

use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ConfigInterface;

class RulePluginManager extends AbstractPluginManager
{
    /**
     * Default set of rules
     *
     * @var array
     */
    protected $invokableClasses = [
        'between' => 'StrokerForm\Renderer\JqueryValidate\Rule\Between',
        'creditcard' => 'StrokerForm\Renderer\JqueryValidate\Rule\CreditCard',
        'digits' => 'StrokerForm\Renderer\JqueryValidate\Rule\Digits',
        'emailaddress' => 'StrokerForm\Renderer\JqueryValidate\Rule\EmailAddress',
        'greaterthan' => 'StrokerForm\Renderer\JqueryValidate\Rule\GreaterThan',
        'identical' => 'StrokerForm\Renderer\JqueryValidate\Rule\Identical',
        'lessthan' => 'StrokerForm\Renderer\JqueryValidate\Rule\LessThan',
        'notempty' => 'StrokerForm\Renderer\JqueryValidate\Rule\NotEmpty',
        'stringlength' => 'StrokerForm\Renderer\JqueryValidate\Rule\StringLength',
        'uri' => 'StrokerForm\Renderer\JqueryValidate\Rule\Uri',
        'inarray' => 'StrokerForm\Renderer\JqueryValidate\Rule\InArray',
        'regex' => 'StrokerForm\Renderer\JqueryValidate\Rule\Regex',
    ];


    /**
     * Constructor
     *
     * After invoking parent constructor, add an initializer to inject the
     * attached renderer and translator, if any, to the currently requested helper.
     *
     * @param null|ConfigInterface $configuration
     */
    public function __construct($configInstanceOrParentLocator = null)
    {
        parent::__construct($configInstanceOrParentLocator);

        $this->addInitializer([$this, 'injectTranslator']);
    }

    /**
     * {@inheritDoc}
     */
    public function validate($plugin)
    {
        if ($plugin instanceof RuleInterface) {
            // we're okay
            return;
        }

        throw new \InvalidArgumentException(
            sprintf(
                'Plugin of type %s is invalid; must implement %s\RuleInterface',
                (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
                __NAMESPACE__
            )
        );
    }

    /**
     * Inject a helper instance with the registered translator
     *
     * @param  RuleInterface $rule
     *
     * @return void
     */
    public function injectTranslator($rule)
    {
        if ($rule instanceof TranslatorAwareInterface) {
            $locator = $this->getServiceLocator();
            if ($locator && $locator->has('MvcTranslator')) {
                $rule->setTranslator($locator->get('MvcTranslator'));
            } elseif ($locator && $locator->has('translator')) {
                $rule->setTranslator($locator->get('translator'));
            }
        }
    }

    public function getRegisteredServices()
    {
        return [
            'invokableClasses' => $this->invokableClasses,
            'factories' => array_keys($this->factories),
            'aliases' => array_keys($this->aliases),
        ];
    }
}
