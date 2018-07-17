<?php

$filter = new Twig_SimpleFilter('rot13', function ($string) {
    return str_rot13($string);
  });
  
  $container->get('view')->getEnvironment()->addFilter($filter);