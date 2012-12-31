# StrokerForm

ZF2 module for extending forms with live clientside validation without need to write js validation code.
For basic usage examples see the sandbox project [StrokerFormSandbox](https://github.com/bramstroker/zf2-form-sandbox).

[![Build Status](https://travis-ci.org/bramstroker/zf2-form.png?branch=master)](https://travis-ci.org/bramstroker/zf2-form)

## Installation

Installation of StrokerCache uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

  1. `cd my/project/directory`
  2. create or modify the `composer.json` file within your ZF2 application file with
     following contents:

     ```json
     {
         "require": {
             "stroker/form": "*"
         }
     }
     ```
  3. install composer via `curl -s https://getcomposer.org/installer | php` (on windows, download
     https://getcomposer.org/installer and execute it with PHP). Then run `php composer.phar install`
  4. open `my/project/directory/configs/application.config.php` and add the following key to your `modules`:

     ```php
     'StrokerForm',
     ```
  5. copy the assets to your public folder (my/project/directory/public).

## Usage

First we need to make sure jquery is loaded by our application and the headScript() and inlineScript() view helpers are called. If you already have this in place you can skip this step.

  <head>
    <?php echo $this->headLink() ?>
  	<?php echo $this->headScript()->prependFile('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js') ?>
  </head>
  <body>
  <div class="container">
  	<?php echo $this->content; ?>
  </div>
  <?php echo $this->inlineScript() ?>
  </body>

For the ajax validation to work inputfilters needs to be hooked to the form.
We need to create a serviceFactory and register it with a unique alias to the formManager (this is an pluginManager).
If the inputFilters are already set to the form (i.e. in your form constructor) it's enough to register the form as an invokable

```php
<?php
namespace MyProject\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

class MyFormFactory implements \Zend\ServiceManager\FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new MyForm();
        $model = new MyModel();
        $form->setInputFilter($model->getInputFilter());
        return $form;
    }
}
```

Now let's add our new factory to the formManager.

```php
<?php
return array(
    'stroker_form' => array(
        'forms' => array(
            'factories' => array(
                'my_form_alias' => 'MyProject\Service\MyFormFactory'
            )
        )
    )
);
```

Last thing we need to do is invoking the StrokerFormPrepare view helper where you are rendering your form.
This view helper add all the needed javascripts to the headScript view helper

```php
<?php
echo $this->strokerFormPrepare('my_form_alias');

// Do your normal form rendering here
