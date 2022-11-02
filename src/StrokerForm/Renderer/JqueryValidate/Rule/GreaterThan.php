<?php
/**
 * GreaterThan
 *
 * @category  StrokerForm
 * @package   StrokerForm\Renderer
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerForm\Renderer\JqueryValidate\Rule;

use Laminas\Form\ElementInterface;
use Laminas\Validator\ValidatorInterface;
use Laminas\Validator\GreaterThan as GreaterThanValidator;

class GreaterThan extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function getRules(ValidatorInterface $validator, ElementInterface $element = null)
    {
        return ['min' => $validator->getMin()];
    }

    /**
     * {@inheritDoc}
     */
    public function getMessages(ValidatorInterface $validator)
    {
        return [
            'min' =>
                sprintf($this->translateMessage('The input is not greater than %s'), $validator->getMin())
        ];
    }

    /**
     * Whether this rule supports certain validators
     *
     * @param ValidatorInterface $validator
     * @return mixed
     */
    public function canHandle(ValidatorInterface $validator)
    {
        return $validator instanceof GreaterThanValidator;
    }
}
