<?php

/**
 * Cunicultura web
 * 
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// -- PORTADA ------------------------------------------------------------------
$app->get('/', function (Request $request) use ($app) {
    return $app['twig']->render('portada.html.twig', array());
})
->bind('portada');

$app->get('/inicio', function() use ($app) {
    return $app -> redirect($app['url_generator']->generate('portada'));
})
->bind('inicio');

// --- SITIO -------------------------------------------------------------------
/*$app->get('/distribuidor', function (Request $request) use ($app) {
	return $app['twig']->render('distribuidor.html.twig', array());
})
->bind('distribuidor');*/

$app->get('/donde', function (Request $request) use ($app) {
	return $app['twig']->render('donde.html.twig', array());
})
->bind('donde');

$app->get('/kaamerp', function (Request $request) use ($app) {
	return $app['twig']->render('kaamerp.html.twig', array());
})
->bind('kaamerp');

$app->get('/kaamcrm', function (Request $request) use ($app) {
	return $app['twig']->render('kaamcrm.html.twig', array());
})
->bind('kaamcrm');

$app->get('/agrokaam', function (Request $request) use ($app) {
	return $app['twig']->render('agrokaam.html.twig', array());
})
->bind('agrokaam');

$app->get('/bambu', function (Request $request) use ($app) {
	return $app['twig']->render('bambucloud.html.twig', array());
})
->bind('bambu');

$app->get('/formacion', function (Request $request) use ($app) {
	return $app['twig']->render('formacion.html.twig', array());
})
->bind('formacion');

$app->get('/idi', function (Request $request) use ($app) {
	return $app['twig']->render('idi.html.twig', array());
})
->bind('idi');

/*$app->get('/partners', function (Request $request) use ($app) {
	return $app['twig']->render('partners.html.twig', array());
})
->bind('partners');*/

