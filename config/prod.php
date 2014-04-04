<?php

use Silex\Provider\MonologServiceProvider;

// descomenta las siguientes líneas para activar la depuración
// en el entorno de producción
$app['debug'] = true;
$app->register(new MonologServiceProvider(), array(
     'monolog.logfile' => __DIR__.'/../logs/prod.log',
));

// Añadir a continuación cualquier otra opción de configuración de producción
// **********************************************************************************
 
// Título de la aplicación
$app['title'] = 'Cunicultura Villamalea S.C.L.';

// Destinatarios del formulario de contacto: comercial@logicom.es
$app['email_comercial'] = 'comercial@logicom.es';

// Swiftmailer config
$app['swiftmailer.options'] = array(
    'host'			=> 'smtp.gmail.com',
    'port'			=> 465,
    'username'		=> 'gplogic@gmail.com',
    'password'		=> 'LCLogCom_1931Ax',
    'encryption'	=> 'ssl',
    'auth_mode'		=> 'login'
);
