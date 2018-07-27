<?php
/*
Twig extension
This package comes with a Twig extension to display error messages and submitted values in your Twig templates. You can skip this step if you don't want to use it.

To use the extension, you must install twig first


$ composer require slim/twig-view
Configuration
$container['view'] = function ($container) {
    // Twig configuration
    $view = new Slim\Views\Twig(...);
    // ...

    // Add the validator extension
    $view->addExtension(
        new Awurth\SlimValidation\ValidatorExtension($container['validator'])
    );

    return $view;
};
Functions
{# Use has_errors() function to know if a form contains errors #}
{{ has_errors() }}

{# Use has_error() function to know if a request parameter is invalid #}
{{ has_error('param') }}

{# Use error() function to get the first error of a parameter #}
{{ error('param') }}

{# Use errors() function to get all errors #}
{{ errors() }}

{# Use errors() function with the name of a parameter to get all errors of a parameter #}
{{ errors('param') }}

{# Use val() function to get the value of a parameter #}
{{ val('param') }}
Example
AuthController.php
public function register(Request $request, Response $response)
{
    if ($request->isPost()) {
        $this->validator->validate($request, [
            'username' => V::length(6, 25)->alnum('_')->noWhitespace(),
            'email' => V::notBlank()->email(),
            'password' => V::length(6, 25),
            'confirm_password' => V::equals($request->getParam('password'))
        ]);
        
        if ($this->validator->isValid()) {
            // Register user in database
            
            return $response->withRedirect('url');
        }
    }
    
    return $this->view->render($response, 'register.twig');
}

?>

register.twig

<form action="url" method="POST">
    <input type="text" name="username" value="{{ val('username') }}">
    {% if has_error('username') %}<span>{{ error('username') }}</span>{% endif %}
    
    <input type="text" name="email" value="{{ val('email') }}">
    {% if has_error('email') %}<span>{{ error('email') }}</span>{% endif %}
    
    <input type="text" name="password">
    {% if has_error('password') %}<span>{{ error('password') }}</span>{% endif %}
    
    <input type="text" name="confirm_password">
    {% if has_error('confirm_password') %}<span>{{ error('confirm_password') }}</span>{% endif %}
</form>