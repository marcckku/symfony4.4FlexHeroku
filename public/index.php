<?php

use App\Kernel;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/config/bootstrap.php';

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? $_ENV['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? $_ENV['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}


////////////////////////////////////////////////////////////////////////////////////////
/*** Questo aggiunta di codice serve al router a Heroku  
 * Al fine di preservare la possibilità di impostare ulteriori intervalli 
 * IP proxy attendibili (ad esempio quando si utilizza un CDN), pur fidandosi 
 * del router Heroku, è possibile combinare la logica esistente che legge la 
 * variabile di ambiente TRUSTED_PROXIES con un'aggiunta condizionale di 
 * REMOTE_ADDR all'elenco in base all'ambiente dell'applicazione, in questo modo: 
 * 
 * Questo approccio è sicuro su Heroku, perché tutto il traffico verso la tua 
 * applicazione deve passare attraverso il router di Heroku, quindi puoi fare 
 * affidamento sul fatto che l'indirizzo IP remoto sia un proxy affidabile. 
 * In altri ambienti, potrebbe non essere così.
 * 
 *  * https://devcenter.heroku.com/articles/deploying-symfony4
*/
$trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? $_ENV['TRUSTED_PROXIES'] ?? false;
$trustedProxies = $trustedProxies ? explode(',', $trustedProxies) : [];
if($_SERVER['APP_ENV'] == 'prod'){
    $trustedProxies[] = $_SERVER['REMOTE_ADDR'];
}
if($trustedProxies) {
    Request::setTrustedProxies($trustedProxies, Request::HEADER_X_FORWARDED_AWS_ELB);
}
////////////////////////////////////////////////////////////////////////////////////////


$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
