<?php

use App\Kernel;
use Symfony\component\HttpFoundation\Request;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

$trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? $_ENV['TRUSTED_PROXIES'] ?? false;
$trustedProxies = $trustedProxies ? explode(',', $trustedProxies) : [];
if($_SERVER['APP_ENV'] == 'prod') $trustedProxies[] = $_SERVER['REMOTE_ADDR'];
if($trustedProxies) {
    Request::setTrustedProxies($trustedProxies, Request::HEADER_X_FORWARDED_AWS_ELB);
}

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
