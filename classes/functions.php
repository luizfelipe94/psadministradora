<?php

$function = new Twig_SimpleFunction('shortest', function ($a, $b) {
    return strlen($a) <= strlen($b) ? $a : $b;
  });
  
$container->get('view')->getEnvironment()->addFunction($function);