// --- BUSCADOR ----------------------------------------------------------------
$app->post('/buscador', function (Request $request) use ($app) {
	
	// Obtenemos el texto a buscar
	$busqueda = trim($request->get('busqueda'));

	if ($busqueda != '') {

		// Array asociativo de resultados:
		// La clave es el posible texto a buscar
		// El valor es un un array asociativo con: 
		// 		claves como paths twig 
		// 		valores como texto resultado de esa búsqueda
		$posibles = array(
			'agricola' => array(
				'agrokaam' => 'Agrokaam es un conjunto de herramientas hardware y software que le permitirán controlar con sencillez la trazabilidad y seguridad de los alimentos, desde sus inicios hasta que llega el producto al consumidor final tanto para productos convencionales como ecológicos (orgánicos).'
				),
			'agro' => array(
				'agrokaam' => 'Agrokaam es un conjunto de herramientas hardware y software que le permitirán controlar con sencillez la trazabilidad y seguridad de los alimentos, desde sus inicios hasta que llega el producto al consumidor final tanto para productos convencionales como ecológicos (orgánicos).'
				),
			'agrokaam' => array(
				'agrokaam' => 'Agrokaam es un conjunto de herramientas hardware y software que le permitirán controlar con sencillez la trazabilidad y seguridad de los alimentos, desde sus inicios hasta que llega el producto al consumidor final tanto para productos convencionales como ecológicos (orgánicos).'
				),
			'agronegocios' => array(
				'agrokaam' => 'Agrokaam es un conjunto de herramientas hardware y software que le permitirán controlar con sencillez la trazabilidad y seguridad de los alimentos, desde sus inicios hasta que llega el producto al consumidor final tanto para productos convencionales como ecológicos (orgánicos).'
				),
			'asistencia' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'bambu' => array(
				'bambu' => 'Bambú Cloud es una completa gestión empresarial orientada principalmente a Pymes y autónomos.'
				),
			'clase' => array(
				'formacion' => 'Formación Online, cursos, etc...'
				),
			'clases' => array(
				'formacion' => 'Formación Online, cursos, etc...'
				),
			'cloud' => array(
				'bambu' => 'Bambú Cloud es una completa gestión empresarial orientada principalmente a Pymes y autónomos.'
				),
			'contabilidad' => array(
				'kaamerp' => 'Kaam ERP + Contabilidad: Controle la producción, gestione sus productos, realice multitud de entradas en sus productos o, simplemente, obtenga unas detalladas estadísticas para su trazabilidad.'
				),
			'contacto' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'crm' => array(
				'kaamcrm' => 'Kaam CRM es un sistema de comunicación entre el cliente y su entorno basado en tecnología Web 3.0.'
				),
			'cursos' => array(
				'formacion' => 'Formación Online, cursos, etc...'
				),
			'desarrollo' => array(
				'idi' => 'Investigación, desarrollo e innovación'
				),
			'direccion' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'docencia' => array(
				'formacion' => 'Formación Online, cursos, etc...'
				),
			'donde' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'erp' => array(
				'kaamerp' => 'Kaam ERP + Contabilidad: Controle la producción, gestione sus productos, realice multitud de entradas en sus productos o, simplemente, obtenga unas detalladas estadísticas para su trazabilidad.'
				),
			'formacion' => array(
				'formacion' => 'Formación Online, cursos, etc...'
				),
			'gestion' => array(
				'kaamerp' => 'Kaam ERP + Contabilidad: Controle la producción, gestione sus productos, realice multitud de entradas en sus productos o, simplemente, obtenga unas detalladas estadísticas para su trazabilidad.',
				'kaamcrm' => 'Kaam CRM es un sistema de comunicación entre el cliente y su entorno basado en tecnología Web 3.0.',
				'agrokaam' => 'Agrokaam es un conjunto de herramientas hardware y software que le permitirán controlar con sencillez la trazabilidad y seguridad de los alimentos, desde sus inicios hasta que llega el producto al consumidor final tanto para productos convencionales como ecológicos (orgánicos).'
				),
			'home' => array(
				'portada' => 'Portada del sitio Logicom'
				),
			'homepage' => array(
				'portada' => 'Portada del sitio Logicom'
				),
			'hortosaas' => array(
				'idi' => 'Investigación, desarrollo e innovación'
				),
			'i+d+i' => array(
				'idi' => 'Investigación, desarrollo e innovación'
				),
			'inicio' => array(
				'portada' => 'Portada del sitio Logicom'
				),
			'innovacion' => array(
				'idi' => 'Investigación, desarrollo e innovación'
				),
			'investigacion' => array(
				'idi' => 'Investigación, desarrollo e innovación'
				),
			'kaam' => array(
				'kaamerp' => 'Kaam ERP + Contabilidad: Controle la producción, gestione sus productos, realice multitud de entradas en sus productos o, simplemente, obtenga unas detalladas estadísticas para su trazabilidad.',
				'kaamcrm' => 'Kaam CRM es un sistema de comunicación entre el cliente y su entorno basado en tecnología Web 3.0.',
				'agrokaam' => 'Agrokaam es un conjunto de herramientas hardware y software que le permitirán controlar con sencillez la trazabilidad y seguridad de los alimentos, desde sus inicios hasta que llega el producto al consumidor final tanto para productos convencionales como ecológicos (orgánicos).'
				),
			'localizacion' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'portada' => array(
				'portada' => 'Portada del sitio Logicom'
				),
			'productos' => array(
				'agrokaam' => 'Agrokaam es un conjunto de herramientas hardware y software que le permitirán controlar con sencillez la trazabilidad y seguridad de los alimentos, desde sus inicios hasta que llega el producto al consumidor final tanto para productos convencionales como ecológicos (orgánicos).',
				'bambu' => 'Bambú Cloud es una completa gestión empresarial orientada principalmente a Pymes y autónomos.',
				'kaamerp' => 'Kaam ERP + Contabilidad: Controle la producción, gestione sus productos, realice multitud de entradas en sus productos o, simplemente, obtenga unas detalladas estadísticas para su trazabilidad.',
				'kaamcrm' => 'Kaam CRM es un sistema de comunicación entre el cliente y su entorno basado en tecnología Web 3.0.'
				),
			'situacion' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'team' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'teamviewer' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'técnicos' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'telefono' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
			'viewer' => array(
				'contacto' => 'Contacte con nosotros: Rellene el formulario de contacto, descárguese la herramienta para asistencia técnica remota, etc.',
				'donde' => '¿Dónde estamos?'
				),
		);

		// Arrays que almacenarán los resultados
		// Inicialmente vacíos
		$resultados = array();

		$array_busqueda = explode(" ", $busqueda);
		
		// Debug
		$app['monolog']->addDebug('Búsqueda: '.$busqueda);
		
		foreach ($array_busqueda as $valor) {
			// Debug
			$app['monolog']->addDebug('Elemento de búsqueda sin limpiar: '.$valor);
			// convertimos en minúsculas y quitamos espacios en blanco sobrantes
			$valor_limpiado = strtolower(trim($valor));

			// quitamos acentos
			$acentos = array("á", "é", "í", "ó", "ú"); 
			$reemplazo = array("a", "e", "i", "o", "u");

			$valor_sin_acentos = str_replace($acentos, $reemplazo, $valor_limpiado);
			$app['monolog']->addDebug('Búsqueda limpiada: '.$valor_sin_acentos);

			if (array_key_exists($valor_sin_acentos, $posibles)) {
				// La búsqueda está en los posibles resultados
				foreach ($posibles[strtolower($valor_sin_acentos)] as $key => $value) {
					// Comprobamos que el resultado esté ya o no en el array resultado

					// Debug
					$app['monolog']->addDebug('Resultado Key añadida: '.$key);
					$app['monolog']->addDebug('Resultado Value añadido: '.$value);
					
					if (!array_key_exists($key, $resultados)) {
						// Añadimos el nuevo par clave, valor
						$resultados[$key] = $value;
					}
				}
			}
		}

		return $app['twig']->render('buscar.html.twig', array(
			'vacio' => false,
			'busqueda' => $busqueda,
			'resultados' => $resultados
		));

	} else {
		
		return $app['twig']->render('buscar.html.twig', array(
			'vacio' => true,
			'busqueda' => $busqueda,
			'resultados' => null
		));
	}

})
->bind('buscar');

// -----------------------------------------------------------------------------
$app->match('/contacto', function (Request $request) use ($app) {
	
	if ($request->getMethod() == 'POST') {
		// Obtenemos los datos del formulario
		$nombre = $request->get('nombre');
		$email = $request->get('email');
		$tipo = $request->get('tipo');
		$mensaje = $request->get('mensaje');
		
		// Construimos el cuerpo del mensaje
        if ($tipo == 'comercial') {
        	$asunto = "Logicom: Correo comercial";
        } else {
        	$asunto = "Logicom: Asistencia técnica";
        }

        $body = "<h1>".$asunto."</h1><hr>";
		$body .= "<p>Nombre o empresa: <strong>".$nombre."</strong></p>";
		$body .= "<p>Email: <strong>".$email."</strong></p>";
		$body .= "".$mensaje;

		$message = \Swift_Message::newInstance()
			->setContentType('text/html')
			->setCharset('UTF-8')
	        ->setSubject($asunto)
	        ->setFrom(array('noreply@logicom.com'))
	        ->setBody($body);

        if ($tipo == 'comercial') {
        	$message->setTo($app['email_comercial']);
        } else {
        	$message->setTo($app['email_asistencia']);
        }

	    $app['mailer']->send($message);

		return $app['twig']->render('contacto.html.twig', array(
			'enviado' => true
		));

	} else {
		return $app['twig']->render('contacto.html.twig', array(
			'enviado' => false
		));
	}
})
->method('GET|POST')
->bind('contacto');